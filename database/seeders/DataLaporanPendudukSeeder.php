<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataLaporanPenduduk;

class DataLaporanPendudukSeeder extends Seeder
{
    /**
     * Menjalankan database seeder.
     */
    public function run(): void
    {
        $data = [
            [
                'bulan' => 'Januari',
                'tahun' => 2026,
                'jumlah_kk' => 1250,
                'jumlah_laki_laki' => 1985,
                'jumlah_perempuan' => 2010,
                'jumlah_kematian' => 8,
                'jumlah_kelahiran' => 15,
                'jumlah_pindah_datang' => 12,
                'jumlah_pindah_keluar' => 10,
                'penduduk_sementara' => 5,
                'keterangan' => 'Laporan kependudukan bulan Januari 2026.',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],

            [
                'bulan' => 'Februari',
                'tahun' => 2026,
                'jumlah_kk' => 1258,
                'jumlah_laki_laki' => 1992,
                'jumlah_perempuan' => 2018,
                'jumlah_kematian' => 6,
                'jumlah_kelahiran' => 13,
                'jumlah_pindah_datang' => 9,
                'jumlah_pindah_keluar' => 8,
                'penduduk_sementara' => 6,
                'keterangan' => 'Laporan kependudukan bulan Februari 2026.',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],

            [
                'bulan' => 'Maret',
                'tahun' => 2026,
                'jumlah_kk' => 1265,
                'jumlah_laki_laki' => 2001,
                'jumlah_perempuan' => 2027,
                'jumlah_kematian' => 7,
                'jumlah_kelahiran' => 17,
                'jumlah_pindah_datang' => 14,
                'jumlah_pindah_keluar' => 11,
                'penduduk_sementara' => 4,
                'keterangan' => 'Laporan kependudukan bulan Maret 2026.',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],

            [
                'bulan' => 'April',
                'tahun' => 2026,
                'jumlah_kk' => 1272,
                'jumlah_laki_laki' => 2008,
                'jumlah_perempuan' => 2035,
                'jumlah_kematian' => 5,
                'jumlah_kelahiran' => 16,
                'jumlah_pindah_datang' => 11,
                'jumlah_pindah_keluar' => 9,
                'penduduk_sementara' => 7,
                'keterangan' => 'Laporan kependudukan bulan April 2026.',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],

            [
                'bulan' => 'Mei',
                'tahun' => 2026,
                'jumlah_kk' => 1280,
                'jumlah_laki_laki' => 2016,
                'jumlah_perempuan' => 2043,
                'jumlah_kematian' => 9,
                'jumlah_kelahiran' => 18,
                'jumlah_pindah_datang' => 15,
                'jumlah_pindah_keluar' => 12,
                'penduduk_sementara' => 5,
                'keterangan' => 'Laporan kependudukan bulan Mei 2026.',
                'google_sync_status' => 'pending',
                'google_synced_at' => null,
            ],
        ];

        foreach ($data as $item) {
            DataLaporanPenduduk::create($item);
        }
    }
}
