<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRtRw extends Model
{
    use HasFactory;

    protected $table = 'data_rt_rw';

    protected $fillable = [
        'nama_rt',
        'nomor_rt',
        'nama_rw',
        'nomor_rw',
        'tanggal_mulai',
        'tanggal_berakhir',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'google_synced_at' => 'datetime',
    ];
}
