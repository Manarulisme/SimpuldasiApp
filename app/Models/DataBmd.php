<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBmd extends Model
{
    protected $table = 'data_bmd';

    protected $fillable = [
        'id_data',
        'nama_barang',
        'type',
        'tahun_perolehan',
        'sumber_dana',
        'kondisi',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'tahun_perolehan' => 'integer',
        'google_synced_at' => 'datetime',
    ];
}
