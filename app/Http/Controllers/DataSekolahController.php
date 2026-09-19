<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataSekolahController extends Controller
{
    /**
     * Menampilkan seluruh data sekolah.
     */
    public function index()
    {
        $dataSekolah = DataSekolah::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_sekolah.index',
            compact('dataSekolah')
        );
    }

    /**
     * Menampilkan form tambah data sekolah.
     */
    public function create()
    {
        $sekolah = null;
        $isEdit = false;

        return view(
            'Admin.Konten.Data_sekolah.tambah',
            compact('sekolah', 'isEdit')
        );
    }

    /**
     * Menyimpan data sekolah baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_data' => [
                'required',
                'string',
                'max:50',
                'unique:data_sekolah,id_data',
            ],

            'nama_sekolah' => [
                'required',
                'string',
                'max:150',
            ],

            'jenjang' => [
                'required',
                'in:TK,SD,SMP,SMA,SMK',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'jumlah_siswa' => [
                'required',
                'integer',
                'min:0',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ], [
            'id_data.required' => 'ID Data wajib diisi.',
            'id_data.unique' => 'ID Data sudah digunakan.',

            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',

            'jenjang.required' => 'Jenjang sekolah wajib dipilih.',
            'jenjang.in' => 'Jenjang sekolah tidak valid.',

            'alamat.required' => 'Alamat sekolah wajib diisi.',

            'jumlah_siswa.required' => 'Jumlah siswa wajib diisi.',
            'jumlah_siswa.integer' => 'Jumlah siswa harus berupa angka.',
            'jumlah_siswa.min' => 'Jumlah siswa tidak boleh kurang dari 0.',
        ]);

        DataSekolah::create([
            'id_data' => $validated['id_data'],
            'nama_sekolah' => $validated['nama_sekolah'],
            'jenjang' => $validated['jenjang'],
            'alamat' => $validated['alamat'],
            'jumlah_siswa' => $validated['jumlah_siswa'],
            'keterangan' => $validated['keterangan'] ?? null,
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        return redirect()
            ->route('datasekolah.index')
            ->with(
                'success',
                'Data sekolah berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail data sekolah.
     */
    public function show(DataSekolah $datasekolah)
    {
        $sekolah = $datasekolah;

        return view(
            'Admin.Konten.Data_sekolah.show',
            compact('sekolah')
        );
    }

    /**
     * Menampilkan form edit data sekolah.
     */
    public function edit(DataSekolah $datasekolah)
    {
        $sekolah = $datasekolah;
        $isEdit = true;

        return view(
            'Admin.Konten.Data_sekolah.tambah',
            compact('sekolah', 'isEdit')
        );
    }

    /**
     * Memperbarui data sekolah.
     */
    public function update(
        Request $request,
        DataSekolah $datasekolah
    ) {
        $validated = $request->validate([
            'id_data' => [
                'required',
                'string',
                'max:50',
                Rule::unique(
                    'data_sekolah',
                    'id_data'
                )->ignore($datasekolah->id),
            ],

            'nama_sekolah' => [
                'required',
                'string',
                'max:150',
            ],

            'jenjang' => [
                'required',
                'in:TK,SD,SMP,SMA,SMK',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'jumlah_siswa' => [
                'required',
                'integer',
                'min:0',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ], [
            'id_data.required' => 'ID Data wajib diisi.',
            'id_data.unique' => 'ID Data sudah digunakan.',

            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',

            'jenjang.required' => 'Jenjang sekolah wajib dipilih.',
            'jenjang.in' => 'Jenjang sekolah tidak valid.',

            'alamat.required' => 'Alamat sekolah wajib diisi.',

            'jumlah_siswa.required' => 'Jumlah siswa wajib diisi.',
            'jumlah_siswa.integer' => 'Jumlah siswa harus berupa angka.',
            'jumlah_siswa.min' => 'Jumlah siswa tidak boleh kurang dari 0.',
        ]);

        $datasekolah->update([
            'id_data' => $validated['id_data'],
            'nama_sekolah' => $validated['nama_sekolah'],
            'jenjang' => $validated['jenjang'],
            'alamat' => $validated['alamat'],
            'jumlah_siswa' => $validated['jumlah_siswa'],
            'keterangan' => $validated['keterangan'] ?? null,
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        return redirect()
            ->route('datasekolah.index')
            ->with(
                'success',
                'Data sekolah berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data sekolah.
     */
    public function destroy(DataSekolah $datasekolah)
    {
        $datasekolah->delete();

        return redirect()
            ->route('datasekolah.index')
            ->with(
                'success',
                'Data sekolah berhasil dihapus.'
            );
    }
}
