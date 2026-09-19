<?php

namespace App\Http\Controllers;

use App\Models\DataKpm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataKpmController extends Controller
{
    /**
     * Menampilkan seluruh data KPM.
     */
    public function index()
    {
        $dataKpm = DataKpm::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_kpm.index',
            compact('dataKpm')
        );
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        $kpm = null;
        $isEdit = false;

        return view(
            'Admin.Konten.Data_kpm.tambah',
            compact('kpm', 'isEdit')
        );
    }

    /**
     * Menyimpan data KPM baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_data' => [
                'required',
                'string',
                'max:50',
                'unique:data_kpm,id_data',
            ],

            'nik' => [
                'required',
                'string',
                'max:20',
                'unique:data_kpm,nik',
            ],

            'nama' => [
                'required',
                'string',
                'max:150',
            ],

            'rw' => [
                'nullable',
                'string',
                'max:10',
            ],

            'jenis_bantuan' => [
                'required',
                'string',
                'max:100',
            ],

            'desil' => [
                'nullable',
                'integer',
                'between:1,10',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ], [

            'id_data.required' => 'ID Data KPM wajib diisi.',
            'id_data.unique' => 'ID Data KPM tersebut sudah terdaftar.',
            'id_data.max' => 'ID Data KPM maksimal 50 karakter.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK tersebut sudah terdaftar.',
            'nik.max' => 'NIK maksimal 20 karakter.',

            'nama.required' => 'Nama KPM wajib diisi.',
            'nama.max' => 'Nama KPM maksimal 150 karakter.',

            'rw.max' => 'RW maksimal 10 karakter.',

            'jenis_bantuan.required' => 'Jenis bantuan wajib diisi.',
            'jenis_bantuan.max' => 'Jenis bantuan maksimal 100 karakter.',

            'desil.integer' => 'Desil harus berupa angka.',
            'desil.between' => 'Desil harus berada antara 1 sampai 10.',
        ]);

        DataKpm::create([
            'id_data' => $validated['id_data'],
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'rw' => $validated['rw'] ?? null,
            'jenis_bantuan' => $validated['jenis_bantuan'],
            'desil' => $validated['desil'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        return redirect()
            ->route('datakpm.index')
            ->with(
                'success',
                'Data KPM berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail data KPM.
     */
    public function show(DataKpm $datakpm)
    {
        $kpm = $datakpm;

        return view(
            'Admin.Konten.Data_kpm.show',
            compact('kpm')
        );
    }

    /**
     * Menampilkan form edit data KPM.
     */
    public function edit(DataKpm $datakpm)
    {
        $kpm = $datakpm;
        $isEdit = true;

        return view(
            'Admin.Konten.Data_kpm.tambah',
            compact('kpm', 'isEdit')
        );
    }

    /**
     * Memperbarui data KPM.
     */
    public function update(
        Request $request,
        DataKpm $datakpm
    ) {
        $validated = $request->validate([
            'id_data' => [
                'required',
                'string',
                'max:50',
                Rule::unique('data_kpm', 'id_data')
                    ->ignore($datakpm->id),
            ],

            'nik' => [
                'required',
                'string',
                'max:20',
                Rule::unique('data_kpm', 'nik')
                    ->ignore($datakpm->id),
            ],

            'nama' => [
                'required',
                'string',
                'max:150',
            ],

            'rw' => [
                'nullable',
                'string',
                'max:10',
            ],

            'jenis_bantuan' => [
                'required',
                'string',
                'max:100',
            ],

            'desil' => [
                'nullable',
                'integer',
                'between:1,10',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ], [

            'id_data.required' => 'ID Data KPM wajib diisi.',
            'id_data.unique' => 'ID Data KPM tersebut sudah digunakan data lain.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK tersebut sudah digunakan data lain.',
            'nik.max' => 'NIK maksimal 20 karakter.',

            'nama.required' => 'Nama KPM wajib diisi.',
            'nama.max' => 'Nama KPM maksimal 150 karakter.',

            'rw.max' => 'RW maksimal 10 karakter.',

            'jenis_bantuan.required' => 'Jenis bantuan wajib diisi.',

            'desil.integer' => 'Desil harus berupa angka.',
            'desil.between' => 'Desil harus berada antara 1 sampai 10.',
        ]);

        $datakpm->update([
            'id_data' => $validated['id_data'],
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'rw' => $validated['rw'] ?? null,
            'jenis_bantuan' => $validated['jenis_bantuan'],
            'desil' => $validated['desil'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,

            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        return redirect()
            ->route('datakpm.index')
            ->with(
                'success',
                'Data KPM berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data KPM.
     */
    public function destroy(DataKpm $datakpm)
    {
        $datakpm->delete();

        return redirect()
            ->route('datakpm.index')
            ->with(
                'success',
                'Data KPM berhasil dihapus.'
            );
    }
}
