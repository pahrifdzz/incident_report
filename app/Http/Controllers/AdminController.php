<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Services\CloudinaryService;
use App\Exports\ReportsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

/**
 * AdminController - Handle semua fungsi admin dashboard
 * Clean Architecture: Single responsibility untuk admin operations
 */
class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan semua laporan
     * Clean Code: Clear method name, proper error handling
     */
    public function index()
    {
        try {
            // Debug: Log sebelum mengambil data
            Log::info('AdminController::index - Starting data fetch');

            // Ambil semua laporan terbaru dari database dengan pagination
            $reports = Report::orderBy('created_at', 'desc')->paginate(10);

            // Debug: Log data yang diambil
            Log::info('AdminController::index - Reports fetched', [
                'count' => $reports->count(),
                'total' => $reports->total(),
                'current_page' => $reports->currentPage(),
                'per_page' => $reports->perPage()
            ]);

            // Debug: Log sample data
            if ($reports->count() > 0) {
                Log::info('AdminController::index - Sample report data', [
                    'first_report' => $reports->first()->nama_pelapor,
                    'first_status' => $reports->first()->status
                ]);
            }

            return view('admin.simple-dashboard', compact('reports'));
        } catch (\Exception $e) {
            Log::error('AdminController::index - Error: ' . $e->getMessage());
            Log::error('AdminController::index - Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Terjadi kesalahan saat memuat dashboard: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail dari satu laporan.
     */
    public function show(Report $report)
    {
        try {
            return view('admin.show', compact('report'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat detail laporan: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat detail laporan.');
        }
    }

    /**
     * Memperbarui status laporan (baru → diproses → selesai) dan upload foto penanganan.
     */
    public function updateStatus(Request $request, Report $report)
    {
        $validated = $request->validate([
            'status' => 'required|in:baru,proses,selesai',
            'foto_sebelum' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'foto_sesudah' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ]);

        try {
            $updateData = ['status' => $validated['status']];

            // Handle foto sebelum upload
            if ($request->hasFile('foto_sebelum')) {
                $cloudinaryService = new CloudinaryService();
                $uploadResult = $cloudinaryService->uploadImage($request->file('foto_sebelum'), 'reports');

                if ($uploadResult['success']) {
                    $updateData['foto_sebelum'] = $uploadResult['secure_url'];
                    $updateData['cloudinary_public_id_sebelum'] = $uploadResult['public_id'];

                    Log::info('Foto sebelum kejadian uploaded to Cloudinary', [
                        'report_id' => $report->id,
                        'public_id' => $uploadResult['public_id'],
                        'url' => $uploadResult['secure_url']
                    ]);
                } else {
                    Log::error('Failed to upload foto sebelum kejadian to Cloudinary', [
                        'report_id' => $report->id,
                        'error' => $uploadResult['error']
                    ]);
                    return redirect()->back()->with('error', 'Gagal mengupload foto sebelum kejadian. Silakan coba lagi.');
                }
            }

            // Handle foto sesudah upload
            if ($request->hasFile('foto_sesudah')) {
                $cloudinaryService = new CloudinaryService();
                $uploadResult = $cloudinaryService->uploadImage($request->file('foto_sesudah'), 'reports');

                if ($uploadResult['success']) {
                    $updateData['foto_sesudah'] = $uploadResult['secure_url'];
                    $updateData['cloudinary_public_id_sesudah'] = $uploadResult['public_id'];

                    Log::info('Foto sesudah kejadian uploaded to Cloudinary', [
                        'report_id' => $report->id,
                        'public_id' => $uploadResult['public_id'],
                        'url' => $uploadResult['secure_url']
                    ]);
                } else {
                    Log::error('Failed to upload foto sesudah kejadian to Cloudinary', [
                        'report_id' => $report->id,
                        'error' => $uploadResult['error']
                    ]);
                    return redirect()->back()->with('error', 'Gagal mengupload foto sesudah kejadian. Silakan coba lagi.');
                }
            }

            $report->update($updateData);

            $photoUploaded = (isset($updateData['foto_sebelum']) || isset($updateData['foto_sesudah']));

            Log::info('Status laporan ID ' . $report->id . ' diubah menjadi: ' . $validated['status']);

            $successMessage = 'Status laporan berhasil diperbarui!';
            if ($photoUploaded) {
                $successMessage .= ' Foto penanganan kejadian telah diupload.';
            }

            return redirect()->back()->with('success', $successMessage);
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui status laporan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }

    /**
     * Export reports data ke Excel
     * Clean Code: Clear method name, proper error handling
     */
    public function exportExcel()
    {
        try {
            // Log export activity
            Log::info('Admin export Excel - Reports data exported');

            // Generate filename dengan timestamp
            $filename = 'reports_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

            // Export data ke Excel
            return Excel::download(new ReportsExport, $filename);
        } catch (\Exception $e) {
            Log::error('Admin export Excel error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat export data. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan form registrasi admin baru
     * Clean Code: Clear method name, proper error handling
     */
    public function showRegisterForm()
    {
        try {
            return view('admin.register');
        } catch (\Exception $e) {
            Log::error('AdminController::showRegisterForm - Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat form registrasi.');
        }
    }

    /**
     * Memproses registrasi admin baru
     * Clean Code: Clear method name, proper validation and error handling
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Buat admin baru dengan role admin
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin',
            ]);

            Log::info('Admin baru berhasil didaftarkan', [
                'admin_id' => $user->id,
                'admin_email' => $user->email,
                'registered_by' => auth()->id()
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Admin baru berhasil didaftarkan!');
        } catch (\Exception $e) {
            Log::error('AdminController::register - Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mendaftarkan admin baru. Silakan coba lagi.');
        }
    }
}
