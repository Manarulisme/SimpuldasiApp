<?php

namespace App\Http\Controllers;

use App\Models\DataLinmas;
use Illuminate\Http\Request;

class DataLinmasController extends Controller
{
    /**
     * Menampilkan seluruh data Linmas & Siskamling.
     */
    public function index()
    {
        $dataLinmas = DataLinmas::orderBy('rw', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        return view(
            'Admin.Konten.Data_linmas.index',
            compact('dataLinmas')
        );
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view(
            'Admin.Konten.Data_linmas.tambah',
            [
                'isEdit' => false,
                'dataLinmas' => null,
            ]
        );
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rw' => 'required|string|max:10',
            'jumlah_linmas' => 'required|integer|min:0',
            'nama' => 'nullable|string|max:150',
            'nik' => 'nullable|string|max:30',
            'alamat' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:100',
            'jumlah_poskamling' => 'required|integer|min:0',
            'titik_poskamling' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'rw.required' => 'RW wajib diisi.',
            'jumlah_linmas.required' => 'Jumlah Linmas wajib diisi.',
            'jumlah_linmas.integer' => 'Jumlah Linmas harus berupa angka.',
            'jumlah_linmas.min' => 'Jumlah Linmas tidak boleh kurang dari 0.',
            'nik.max' => 'NIK maksimal 30 karakter.',
            'jumlah_poskamling.required' => 'Jumlah Poskamling wajib diisi.',
            'jumlah_poskamling.integer' => 'Jumlah Poskamling harus berupa angka.',
            'jumlah_poskamling.min' => 'Jumlah Poskamling tidak boleh kurang dari 0.',
            'titik_poskamling.max' => 'Titik Poskamling maksimal 255 karakter.',
        ]);

        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        DataLinmas::create($validated);

        return redirect()
            ->route('datalinmas.index')
            ->with('success', 'Data Linmas & Siskamling berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $dataLinmas = DataLinmas::findOrFail($id);

        return view(
            'Admin.Konten.Data_linmas.show',
            compact('dataLinmas')
        );
    }

    /**
     * Menampilkan form edit data.
     */
    public function edit($id)
    {
        $dataLinmas = DataLinmas::findOrFail($id);

        return view(
            'Admin.Konten.Data_linmas.tambah',
            [
                'isEdit' => true,
                'dataLinmas' => $dataLinmas,
            ]
        );
    }

    /**
     * Memperbarui data.
     */
    public function update(Request $request, $id)
    {
        $dataLinmas = DataLinmas::findOrFail($id);

        $validated = $request->validate([
            'rw' => 'required|string|max:10',
            'jumlah_linmas' => 'required|integer|min:0',
            'nama' => 'nullable|string|max:150',
            'nik' => 'nullable|string|max:30',
            'alamat' => 'nullable|string',
            'pekerjaan' => 'nullable|string|max:100',
            'jumlah_poskamling' => 'required|integer|min:0',
            'titik_poskamling' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'rw.required' => 'RW wajib diisi.',
            'jumlah_linmas.required' => 'Jumlah Linmas wajib diisi.',
            'jumlah_linmas.integer' => 'Jumlah Linmas harus berupa angka.',
            'jumlah_linmas.min' => 'Jumlah Linmas tidak boleh kurang dari 0.',
            'nik.max' => 'NIK maksimal 30 karakter.',
            'jumlah_poskamling.required' => 'Jumlah Poskamling wajib diisi.',
            'jumlah_poskamling.integer' => 'Jumlah Poskamling harus berupa angka.',
            'jumlah_poskamling.min' => 'Jumlah Poskamling tidak boleh kurang dari 0.',
            'titik_poskamling.max' => 'Titik Poskamling maksimal 255 karakter.',
        ]);

        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        $dataLinmas->update($validated);

        return redirect()
            ->route('datalinmas.index')
            ->with('success', 'Data Linmas & Siskamling berhasil diperbarui.');
    }

    /**
     * Menghapus data.
     */
    public function destroy($id)
    {
        $dataLinmas = DataLinmas::findOrFail($id);

        $dataLinmas->delete();

        return redirect()
            ->route('datalinmas.index')
            ->with('success', 'Data Linmas & Siskamling berhasil dihapus.');
    }
}
