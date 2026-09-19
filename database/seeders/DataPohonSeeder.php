<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPohon;

class DataPohonSeeder extends Seeder
{
    /**
     * Menjalankan seeder data pohon.
     */
    public function run(): void
    {
        $dataPohon = [
            [
                'jenis_pohon' => 'Pohon Mangga',
                'lokasi' => 'Kp. Sukamaju RT 02',
                'jumlah' => 25,
                'kondisi' => 'Baik',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Jambu',
                'lokasi' => 'Kp. Mekarsari RT 04',
                'jumlah' => 18,
                'kondisi' => 'Baik',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Rambutan',
                'lokasi' => 'Kp. Cibogo RT 03',
                'jumlah' => 32,
                'kondisi' => 'Cukup Baik',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Ketapang',
                'lokasi' => 'Jl. Raya Kelurahan RT 01',
                'jumlah' => 15,
                'kondisi' => 'Baik',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Mahoni',
                'lokasi' => 'Kp. Sukajaya RT 05',
                'jumlah' => 20,
                'kondisi' => 'Perlu Perawatan',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Jati',
                'lokasi' => 'Kp. Binong RT 02',
                'jumlah' => 22,
                'kondisi' => 'Baik',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Trembesi',
                'lokasi' => 'Jl. Lingkungan RW 06',
                'jumlah' => 12,
                'kondisi' => 'Cukup Baik',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Pucuk Merah',
                'lokasi' => 'Kp. Sukamukti RT 03',
                'jumlah' => 35,
                'kondisi' => 'Baik',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Angsana',
                'lokasi' => 'Kp. Cibogo RT 06',
                'jumlah' => 17,
                'kondisi' => 'Cukup Baik',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'jenis_pohon' => 'Pohon Flamboyan',
                'lokasi' => 'Jl. Raya Binong RT 07',
                'jumlah' => 10,
                'kondisi' => 'Perlu Perawatan',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
        ];

        foreach ($dataPohon as $pohon) {
            DataPohon::create($pohon);
        }
    }
}
