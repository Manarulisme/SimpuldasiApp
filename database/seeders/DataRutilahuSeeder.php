<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataRutilahu;

class DataRutilahuSeeder extends Seeder
{
    /**
     * Menambahkan data dummy Rutilahu.
     */
    public function run(): void
    {
        $data = [
            [
                'nik' => '3273010101800001',
                'nama_kepala_keluarga' => 'Asep Supriatna',
                'alamat' => 'Jl. Binong Raya No. 12',
                'rt' => '001',
                'rw' => '001',
                'kondisi_rumah' => 'Rusak',
                'tingkat_prioritas' => 'Tinggi',
                'status_bantuan' => 'Belum Mendapatkan',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273010202750002',
                'nama_kepala_keluarga' => 'Dedi Mulyana',
                'alamat' => 'Kp. Binong RT 002 RW 001',
                'rt' => '002',
                'rw' => '001',
                'kondisi_rumah' => 'Sedang',
                'tingkat_prioritas' => 'Sedang',
                'status_bantuan' => 'Dalam Proses',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273010303680003',
                'nama_kepala_keluarga' => 'Ujang Hidayat',
                'alamat' => 'Kp. Sukamaju RT 003 RW 002',
                'rt' => '003',
                'rw' => '002',
                'kondisi_rumah' => 'Rusak',
                'tingkat_prioritas' => 'Tinggi',
                'status_bantuan' => 'Belum Mendapatkan',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273010401600004',
                'nama_kepala_keluarga' => 'Endang Sutisna',
                'alamat' => 'Jl. Raya Binong No. 25',
                'rt' => '004',
                'rw' => '002',
                'kondisi_rumah' => 'Sedang',
                'tingkat_prioritas' => 'Sedang',
                'status_bantuan' => 'Sudah Mendapatkan',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273010505550005',
                'nama_kepala_keluarga' => 'Rudi Hermawan',
                'alamat' => 'Kp. Cibodas RT 005 RW 003',
                'rt' => '005',
                'rw' => '003',
                'kondisi_rumah' => 'Baik',
                'tingkat_prioritas' => 'Rendah',
                'status_bantuan' => 'Sudah Mendapatkan',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273010606900006',
                'nama_kepala_keluarga' => 'Dadang Kurniawan',
                'alamat' => 'Kp. Binong RT 006 RW 003',
                'rt' => '006',
                'rw' => '003',
                'kondisi_rumah' => 'Rusak',
                'tingkat_prioritas' => 'Tinggi',
                'status_bantuan' => 'Dalam Proses',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273010701770007',
                'nama_kepala_keluarga' => 'Yayan Suryana',
                'alamat' => 'Jl. Sukamulya RT 007 RW 004',
                'rt' => '007',
                'rw' => '004',
                'kondisi_rumah' => 'Sedang',
                'tingkat_prioritas' => 'Sedang',
                'status_bantuan' => 'Belum Mendapatkan',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273010802820008',
                'nama_kepala_keluarga' => 'Wawan Gunawan',
                'alamat' => 'Kp. Cikadu RT 008 RW 004',
                'rt' => '008',
                'rw' => '004',
                'kondisi_rumah' => 'Rusak',
                'tingkat_prioritas' => 'Tinggi',
                'status_bantuan' => 'Belum Mendapatkan',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273010909730009',
                'nama_kepala_keluarga' => 'Iwan Setiawan',
                'alamat' => 'Kp. Binong RT 009 RW 005',
                'rt' => '009',
                'rw' => '005',
                'kondisi_rumah' => 'Baik',
                'tingkat_prioritas' => 'Rendah',
                'status_bantuan' => 'Sudah Mendapatkan',
                'google_sync_status' => 'pending',
            ],
            [
                'nik' => '3273011012670010',
                'nama_kepala_keluarga' => 'Cecep Ramdani',
                'alamat' => 'Jl. Mekarsari RT 010 RW 005',
                'rt' => '010',
                'rw' => '005',
                'kondisi_rumah' => 'Sedang',
                'tingkat_prioritas' => 'Sedang',
                'status_bantuan' => 'Dalam Proses',
                'google_sync_status' => 'pending',
            ],
        ];

        foreach ($data as $item) {
            DataRutilahu::create($item);
        }
    }
}
