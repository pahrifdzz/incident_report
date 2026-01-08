<?php

namespace App\Http\Controllers;

use App\Mail\NewReportNotification;
use App\Models\Report;
use App\Models\User;
use App\Services\LocalStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    // Tampilkan form pelaporan
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Simpan laporan ke database dengan Cloudinary upload
     * Clean Code: Clear method name, proper error handling
     */
    public function store(Request $request)
    {
        try {
            // Validation rules dengan update untuk Cloudinary dan status_kejadian
            $request->validate([
                'nama_pelapor' => 'required|string|max:255',
                'nomor_whatsapp' => 'required|string|max:20',
                'departemen' => 'required|string|max:255',
                'nik' => 'required|string|max:50',
                'keterangan' => 'required|string',
                'status_kejadian' => 'required|in:hampir_celaka,kecelakaan', // Validasi status kejadian
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            ]);

            $localUrl = null;
            $localPath = null;

            // Handle file upload ke local storage
            if ($request->hasFile('foto')) {
                $localStorageService = new LocalStorageService();
                $uploadResult = $localStorageService->uploadImage($request->file('foto'), '');

                if ($uploadResult['success']) {
                    $localUrl = $uploadResult['public_url'];
                    $localPath = $uploadResult['path'];

                    Log::info('Report photo uploaded to local storage', [
                        'path' => $localPath,
                        'url' => $localUrl
                    ]);
                } else {
                    Log::error('Failed to upload photo to local storage', [
                        'error' => $uploadResult['error']
                    ]);
                    return redirect()->back()->with('error', 'Gagal mengupload foto. Silakan coba lagi.');
                }
            }

            // Create report dengan local storage URL dan status_kejadian
            $report = Report::create([
                'nama_pelapor' => $request->nama_pelapor,
                'nomor_whatsapp' => $request->nomor_whatsapp,
                'departemen' => $request->departemen,
                'nik' => $request->nik,
                'keterangan' => $request->keterangan,
                'status_kejadian' => $request->status_kejadian, // Store status kejadian
                'foto' => $localUrl, // Store local storage URL
                'cloudinary_public_id' => $localPath, // Store local path for future operations
                'status' => 'baru',
            ]);

            Log::info('Report created successfully', [
                'report_id' => $report->id,
                'has_photo' => !is_null($localUrl)
            ]);

            // Kirim notifikasi email ke semua admin
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                try {
                    Mail::to($admin->email)->send(new NewReportNotification($report));
                    Log::info('Notification email sent to admin', [
                        'admin_email' => $admin->email,
                        'report_id' => $report->id
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to send notification email to admin', [
                        'admin_email' => $admin->email,
                        'report_id' => $report->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Laporan berhasil dikirim! Terima kasih atas pelaporannya.');

        } catch (\Exception $e) {
            Log::error('Failed to create report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim laporan. Silakan coba lagi.');
        }
    }
}
