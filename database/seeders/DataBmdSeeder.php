<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataBmd;

class DataBmdSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_data' => 'BMD-001',
                'nama_barang' => 'Meja Kerja',
                'type' => 'Sarana',
                'tahun_perolehan' => 2025,
                'sumber_dana' => 'BOS',
                'kondisi' => 'Baik',
                'keterangan' => 'Meja kerja pegawai dalam kondisi baik.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-002',
                'nama_barang' => 'Kursi Kerja',
                'type' => 'Sarana',
                'tahun_perolehan' => 2025,
                'sumber_dana' => 'BOS',
                'kondisi' => 'Baik',
                'keterangan' => 'Kursi kerja untuk ruang pelayanan.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-003',
                'nama_barang' => 'Laptop',
                'type' => 'Peralatan Elektronik',
                'tahun_perolehan' => 2024,
                'sumber_dana' => 'APBD',
                'kondisi' => 'Baik',
                'keterangan' => 'Laptop untuk kebutuhan administrasi kelurahan.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-004',
                'nama_barang' => 'Printer',
                'type' => 'Peralatan Elektronik',
                'tahun_perolehan' => 2024,
                'sumber_dana' => 'APBD',
                'kondisi' => 'Cukup Baik',
                'keterangan' => 'Printer masih dapat digunakan dengan baik.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-005',
                'nama_barang' => 'Lemari Arsip',
                'type' => 'Sarana',
                'tahun_perolehan' => 2023,
                'sumber_dana' => 'APBD',
                'kondisi' => 'Baik',
                'keterangan' => 'Lemari untuk penyimpanan dokumen dan arsip.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-006',
                'nama_barang' => 'AC Split',
                'type' => 'Peralatan Elektronik',
                'tahun_perolehan' => 2022,
                'sumber_dana' => 'APBD',
                'kondisi' => 'Cukup Baik',
                'keterangan' => 'AC ruang pelayanan, masih berfungsi.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-007',
                'nama_barang' => 'Komputer Desktop',
                'type' => 'Peralatan Elektronik',
                'tahun_perolehan' => 2023,
                'sumber_dana' => 'BOS',
                'kondisi' => 'Baik',
                'keterangan' => 'Komputer untuk administrasi dan pengolahan data.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-008',
                'nama_barang' => 'Proyektor',
                'type' => 'Peralatan Elektronik',
                'tahun_perolehan' => 2021,
                'sumber_dana' => 'Hibah',
                'kondisi' => 'Cukup Baik',
                'keterangan' => 'Digunakan untuk kegiatan rapat dan sosialisasi.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-009',
                'nama_barang' => 'Rak Dokumen',
                'type' => 'Sarana',
                'tahun_perolehan' => 2020,
                'sumber_dana' => 'APBD',
                'kondisi' => 'Rusak Ringan',
                'keterangan' => 'Beberapa bagian rak mengalami kerusakan ringan.',
                'google_sync_status' => 'pending',
            ],
            [
                'id_data' => 'BMD-010',
                'nama_barang' => 'Kipas Angin',
                'type' => 'Peralatan Elektronik',
                'tahun_perolehan' => 2020,
                'sumber_dana' => 'Lainnya',
                'kondisi' => 'Rusak Berat',
                'keterangan' => 'Kipas tidak dapat digunakan dan membutuhkan penggantian.',
                'google_sync_status' => 'pending',
            ],
        ];

        foreach ($data as $item) {
            DataBmd::create($item);
        }
    }
}
