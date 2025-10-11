<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pelaporan Kejadian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center">Form Pelaporan Kejadian Tidak Terduga</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama Pelapor</label>
                <input type="text" name="nama_pelapor" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nomor WhatsApp</label>
                <input type="text" name="nomor_whatsapp" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Departemen</label>
                <input type="text" name="departemen" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Keterangan Kejadian</label>
                <textarea name="keterangan" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label>Foto Pendukung (opsional)</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">Kirim Laporan</button>
        </form>
    </div>
</div>

</body>
</html>
