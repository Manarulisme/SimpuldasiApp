<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Lurah',
                'jabatan' => 'Lurah',
                'email' => 'lurah@kelurahanbinong.id',
                'password' => Hash::make('LurahBinong123'),
            ],
            [
                'name' => 'Sekretaris Kelurahan',
                'jabatan' => 'Sekretaris Kelurahan',
                'email' => 'sekretaris@kelurahanbinong.id',
                'password' => Hash::make('SekretarisBinong123'),
            ],
            [
                'name' => 'Kasi Pemerintahan',
                'jabatan' => 'Kasi Pemerintahan',
                'email' => 'pemerintahan@kelurahanbinong.id',
                'password' => Hash::make('PemerintahanBinong123'),
            ],
            [
                'name' => 'Kasi Kesejahteraan Sosial',
                'jabatan' => 'Kasi Kesejahteraan Sosial',
                'email' => 'kessos@kelurahanbinong.id',
                'password' => Hash::make('KessosBinong123'),
            ],
            [
                'name' => 'Kasi Ekonomi Pembangunan',
                'jabatan' => 'Kasi Ekonomi Pembangunan',
                'email' => 'ekbang@kelurahanbinong.id',
                'password' => Hash::make('EkbangBinong123'),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                [
                    'email' => $user['email'],
                ],
                [
                    'name' => $user['name'],
                    'jabatan' => $user['jabatan'],
                    'password' => $user['password'],
                ]
            );
        }
    }
}
