<?php

namespace App\Http\Controllers;

use App\Models\DataPkl;
use Illuminate\Http\Request;

class DataPklController extends Controller
{
    /**
     * Menampilkan seluruh data PKL.
     */
    public function index()
    {
        $dataPkl = DataPkl::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_pkl.index',
            compact('dataPkl')
        );
    }

    /**
     * Menampilkan form tambah data PKL.
     */
    public function create()
    {
        return view(
            'Admin.Konten.Data_pkl.tambah',
            [
                'isEdit' => false,
                'dataPkl' => null,
            ]
        );
    }

    /**
     * Menyimpan data PKL baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pkl' => 'required|string|max:150',
            'jenis_dagangan' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'nama_pkl.required' => 'Nama PKL wajib diisi.',
            'nama_pkl.max' => 'Nama PKL maksimal 150 karakter.',
            'jenis_dagangan.required' => 'Jenis dagangan wajib diisi.',
            'jenis_dagangan.max' => 'Jenis dagangan maksimal 100 karakter.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',
        ]);

        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        DataPkl::create($validated);

        return redirect()
            ->route('datapkl.index')
            ->with('success', 'Data PKL berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data PKL.
     */
    public function show($id)
    {
        $dataPkl = DataPkl::findOrFail($id);

        return view(
            'Admin.Konten.Data_pkl.show',
            compact('dataPkl')
        );
    }

    /**
     * Menampilkan form edit data PKL.
     */
    public function edit($id)
    {
        $dataPkl = DataPkl::findOrFail($id);

        return view(
            'Admin.Konten.Data_pkl.tambah',
            [
                'isEdit' => true,
                'dataPkl' => $dataPkl,
            ]
        );
    }

    /**
     * Memperbarui data PKL.
     */
    public function update(Request $request, $id)
    {
        $dataPkl = DataPkl::findOrFail($id);

        $validated = $request->validate([
            'nama_pkl' => 'required|string|max:150',
            'jenis_dagangan' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'nama_pkl.required' => 'Nama PKL wajib diisi.',
            'nama_pkl.max' => 'Nama PKL maksimal 150 karakter.',
            'jenis_dagangan.required' => 'Jenis dagangan wajib diisi.',
            'jenis_dagangan.max' => 'Jenis dagangan maksimal 100 karakter.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',
        ]);

        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        $dataPkl->update($validated);

        return redirect()
            ->route('datapkl.index')
            ->with('success', 'Data PKL berhasil diperbarui.');
    }

    /**
     * Menghapus data PKL.
     */
    public function destroy($id)
    {
        $dataPkl = DataPkl::findOrFail($id);

        $dataPkl->delete();

        return redirect()
            ->route('datapkl.index')
            ->with('success', 'Data PKL berhasil dihapus.');
    }
}
