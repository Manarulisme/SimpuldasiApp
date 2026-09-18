<?php

namespace App\Http\Controllers;

use App\Models\DataUmumKepegawaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DataUmumKepegawaianController extends Controller
{
    /**
     * Menampilkan semua data pegawai
     */
    public function index()
    {
        $pegawai = DataUmumKepegawaian::latest()->get();

        return view(
            'Admin.Konten.Data_umum_pegawai.index',
            compact('pegawai')
        );
    }


    /**
     * Form tambah
     */
    public function create()
    {
        $isEdit = false;

        return view(
            'Admin.Konten.Data_umum_pegawai.tambah',
            compact('isEdit')
        );
    }


    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => ['required', 'in:ASN,PPPK,Non-ASN'],
            'nomor' => ['required', 'string', 'max:100'],
            'nama' => ['required', 'string', 'max:150'],
            'golongan' => ['required', 'string', 'max:20'],
            'pangkat' => ['required', 'string', 'max:100'],
            'jabatan' => ['required', 'string', 'max:150'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'jenis.required' => 'Jenis pegawai wajib dipilih.',
            'jenis.in' => 'Jenis pegawai tidak valid.',
            'nomor.required' => 'NIP / NRP / TT wajib diisi.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'golongan.required' => 'Golongan wajib dipilih.',
            'pangkat.required' => 'Pangkat wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $pegawai = DataUmumKepegawaian::create([
            ...$validated,

            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. KIRIM KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $berhasilSync = $this->sendToGoogleSheets([
            'action' => 'create',

            'id' => $pegawai->id,

            'jenis' => $pegawai->jenis,

            'nomor' => $pegawai->nomor,

            'nama' => $pegawai->nama,

            'golongan' => $pegawai->golongan,

            'pangkat' => $pegawai->pangkat,

            'jabatan' => $pegawai->jabatan,

            'keterangan' => $pegawai->keterangan,

            // Gunakan updated_at
            'updated_at' => $pegawai->updated_at
                ? $pegawai->updated_at->format('Y-m-d H:i:s')
                : now()->format('Y-m-d H:i:s'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | 3. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($berhasilSync) {

            $pegawai->update([
                'google_sync_status' => 'synced',
                'google_synced_at' => now(),
            ]);

        } else {

            $pegawai->update([
                'google_sync_status' => 'failed',
                'google_synced_at' => null,
            ]);
        }


        return redirect()
            ->route('dataumumpegawai.index')
            ->with(
                'success',
                'Data pegawai berhasil disimpan.'
            );
    }


    /**
     * Form edit
     */
    public function edit(DataUmumKepegawaian $dataumumpegawai)
    {
        $pegawai = $dataumumpegawai;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_umum_pegawai.edit',
            compact(
                'pegawai',
                'isEdit'
            )
        );
    }


    /**
     * Update data
     */
    public function update(
        Request $request,
        DataUmumKepegawaian $dataumumpegawai
    ) {
        $validated = $request->validate([
            'jenis' => ['required', 'in:ASN,PPPK,Non-ASN'],
            'nomor' => ['required', 'string', 'max:100'],
            'nama' => ['required', 'string', 'max:150'],
            'golongan' => ['required', 'string', 'max:20'],
            'pangkat' => ['required', 'string', 'max:100'],
            'jabatan' => ['required', 'string', 'max:150'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'jenis.required' => 'Jenis pegawai wajib dipilih.',
            'jenis.in' => 'Jenis pegawai tidak valid.',
            'nomor.required' => 'NIP / NRP / TT wajib diisi.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'golongan.required' => 'Golongan wajib dipilih.',
            'pangkat.required' => 'Pangkat wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataumumpegawai->update([

            ...$validated,

            'google_sync_status' => 'pending',

            'google_synced_at' => null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. REFRESH DATA
        |--------------------------------------------------------------------------
        |
        | Memastikan updated_at yang dikirim adalah
        | updated_at terbaru dari database.
        |
        */

        $dataumumpegawai->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. KIRIM PERUBAHAN KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $berhasilSync = $this->sendToGoogleSheets([
            'action' => 'update',

            'id' => $dataumumpegawai->id,

            'jenis' => $dataumumpegawai->jenis,

            'nomor' => $dataumumpegawai->nomor,

            'nama' => $dataumumpegawai->nama,

            'golongan' => $dataumumpegawai->golongan,

            'pangkat' => $dataumumpegawai->pangkat,

            'jabatan' => $dataumumpegawai->jabatan,

            'keterangan' => $dataumumpegawai->keterangan,

            'updated_at' => $dataumumpegawai->updated_at
                ? $dataumumpegawai->updated_at->format('Y-m-d H:i:s')
                : now()->format('Y-m-d H:i:s'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | 4. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($berhasilSync) {

            $dataumumpegawai->update([
                'google_sync_status' => 'synced',

                'google_synced_at' => now(),
            ]);

        } else {

            $dataumumpegawai->update([
                'google_sync_status' => 'failed',

                'google_synced_at' => null,
            ]);
        }


        return redirect()
            ->route('dataumumpegawai.index')
            ->with(
                'success',
                'Data pegawai berhasil diperbarui.'
            );
    }


    /**
     * Hapus data
     */
    public function destroy(
        DataUmumKepegawaian $dataumumpegawai
    ) {
        $id = $dataumumpegawai->id;


        /*
        |--------------------------------------------------------------------------
        | 1. HAPUS DARI GOOGLE SHEETS
        |--------------------------------------------------------------------------
        |
        | Kita hapus Google terlebih dahulu.
        | Kalau Google gagal, data MySQL tidak langsung hilang.
        |
        */

        $berhasilSync = $this->sendToGoogleSheets([
            'action' => 'delete',

            'id' => $id,
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. JIKA GOOGLE BERHASIL, HAPUS DATABASE
        |--------------------------------------------------------------------------
        */

        if ($berhasilSync) {

            $dataumumpegawai->delete();

            return redirect()
                ->route('dataumumpegawai.index')
                ->with(
                    'success',
                    'Data pegawai berhasil dihapus.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | 3. JIKA GOOGLE GAGAL
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('dataumumpegawai.index')
            ->with(
                'error',
                'Data gagal dihapus karena sinkronisasi dengan Google Sheets gagal.'
            );
    }


    /**
     * Komunikasi dengan Google Apps Script
     */
private function sendToGoogleSheets(array $data): bool
{
    $url = env('GOOGLE_SHEETS_WEBHOOK_URL');

    if (!$url) {
        Log::error('GOOGLE_SHEETS_WEBHOOK_URL belum dikonfigurasi.');

        return false;
    }

    try {

        $payload = json_encode(
            $data,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        $ch = curl_init($url);

        curl_setopt_array($ch, [

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => $payload,

            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],

            // Maksimal waktu koneksi
            CURLOPT_CONNECTTIMEOUT => 10,

            // Maksimal request
            CURLOPT_TIMEOUT => 25,

            // JANGAN ikuti redirect Google Apps Script
            CURLOPT_FOLLOWLOCATION => false,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        ]);

        $response = curl_exec($ch);

        $curlError = curl_error($ch);
        $curlErrno = curl_errno($ch);

        $httpCode = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

        $redirectUrl = curl_getinfo(
            $ch,
            CURLINFO_REDIRECT_URL
        );

        curl_close($ch);


        Log::info(
            'Response Google Sheets',
            [
                'http_code' => $httpCode,
                'curl_errno' => $curlErrno,
                'curl_error' => $curlError,
                'redirect_url' => $redirectUrl,
                'response' => $response,
                'data' => $data,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | CEK CURL ERROR
        |--------------------------------------------------------------------------
        */

        if ($response === false) {

            Log::error(
                'cURL Google Sheets gagal',
                [
                    'curl_errno' => $curlErrno,
                    'curl_error' => $curlError,
                    'data' => $data,
                ]
            );

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSE NORMAL
        |--------------------------------------------------------------------------
        */

        $result = json_decode(
            $response,
            true
        );


        /*
        |--------------------------------------------------------------------------
        | GOOGLE APPS SCRIPT BERHASIL
        |--------------------------------------------------------------------------
        |
        | Apps Script dapat mengembalikan HTTP 200
        | atau redirect 302 setelah POST diproses.
        |
        */

        if (
            is_array($result) &&
            isset($result['success'])
        ) {

            if ($result['success'] === true) {

                Log::info(
                    'Google Sheets berhasil disinkronkan.',
                    [
                        'response' => $result,
                        'data' => $data,
                    ]
                );

                return true;
            }

            Log::error(
                'Google Apps Script mengembalikan success=false.',
                [
                    'response' => $result,
                    'data' => $data,
                ]
            );

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | HTTP 302
        |--------------------------------------------------------------------------
        |
        | Untuk Apps Script, redirect berarti POST sudah
        | diterima dan diproses, tetapi Google mengarahkan
        | browser/client ke URL hasil.
        |
        */

        if ($httpCode === 302 || $httpCode === 301) {

            Log::info(
                'Google Apps Script mengembalikan redirect setelah POST.',
                [
                    'http_code' => $httpCode,
                    'redirect_url' => $redirectUrl,
                    'data' => $data,
                ]
            );

            return true;
        }


        /*
        |--------------------------------------------------------------------------
        | HTTP ERROR
        |--------------------------------------------------------------------------
        */

        if ($httpCode < 200 || $httpCode >= 300) {

            Log::error(
                'Google Sheets HTTP error',
                [
                    'http_code' => $httpCode,
                    'response' => $response,
                    'data' => $data,
                ]
            );

            return false;
        }


        return true;


    } catch (\Throwable $e) {

        Log::error(
            'Gagal menghubungi Google Sheets',
            [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'data' => $data,
            ]
        );

        return false;
    }
}
}
