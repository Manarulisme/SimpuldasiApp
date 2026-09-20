<?php

namespace App\Http\Controllers;

use App\Models\DataPohon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataPohonController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'Pohon';


    /**
     * Menampilkan seluruh data pohon.
     */
    public function index()
    {
        $dataPohon = DataPohon::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_pohon.index',
            compact('dataPohon')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $dataPohon = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_pohon.tambah',
            compact(
                'dataPohon',
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

                'jenis_pohon' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'lokasi' => [
                    'nullable',
                    'string',
                    'max:255',
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

            ],
            [

                'jenis_pohon.required' =>
                    'Jenis pohon wajib diisi.',

                'jenis_pohon.string' =>
                    'Jenis pohon harus berupa teks.',

                'jenis_pohon.max' =>
                    'Jenis pohon maksimal 255 karakter.',

                'lokasi.string' =>
                    'Lokasi harus berupa teks.',

                'lokasi.max' =>
                    'Lokasi maksimal 255 karakter.',

                'jumlah.integer' =>
                    'Jumlah pohon harus berupa angka.',

                'jumlah.min' =>
                    'Jumlah pohon minimal 1.',

                'kondisi.in' =>
                    'Kondisi pohon yang dipilih tidak valid.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataPohon = DataPohon::create(
            [

                'jenis_pohon' =>
                    $validated['jenis_pohon'],

                'lokasi' =>
                    $validated['lokasi'] ?? null,

                'jumlah' =>
                    $validated['jumlah'] ?? null,

                'kondisi' =>
                    $validated['kondisi'] ?? null,

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

        $dataPohon->refresh();


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
                | ID menggunakan ID primary key
                | Data Pohon dari database Laravel.
                */
                'id' =>
                    $dataPohon->id,

                'jenis_pohon' =>
                    $dataPohon->jenis_pohon,

                'lokasi' =>
                    $dataPohon->lokasi,

                'jumlah' =>
                    $dataPohon->jumlah,

                'kondisi' =>
                    $dataPohon->kondisi,

                'diperbarui' =>
                    $dataPohon->updated_at
                        ? $dataPohon->updated_at->format(
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

            $dataPohon->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datapohon.index'
                )
                ->with(
                    'success',
                    'Data pohon berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $dataPohon->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datapohon.index'
            )
            ->with(
                'warning',
                'Data pohon berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show(
        DataPohon $datapohon
    ) {
        $dataPohon = $datapohon;

        return view(
            'Admin.Konten.Data_pohon.show',
            compact('dataPohon')
        );
    }


    /**
     * Form edit data.
     */
    public function edit(
        DataPohon $datapohon
    ) {
        $dataPohon = $datapohon;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_pohon.tambah',
            compact(
                'dataPohon',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataPohon $datapohon
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'jenis_pohon' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'lokasi' => [
                    'nullable',
                    'string',
                    'max:255',
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

            ],
            [

                'jenis_pohon.required' =>
                    'Jenis pohon wajib diisi.',

                'jenis_pohon.string' =>
                    'Jenis pohon harus berupa teks.',

                'jenis_pohon.max' =>
                    'Jenis pohon maksimal 255 karakter.',

                'lokasi.string' =>
                    'Lokasi harus berupa teks.',

                'lokasi.max' =>
                    'Lokasi maksimal 255 karakter.',

                'jumlah.integer' =>
                    'Jumlah pohon harus berupa angka.',

                'jumlah.min' =>
                    'Jumlah pohon minimal 1.',

                'kondisi.in' =>
                    'Kondisi pohon yang dipilih tidak valid.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | ID primary key digunakan sebagai identifier
        | baris Google Sheets.
        |
        | Jika ID berubah saat edit, Apps Script
        | akan mencari ID lama terlebih dahulu.
        |
        */

        $oldId = $datapohon->id;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datapohon->update(
            [

                'jenis_pohon' =>
                    $validated['jenis_pohon'],

                'lokasi' =>
                    $validated['lokasi'] ?? null,

                'jumlah' =>
                    $validated['jumlah'] ?? null,

                'kondisi' =>
                    $validated['kondisi'] ?? null,

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

        $datapohon->refresh();


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
                | ID baru yang ditulis.
                */
                'id' =>
                    $datapohon->id,

                'jenis_pohon' =>
                    $datapohon->jenis_pohon,

                'lokasi' =>
                    $datapohon->lokasi,

                'jumlah' =>
                    $datapohon->jumlah,

                'kondisi' =>
                    $datapohon->kondisi,

                'diperbarui' =>
                    $datapohon->updated_at
                        ? $datapohon->updated_at->format(
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

            $datapohon->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datapohon.index'
                )
                ->with(
                    'success',
                    'Data pohon berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datapohon->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datapohon.index'
            )
            ->with(
                'warning',
                'Data pohon berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataPohon $datapohon
    ) {
        $datapohon->delete();


        return redirect()
            ->route(
                'datapohon.index'
            )
            ->with(
                'success',
                'Data pohon berhasil dihapus dari database.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk Pohon.'
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
                'Gagal melakukan JSON encode untuk Google Sheets Pohon.',
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
            'Google Sheets Pohon - Initial Response',
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
                'cURL Google Sheets Pohon gagal.',
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
                'cURL Google Sheets Pohon mengalami error.',
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
                'Google Sheets Pohon - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets Pohon.',
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
            'Google Sheets Pohon HTTP error.',
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
