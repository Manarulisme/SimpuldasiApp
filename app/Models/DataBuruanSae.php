<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBuruanSae extends Model
{
    use HasFactory;

    protected $table = 'data_buruan_sae';

    protected $fillable = [
        'nama',
        'lokasi',
        'rw',
        'jenis_tanaman',
        'luas_area',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'google_synced_at' => 'datetime',
    ];
}
