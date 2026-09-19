<?php

namespace Database\Seeders;

use App\Models\DataRtRw;
use Illuminate\Database\Seeder;

class DataRtRwSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'nama_rt' => 'Budi Santoso',
                'nomor_rt' => 'RT 01',
                'nama_rw' => 'Hendra Wijaya',
                'nomor_rw' => 'RW 01',
                'tanggal_mulai' => '2025-01-01',
                'tanggal_berakhir' => '2029-12-31',
            ],

            [
                'nama_rt' => 'Ahmad Hidayat',
                'nomor_rt' => 'RT 02',
                'nama_rw' => 'Hendra Wijaya',
                'nomor_rw' => 'RW 01',
                'tanggal_mulai' => '2025-01-01',
                'tanggal_berakhir' => '2029-12-31',
            ],

            [
                'nama_rt' => 'Dedi Kurniawan',
                'nomor_rt' => 'RT 03',
                'nama_rw' => 'Agus Setiawan',
                'nomor_rw' => 'RW 02',
                'tanggal_mulai' => '2025-02-15',
                'tanggal_berakhir' => '2030-02-14',
            ],

            [
                'nama_rt' => 'Eko Prasetyo',
                'nomor_rt' => 'RT 04',
                'nama_rw' => 'Agus Setiawan',
                'nomor_rw' => 'RW 02',
                'tanggal_mulai' => '2025-02-15',
                'tanggal_berakhir' => '2030-02-14',
            ],

            [
                'nama_rt' => 'Rudi Hartono',
                'nomor_rt' => 'RT 05',
                'nama_rw' => 'Hendra Wijaya',
                'nomor_rw' => 'RW 01',
                'tanggal_mulai' => '2025-01-01',
                'tanggal_berakhir' => '2029-12-31',
            ],

            [
                'nama_rt' => 'Dadan Hidayat',
                'nomor_rt' => 'RT 06',
                'nama_rw' => 'Agus Setiawan',
                'nomor_rw' => 'RW 02',
                'tanggal_mulai' => '2025-02-15',
                'tanggal_berakhir' => '2030-02-14',
            ],

        ];

        foreach ($data as $item) {

            DataRtRw::create(array_merge(
                $item,
                [
                    'google_sync_status' => 'pending',
                    'google_synced_at' => null,
                ]
            ));

        }
    }
}
