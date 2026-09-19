<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLaporanPenduduk extends Model
{
    use HasFactory;

    protected $table = 'data_laporan_penduduk';

    protected $fillable = [
        'bulan',
        'tahun',
        'jumlah_kk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'jumlah_kematian',
        'jumlah_kelahiran',
        'jumlah_pindah_datang',
        'jumlah_pindah_keluar',
        'penduduk_sementara',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'jumlah_kk' => 'integer',
        'jumlah_laki_laki' => 'integer',
        'jumlah_perempuan' => 'integer',
        'jumlah_kematian' => 'integer',
        'jumlah_kelahiran' => 'integer',
        'jumlah_pindah_datang' => 'integer',
        'jumlah_pindah_keluar' => 'integer',
        'penduduk_sementara' => 'integer',
        'google_synced_at' => 'datetime',
    ];
}
