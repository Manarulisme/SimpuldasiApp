<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanBulanan extends Model
{
    protected $table = 'laporan_bulanan';

    protected $fillable = [
        'menu',
        'judul_laporan',
        'bulan',
        'tahun',
        'nama_file',
        'file_path',
        'status',
        'keterangan',
        'generated_at',
    ];

    protected $casts = [
        'bulan' => 'integer',
        'tahun' => 'integer',
        'generated_at' => 'datetime',
    ];
}
