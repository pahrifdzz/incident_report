<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

/**
 * ReportsExport - Export reports data to Excel
 * Clean Architecture: Single responsibility untuk export functionality
 */
class ReportsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithColumnFormatting
{
    /**
     * Ambil semua data reports untuk export
     * Clean Code: Clear method name, proper data handling
     */
    public function collection()
    {
        return Report::orderBy('created_at', 'desc')->get();
    }

    /**
     * Header untuk Excel file
     * Clean Code: Clear headers yang user-friendly
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Pelapor',
            'Nomor WhatsApp',
            'Departemen',
            'NIK',
            'Status',
            'Keterangan',
            'Tanggal Laporan',
            'Foto Pendukung'
        ];
    }

    /**
     * Mapping data untuk setiap row
     * Clean Code: Transform data sesuai kebutuhan Excel
     */
    public function map($report): array
    {
        return [
            $report->id,
            $report->nama_pelapor,
            $report->nomor_whatsapp,
            $report->departemen,
            "'" . $report->nik, // Prefix dengan ' untuk memastikan NIK sebagai text
            ucfirst($report->status ?? 'Belum ada status'),
            $report->keterangan,
            $report->created_at ? \Carbon\Carbon::parse($report->created_at)->translatedFormat('d M Y, H:i') : '-',
            $report->foto ? 'Ada' : 'Tidak ada'
        ];
    }

    /**
     * Styling untuk Excel file
     * Clean Code: Professional appearance
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '374151'] // Gray-700
                ]
            ],
        ];
    }

    /**
     * Column widths untuk Excel file
     * Clean Code: Optimal column sizing
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,   // No
            'B' => 20,  // Nama Pelapor
            'C' => 18,  // Nomor WhatsApp
            'D' => 15,  // Departemen
            'E' => 18,  // NIK
            'F' => 12,  // Status
            'G' => 30,  // Keterangan
            'H' => 20,  // Tanggal Laporan
            'I' => 15,  // Foto Pendukung
        ];
    }

    /**
     * Column formatting untuk Excel file
     * Clean Code: Format NIK sebagai text untuk mencegah scientific notation
     */
    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_TEXT, // Format kolom NIK sebagai text
        ];
    }
}