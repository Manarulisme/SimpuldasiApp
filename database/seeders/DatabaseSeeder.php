<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $this->call([
        //     DataSekolahSeeder::class,
        // ]);

        // $this->call([ DataUmkmSeeder::class, ]);
        // $this->call([ DataRutilahuSeeder::class, ]);

//         $this->call([
// // Seeder yang sudah ada
// DataLinmasSeeder::class,
// ]);
$this->call([
DataPklSeeder::class,
]);
    }
}
