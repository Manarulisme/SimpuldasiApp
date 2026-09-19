<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUmkm extends Model
{
    use HasFactory;

    protected $table = 'data_umkm';

    protected $fillable = [
'nama_pelaku_usaha',
'nik',
'no_kk',
'no_telepon',
'nama_usaha',
'jenis_usaha',
'alamat_usaha',
'kelurahan',
'kecamatan',
'kabupaten_kota',
'nib',
'npwp',
'izin_usaha',
'produk_utama',
'modal_usaha',
'omzet_bulanan',
'jumlah_tenaga_kerja',
'skala_usaha',
'status_usaha',
'keterangan',
'google_sync_status',
'google_synced_at',
];

protected $casts = [
'modal_usaha' => 'decimal:2',
'omzet_bulanan' => 'decimal:2',
'jumlah_tenaga_kerja' => 'integer',
'google_synced_at' => 'datetime',
];

}
