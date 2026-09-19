<?php

namespace Database\Seeders;

use App\Models\DataPkl;
use Illuminate\Database\Seeder;

class DataPklSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        DataPkl::create([
            'nama_pkl' => 'Warung Bu Siti',
            'jenis_dagangan' => 'Makanan',
            'lokasi' => 'Jl. Raya Kelurahan',
            'keterangan' => 'Menjual nasi dan lauk pauk',
            'google_sync_status' => 'pending',
        ]);

        DataPkl::create([
            'nama_pkl' => 'Es Teh Segar Pak Andi',
            'jenis_dagangan' => 'Minuman',
            'lokasi' => 'Dekat Lapangan Kelurahan',
            'keterangan' => 'Menjual aneka minuman dingin',
            'google_sync_status' => 'pending',
        ]);

        DataPkl::create([
            'nama_pkl' => 'Gorengan Bu Rina',
            'jenis_dagangan' => 'Makanan',
            'lokasi' => 'Jl. Pasar Kelurahan',
            'keterangan' => 'Menjual gorengan dan makanan ringan',
            'google_sync_status' => 'pending',
        ]);

        DataPkl::create([
            'nama_pkl' => 'Toko Aksesoris Dika',
            'jenis_dagangan' => 'Aksesoris',
            'lokasi' => 'Area Pertokoan',
            'keterangan' => 'Menjual aksesoris dan kebutuhan harian',
            'google_sync_status' => 'pending',
        ]);

        DataPkl::create([
            'nama_pkl' => 'Jasa Sol Sepatu Ujang',
            'jenis_dagangan' => 'Jasa',
            'lokasi' => 'Jl. Utama Kelurahan',
            'keterangan' => 'Melayani jasa reparasi sepatu dan tas',
            'google_sync_status' => 'pending',
        ]);
    }
}
