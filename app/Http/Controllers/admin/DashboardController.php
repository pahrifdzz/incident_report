<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Log; // <--- Tambahkan ini
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua data laporan terbaru dari tabel 'reports'
            $reports = Report::orderBy('created_at', 'desc')->get();

            // Debug opsional: catat jumlah laporan di log Laravel
            Log::info('Jumlah laporan diambil: ' . $reports->count());

            // Jika tidak ada laporan, tampilkan tampilan kosong
            if ($reports->isEmpty()) {
                return view('admin.dashboard', [
                    'reports' => $reports,
                    'message' => 'Belum ada laporan yang masuk.'
                ]);
            }

            // Jika ada data, kirim ke view admin.dashboard
            return view('admin.dashboard', compact('reports'));

        } catch (\Exception $e) {
            // Tangani error agar tidak menyebabkan halaman blank
            Log::error('Error di DashboardController: ' . $e->getMessage());
            return response()->view('errors.custom', [
                'message' => 'Terjadi kesalahan saat memuat data dashboard: ' . $e->getMessage()
            ], 500);
        }
    }
}
