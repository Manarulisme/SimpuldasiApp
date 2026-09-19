<?php

namespace App\Http\Controllers;

use App\Models\DataAnakPutusSekolah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataAnakPutusSekolahController extends Controller
{
    /**
     * Menampilkan seluruh data anak putus sekolah.
     */
    public function index()
    {
        $dataPutusSekolah = DataAnakPutusSekolah::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_putus_sekolah.index',
            compact('dataPutusSekolah')
        );
    }


    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        $putusSekolah = null;
        $isEdit = false;

        return view(
            'Admin.Konten.Data_putus_sekolah.tambah',
            compact('putusSekolah', 'isEdit')
        );
    }


    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'id_data' => [
                    'required',
                    'string',
                    'max:50',
                    'unique:data_anak_putus_sekolah,id_data',
                ],

                'nik' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:data_anak_putus_sekolah,nik',
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

                'usia' => [
                    'required',
                    'integer',
                    'between:1,30',
                ],

                'jenjang_terakhir' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'alasan' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'id_data.required' =>
                    'ID Data wajib diisi.',

                'id_data.unique' =>
                    'ID Data sudah digunakan.',

                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK sudah terdaftar.',

                'nama.required' =>
                    'Nama anak wajib diisi.',

                'usia.required' =>
                    'Usia wajib diisi.',

                'usia.between' =>
                    'Usia harus antara 1 sampai 30 tahun.',

                'jenjang_terakhir.required' =>
                    'Jenjang terakhir wajib dipilih.',

                'alasan.required' =>
                    'Alasan putus sekolah wajib diisi.',
            ]
        );


        DataAnakPutusSekolah::create([
            'id_data' =>
                $validated['id_data'],

            'nik' =>
                $validated['nik'],

            'nama' =>
                $validated['nama'],

            'rw' =>
                $validated['rw'] ?? null,

            'usia' =>
                $validated['usia'],

            'jenjang_terakhir' =>
                $validated['jenjang_terakhir'],

            'alasan' =>
                $validated['alasan'],

            'keterangan' =>
                $validated['keterangan'] ?? null,

            'google_sync_status' =>
                'pending',

            'google_synced_at' =>
                null,
        ]);


        return redirect()
            ->route('dataputussekolah.index')
            ->with(
                'success',
                'Data anak putus sekolah berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show(
        DataAnakPutusSekolah $dataputussekolah
    ) {
        $putusSekolah = $dataputussekolah;

        return view(
            'Admin.Konten.Data_putus_sekolah.show',
            compact('putusSekolah')
        );
    }


    /**
     * Menampilkan form edit.
     */
    public function edit(
        DataAnakPutusSekolah $dataputussekolah
    ) {
        $putusSekolah = $dataputussekolah;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_putus_sekolah.tambah',
            compact('putusSekolah', 'isEdit')
        );
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataAnakPutusSekolah $dataputussekolah
    ) {
        $validated = $request->validate(
            [
                'id_data' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique(
                        'data_anak_putus_sekolah',
                        'id_data'
                    )->ignore($dataputussekolah->id),
                ],

                'nik' => [
                    'required',
                    'string',
                    'max:20',
                    Rule::unique(
                        'data_anak_putus_sekolah',
                        'nik'
                    )->ignore($dataputussekolah->id),
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

                'usia' => [
                    'required',
                    'integer',
                    'between:1,30',
                ],

                'jenjang_terakhir' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'alasan' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'id_data.required' =>
                    'ID Data wajib diisi.',

                'id_data.unique' =>
                    'ID Data sudah digunakan.',

                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK sudah terdaftar.',

                'nama.required' =>
                    'Nama anak wajib diisi.',

                'usia.required' =>
                    'Usia wajib diisi.',

                'usia.between' =>
                    'Usia harus antara 1 sampai 30 tahun.',

                'jenjang_terakhir.required' =>
                    'Jenjang terakhir wajib dipilih.',

                'alasan.required' =>
                    'Alasan putus sekolah wajib diisi.',
            ]
        );


        $dataputussekolah->update([
            'id_data' =>
                $validated['id_data'],

            'nik' =>
                $validated['nik'],

            'nama' =>
                $validated['nama'],

            'rw' =>
                $validated['rw'] ?? null,

            'usia' =>
                $validated['usia'],

            'jenjang_terakhir' =>
                $validated['jenjang_terakhir'],

            'alasan' =>
                $validated['alasan'],

            'keterangan' =>
                $validated['keterangan'] ?? null,

            'google_sync_status' =>
                'pending',

            'google_synced_at' =>
                null,
        ]);


        return redirect()
            ->route('dataputussekolah.index')
            ->with(
                'success',
                'Data anak putus sekolah berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data.
     */
    public function destroy(
        DataAnakPutusSekolah $dataputussekolah
    ) {
        $dataputussekolah->delete();

        return redirect()
            ->route('dataputussekolah.index')
            ->with(
                'success',
                'Data anak putus sekolah berhasil dihapus.'
            );
    }
}
