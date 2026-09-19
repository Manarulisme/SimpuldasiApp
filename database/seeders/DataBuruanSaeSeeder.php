<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataBuruanSae;

class DataBuruanSaeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Buruan Sae RW 01',
                'lokasi' => 'Kampung Binong',
                'rw' => '01',
                'jenis_tanaman' => 'Cabai, Tomat, Kangkung',
                'luas_area' => '50 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 02',
                'lokasi' => 'Kampung Binong',
                'rw' => '02',
                'jenis_tanaman' => 'Sawi, Bayam, Kangkung',
                'luas_area' => '40 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 03',
                'lokasi' => 'Kampung Binong',
                'rw' => '03',
                'jenis_tanaman' => 'Cabai, Terong, Tomat',
                'luas_area' => '60 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 04',
                'lokasi' => 'Kampung Binong',
                'rw' => '04',
                'jenis_tanaman' => 'Kangkung, Bayam, Sawi',
                'luas_area' => '35 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 05',
                'lokasi' => 'Kampung Binong',
                'rw' => '05',
                'jenis_tanaman' => 'Cabai, Bawang, Tomat',
                'luas_area' => '45 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 06',
                'lokasi' => 'Kampung Binong',
                'rw' => '06',
                'jenis_tanaman' => 'Pakcoy, Sawi, Bayam',
                'luas_area' => '55 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 07',
                'lokasi' => 'Kampung Binong',
                'rw' => '07',
                'jenis_tanaman' => 'Cabai, Kangkung, Tomat',
                'luas_area' => '30 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 08',
                'lokasi' => 'Kampung Binong',
                'rw' => '08',
                'jenis_tanaman' => 'Terong, Sawi, Bayam',
                'luas_area' => '70 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 09',
                'lokasi' => 'Kampung Binong',
                'rw' => '09',
                'jenis_tanaman' => 'Cabai, Tomat, Kangkung',
                'luas_area' => '48 m²',
            ],
            [
                'nama' => 'Buruan Sae RW 10',
                'lokasi' => 'Kampung Binong',
                'rw' => '10',
                'jenis_tanaman' => 'Sawi, Pakcoy, Bayam',
                'luas_area' => '52 m²',
            ],
        ];

        foreach ($data as $item) {
            DataBuruanSae::create(array_merge(
                $item,
                [
                    'google_sync_status' => 'pending',
                ]
            ));
        }
    }
}
