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
        'foto',
        'status',
    ];
}
