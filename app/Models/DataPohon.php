<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPohon extends Model
{
    protected $table = 'data_pohon';

    protected $fillable = [
        'jenis_pohon',
        'lokasi',
        'jumlah',
        'kondisi',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'google_synced_at' => 'datetime',
    ];
}
