<?php

namespace Database\Seeders;

use App\Models\DataKpm;
use Illuminate\Database\Seeder;

class DataKpmSeeder extends Seeder
{
    public function run(): void
    {
        DataKpm::create([
            'id_data' => 'KPM-001',
            'nik' => '3275014202850001',
            'nama' => 'Rina Wulandari',
            'rw' => '05',
            'jenis_bantuan' => 'PKH',
            'desil' => 2,
            'keterangan' => 'Penerima Program Keluarga Harapan.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataKpm::create([
            'id_data' => 'KPM-002',
            'nik' => '3275011801780002',
            'nama' => 'Agus Setiawan',
            'rw' => '03',
            'jenis_bantuan' => 'BPNT',
            'desil' => 3,
            'keterangan' => 'Penerima bantuan pangan melalui program BPNT.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataKpm::create([
            'id_data' => 'KPM-003',
            'nik' => '3275015606900003',
            'nama' => 'Sulastri',
            'rw' => '08',
            'jenis_bantuan' => 'PKH',
            'desil' => 1,
            'keterangan' => 'Penerima PKH berdasarkan data kesejahteraan sosial.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataKpm::create([
            'id_data' => 'KPM-004',
            'nik' => '3275011205640004',
            'nama' => 'Bambang Haryanto',
            'rw' => '02',
            'jenis_bantuan' => 'Bantuan Pangan',
            'desil' => 4,
            'keterangan' => 'Penerima bantuan pangan.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataKpm::create([
            'id_data' => 'KPM-005',
            'nik' => '3275016303720005',
            'nama' => 'Nurhayati',
            'rw' => '11',
            'jenis_bantuan' => 'BPNT',
            'desil' => 2,
            'keterangan' => 'Penerima bantuan sosial melalui program BPNT.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);
    }
}
