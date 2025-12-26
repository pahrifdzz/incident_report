<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports'; // pastikan nama tabel sama dengan yang ada di database

    protected $fillable = [
        'nama_pelapor',
        'nomor_whatsapp',
        'departemen',
        'nik',
        'keterangan',
        'status_kejadian', // Tambahkan field untuk status kejadian
        'foto',
        'cloudinary_public_id', // Tambahkan field untuk Cloudinary public ID
        'foto_sebelum',
        'foto_sesudah',
        'cloudinary_public_id_sebelum',
        'cloudinary_public_id_sesudah',
        'status',
    ];
}
