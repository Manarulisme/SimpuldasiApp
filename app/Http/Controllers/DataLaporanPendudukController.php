<?php

namespace App\Http\Controllers;

use App\Models\DataLaporanPenduduk;
use Illuminate\Http\Request;

class DataLaporanPendudukController extends Controller
{
    /**
     * Menampilkan seluruh data laporan penduduk.
     */
    public function index()
    {
        $dataLaporanPenduduk = DataLaporanPenduduk::orderBy('tahun', 'desc')
            ->orderByDesc('id')
            ->get();

        return view(
            'Admin.Konten.Data_laporan_penduduk.index',
            compact('dataLaporanPenduduk')
        );
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view(
            'Admin.Konten.Data_laporan_penduduk.tambah',
            [
                'isEdit' => false,
            ]
        );
    }

    /**
     * Menyimpan data laporan penduduk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan' => [
                'required',
                'string',
                'in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            ],

            'tahun' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'jumlah_kk' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_laki_laki' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_perempuan' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_kematian' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_kelahiran' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_pindah_datang' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_pindah_keluar' => [
                'required',
                'integer',
                'min:0',
            ],

            'penduduk_sementara' => [
                'required',
                'integer',
                'min:0',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        DataLaporanPenduduk::create($validated);

        return redirect()
            ->route('datalaporanpenduduk.index')
            ->with('success', 'Data laporan penduduk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data laporan penduduk.
     */
    public function show($id)
    {
        $dataLaporanPenduduk = DataLaporanPenduduk::findOrFail($id);

        return view(
            'Admin.Konten.Data_laporan_penduduk.show',
            compact('dataLaporanPenduduk')
        );
    }

    /**
     * Menampilkan form edit data.
     */
    public function edit($id)
    {
        $dataLaporanPenduduk = DataLaporanPenduduk::findOrFail($id);

        return view(
            'Admin.Konten.Data_laporan_penduduk.tambah',
            [
                'dataLaporanPenduduk' => $dataLaporanPenduduk,
                'isEdit' => true,
            ]
        );
    }

    /**
     * Memperbarui data laporan penduduk.
     */
    public function update(Request $request, $id)
    {
        $dataLaporanPenduduk = DataLaporanPenduduk::findOrFail($id);

        $validated = $request->validate([
            'bulan' => [
                'required',
                'string',
                'in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            ],

            'tahun' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'jumlah_kk' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_laki_laki' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_perempuan' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_kematian' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_kelahiran' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_pindah_datang' => [
                'required',
                'integer',
                'min:0',
            ],

            'jumlah_pindah_keluar' => [
                'required',
                'integer',
                'min:0',
            ],

            'penduduk_sementara' => [
                'required',
                'integer',
                'min:0',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        // Data berubah, sehingga perlu disinkronkan kembali
        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        $dataLaporanPenduduk->update($validated);

        return redirect()
            ->route('datalaporanpenduduk.index')
            ->with('success', 'Data laporan penduduk berhasil diperbarui.');
    }

    /**
     * Menghapus data laporan penduduk.
     */
    public function destroy($id)
    {
        $dataLaporanPenduduk = DataLaporanPenduduk::findOrFail($id);

        $dataLaporanPenduduk->delete();

        return redirect()
            ->route('datalaporanpenduduk.index')
            ->with('success', 'Data laporan penduduk berhasil dihapus.');
    }
}
