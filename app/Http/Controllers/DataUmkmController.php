<?php

namespace App\Http\Controllers;

use App\Models\DataUmkm;
use Illuminate\Http\Request;

class DataUmkmController extends Controller
{
    /**
     * Menampilkan seluruh data UMKM.
     */
    public function index()
    {
        $dataUmkm = DataUmkm::orderBy('updated_at', 'desc')->get();

        return view('Admin.Konten.Data_umkm.index', compact('dataUmkm'));
    }

    /**
     * Menampilkan form tambah data UMKM.
     */
    public function create()
    {
        return view('Admin.Konten.Data_umkm.tambah', [
            'isEdit' => false,
        ]);
    }

    /**
     * Menyimpan data UMKM baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelaku_usaha'   => 'required|string|max:255',
            'nik'                 => 'nullable|string|max:20',
            'no_kk'               => 'nullable|string|max:20',
            'no_telepon'          => 'nullable|string|max:20',
            'nama_usaha'          => 'required|string|max:255',
            'jenis_usaha'         => 'nullable|string|max:255',
            'alamat_usaha'        => 'nullable|string',
            'kelurahan'           => 'nullable|string|max:255',
            'kecamatan'           => 'nullable|string|max:255',
            'kabupaten_kota'      => 'nullable|string|max:255',
            'nib'                 => 'nullable|string|max:255',
            'npwp'                => 'nullable|string|max:255',
            'izin_usaha'          => 'nullable|string|max:255',
            'produk_utama'        => 'nullable|string|max:255',
            'modal_usaha'         => 'nullable|numeric|min:0',
            'omzet_bulanan'       => 'nullable|numeric|min:0',
            'jumlah_tenaga_kerja' => 'nullable|integer|min:0',
            'skala_usaha'         => 'nullable|in:Mikro,Kecil,Menengah',
            'status_usaha'        => 'nullable|in:Aktif,Tidak Aktif',
            'keterangan'          => 'nullable|string',
        ]);

        DataUmkm::create($validated);

        return redirect()
            ->route('dataumkm.index')
            ->with('success', 'Data UMKM berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data UMKM.
     */
    public function show($id)
    {
        $dataUmkm = DataUmkm::findOrFail($id);

        return view('Admin.Konten.Data_umkm.show', compact('dataUmkm'));
    }

    /**
     * Menampilkan form edit data UMKM.
     */
    public function edit($id)
    {
        $dataUmkm = DataUmkm::findOrFail($id);

        return view('Admin.Konten.Data_umkm.tambah', [
            'dataUmkm' => $dataUmkm,
            'isEdit'   => true,
        ]);
    }

    /**
     * Memperbarui data UMKM.
     */
    public function update(Request $request, $id)
    {
        $dataUmkm = DataUmkm::findOrFail($id);

        $validated = $request->validate([
            'nama_pelaku_usaha'   => 'required|string|max:255',
            'nik'                 => 'nullable|string|max:20',
            'no_kk'               => 'nullable|string|max:20',
            'no_telepon'          => 'nullable|string|max:20',
            'nama_usaha'          => 'required|string|max:255',
            'jenis_usaha'         => 'nullable|string|max:255',
            'alamat_usaha'        => 'nullable|string',
            'kelurahan'           => 'nullable|string|max:255',
            'kecamatan'           => 'nullable|string|max:255',
            'kabupaten_kota'      => 'nullable|string|max:255',
            'nib'                 => 'nullable|string|max:255',
            'npwp'                => 'nullable|string|max:255',
            'izin_usaha'          => 'nullable|string|max:255',
            'produk_utama'        => 'nullable|string|max:255',
            'modal_usaha'         => 'nullable|numeric|min:0',
            'omzet_bulanan'       => 'nullable|numeric|min:0',
            'jumlah_tenaga_kerja' => 'nullable|integer|min:0',
            'skala_usaha'         => 'nullable|in:Mikro,Kecil,Menengah',
            'status_usaha'        => 'nullable|in:Aktif,Tidak Aktif',
            'keterangan'          => 'nullable|string',
        ]);

        $dataUmkm->update($validated);

        return redirect()
            ->route('dataumkm.index')
            ->with('success', 'Data UMKM berhasil diperbarui.');
    }

    /**
     * Menghapus data UMKM.
     */
    public function destroy($id)
    {
        $dataUmkm = DataUmkm::findOrFail($id);
        $dataUmkm->delete();

        return redirect()
            ->route('dataumkm.index')
            ->with('success', 'Data UMKM berhasil dihapus.');
    }
}
