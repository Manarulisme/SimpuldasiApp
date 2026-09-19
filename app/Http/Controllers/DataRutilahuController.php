<?php

namespace App\Http\Controllers;

use App\Models\DataRutilahu;
use Illuminate\Http\Request;

class DataRutilahuController extends Controller
{
    /**
     * Menampilkan seluruh data Rutilahu.
     */
    public function index()
    {
        $dataRutilahu = DataRutilahu::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_rutilahu.index',
            compact('dataRutilahu')
        );
    }

    /**
     * Menampilkan form tambah data Rutilahu.
     */
    public function create()
    {
        return view(
            'Admin.Konten.Data_rutilahu.tambah',
            [
                'isEdit' => false,
            ]
        );
    }

    /**
     * Menyimpan data Rutilahu baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'nullable|string|max:20',

            'nama_kepala_keluarga' => 'required|string|max:255',

            'alamat' => 'nullable|string',

            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',

            'kondisi_rumah' => 'nullable|string|max:255',

            'tingkat_prioritas' => 'nullable|string|max:255',

            'status_bantuan' => 'nullable|string|max:255',
        ]);

        DataRutilahu::create($validated);

        return redirect()
            ->route('datarutilahu.index')
            ->with('success', 'Data Rutilahu berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data Rutilahu.
     */
    public function show($id)
    {
        $dataRutilahu = DataRutilahu::findOrFail($id);

        return view(
            'Admin.Konten.Data_rutilahu.show',
            compact('dataRutilahu')
        );
    }

    /**
     * Menampilkan form edit data Rutilahu.
     */
    public function edit($id)
    {
        $dataRutilahu = DataRutilahu::findOrFail($id);

        return view(
            'Admin.Konten.Data_rutilahu.tambah',
            [
                'dataRutilahu' => $dataRutilahu,
                'isEdit' => true,
            ]
        );
    }

    /**
     * Memperbarui data Rutilahu.
     */
    public function update(Request $request, $id)
    {
        $dataRutilahu = DataRutilahu::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'nullable|string|max:20',

            'nama_kepala_keluarga' => 'required|string|max:255',

            'alamat' => 'nullable|string',

            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',

            'kondisi_rumah' => 'nullable|string|max:255',

            'tingkat_prioritas' => 'nullable|string|max:255',

            'status_bantuan' => 'nullable|string|max:255',
        ]);

        $dataRutilahu->update($validated);

        return redirect()
            ->route('datarutilahu.index')
            ->with('success', 'Data Rutilahu berhasil diperbarui.');
    }

    /**
     * Menghapus data Rutilahu.
     */
    public function destroy($id)
    {
        $dataRutilahu = DataRutilahu::findOrFail($id);

        $dataRutilahu->delete();

        return redirect()
            ->route('datarutilahu.index')
            ->with('success', 'Data Rutilahu berhasil dihapus.');
    }
}
