<?php

namespace App\Http\Controllers;

use App\Models\LaporanBulanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman utama laporan bulanan.
     */
    public function index()
    {
        $laporan = LaporanBulanan::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $daftarMenu = [
            'datapenduduk' => 'Data Penduduk',
            'datartrw' => 'Data RT & RW',
            'datalinmas' => 'Data Linmas & Siskamling',
            'datapkl' => 'Data PKL',
            'dataumkm' => 'Data UMKM',
            'datastunting' => 'Data Stunting',
        ];

        $daftarBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $tahunSekarang = now()->year;

        return view(
            'Admin.Konten.Laporan.index',
            compact(
                'laporan',
                'daftarMenu',
                'daftarBulan',
                'tahunSekarang'
            )
        );
    }

    /**
     * Menampilkan preview laporan.
     */
    public function preview(Request $request)
    {
        $validated = $request->validate([
            'menu' => 'required|string|max:100',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2100',
        ]);

        $menu = $validated['menu'];
        $bulan = $validated['bulan'];
        $tahun = $validated['tahun'];

        $daftarMenu = $this->daftarMenu();

        if (!array_key_exists($menu, $daftarMenu)) {
            return back()
                ->withInput()
                ->with('error', 'Menu laporan tidak ditemukan.');
        }

        $namaMenu = $daftarMenu[$menu]['nama'];
        $model = $daftarMenu[$menu]['model'];

        $data = $model::orderBy('updated_at', 'desc')->get();

        $namaBulan = $this->namaBulan($bulan);

        return view(
            'Admin.Konten.Laporan.preview',
            compact(
                'data',
                'menu',
                'namaMenu',
                'bulan',
                'tahun',
                'namaBulan'
            )
        );
    }

    /**
     * Generate laporan PDF.
     */
    public function pdf(Request $request)
    {
        $validated = $request->validate([
            'menu' => 'required|string|max:100',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2100',
        ]);

        $menu = $validated['menu'];
        $bulan = $validated['bulan'];
        $tahun = $validated['tahun'];

        $daftarMenu = $this->daftarMenu();

        if (!array_key_exists($menu, $daftarMenu)) {
            return back()
                ->withInput()
                ->with('error', 'Menu laporan tidak ditemukan.');
        }

        $namaMenu = $daftarMenu[$menu]['nama'];
        $model = $daftarMenu[$menu]['model'];

        try {
            $data = $model::orderBy('updated_at', 'desc')->get();

            $namaBulan = $this->namaBulan($bulan);

            $judulLaporan = 'Laporan ' . $namaMenu . ' ' . $namaBulan . ' ' . $tahun;

            /*
             * Simpan riwayat laporan ke database.
             */
            $laporan = LaporanBulanan::create([
                'menu' => $menu,
                'judul_laporan' => $judulLaporan,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'status' => 'generated',
                'keterangan' => 'Laporan dibuat melalui sistem administrasi Kelurahan Binong.',
                'generated_at' => now(),
            ]);

            /*
             * Nama file PDF.
             */
            $namaFile = 'laporan-' .
                $menu . '-' .
                strtolower($namaBulan) . '-' .
                $tahun . '-' .
                $laporan->id . '.pdf';

            /*
             * Generate PDF.
             */
            $pdf = Pdf::loadView(
                'Admin.Konten.Laporan.pdf',
                [
                    'data' => $data,
                    'menu' => $menu,
                    'namaMenu' => $namaMenu,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'namaBulan' => $namaBulan,
                    'judulLaporan' => $judulLaporan,
                ]
            );

            /*
             * Update nama file setelah PDF berhasil dibuat.
             */
            $laporan->update([
                'nama_file' => $namaFile,
            ]);

            return $pdf->download($namaFile);

        } catch (\Throwable $e) {

            Log::error('Gagal membuat laporan PDF', [
                'menu' => $menu,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'error' => $e->getMessage(),
            ]);

            /*
             * Jika proses gagal, simpan status failed.
             */
            if (isset($laporan)) {
                $laporan->update([
                    'status' => 'failed',
                    'keterangan' => $e->getMessage(),
                ]);
            }

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Laporan PDF gagal dibuat. Silakan coba kembali.'
                );
        }
    }

    /**
     * Daftar menu yang tersedia untuk laporan.
     */
    private function daftarMenu()
    {
        return [
            'datapenduduk' => [
                'nama' => 'Data Penduduk',
                'model' => \App\Models\DataPenduduk::class,
            ],

            'datartrw' => [
                'nama' => 'Data RT & RW',
                'model' => \App\Models\DataRtRw::class,
            ],

            'datalinmas' => [
                'nama' => 'Data Linmas & Siskamling',
                'model' => \App\Models\DataLinmas::class,
            ],

            'datapkl' => [
                'nama' => 'Data PKL',
                'model' => \App\Models\DataPkl::class,
            ],

            'dataumkm' => [
                'nama' => 'Data UMKM',
                'model' => \App\Models\DataUmkm::class,
            ],

            'datastunting' => [
                'nama' => 'Data Stunting',
                'model' => \App\Models\DataStunting::class,
            ],
        ];
    }

    /**
     * Mengubah nomor bulan menjadi nama bulan.
     */
    private function namaBulan($bulan)
    {
        $daftarBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $daftarBulan[$bulan] ?? '-';
    }
}
