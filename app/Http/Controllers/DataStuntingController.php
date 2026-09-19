<?php

namespace App\Http\Controllers;

use App\Models\DataStunting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataStuntingController extends Controller
{
    /**
     * Menampilkan seluruh data stunting.
     */
    public function index()
    {
        $dataStunting = DataStunting::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_stunting.index',
            compact('dataStunting')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $stunting = null;
        $isEdit = false;

        return view(
            'Admin.Konten.Data_stunting.tambah',
            compact('stunting', 'isEdit')
        );
    }


    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'nik' => [
                'required',
                'string',
                'max:20',
                'unique:data_stunting,nik',
            ],

            'nama' => [
                'required',
                'string',
                'max:150',
            ],

            'tanggal_lahir' => [
                'required',
                'date',
            ],

            'jenis_kelamin' => [
                'required',
                'in:Laki-laki,Perempuan',
            ],

            'status' => [
                'required',
                'in:Normal,Berisiko,Stunting',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

        ], [

            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK tersebut sudah terdaftar.',
            'nik.max' => 'NIK maksimal 20 karakter.',

            'nama.required' => 'Nama anak wajib diisi.',
            'nama.max' => 'Nama anak maksimal 150 karakter.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'status.required' => 'Status stunting wajib dipilih.',
            'status.in' => 'Status stunting tidak valid.',

        ]);


        $stunting = DataStunting::create([

            'nik' => $validated['nik'],

            'nama' => $validated['nama'],

            'tanggal_lahir' => $validated['tanggal_lahir'],

            'jenis_kelamin' => $validated['jenis_kelamin'],

            'status' => $validated['status'],

            'keterangan' => $validated['keterangan'] ?? null,

            'google_sync_status' => 'pending',

            'google_synced_at' => null,

        ]);


        return redirect()
            ->route('datastunting.index')
            ->with(
                'success',
                'Data stunting berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show(DataStunting $datastunting)
    {
        $stunting = $datastunting;

        return view(
            'Admin.Konten.Data_stunting.show',
            compact('stunting')
        );
    }


    /**
     * Form edit data.
     */
    public function edit(DataStunting $datastunting)
    {
$stunting = $datastunting;
$isEdit = true;

return view(
    'Admin.Konten.Data_stunting.tambah',
    compact('stunting', 'isEdit')
);
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataStunting $datastunting
    ) {
        $validated = $request->validate([

            'nik' => [
                'required',
                'string',
                'max:20',
                Rule::unique('data_stunting', 'nik')
                    ->ignore($datastunting->id),
            ],

            'nama' => [
                'required',
                'string',
                'max:150',
            ],

            'tanggal_lahir' => [
                'required',
                'date',
            ],

            'jenis_kelamin' => [
                'required',
                'in:Laki-laki,Perempuan',
            ],

            'status' => [
                'required',
                'in:Normal,Berisiko,Stunting',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],

        ], [

            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK tersebut sudah digunakan data lain.',
            'nik.max' => 'NIK maksimal 20 karakter.',

            'nama.required' => 'Nama anak wajib diisi.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',

            'status.required' => 'Status stunting wajib dipilih.',

        ]);


        $datastunting->update([

            'nik' => $validated['nik'],

            'nama' => $validated['nama'],

            'tanggal_lahir' => $validated['tanggal_lahir'],

            'jenis_kelamin' => $validated['jenis_kelamin'],

            'status' => $validated['status'],

            'keterangan' => $validated['keterangan'] ?? null,

            'google_sync_status' => 'pending',

            'google_synced_at' => null,

        ]);


        return redirect()
            ->route('datastunting.index')
            ->with(
                'success',
                'Data stunting berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data.
     *
     * Penghapusan hanya dilakukan pada database lokal.
     */
    public function destroy(DataStunting $datastunting)
    {
        $datastunting->delete();

        return redirect()
            ->route('datastunting.index')
            ->with(
                'success',
                'Data stunting berhasil dihapus.'
            );
    }
}
