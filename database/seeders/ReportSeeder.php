<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * ReportSeeder - Create sample reports for testing
 * Clean Architecture: Sample data untuk development dan testing
 */
class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Buat sample laporan untuk testing admin dashboard
     */
    public function run(): void
    {
        $sampleReports = [
            [
                'nama_pelapor' => 'John Doe',
                'nomor_whatsapp' => '081234567890',
                'departemen' => 'IT Department',
                'nik' => '1234567890123456',
                'keterangan' => 'Laporan kerusakan komputer di ruang server. Komputer tidak bisa boot dan mengeluarkan suara beep.',
                'status_kejadian' => 'hampir_celaka',
                'status' => 'baru',
            ],
            [
                'nama_pelapor' => 'Jane Smith',
                'nomor_whatsapp' => '081234567891',
                'departemen' => 'HR Department',
                'nik' => '1234567890123457',
                'keterangan' => 'Laporan kehilangan dokumen penting. Dokumen kontrak karyawan hilang dari filing cabinet.',
                'status_kejadian' => 'kecelakaan',
                'status' => 'proses',
            ],
            [
                'nama_pelapor' => 'Bob Wilson',
                'nomor_whatsapp' => '081234567892',
                'departemen' => 'Finance Department',
                'nik' => '1234567890123458',
                'keterangan' => 'Laporan masalah sistem payroll. Gaji karyawan tidak terhitung dengan benar.',
                'status_kejadian' => 'hampir_celaka',
                'status' => 'selesai',
            ],
            [
                'nama_pelapor' => 'Alice Brown',
                'nomor_whatsapp' => '081234567893',
                'departemen' => 'Marketing Department',
                'nik' => '1234567890123459',
                'keterangan' => 'Laporan masalah printer. Printer tidak bisa mencetak dokumen dengan benar.',
                'status_kejadian' => 'kecelakaan',
                'status' => 'baru',
            ],
            [
                'nama_pelapor' => 'Charlie Davis',
                'nomor_whatsapp' => '081234567894',
                'departemen' => 'Operations Department',
                'nik' => '1234567890123460',
                'keterangan' => 'Laporan masalah jaringan internet. Koneksi internet sering putus-putus.',
                'status_kejadian' => 'hampir_celaka',
                'status' => 'proses',
            ],
        ];

        foreach ($sampleReports as $report) {
            Report::create($report);
        }

        $this->command->info('✅ Sample reports berhasil dibuat!');
        $this->command->info('📊 Total reports: ' . count($sampleReports));
    }
}
