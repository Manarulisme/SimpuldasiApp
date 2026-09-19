<?php

namespace App\Http\Controllers;

use App\Models\DataUmumKepegawaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataUmumKepegawaianController extends Controller
{
    /**
     * Menampilkan seluruh data pegawai
     */
    public function index()
    {
        $pegawai = DataUmumKepegawaian::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_umum_pegawai.index',
            compact('pegawai')
        );
    }


    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        $pegawai = null;
        $isEdit = false;

        return view(
            'Admin.Konten.Data_umum_pegawai.tambah',
            compact('pegawai', 'isEdit')
        );
    }


    /**
     * Menyimpan data pegawai baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => [
                'required',
                'in:ASN,PPPK,Non-ASN'
            ],

            'nomor' => [
                'required',
                'string',
                'max:100'
            ],

            'nama' => [
                'required',
                'string',
                'max:150'
            ],

            'golongan' => [
                'required',
                'string',
                'max:20'
            ],

            'pangkat' => [
                'required',
                'string',
                'max:100'
            ],

            'jabatan' => [
                'required',
                'string',
                'max:150'
            ],

            'keterangan' => [
                'nullable',
                'string'
            ],
        ], [

            'jenis.required' =>
                'Jenis pegawai wajib dipilih.',

            'jenis.in' =>
                'Jenis pegawai tidak valid.',

            'nomor.required' =>
                'NIP / NRP / TT wajib diisi.',

            'nama.required' =>
                'Nama lengkap wajib diisi.',

            'golongan.required' =>
                'Golongan wajib dipilih.',

            'pangkat.required' =>
                'Pangkat wajib diisi.',

            'jabatan.required' =>
                'Jabatan wajib diisi.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $pegawai = DataUmumKepegawaian::create([

            'jenis' => $validated['jenis'],

            'nomor' => $validated['nomor'],

            'nama' => $validated['nama'],

            'golongan' => $validated['golongan'],

            'pangkat' => $validated['pangkat'],

            'jabatan' => $validated['jabatan'],

            'keterangan' => $validated['keterangan'] ?? null,

            'google_sync_status' => 'pending',

            'google_synced_at' => null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. KIRIM KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $sync = $this->sendToGoogleSheets([

            'module' => 'Data Umum Kepegawaian',

            'action' => 'create',

            'id' => $pegawai->id,

            'jenis' => $pegawai->jenis,

            'nomor' => $pegawai->nomor,

            'nama' => $pegawai->nama,

            'golongan' => $pegawai->golongan,

            'pangkat' => $pegawai->pangkat,

            'jabatan' => $pegawai->jabatan,

            'keterangan' => $pegawai->keterangan,

            'updated_at' => $pegawai->updated_at
                ? $pegawai->updated_at->format('d/m/Y H:i:s')
                : now()->format('d/m/Y H:i:s'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | 3. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($sync) {

            $pegawai->update([

                'google_sync_status' => 'synced',

                'google_synced_at' => now(),
            ]);


            return redirect()
                ->route('dataumumpegawai.index')
                ->with(
                    'success',
                    'Data pegawai berhasil ditambahkan dan disinkronkan ke Google Sheets.'
                );
        }


        $pegawai->update([

            'google_sync_status' => 'failed',

            'google_synced_at' => null,
        ]);


        return redirect()
            ->route('dataumumpegawai.index')
            ->with(
                'warning',
                'Data pegawai berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data pegawai
     */
    public function show(DataUmumKepegawaian $dataumumpegawai)
    {
        $pegawai = $dataumumpegawai;

        return view(
            'Admin.Konten.Data_umum_pegawai.show',
            compact('pegawai')
        );
    }


    /**
     * Menampilkan form edit
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
     * Memperbarui data pegawai
     */
    public function update(
        Request $request,
        DataUmumKepegawaian $dataumumpegawai
    ) {
        $validated = $request->validate([
            'jenis' => [
                'required',
                'in:ASN,PPPK,Non-ASN'
            ],

            'nomor' => [
                'required',
                'string',
                'max:100'
            ],

            'nama' => [
                'required',
                'string',
                'max:150'
            ],

            'golongan' => [
                'required',
                'string',
                'max:20'
            ],

            'pangkat' => [
                'required',
                'string',
                'max:100'
            ],

            'jabatan' => [
                'required',
                'string',
                'max:150'
            ],

            'keterangan' => [
                'nullable',
                'string'
            ],
        ], [

            'jenis.required' =>
                'Jenis pegawai wajib dipilih.',

            'jenis.in' =>
                'Jenis pegawai tidak valid.',

            'nomor.required' =>
                'NIP / NRP / TT wajib diisi.',

            'nama.required' =>
                'Nama lengkap wajib diisi.',

            'golongan.required' =>
                'Golongan wajib dipilih.',

            'pangkat.required' =>
                'Pangkat wajib diisi.',

            'jabatan.required' =>
                'Jabatan wajib diisi.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataumumpegawai->update([

            'jenis' => $validated['jenis'],

            'nomor' => $validated['nomor'],

            'nama' => $validated['nama'],

            'golongan' => $validated['golongan'],

            'pangkat' => $validated['pangkat'],

            'jabatan' => $validated['jabatan'],

            'keterangan' => $validated['keterangan'] ?? null,

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

        $sync = $this->sendToGoogleSheets([

            'module' => 'Data Umum Kepegawaian',

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
                ? $dataumumpegawai->updated_at->format('d/m/Y H:i:s')
                : now()->format('d/m/Y H:i:s'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | 4. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($sync) {

            $dataumumpegawai->update([

                'google_sync_status' => 'synced',

                'google_synced_at' => now(),
            ]);


            return redirect()
                ->route('dataumumpegawai.index')
                ->with(
                    'success',
                    'Data pegawai berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        $dataumumpegawai->update([

            'google_sync_status' => 'failed',

            'google_synced_at' => null,
        ]);


        return redirect()
            ->route('dataumumpegawai.index')
            ->with(
                'warning',
                'Data pegawai berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data pegawai
     *
     * CATATAN:
     * Delete hanya dilakukan pada database lokal.
     * Tidak ada sinkronisasi delete ke Google Sheets.
     */
    public function destroy(DataUmumKepegawaian $dataumumpegawai)
    {
        $dataumumpegawai->delete();

        return redirect()
            ->route('dataumumpegawai.index')
            ->with(
                'success',
                'Data pegawai berhasil dihapus.'
            );
    }


    /**
     * Mengirim data ke Google Apps Script
     */
    private function sendToGoogleSheets(array $data): bool
    {
        $url = env('GOOGLE_SHEETS_WEBHOOK_URL');


        /*
        |--------------------------------------------------------------------------
        | CEK WEBHOOK
        |--------------------------------------------------------------------------
        */

        if (!$url) {

            Log::error(
                'GOOGLE_SHEETS_WEBHOOK_URL tidak ditemukan di .env'
            );

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | ENCODE JSON
        |--------------------------------------------------------------------------
        */

        $jsonData = json_encode(
            $data,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );


        if ($jsonData === false) {

            Log::error(
                'Gagal encode JSON Google Sheets Data Umum Kepegawaian',
                [
                    'data' => $data,

                    'json_error' =>
                        json_last_error_msg(),
                ]
            );

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | CURL REQUEST
        |--------------------------------------------------------------------------
        */

        $ch = curl_init($url);


        curl_setopt_array($ch, [

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => $jsonData,

            CURLOPT_HTTPHEADER => [

                'Content-Type: application/json',

                'Accept: application/json',

                'Content-Length: ' . strlen($jsonData),
            ],

            CURLOPT_CONNECTTIMEOUT => 10,

            CURLOPT_TIMEOUT => 30,

            /*
             * Jangan mengikuti redirect otomatis.
             * Google Apps Script biasanya memberikan
             * response redirect setelah menerima POST.
             */

            CURLOPT_FOLLOWLOCATION => false,

            CURLOPT_HTTP_VERSION =>
                CURL_HTTP_VERSION_1_1,

            CURLOPT_HEADER => true,
        ]);


        $rawResponse = curl_exec($ch);


        $httpCode = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );


        $redirectUrl = curl_getinfo(
            $ch,
            CURLINFO_REDIRECT_URL
        );


        $curlErrno = curl_errno($ch);


        $curlError = curl_error($ch);


        $headerSize = curl_getinfo(
            $ch,
            CURLINFO_HEADER_SIZE
        );


        $responseHeaders = '';

        $responseBody = '';


        if ($rawResponse !== false) {

            $responseHeaders = substr(
                $rawResponse,
                0,
                $headerSize
            );

            $responseBody = substr(
                $rawResponse,
                $headerSize
            );
        }


        curl_close($ch);


        /*
        |--------------------------------------------------------------------------
        | LOG RESPONSE AWAL
        |--------------------------------------------------------------------------
        */

        Log::info(
            'Response Google Sheets Data Umum Kepegawaian - Initial',
            [

                'http_code' => $httpCode,

                'curl_errno' => $curlErrno,

                'curl_error' => $curlError,

                'redirect_url' => $redirectUrl,

                'response_headers' => $responseHeaders,

                'response_body' => $responseBody,

                'data' => $data,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | CEK CURL ERROR
        |--------------------------------------------------------------------------
        */

        if ($rawResponse === false) {

            Log::error(
                'cURL Google Sheets Data Umum Kepegawaian gagal',
                [

                    'curl_errno' => $curlErrno,

                    'curl_error' => $curlError,

                    'data' => $data,
                ]
            );

            return false;
        }


        if ($curlErrno !== 0) {

            Log::error(
                'cURL Google Sheets Data Umum Kepegawaian error',
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
        | JIKA GOOGLE MEMBERIKAN REDIRECT
        |--------------------------------------------------------------------------
        */

        if (
            (
                $httpCode === 301 ||
                $httpCode === 302 ||
                $httpCode === 303
            )
            &&
            $redirectUrl
        ) {

            $redirectUrl = trim(
                $redirectUrl
            );


            /*
            |--------------------------------------------------------------------------
            | REQUEST KE URL REDIRECT
            |--------------------------------------------------------------------------
            */

            $ch = curl_init(
                $redirectUrl
            );


            curl_setopt_array($ch, [

                CURLOPT_RETURNTRANSFER => true,

                CURLOPT_HTTPGET => true,

                CURLOPT_HTTPHEADER => [

                    'Accept: application/json',
                ],

                CURLOPT_CONNECTTIMEOUT => 10,

                CURLOPT_TIMEOUT => 30,

                CURLOPT_FOLLOWLOCATION => false,

                CURLOPT_HTTP_VERSION =>
                    CURL_HTTP_VERSION_1_1,
            ]);


            $finalResponse = curl_exec($ch);


            $finalHttpCode = curl_getinfo(
                $ch,
                CURLINFO_HTTP_CODE
            );


            $finalCurlErrno = curl_errno(
                $ch
            );


            $finalCurlError = curl_error(
                $ch
            );


            curl_close($ch);


            /*
            |--------------------------------------------------------------------------
            | LOG RESPONSE REDIRECT
            |--------------------------------------------------------------------------
            */

            Log::info(
                'Response Google Sheets Data Umum Kepegawaian - Redirect',
                [

                    'http_code' =>
                        $finalHttpCode,

                    'curl_errno' =>
                        $finalCurlErrno,

                    'curl_error' =>
                        $finalCurlError,

                    'response' =>
                        $finalResponse,

                    'data' =>
                        $data,
                ]
            );


            if (
                $finalResponse === false ||
                $finalCurlErrno !== 0
            ) {

                return false;
            }


            /*
            |--------------------------------------------------------------------------
            | CEK JSON RESPONSE
            |--------------------------------------------------------------------------
            */

            $decoded = json_decode(
                $finalResponse,
                true
            );


            if (
                is_array($decoded) &&
                isset($decoded['success'])
            ) {

                return (bool) $decoded['success'];
            }


            /*
            |--------------------------------------------------------------------------
            | HTTP 2xx DIANGGAP BERHASIL
            |--------------------------------------------------------------------------
            */

            if (
                $finalHttpCode >= 200 &&
                $finalHttpCode < 300
            ) {

                return true;
            }


            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSE JSON NORMAL
        |--------------------------------------------------------------------------
        */

        $decoded = json_decode(
            $responseBody,
            true
        );


        if (
            is_array($decoded) &&
            isset($decoded['success'])
        ) {

            return (bool) $decoded['success'];
        }


        /*
        |--------------------------------------------------------------------------
        | HTTP 2xx
        |--------------------------------------------------------------------------
        */

        if (
            $httpCode >= 200 &&
            $httpCode < 300
        ) {

            return true;
        }


        /*
        |--------------------------------------------------------------------------
        | HTTP ERROR
        |--------------------------------------------------------------------------
        */

        Log::error(
            'Google Sheets Data Umum Kepegawaian HTTP error',
            [

                'http_code' => $httpCode,

                'response' => $responseBody,

                'data' => $data,
            ]
        );


        return false;
    }
}
