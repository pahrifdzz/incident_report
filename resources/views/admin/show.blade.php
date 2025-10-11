@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Detail Laporan Kejadian</h3>

    <div class="card p-4 shadow-sm">
        <p><strong>Nama Pelapor:</strong> {{ $report->nama_pelapor }}</p>
        <p><strong>Nomor WhatsApp:</strong> {{ $report->nomor_whatsapp }}</p>
        <p><strong>Departemen:</strong> {{ $report->departemen }}</p>
        <p><strong>NIK:</strong> {{ $report->nik }}</p>
        <p><strong>Keterangan:</strong> {{ $report->keterangan }}</p>

        @if($report->foto)
            <p><strong>Foto Pendukung:</strong></p>
            <img src="{{ asset('storage/' . $report->foto) }}" alt="Foto kejadian" class="img-fluid rounded mb-3" width="300">
        @endif

        <form action="{{ route('admin.reports.status', $report->id) }}" method="POST" class="mt-3">
            @csrf
            <label>Ubah Status:</label>
            <select name="status" class="form-select w-50 mb-3">
                <option value="baru" {{ $report->status == 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
