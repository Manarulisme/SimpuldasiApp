<?php

namespace App\Http\Controllers;

use App\Models\DataFasilitasUmum;
use App\Models\DataPohon;
use App\Models\DataBuruanSae;
use App\Models\DataRutilahu;
use App\Models\DataUmkm;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahFasilitasUmum = DataFasilitasUmum::count();
        $jumlahPohon = DataPohon::count();
        $jumlahBuruanSae = DataBuruanSae::count();
        $jumlahRutilahu = DataRutilahu::count();
        $jumlahUmkm = DataUmkm::count();

        /*
        |--------------------------------------------------------------------------
        | Riwayat Perubahan Data
        |--------------------------------------------------------------------------
        */

        $riwayatPerubahan = collect();

        // UMKM
        $riwayatPerubahan = $riwayatPerubahan->merge(
            DataUmkm::select('id', 'nama_usaha', 'updated_at')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama_usaha ?: 'Data UMKM',
                        'jenis' => 'UMKM',
                        'updated_at' => $item->updated_at,
                        'route' => route('dataumkm.show', $item->id),
                    ];
                })
        );

        // Rutilahu
        $riwayatPerubahan = $riwayatPerubahan->merge(
            DataRutilahu::select('id', 'nama_kepala_keluarga', 'updated_at')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama_kepala_keluarga ?: 'Data Rutilahu',
                        'jenis' => 'Rutilahu',
                        'updated_at' => $item->updated_at,
                        'route' => route('datarutilahu.show', $item->id),
                    ];
                })
        );

        // Buruan Sae
        $riwayatPerubahan = $riwayatPerubahan->merge(
            DataBuruanSae::select('id', 'nama', 'updated_at')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama ?: 'Data Buruan Sae',
                        'jenis' => 'Buruan Sae',
                        'updated_at' => $item->updated_at,
                        'route' => route('databuruansae.show', $item->id),
                    ];
                })
        );

        // Pohon
        $riwayatPerubahan = $riwayatPerubahan->merge(
            DataPohon::select('id', 'jenis_pohon', 'updated_at')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->jenis_pohon ?: 'Data Pohon',
                        'jenis' => 'Pohon',
                        'updated_at' => $item->updated_at,
                        'route' => route('datapohon.show', $item->id),
                    ];
                })
        );

        // Fasilitas Umum & Sosial
        $riwayatPerubahan = $riwayatPerubahan->merge(
            DataFasilitasUmum::select('id', 'nama', 'updated_at')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama' => $item->nama ?: 'Data Fasilitas Umum',
                        'jenis' => 'Fasilitas Umum & Sosial',
                        'updated_at' => $item->updated_at,
                        'route' => route('datafasilitasumum.show', $item->id),
                    ];
                })
        );

        // Urutkan berdasarkan perubahan terbaru
        $riwayatPerubahan = $riwayatPerubahan
            ->sortByDesc('updated_at')
            ->take(5)
            ->values();

        return view('Admin.Konten.dashboard', compact(
            'jumlahFasilitasUmum',
            'jumlahPohon',
            'jumlahBuruanSae',
            'jumlahRutilahu',
            'jumlahUmkm',
            'riwayatPerubahan'
        ));
    }
}
