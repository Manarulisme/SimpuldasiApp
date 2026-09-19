<?php

namespace App\Http\Controllers;

use App\Models\DataFasilitasUmum;
use Illuminate\Http\Request;

class DataFasilitasUmumController extends Controller
{
    /**
     * Menampilkan seluruh data fasilitas umum dan sosial.
     */
    public function index()
    {
        $dataFasilitasUmum = DataFasilitasUmum::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_fasilitas_umum.index',
            compact('dataFasilitasUmum')
        );
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view(
            'Admin.Konten.Data_fasilitas_umum.tambah',
            [
                'isEdit' => false
            ]
        );
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|in:Kesehatan,Pendidikan,Olahraga,Sosial,Ruang Terbuka,Keagamaan,Infrastruktur,Lainnya',
            'alamat' => 'nullable|string',
            'sumber_dana' => 'nullable|string|in:APBD,Dana Kelurahan,Dana Desa,Swadaya Masyarakat,Bantuan Pemerintah,Lainnya',
        ]);

        $validated['google_sync_status'] = 'pending';

        DataFasilitasUmum::create($validated);

        return redirect()
            ->route('datafasilitasumum.index')
            ->with('success', 'Data fasilitas umum dan sosial berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $dataFasilitasUmum = DataFasilitasUmum::findOrFail($id);

        return view(
            'Admin.Konten.Data_fasilitas_umum.show',
            compact('dataFasilitasUmum')
        );
    }

    /**
     * Menampilkan form edit data.
     */
    public function edit($id)
    {
        $dataFasilitasUmum = DataFasilitasUmum::findOrFail($id);

        return view(
            'Admin.Konten.Data_fasilitas_umum.tambah',
            [
                'dataFasilitasUmum' => $dataFasilitasUmum,
                'isEdit' => true
            ]
        );
    }

    /**
     * Memperbarui data.
     */
    public function update(Request $request, $id)
    {
        $dataFasilitasUmum = DataFasilitasUmum::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|in:Kesehatan,Pendidikan,Olahraga,Sosial,Ruang Terbuka,Keagamaan,Infrastruktur,Lainnya',
            'alamat' => 'nullable|string',
            'sumber_dana' => 'nullable|string|in:APBD,Dana Kelurahan,Dana Desa,Swadaya Masyarakat,Bantuan Pemerintah,Lainnya',
        ]);

        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        $dataFasilitasUmum->update($validated);

        return redirect()
            ->route('datafasilitasumum.index')
            ->with('success', 'Data fasilitas umum dan sosial berhasil diperbarui.');
    }

    /**
     * Menghapus data.
     */
    public function destroy($id)
    {
        $dataFasilitasUmum = DataFasilitasUmum::findOrFail($id);

        $dataFasilitasUmum->delete();

        return redirect()
            ->route('datafasilitasumum.index')
            ->with('success', 'Data fasilitas umum dan sosial berhasil dihapus.');
    }
}
