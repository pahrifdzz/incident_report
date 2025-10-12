<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            // Validation rules dengan update untuk Cloudinary
            $request->validate([
                'nama_pelapor' => 'required|string|max:255',
                'nomor_whatsapp' => 'required|string|max:20',
                'departemen' => 'required|string|max:255',
                'nik' => 'required|string|max:50',
                'keterangan' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            ]);

            $cloudinaryUrl = null;
            $cloudinaryPublicId = null;

            // Handle file upload ke Cloudinary
            if ($request->hasFile('foto')) {
                $cloudinaryService = new CloudinaryService();
                $uploadResult = $cloudinaryService->uploadImage($request->file('foto'), 'reports');

                if ($uploadResult['success']) {
                    $cloudinaryUrl = $uploadResult['secure_url'];
                    $cloudinaryPublicId = $uploadResult['public_id'];

                    Log::info('Report photo uploaded to Cloudinary', [
                        'public_id' => $cloudinaryPublicId,
                        'url' => $cloudinaryUrl
                    ]);
                } else {
                    Log::error('Failed to upload photo to Cloudinary', [
                        'error' => $uploadResult['error']
                    ]);
                    return redirect()->back()->with('error', 'Gagal mengupload foto. Silakan coba lagi.');
                }
            }

            // Create report dengan Cloudinary URL
            $report = Report::create([
                'nama_pelapor' => $request->nama_pelapor,
                'nomor_whatsapp' => $request->nomor_whatsapp,
                'departemen' => $request->departemen,
                'nik' => $request->nik,
                'keterangan' => $request->keterangan,
                'foto' => $cloudinaryUrl, // Store Cloudinary URL instead of local path
                'cloudinary_public_id' => $cloudinaryPublicId, // Store public ID for future operations
                'status' => 'baru',
            ]);

            Log::info('Report created successfully', [
                'report_id' => $report->id,
                'has_photo' => !is_null($cloudinaryUrl)
            ]);

            return redirect()->back()->with('success', 'Laporan berhasil dikirim! Terima kasih atas pelaporannya.');

        } catch (\Exception $e) {
            Log::error('Failed to create report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim laporan. Silakan coba lagi.');
        }
    }
}
