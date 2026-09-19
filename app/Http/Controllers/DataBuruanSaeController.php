<?php

namespace App\Http\Controllers;

use App\Models\DataBuruanSae;
use Illuminate\Http\Request;

class DataBuruanSaeController extends Controller
{
    /**
     * Menampilkan seluruh data Buruan Sae.
     */
    public function index()
    {
        $dataBuruanSae = DataBuruanSae::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_buruan_sae.index',
            compact('dataBuruanSae')
        );
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view(
            'Admin.Konten.Data_buruan_sae.tambah',
            [
                'isEdit' => false,
            ]
        );
    }

    /**
     * Menyimpan data Buruan Sae.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'rw' => 'nullable|string|max:5',
            'jenis_tanaman' => 'nullable|string|max:255',
            'luas_area' => 'nullable|string|max:255',
        ]);

        DataBuruanSae::create($validated);

        return redirect()
            ->route('databuruansae.index')
            ->with('success', 'Data Buruan Sae berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $dataBuruanSae = DataBuruanSae::findOrFail($id);

        return view(
            'Admin.Konten.Data_buruan_sae.show',
            compact('dataBuruanSae')
        );
    }

    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $dataBuruanSae = DataBuruanSae::findOrFail($id);

        return view(
            'Admin.Konten.Data_buruan_sae.tambah',
            [
                'dataBuruanSae' => $dataBuruanSae,
                'isEdit' => true,
            ]
        );
    }

    /**
     * Memperbarui data Buruan Sae.
     */
    public function update(Request $request, $id)
    {
        $dataBuruanSae = DataBuruanSae::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'rw' => 'nullable|string|max:5',
            'jenis_tanaman' => 'nullable|string|max:255',
            'luas_area' => 'nullable|string|max:255',
        ]);

        $dataBuruanSae->update($validated);

        return redirect()
            ->route('databuruansae.index')
            ->with('success', 'Data Buruan Sae berhasil diperbarui.');
    }

    /**
     * Menghapus data Buruan Sae.
     */
    public function destroy($id)
    {
        $dataBuruanSae = DataBuruanSae::findOrFail($id);

        $dataBuruanSae->delete();

        return redirect()
            ->route('databuruansae.index')
            ->with('success', 'Data Buruan Sae berhasil dihapus.');
    }
}
