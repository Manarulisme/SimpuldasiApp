<?php

namespace Database\Seeders;

use App\Models\DataAnakPutusSekolah;
use Illuminate\Database\Seeder;

class DataAnakPutusSekolahSeeder extends Seeder
{
    public function run(): void
    {
        DataAnakPutusSekolah::create([
            'id_data' => 'APS-001',
            'nik' => '3275011205140001',
            'nama' => 'Andi Pratama',
            'rw' => 'RW 04',
            'usia' => 14,
            'jenjang_terakhir' => 'SD Kelas 6',
            'alasan' => 'Kondisi ekonomi keluarga',
            'keterangan' => 'Anak berhenti sekolah karena keterbatasan ekonomi keluarga.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataAnakPutusSekolah::create([
            'id_data' => 'APS-002',
            'nik' => '3275014508120002',
            'nama' => 'Siti Nurhaliza',
            'rw' => 'RW 07',
            'usia' => 16,
            'jenjang_terakhir' => 'SMP Kelas 8',
            'alasan' => 'Membantu orang tua bekerja',
            'keterangan' => 'Anak berhenti sekolah untuk membantu perekonomian keluarga.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataAnakPutusSekolah::create([
            'id_data' => 'APS-003',
            'nik' => '3275012309100003',
            'nama' => 'Rian Saputra',
            'rw' => 'RW 02',
            'usia' => 13,
            'jenjang_terakhir' => 'SD Kelas 5',
            'alasan' => 'Tidak melanjutkan sekolah',
            'keterangan' => 'Anak tidak melanjutkan pendidikan ke jenjang berikutnya.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataAnakPutusSekolah::create([
            'id_data' => 'APS-004',
            'nik' => '3275016711070004',
            'nama' => 'Maya Lestari',
            'rw' => 'RW 09',
            'usia' => 17,
            'jenjang_terakhir' => 'SMP Kelas 9',
            'alasan' => 'Masalah keluarga',
            'keterangan' => 'Anak berhenti sekolah karena kondisi dan permasalahan keluarga.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        DataAnakPutusSekolah::create([
            'id_data' => 'APS-005',
            'nik' => '3275013403160005',
            'nama' => 'Fajar Hidayat',
            'rw' => 'RW 01',
            'usia' => 15,
            'jenjang_terakhir' => 'SD Kelas 6',
            'alasan' => 'Kendala biaya pendidikan',
            'keterangan' => 'Anak berhenti sekolah karena keluarga mengalami kendala biaya pendidikan.',
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);
    }
}
