<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Kejadian Baru</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; border-radius: 5px; }
        .content { margin: 20px 0; }
        .report-details { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Notifikasi Kejadian Baru</h1>
            <p>Laporan kejadian baru telah diterima.</p>
        </div>

        <div class="content">
            <h2>Detail Laporan:</h2>
            <div class="report-details">
                <p><strong>Nama Pelapor:</strong> {{ $report->nama_pelapor }}</p>
                <p><strong>Nomor WhatsApp:</strong> {{ $report->nomor_whatsapp }}</p>
                <p><strong>Departemen:</strong> {{ $report->departemen }}</p>
                <p><strong>NIK:</strong> {{ $report->nik }}</p>
                <p><strong>Status Kejadian:</strong> {{ $report->status_kejadian == 'hampir_celaka' ? 'Hampir Celaka' : 'Kecelakaan' }}</p>
                <p><strong>Keterangan:</strong></p>
                <p>{{ $report->keterangan }}</p>
                @if($report->foto)
                    <p><strong>Foto:</strong> <a href="{{ $report->foto }}" target="_blank">Lihat Foto</a></p>
                @endif
                <p><strong>Tanggal Laporan:</strong> {{ $report->created_at->format('d M Y H:i') }}</p>
            </div>

            <p>Silakan login ke sistem untuk melihat detail lengkap dan mengelola laporan ini.</p>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh Sistem Pelaporan Kejadian.</p>
        </div>
    </div>
</body>
</html>
