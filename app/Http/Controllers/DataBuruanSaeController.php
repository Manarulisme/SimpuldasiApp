<?php

namespace App\Http\Controllers;

use App\Models\DataBuruanSae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataBuruanSaeController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'BuruanSae';


    /**
     * Menampilkan seluruh data Buruan Sae.
     */
    public function index()
    {
        $dataBuruanSae = DataBuruanSae::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_buruan_sae.index',
            compact('dataBuruanSae')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $dataBuruanSae = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_buruan_sae.tambah',
            compact(
                'dataBuruanSae',
                'isEdit'
            )
        );
    }


    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'nama' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'lokasi' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'rw' => [
                    'nullable',
                    'string',
                    'max:5',
                ],

                'jenis_tanaman' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'luas_area' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

            ],
            [

                'nama.required' =>
                    'Nama lokasi Buruan Sae wajib diisi.',

                'nama.max' =>
                    'Nama lokasi maksimal 255 karakter.',

                'lokasi.max' =>
                    'Lokasi maksimal 255 karakter.',

                'rw.max' =>
                    'RW maksimal 5 karakter.',

                'jenis_tanaman.max' =>
                    'Jenis tanaman maksimal 255 karakter.',

                'luas_area.max' =>
                    'Luas area maksimal 255 karakter.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataBuruanSae = DataBuruanSae::create(
            [

                'nama' =>
                    $validated['nama'],

                'lokasi' =>
                    $validated['lokasi'] ?? null,

                'rw' =>
                    $validated['rw'] ?? null,

                'jenis_tanaman' =>
                    $validated['jenis_tanaman'] ?? null,

                'luas_area' =>
                    $validated['luas_area'] ?? null,

                'google_sync_status' =>
                    'pending',

                'google_synced_at' =>
                    null,

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 2. REFRESH DATA
        |--------------------------------------------------------------------------
        |
        | Memastikan ID dan updated_at merupakan
        | data terbaru dari database.
        |
        */

        $dataBuruanSae->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. SINKRONISASI CREATE KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $sync = $this->sendToGoogleSheets(
            [

                'sheet' =>
                    self::GOOGLE_SHEET_NAME,

                'action' =>
                    'create',

                /*
                | ID menggunakan primary key Laravel.
                */
                'id' =>
                    $dataBuruanSae->id,

                /*
                | Nama lokasi.
                */
                'nama' =>
                    $dataBuruanSae->nama,

                /*
                | Lokasi tidak dikirim karena
                | tidak memiliki kolom di Google Sheets.
                */

                'rw' =>
                    $dataBuruanSae->rw,

                'jenis_tanaman' =>
                    $dataBuruanSae->jenis_tanaman,

                'luas_area' =>
                    $dataBuruanSae->luas_area,

                'diperbarui' =>
                    $dataBuruanSae->updated_at
                        ? $dataBuruanSae->updated_at->format(
                            'Y-m-d H:i:s'
                        )
                        : now()->format(
                            'Y-m-d H:i:s'
                        ),

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 4. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($sync) {

            $dataBuruanSae->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'databuruansae.index'
                )
                ->with(
                    'success',
                    'Data Buruan Sae berhasil ditambahkan dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        |
        | Data tetap dianggap berhasil tersimpan
        | di database Laravel.
        |
        */

        $dataBuruanSae->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'databuruansae.index'
            )
            ->with(
                'warning',
                'Data Buruan Sae berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show(
        DataBuruanSae $databuruansae
    ) {
        $dataBuruanSae = $databuruansae;

        return view(
            'Admin.Konten.Data_buruan_sae.show',
            compact('dataBuruanSae')
        );
    }


    /**
     * Form edit data.
     */
    public function edit(
        DataBuruanSae $databuruansae
    ) {
        $dataBuruanSae = $databuruansae;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_buruan_sae.tambah',
            compact(
                'dataBuruanSae',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataBuruanSae $databuruansae
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'nama' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'lokasi' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'rw' => [
                    'nullable',
                    'string',
                    'max:5',
                ],

                'jenis_tanaman' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'luas_area' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

            ],
            [

                'nama.required' =>
                    'Nama lokasi Buruan Sae wajib diisi.',

                'nama.max' =>
                    'Nama lokasi maksimal 255 karakter.',

                'lokasi.max' =>
                    'Lokasi maksimal 255 karakter.',

                'rw.max' =>
                    'RW maksimal 5 karakter.',

                'jenis_tanaman.max' =>
                    'Jenis tanaman maksimal 255 karakter.',

                'luas_area.max' =>
                    'Luas area maksimal 255 karakter.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | Primary key Laravel digunakan sebagai identifier
        | baris Google Sheets.
        |
        | Karena ID primary key tidak berubah saat edit,
        | old_id tetap dikirim untuk memastikan baris yang
        | benar diperbarui.
        |
        */

        $oldId = $databuruansae->id;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $databuruansae->update(
            [

                'nama' =>
                    $validated['nama'],

                'lokasi' =>
                    $validated['lokasi'] ?? null,

                'rw' =>
                    $validated['rw'] ?? null,

                'jenis_tanaman' =>
                    $validated['jenis_tanaman'] ?? null,

                'luas_area' =>
                    $validated['luas_area'] ?? null,

                'google_sync_status' =>
                    'pending',

                'google_synced_at' =>
                    null,

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 2. REFRESH DATA
        |--------------------------------------------------------------------------
        */

        $databuruansae->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. SINKRONISASI UPDATE KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $sync = $this->sendToGoogleSheets(
            [

                'sheet' =>
                    self::GOOGLE_SHEET_NAME,

                'action' =>
                    'update',

                /*
                | ID lama digunakan Apps Script
                | untuk mencari baris yang akan di-update.
                */
                'old_id' =>
                    $oldId,

                /*
                | ID baru.
                */
                'id' =>
                    $databuruansae->id,

                'nama' =>
                    $databuruansae->nama,

                'rw' =>
                    $databuruansae->rw,

                'jenis_tanaman' =>
                    $databuruansae->jenis_tanaman,

                'luas_area' =>
                    $databuruansae->luas_area,

                'diperbarui' =>
                    $databuruansae->updated_at
                        ? $databuruansae->updated_at->format(
                            'Y-m-d H:i:s'
                        )
                        : now()->format(
                            'Y-m-d H:i:s'
                        ),

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 4. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($sync) {

            $databuruansae->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'databuruansae.index'
                )
                ->with(
                    'success',
                    'Data Buruan Sae berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $databuruansae->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'databuruansae.index'
            )
            ->with(
                'warning',
                'Data Buruan Sae berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataBuruanSae $databuruansae
    ) {
        $databuruansae->delete();


        return redirect()
            ->route(
                'databuruansae.index'
            )
            ->with(
                'success',
                'Data Buruan Sae berhasil dihapus dari database.'
            );
    }


    /**
     * Mengirim data ke Google Apps Script.
     */
    private function sendToGoogleSheets(
        array $data
    ): bool {

        /*
        |--------------------------------------------------------------------------
        | AMBIL URL APPS SCRIPT DARI .ENV
        |--------------------------------------------------------------------------
        */

        $url = env(
            'GOOGLE_SHEETS_SCRIPT_URL'
        );


        /*
        |--------------------------------------------------------------------------
        | CEK URL
        |--------------------------------------------------------------------------
        */

        if (!$url) {

            Log::error(
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk BuruanSae.'
            );

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | JSON ENCODE
        |--------------------------------------------------------------------------
        */

        $jsonData = json_encode(
            $data,
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );


        if ($jsonData === false) {

            Log::error(
                'Gagal melakukan JSON encode untuk Google Sheets BuruanSae.',
                [

                    'data' =>
                        $data,

                    'json_error' =>
                        json_last_error_msg(),

                ]
            );

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | CURL REQUEST AWAL
        |--------------------------------------------------------------------------
        */

        $ch = curl_init(
            $url
        );


        curl_setopt_array(
            $ch,
            [

                CURLOPT_RETURNTRANSFER =>
                    true,

                CURLOPT_POST =>
                    true,

                CURLOPT_POSTFIELDS =>
                    $jsonData,

                CURLOPT_HTTPHEADER =>
                    [

                        'Content-Type: application/json',

                        'Accept: application/json',

                        'Content-Length: ' .
                            strlen($jsonData),

                    ],

                CURLOPT_CONNECTTIMEOUT =>
                    10,

                CURLOPT_TIMEOUT =>
                    30,

                /*
                | Google Apps Script dapat memberikan
                | HTTP 301/302/303.
                */
                CURLOPT_FOLLOWLOCATION =>
                    false,

                CURLOPT_HTTP_VERSION =>
                    CURL_HTTP_VERSION_1_1,

                CURLOPT_HEADER =>
                    true,

            ]
        );


        $rawResponse = curl_exec(
            $ch
        );


        $httpCode = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );


        $redirectUrl = curl_getinfo(
            $ch,
            CURLINFO_REDIRECT_URL
        );


        $curlErrno = curl_errno(
            $ch
        );


        $curlError = curl_error(
            $ch
        );


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


        curl_close(
            $ch
        );


        /*
        |--------------------------------------------------------------------------
        | LOG RESPONSE AWAL
        |--------------------------------------------------------------------------
        */

        Log::info(
            'Google Sheets BuruanSae - Initial Response',
            [

                'http_code' =>
                    $httpCode,

                'curl_errno' =>
                    $curlErrno,

                'curl_error' =>
                    $curlError,

                'redirect_url' =>
                    $redirectUrl,

                'response_headers' =>
                    $responseHeaders,

                'response_body' =>
                    $responseBody,

                'data' =>
                    $data,

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | CEK CURL ERROR
        |--------------------------------------------------------------------------
        */

        if ($rawResponse === false) {

            Log::error(
                'cURL Google Sheets BuruanSae gagal.',
                [

                    'curl_errno' =>
                        $curlErrno,

                    'curl_error' =>
                        $curlError,

                    'data' =>
                        $data,

                ]
            );

            return false;
        }


        if ($curlErrno !== 0) {

            Log::error(
                'cURL Google Sheets BuruanSae mengalami error.',
                [

                    'curl_errno' =>
                        $curlErrno,

                    'curl_error' =>
                        $curlError,

                    'data' =>
                        $data,

                ]
            );

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | HANDLE REDIRECT GOOGLE APPS SCRIPT
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

            $redirectUrl =
                trim($redirectUrl);


            /*
            |--------------------------------------------------------------------------
            | REQUEST KE URL REDIRECT
            |--------------------------------------------------------------------------
            */

            $ch = curl_init(
                $redirectUrl
            );


            curl_setopt_array(
                $ch,
                [

                    CURLOPT_RETURNTRANSFER =>
                        true,

                    CURLOPT_HTTPGET =>
                        true,

                    CURLOPT_HTTPHEADER =>
                        [

                            'Accept: application/json',

                        ],

                    CURLOPT_CONNECTTIMEOUT =>
                        10,

                    CURLOPT_TIMEOUT =>
                        30,

                    CURLOPT_FOLLOWLOCATION =>
                        true,

                    CURLOPT_MAXREDIRS =>
                        5,

                    CURLOPT_HTTP_VERSION =>
                        CURL_HTTP_VERSION_1_1,

                ]
            );


            $finalResponse = curl_exec(
                $ch
            );


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


            curl_close(
                $ch
            );


            /*
            |--------------------------------------------------------------------------
            | LOG RESPONSE AKHIR
            |--------------------------------------------------------------------------
            */

            Log::info(
                'Google Sheets BuruanSae - Redirect Response',
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


            /*
            |--------------------------------------------------------------------------
            | CEK ERROR REDIRECT
            |--------------------------------------------------------------------------
            */

            if (
                $finalResponse === false ||
                $finalCurlErrno !== 0
            ) {

                Log::error(
                    'Gagal mengambil response redirect Google Sheets BuruanSae.',
                    [

                        'curl_errno' =>
                            $finalCurlErrno,

                        'curl_error' =>
                            $finalCurlError,

                    ]
                );

                return false;
            }


            /*
            |--------------------------------------------------------------------------
            | PARSE JSON
            |--------------------------------------------------------------------------
            */

            $decoded = json_decode(
                $finalResponse,
                true
            );


            if (
                is_array($decoded) &&
                array_key_exists(
                    'success',
                    $decoded
                )
            ) {

                return (bool)
                    $decoded['success'];
            }


            /*
            |--------------------------------------------------------------------------
            | HTTP 2XX
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
            array_key_exists(
                'success',
                $decoded
            )
        ) {

            return (bool)
                $decoded['success'];
        }


        /*
        |--------------------------------------------------------------------------
        | HTTP 2XX
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
            'Google Sheets BuruanSae HTTP error.',
            [

                'http_code' =>
                    $httpCode,

                'response' =>
                    $responseBody,

                'data' =>
                    $data,

            ]
        );


        return false;
    }
}
