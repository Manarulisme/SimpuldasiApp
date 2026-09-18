<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPosyandu;

class DataPosyanduSeeder extends Seeder
{
    public function run(): void
    {
        DataPosyandu::create([
            'id_data' => 'PSY-001',
            'jenis' => 'Posyandu',
            'nama' => 'Posyandu Melati',
            'rw' => '01',
            'jumlah_kader' => 8,
            'keterangan' => 'Posyandu balita dan ibu hamil',
            'google_sync_status' => 'pending',
        ]);

        DataPosyandu::create([
            'id_data' => 'PSY-002',
            'jenis' => 'Posyandu',
            'nama' => 'Posyandu Mawar',
            'rw' => '02',
            'jumlah_kader' => 7,
            'keterangan' => 'Pelayanan kesehatan balita',
            'google_sync_status' => 'pending',
        ]);

        DataPosyandu::create([
            'id_data' => 'PSY-003',
            'jenis' => 'Posyandu',
            'nama' => 'Posyandu Kenanga',
            'rw' => '03',
            'jumlah_kader' => 9,
            'keterangan' => 'Posyandu balita dan lansia',
            'google_sync_status' => 'pending',
        ]);

        DataPosyandu::create([
            'id_data' => 'PBD-001',
            'jenis' => 'Posbindu',
            'nama' => 'Posbindu Sehat Bersama',
            'rw' => '04',
            'jumlah_kader' => 6,
            'keterangan' => 'Pemeriksaan kesehatan masyarakat usia produktif dan lansia',
            'google_sync_status' => 'pending',
        ]);

        DataPosyandu::create([
            'id_data' => 'PBD-002',
            'jenis' => 'Posbindu',
            'nama' => 'Posbindu Binong Sehat',
            'rw' => '05',
            'jumlah_kader' => 5,
            'keterangan' => 'Pemantauan tekanan darah, gula darah, dan kesehatan lansia',
            'google_sync_status' => 'pending',
        ]);
    }
}
