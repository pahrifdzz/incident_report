<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Exports\ReportsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
     * Memperbarui status laporan (baru → diproses → selesai).
     */
    public function updateStatus(Request $request, Report $report)
    {
        $validated = $request->validate([
            'status' => 'required|in:baru,proses,selesai'
        ]);

        try {
            $report->update(['status' => $validated['status']]);

            Log::info('Status laporan ID ' . $report->id . ' diubah menjadi: ' . $validated['status']);

            return redirect()->back()->with('success', 'Status laporan berhasil diperbarui!');
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
}
