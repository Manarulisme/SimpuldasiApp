<?php

namespace App\Http\Controllers;

use App\Models\DataRtRw;
use Illuminate\Http\Request;

class DataRtRwController extends Controller
{
    /**
     * Menampilkan seluruh data RT & RW.
     */
    public function index()
    {
$dataRtRw = DataRtRw::orderBy('created_at', 'desc')->get();

return view(
    'Admin.Konten.Data_rt_rw.index',
    compact('dataRtRw')
);
    }

    /**
     * Menampilkan tambah tambah data.
     */
    public function create()
    {
        return view('Admin.Konten.Data_rt_rw.tambah', [
            'isEdit' => false,
            'dataRtRw' => null,
        ]);
    }

    /**
     * Menyimpan data RT & RW baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_rt' => 'required|string|max:150',
            'nomor_rt' => 'required|string|max:20',
            'nama_rw' => 'required|string|max:150',
            'nomor_rw' => 'required|string|max:20',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ], [
            'nama_rt.required' => 'Nama Ketua RT wajib diisi.',
            'nama_rt.max' => 'Nama Ketua RT maksimal 150 karakter.',

            'nomor_rt.required' => 'Nomor RT wajib diisi.',
            'nomor_rt.max' => 'Nomor RT maksimal 20 karakter.',

            'nama_rw.required' => 'Nama Ketua RW wajib diisi.',
            'nama_rw.max' => 'Nama Ketua RW maksimal 150 karakter.',

            'nomor_rw.required' => 'Nomor RW wajib diisi.',
            'nomor_rw.max' => 'Nomor RW maksimal 20 karakter.',

            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',

            'tanggal_berakhir.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal berakhir tidak boleh sebelum tanggal mulai.',
        ]);

        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        DataRtRw::create($validated);

        return redirect()
            ->route('datartrw.index')
            ->with('success', 'Data RT & RW berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data RT & RW.
     */
    public function show(DataRtRw $datartrw)
    {
        return view(
            'Admin.Konten.Data_rt_rw.show',
            compact('datartrw')
        );
    }

    /**
     * Menampilkan tambah edit data.
     */
    public function edit(DataRtRw $datartrw)
    {
        return view('Admin.Konten.Data_rt_rw.tambah', [
            'isEdit' => true,
            'dataRtRw' => $datartrw,
        ]);
    }

    /**
     * Memperbarui data RT & RW.
     */
    public function update(Request $request, DataRtRw $datartrw)
    {
        $validated = $request->validate([
            'nama_rt' => 'required|string|max:150',
            'nomor_rt' => 'required|string|max:20',
            'nama_rw' => 'required|string|max:150',
            'nomor_rw' => 'required|string|max:20',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ], [
            'nama_rt.required' => 'Nama Ketua RT wajib diisi.',
            'nama_rt.max' => 'Nama Ketua RT maksimal 150 karakter.',

            'nomor_rt.required' => 'Nomor RT wajib diisi.',
            'nomor_rt.max' => 'Nomor RT maksimal 20 karakter.',

            'nama_rw.required' => 'Nama Ketua RW wajib diisi.',
            'nama_rw.max' => 'Nama Ketua RW maksimal 150 karakter.',

            'nomor_rw.required' => 'Nomor RW wajib diisi.',
            'nomor_rw.max' => 'Nomor RW maksimal 20 karakter.',

            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',

            'tanggal_berakhir.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
            'tanggal_berakhir.after_or_equal' => 'Tanggal berakhir tidak boleh sebelum tanggal mulai.',
        ]);

        $validated['google_sync_status'] = 'pending';
        $validated['google_synced_at'] = null;

        $datartrw->update($validated);

        return redirect()
            ->route('datartrw.index')
            ->with('success', 'Data RT & RW berhasil diperbarui.');
    }

    /**
     * Menghapus data RT & RW.
     */
    public function destroy(DataRtRw $datartrw)
    {
        $datartrw->delete();

        return redirect()
            ->route('datartrw.index')
            ->with('success', 'Data RT & RW berhasil dihapus.');
    }
}
