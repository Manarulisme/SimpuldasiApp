<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKpm extends Model
{
    protected $table = 'data_kpm';

    protected $fillable = [
        'id_data',
        'nik',
        'nama',
        'rw',
        'jenis_bantuan',
        'desil',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'desil' => 'integer',
        'google_synced_at' => 'datetime',
    ];
}
