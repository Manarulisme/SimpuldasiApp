<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataUmumKepegawaian extends Model
{
    protected $table = 'data_umum_kepegawaian';

    protected $fillable = [
    'jenis',
    'nomor',
    'nama',
    'golongan',
    'pangkat',
    'jabatan',
    'keterangan',
    'google_sync_status',
    'google_synced_at',
    ];

    protected $casts = [
    'google_synced_at' => 'datetime',
];

}
