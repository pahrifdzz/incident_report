<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Menampilkan semua laporan di dashboard admin.
     */
    public function index()
    {
        try {
            // Ambil semua laporan terbaru dari database
            $reports = Report::orderBy('created_at', 'desc')->get();

            Log::info('Jumlah laporan ditampilkan di dashboard: ' . $reports->count());

            // Tampilkan halaman dashboard admin
            return view('admin.dashboard', compact('reports'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat dashboard admin: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat dashboard.');
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
}
