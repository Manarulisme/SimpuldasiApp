<?php

namespace App\Http\Controllers;

use App\Models\LaporanBulanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Throwable;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Halaman utama laporan bulanan.
     */
    public function index()
    {
        $laporan = LaporanBulanan::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $daftarMenu = [];

        foreach ($this->daftarMenu() as $key => $config) {
            $daftarMenu[$key] = $config['label'];
        }

        $daftarBulan = $this->namaBulan();

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
     * Preview laporan.
     *
     * Method ini menggunakan POST.
     */
    public function preview(Request $request)
    {
        $validated = $request->validate([
            'menu' => 'required|string|max:100',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        try {

            $menu = $validated['menu'];
            $bulan = (int) $validated['bulan'];
            $tahun = (int) $validated['tahun'];

            $daftarMenu = $this->daftarMenu();

            if (!isset($daftarMenu[$menu])) {

                return redirect()
                    ->route('laporan.index')
                    ->with(
                        'error',
                        'Menu laporan tidak ditemukan.'
                    );
            }

            $config = $daftarMenu[$menu];

            if (
                !isset($config['model']) ||
                !class_exists($config['model'])
            ) {

                return redirect()
                    ->route('laporan.index')
                    ->with(
                        'error',
                        'Model untuk menu laporan tidak ditemukan.'
                    );
            }

            $model = $config['model'];

            $modelInstance = new $model();

            $table = $modelInstance->getTable();

            if (!Schema::hasTable($table)) {

                return redirect()
                    ->route('laporan.index')
                    ->with(
                        'error',
                        'Tabel database untuk ' .
                        $config['label'] .
                        ' belum tersedia.'
                    );
            }

            $data = $model::orderBy(
                'updated_at',
                'desc'
            )->get();

            $namaMenu = $config['label'];

            $namaBulan = $this->namaBulan()[$bulan];

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

        } catch (Throwable $e) {

            Log::error(
                'Preview laporan gagal',
                [
                    'message' => $e->getMessage(),
                    'menu' => $request->menu,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                ]
            );

            return redirect()
                ->route('laporan.index')
                ->with(
                    'error',
                    'Gagal menampilkan preview laporan: ' .
                    $e->getMessage()
                );
        }
    }

    /**
     * Generate dan download PDF.
     *
     * Tidak menggunakan logo atau gambar.
     */
    public function pdf(Request $request)
    {
        $validated = $request->validate([
            'menu' => 'required|string|max:100',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        $laporan = null;

        try {

            $menu = $validated['menu'];
            $bulan = (int) $validated['bulan'];
            $tahun = (int) $validated['tahun'];

            $daftarMenu = $this->daftarMenu();

            if (!isset($daftarMenu[$menu])) {

                return redirect()
                    ->route('laporan.index')
                    ->with(
                        'error',
                        'Menu laporan tidak ditemukan.'
                    );
            }

            $config = $daftarMenu[$menu];

            if (
                !isset($config['model']) ||
                !class_exists($config['model'])
            ) {

                return redirect()
                    ->route('laporan.index')
                    ->with(
                        'error',
                        'Model untuk menu laporan tidak ditemukan.'
                    );
            }

            $model = $config['model'];

            $modelInstance = new $model();

            $table = $modelInstance->getTable();

            if (!Schema::hasTable($table)) {

                return redirect()
                    ->route('laporan.index')
                    ->with(
                        'error',
                        'Tabel database untuk ' .
                        $config['label'] .
                        ' belum tersedia.'
                    );
            }

            $data = $model::orderBy(
                'updated_at',
                'desc'
            )->get();

            $namaMenu = $config['label'];

            $namaBulan = $this->namaBulan()[$bulan];

            $judulLaporan =
                $namaMenu .
                ' - ' .
                $namaBulan .
                ' ' .
                $tahun;

            /*
             * Simpan histori laporan.
             */
            $laporan = LaporanBulanan::create([
                'menu' => $menu,
                'judul_laporan' => $judulLaporan,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'status' => 'generated',
                'keterangan' => 'Laporan berhasil dibuat.',
                'generated_at' => now(),
            ]);

            /*
             * Nama file PDF.
             */
            $filename =
                'laporan-' .
                $menu .
                '-' .
                strtolower($namaBulan) .
                '-' .
                $tahun .
                '-' .
                $laporan->id .
                '.pdf';

            /*
             * Generate PDF.
             *
             * Tidak menggunakan:
             * - logo
             * - gambar
             * - Base64
             * - GD image processing
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
                ]
            );

            /*
             * A4 Landscape.
             */
            $pdf->setPaper(
                'a4',
                'landscape'
            );

            /*
             * Update informasi file.
             */
            $laporan->update([
                'nama_file' => $filename,
                'file_path' => 'laporan/' . $filename,
                'status' => 'generated',
                'generated_at' => now(),
            ]);

            return $pdf->download($filename);

        } catch (Throwable $e) {

            Log::error(
                'Generate PDF laporan gagal',
                [
                    'message' => $e->getMessage(),
                    'menu' => $request->menu,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                ]
            );

            if ($laporan) {

                $laporan->update([
                    'status' => 'failed',
                    'keterangan' => $e->getMessage(),
                ]);
            }

            return redirect()
                ->route('laporan.index')
                ->with(
                    'error',
                    'ERROR PDF: ' .
                    $e->getMessage()
                );
        }
    }

    /**
     * Daftar seluruh menu laporan.
     */
    private function daftarMenu()
    {
        return [

            'dataanakputussekolah' => [
                'label' => 'Data Anak Putus Sekolah',
                'model' => \App\Models\DataAnakPutusSekolah::class,
            ],

            'databmd' => [
                'label' => 'Data BMD',
                'model' => \App\Models\DataBmd::class,
            ],

            'databuruansae' => [
                'label' => 'Data Buruan SAE',
                'model' => \App\Models\DataBuruanSae::class,
            ],

            'datafasilitasumum' => [
                'label' => 'Data Fasilitas Umum',
                'model' => \App\Models\DataFasilitasUmum::class,
            ],

            'datakpm' => [
                'label' => 'Data KPM',
                'model' => \App\Models\DataKpm::class,
            ],

            'datalaporanpenduduk' => [
                'label' => 'Data Laporan Penduduk',
                'model' => \App\Models\DataLaporanPenduduk::class,
            ],

            'datalinmas' => [
                'label' => 'Data Linmas & Siskamling',
                'model' => \App\Models\DataLinmas::class,
            ],

            'datapkl' => [
                'label' => 'Data PKL',
                'model' => \App\Models\DataPkl::class,
            ],

            'datapohon' => [
                'label' => 'Data Pohon',
                'model' => \App\Models\DataPohon::class,
            ],

            'dataposyandu' => [
                'label' => 'Data Posyandu',
                'model' => \App\Models\DataPosyandu::class,
            ],

            'datartrw' => [
                'label' => 'Data RT & RW',
                'model' => \App\Models\DataRtRw::class,
            ],

            'datarutilahu' => [
                'label' => 'Data Rutilahu',
                'model' => \App\Models\DataRutilahu::class,
            ],

            'datasekolah' => [
                'label' => 'Data Sekolah',
                'model' => \App\Models\DataSekolah::class,
            ],

            'datastunting' => [
                'label' => 'Data Stunting',
                'model' => \App\Models\DataStunting::class,
            ],

            'dataumkm' => [
                'label' => 'Data UMKM',
                'model' => \App\Models\DataUmkm::class,
            ],

            'dataumumkepegawaian' => [
                'label' => 'Data Umum Kepegawaian',
                'model' => \App\Models\DataUmumKepegawaian::class,
            ],

        ];
    }

    /**
     * Nama bulan Indonesia.
     */
    private function namaBulan()
    {
        return [

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
    }
}
