<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataUmumKepegawaian;

class DataUmumKepegawaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DataUmumKepegawaian::create([
            'jenis' => 'ASN',
            'nomor' => '19780512 200501 1 001',
            'nama' => 'Ahmad Hidayat',
            'golongan' => 'III/d',
            'pangkat' => 'Pembina Tk. I',
            'jabatan' => 'Lurah',
        ]);

        DataUmumKepegawaian::create([
            'jenis' => 'ASN',
            'nomor' => '19820415 200701 2 002',
            'nama' => 'Siti Rahmawati',
            'golongan' => 'III/c',
            'pangkat' => 'Penata',
            'jabatan' => 'Sekretaris Kelurahan',
        ]);

        DataUmumKepegawaian::create([
            'jenis' => 'ASN',
            'nomor' => '19870622 201001 1 003',
            'nama' => 'Budi Santoso',
            'golongan' => 'III/b',
            'pangkat' => 'Penata Muda Tk. I',
            'jabatan' => 'Kasi Pemerintahan',
        ]);

        DataUmumKepegawaian::create([
            'jenis' => 'ASN',
            'nomor' => '19900318 201502 2 004',
            'nama' => 'Dewi Lestari',
            'golongan' => 'III/a',
            'pangkat' => 'Penata Muda',
            'jabatan' => 'Kasi Pelayanan',
        ]);

        DataUmumKepegawaian::create([
            'jenis' => 'PPPK',
            'nomor' => '19940527 202301 1 005',
            'nama' => 'Rudi Hermawan',
            'golongan' => 'IX',
            'pangkat' => 'Ahli Pertama',
            'jabatan' => 'Staf Pelayanan',
        ]);
    }
}
