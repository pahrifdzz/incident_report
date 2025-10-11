<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Tampilkan form pelaporan
    public function create()
    {
        return view('reports.create');
    }

    // Simpan laporan ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'nomor_whatsapp' => 'required|string|max:20',
            'departemen' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads', 'public');
        }

        Report::create([
            'nama_pelapor' => $request->nama_pelapor,
            'nomor_whatsapp' => $request->nomor_whatsapp,
            'departemen' => $request->departemen,
            'nik' => $request->nik,
            'keterangan' => $request->keterangan,
            'foto' => $fotoPath,
            'status' => 'baru',
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim! Terima kasih atas pelaporannya.');
    }
}
