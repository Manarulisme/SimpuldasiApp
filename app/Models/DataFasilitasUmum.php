<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataFasilitasUmum extends Model
{
    protected $table = 'data_fasilitas_umum';

    protected $fillable = [
        'nama',
        'lokasi',
        'jenis',
        'alamat',
        'sumber_dana',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'google_synced_at' => 'datetime',
    ];
}
