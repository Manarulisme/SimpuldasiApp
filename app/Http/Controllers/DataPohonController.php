<?php

namespace App\Http\Controllers;

use App\Models\DataPohon;
use Illuminate\Http\Request;

class DataPohonController extends Controller
{
    /**
     * Menampilkan seluruh data pohon.
     */
    public function index()
    {
        $dataPohon = DataPohon::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_pohon.index',
            compact('dataPohon')
        );
    }

    /**
     * Menampilkan form tambah data pohon.
     */
    public function create()
    {
        return view(
            'Admin.Konten.Data_pohon.tambah',
            [
                'isEdit' => false,
            ]
        );
    }

    /**
     * Menyimpan data pohon baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pohon' => [
                'required',
                'string',
                'max:255',
            ],

            'lokasi' => [
                'nullable',
                'string',
            ],

            'jumlah' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'kondisi' => [
                'nullable',
                'string',
                'in:Baik,Cukup Baik,Perlu Perawatan',
            ],
        ], [
            'jenis_pohon.required' => 'Jenis pohon wajib diisi.',
            'jenis_pohon.string' => 'Jenis pohon harus berupa teks.',
            'jenis_pohon.max' => 'Jenis pohon maksimal 255 karakter.',

            'lokasi.string' => 'Lokasi harus berupa teks.',

            'jumlah.integer' => 'Jumlah pohon harus berupa angka.',
            'jumlah.min' => 'Jumlah pohon minimal 1.',

            'kondisi.in' => 'Kondisi pohon yang dipilih tidak valid.',
        ]);

        DataPohon::create([
            'jenis_pohon' => $validated['jenis_pohon'],
            'lokasi' => $validated['lokasi'] ?? null,
            'jumlah' => $validated['jumlah'] ?? null,
            'kondisi' => $validated['kondisi'] ?? null,
            'google_sync_status' => 'pending',
        ]);

        return redirect()
            ->route('datapohon.index')
            ->with('success', 'Data pohon berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data pohon.
     */
    public function show($id)
    {
        $dataPohon = DataPohon::findOrFail($id);

        return view(
            'Admin.Konten.Data_pohon.show',
            compact('dataPohon')
        );
    }

    /**
     * Menampilkan form edit data pohon.
     */
    public function edit($id)
    {
        $dataPohon = DataPohon::findOrFail($id);

        return view(
            'Admin.Konten.Data_pohon.tambah',
            [
                'dataPohon' => $dataPohon,
                'isEdit' => true,
            ]
        );
    }

    /**
     * Memperbarui data pohon.
     */
    public function update(Request $request, $id)
    {
        $dataPohon = DataPohon::findOrFail($id);

        $validated = $request->validate([
            'jenis_pohon' => [
                'required',
                'string',
                'max:255',
            ],

            'lokasi' => [
                'nullable',
                'string',
            ],

            'jumlah' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'kondisi' => [
                'nullable',
                'string',
                'in:Baik,Cukup Baik,Perlu Perawatan',
            ],
        ], [
            'jenis_pohon.required' => 'Jenis pohon wajib diisi.',
            'jenis_pohon.string' => 'Jenis pohon harus berupa teks.',
            'jenis_pohon.max' => 'Jenis pohon maksimal 255 karakter.',

            'lokasi.string' => 'Lokasi harus berupa teks.',

            'jumlah.integer' => 'Jumlah pohon harus berupa angka.',
            'jumlah.min' => 'Jumlah pohon minimal 1.',

            'kondisi.in' => 'Kondisi pohon yang dipilih tidak valid.',
        ]);

        $dataPohon->update([
            'jenis_pohon' => $validated['jenis_pohon'],
            'lokasi' => $validated['lokasi'] ?? null,
            'jumlah' => $validated['jumlah'] ?? null,
            'kondisi' => $validated['kondisi'] ?? null,

            // Tandai kembali sebagai pending agar nantinya
            // dapat disinkronkan ulang ke Google Sheets.
            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);

        return redirect()
            ->route('datapohon.index')
            ->with('success', 'Data pohon berhasil diperbarui.');
    }

    /**
     * Menghapus data pohon.
     */
    public function destroy($id)
    {
        $dataPohon = DataPohon::findOrFail($id);

        $dataPohon->delete();

        return redirect()
            ->route('datapohon.index')
            ->with('success', 'Data pohon berhasil dihapus.');
    }
}
