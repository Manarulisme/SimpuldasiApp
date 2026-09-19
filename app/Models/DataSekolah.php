<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSekolah extends Model
{
    protected $table = 'data_sekolah';

    protected $fillable = [
        'id_data',
        'nama_sekolah',
        'jenjang',
        'alamat',
        'jumlah_siswa',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'jumlah_siswa' => 'integer',
        'google_synced_at' => 'datetime',
    ];
}
