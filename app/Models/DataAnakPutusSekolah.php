<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAnakPutusSekolah extends Model
{
    protected $table = 'data_anak_putus_sekolah';

    protected $fillable = [
        'id_data',
        'nik',
        'nama',
        'rw',
        'usia',
        'jenjang_terakhir',
        'alasan',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'usia' => 'integer',
        'google_synced_at' => 'datetime',
    ];
}
