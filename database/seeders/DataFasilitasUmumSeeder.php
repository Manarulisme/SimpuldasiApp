<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataFasilitasUmum;

class DataFasilitasUmumSeeder extends Seeder
{
    /**
     * Menjalankan seeder database.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Posyandu Melati',
                'lokasi' => 'RW 01',
                'jenis' => 'Kesehatan',
                'alamat' => 'Kp. Sukamaju RT 02',
                'sumber_dana' => 'Dana Kelurahan',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'Lapangan Kelurahan',
                'lokasi' => 'RW 02',
                'jenis' => 'Olahraga',
                'alamat' => 'Jl. Raya Kelurahan RT 01',
                'sumber_dana' => 'APBD',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'Taman Bermain Anak',
                'lokasi' => 'RW 03',
                'jenis' => 'Ruang Terbuka',
                'alamat' => 'Kp. Cibogo RT 03',
                'sumber_dana' => 'Swadaya Masyarakat',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'Balai Warga',
                'lokasi' => 'RW 04',
                'jenis' => 'Sosial',
                'alamat' => 'Kp. Sukajaya RT 05',
                'sumber_dana' => 'Dana Desa',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'Perpustakaan Kelurahan',
                'lokasi' => 'RW 05',
                'jenis' => 'Pendidikan',
                'alamat' => 'Kp. Babakan RT 01',
                'sumber_dana' => 'APBD',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'Masjid Al-Ikhlas',
                'lokasi' => 'RW 06',
                'jenis' => 'Keagamaan',
                'alamat' => 'Kp. Binong RT 02',
                'sumber_dana' => 'Swadaya Masyarakat',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'PAUD Melati',
                'lokasi' => 'RW 07',
                'jenis' => 'Pendidikan',
                'alamat' => 'Kp. Sukamukti RT 03',
                'sumber_dana' => 'Dana Kelurahan',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'Pos Keamanan Lingkungan',
                'lokasi' => 'RW 08',
                'jenis' => 'Infrastruktur',
                'alamat' => 'Kp. Mekarsari RT 01',
                'sumber_dana' => 'Dana Kelurahan',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'Taman Kelurahan',
                'lokasi' => 'RW 09',
                'jenis' => 'Ruang Terbuka',
                'alamat' => 'Kp. Cibogo RT 06',
                'sumber_dana' => 'APBD',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'nama' => 'Gedung Serbaguna',
                'lokasi' => 'RW 10',
                'jenis' => 'Sosial',
                'alamat' => 'Kp. Binong RT 07',
                'sumber_dana' => 'Bantuan Pemerintah',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
        ];

        foreach ($data as $item) {
            DataFasilitasUmum::create($item);
        }
    }
}
