<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPosyandu extends Model
{
    protected $table = 'data_posyandu';

    protected $fillable = [
        'id_data',
        'jenis',
        'nama',
        'rw',
        'jumlah_kader',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'jumlah_kader' => 'integer',
        'google_synced_at' => 'datetime',
    ];
}
