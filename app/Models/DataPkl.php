<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPkl extends Model
{
    protected $table = 'data_pkl';

    protected $fillable = [
        'nama_pkl',
        'jenis_dagangan',
        'lokasi',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'google_synced_at' => 'datetime',
    ];
}
