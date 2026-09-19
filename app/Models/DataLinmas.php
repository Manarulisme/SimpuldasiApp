<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLinmas extends Model
{
    use HasFactory;

    protected $table = 'data_linmas';

    protected $fillable = [
        'rw',
        'jumlah_linmas',
        'nama',
        'nik',
        'alamat',
        'pekerjaan',
        'jumlah_poskamling',
        'titik_poskamling',
        'keterangan',
        'google_sync_status',
        'google_synced_at',
    ];

    protected $casts = [
        'jumlah_linmas' => 'integer',
        'jumlah_poskamling' => 'integer',
        'google_synced_at' => 'datetime',
    ];
}
