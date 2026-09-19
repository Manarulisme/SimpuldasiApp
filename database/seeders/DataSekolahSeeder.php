<?php

namespace Database\Seeders;

use App\Models\DataSekolah;
use Illuminate\Database\Seeder;

class DataSekolahSeeder extends Seeder
{
    public function run(): void
    {
        DataSekolah::create([
            'id_data' => 'SEK-001',
            'nama_sekolah' => 'SDN Binong 01',
            'jenjang' => 'SD',
            'alamat' => 'Jl. Melati No. 1, Kelurahan Binong',
            'jumlah_siswa' => 245,
            'keterangan' => 'Sekolah dasar negeri di wilayah Kelurahan Binong.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataSekolah::create([
            'id_data' => 'SEK-002',
            'nama_sekolah' => 'SMPN Binong 02',
            'jenjang' => 'SMP',
            'alamat' => 'Jl. Mawar No. 2, Kelurahan Binong',
            'jumlah_siswa' => 318,
            'keterangan' => 'Sekolah menengah pertama negeri di wilayah Kelurahan Binong.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataSekolah::create([
            'id_data' => 'SEK-003',
            'nama_sekolah' => 'SDN Binong 03',
            'jenjang' => 'SD',
            'alamat' => 'Jl. Kenanga No. 3, Kelurahan Binong',
            'jumlah_siswa' => 198,
            'keterangan' => 'Sekolah dasar negeri di wilayah Kelurahan Binong.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataSekolah::create([
            'id_data' => 'SEK-004',
            'nama_sekolah' => 'TK Melati',
            'jenjang' => 'TK',
            'alamat' => 'Jl. Anggrek No. 4, Kelurahan Binong',
            'jumlah_siswa' => 86,
            'keterangan' => 'Taman kanak-kanak yang melayani pendidikan anak usia dini.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataSekolah::create([
            'id_data' => 'SEK-005',
            'nama_sekolah' => 'SMA Binong 01',
            'jenjang' => 'SMA',
            'alamat' => 'Jl. Flamboyan No. 5, Kelurahan Binong',
            'jumlah_siswa' => 412,
            'keterangan' => 'Sekolah menengah atas di wilayah Kelurahan Binong.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);
    }
}
