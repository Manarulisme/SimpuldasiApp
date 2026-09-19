<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataStunting extends Model
{
    protected $table = 'data_stunting';

    protected $fillable = [
        'nik',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'status',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'google_synced_at' => 'datetime',
    ];
}
