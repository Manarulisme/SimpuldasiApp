<?php

namespace Database\Seeders;

use App\Models\DataStunting;
use Illuminate\Database\Seeder;

class DataStuntingSeeder extends Seeder
{
    public function run(): void
    {
        DataStunting::create([
            'nik' => '3275010101200001',
            'nama' => 'Ahmad Fauzan',
            'tanggal_lahir' => '2020-01-15',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Normal',
            'keterangan' => 'Pertumbuhan dan perkembangan anak sesuai dengan usia.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataStunting::create([
            'nik' => '3275010202210002',
            'nama' => 'Siti Aisyah',
            'tanggal_lahir' => '2021-02-20',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Berisiko',
            'keterangan' => 'Perlu pemantauan pertumbuhan dan asupan gizi secara berkala.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataStunting::create([
            'nik' => '3275010303190003',
            'nama' => 'Rizky Maulana',
            'tanggal_lahir' => '2019-03-10',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Stunting',
            'keterangan' => 'Memerlukan pemantauan dan penanganan lebih lanjut.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataStunting::create([
            'nik' => '3275010410220004',
            'nama' => 'Nabila Putri',
            'tanggal_lahir' => '2022-04-25',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Normal',
            'keterangan' => 'Kondisi anak dalam batas normal berdasarkan pemantauan.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataStunting::create([
            'nik' => '3275010507180005',
            'nama' => 'Dimas Pratama',
            'tanggal_lahir' => '2018-07-08',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Berisiko',
            'keterangan' => 'Disarankan melakukan pemantauan berat dan tinggi badan secara berkala.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);
    }
}
