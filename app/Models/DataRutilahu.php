<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRutilahu extends Model
{
    use HasFactory;

    protected $table = 'data_rutilahu';

    protected $fillable = [
        'nik',
        'nama_kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'kondisi_rumah',
        'tingkat_prioritas',
        'status_bantuan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'google_synced_at' => 'datetime',
    ];
}
