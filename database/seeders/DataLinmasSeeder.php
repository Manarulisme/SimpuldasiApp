<?php

namespace Database\Seeders;

use App\Models\DataLinmas;
use Illuminate\Database\Seeder;

class DataLinmasSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        $data = [
            [
                'rw' => '01',
                'jumlah_linmas' => 8,
                'nama' => 'Budi Santoso',
                'nik' => '3273010101800001',
                'alamat' => 'Jl. Binong Raya RT 01/RW 01',
                'pekerjaan' => 'Wiraswasta',
                'jumlah_poskamling' => 2,
                'keterangan' => 'Data Linmas RW 01',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '02',
                'jumlah_linmas' => 7,
                'nama' => 'Dedi Hermawan',
                'nik' => '3273010201800002',
                'alamat' => 'Jl. Binong Raya RT 02/RW 02',
                'pekerjaan' => 'Karyawan Swasta',
                'jumlah_poskamling' => 2,
                'keterangan' => 'Data Linmas RW 02',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '03',
                'jumlah_linmas' => 9,
                'nama' => 'Asep Supriatna',
                'nik' => '3273010301800003',
                'alamat' => 'Jl. Binong Raya RT 03/RW 03',
                'pekerjaan' => 'Pedagang',
                'jumlah_poskamling' => 3,
                'keterangan' => 'Data Linmas RW 03',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '04',
                'jumlah_linmas' => 8,
                'nama' => 'Agus Setiawan',
                'nik' => '3273010401800004',
                'alamat' => 'Jl. Binong Raya RT 04/RW 04',
                'pekerjaan' => 'Wiraswasta',
                'jumlah_poskamling' => 2,
                'keterangan' => 'Data Linmas RW 04',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '05',
                'jumlah_linmas' => 10,
                'nama' => 'Dadan Hidayat',
                'nik' => '3273010501800005',
                'alamat' => 'Jl. Binong Raya RT 05/RW 05',
                'pekerjaan' => 'Karyawan Swasta',
                'jumlah_poskamling' => 3,
                'keterangan' => 'Data Linmas RW 05',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '06',
                'jumlah_linmas' => 7,
                'nama' => 'Hendra Gunawan',
                'nik' => '3273010601800006',
                'alamat' => 'Jl. Binong Raya RT 01/RW 06',
                'pekerjaan' => 'Petani',
                'jumlah_poskamling' => 2,
                'keterangan' => 'Data Linmas RW 06',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '07',
                'jumlah_linmas' => 8,
                'nama' => 'Iwan Kurniawan',
                'nik' => '3273010701800007',
                'alamat' => 'Jl. Binong Raya RT 02/RW 07',
                'pekerjaan' => 'Wiraswasta',
                'jumlah_poskamling' => 2,
                'keterangan' => 'Data Linmas RW 07',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '08',
                'jumlah_linmas' => 9,
                'nama' => 'Rudi Hartono',
                'nik' => '3273010801800008',
                'alamat' => 'Jl. Binong Raya RT 03/RW 08',
                'pekerjaan' => 'Karyawan Swasta',
                'jumlah_poskamling' => 3,
                'keterangan' => 'Data Linmas RW 08',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '09',
                'jumlah_linmas' => 8,
                'nama' => 'Yanto Pratama',
                'nik' => '3273010901800009',
                'alamat' => 'Jl. Binong Raya RT 04/RW 09',
                'pekerjaan' => 'Pedagang',
                'jumlah_poskamling' => 2,
                'keterangan' => 'Data Linmas RW 09',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
            [
                'rw' => '10',
                'jumlah_linmas' => 10,
                'nama' => 'Cecep Suhendar',
                'nik' => '3273011001800010',
                'alamat' => 'Jl. Binong Raya RT 01/RW 10',
                'pekerjaan' => 'Wiraswasta',
                'jumlah_poskamling' => 3,
                'keterangan' => 'Data Linmas RW 10',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
        ];

        foreach ($data as $item) {
            DataLinmas::create($item);
        }
    }
}
