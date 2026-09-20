<?php

namespace App\Http\Controllers;

use App\Models\DataRutilahu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataRutilahuController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'Rutilahu';


    /**
     * Menampilkan seluruh data Rutilahu.
     */
    public function index()
    {
        $dataRutilahu = DataRutilahu::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_rutilahu.index',
            compact('dataRutilahu')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $dataRutilahu = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_rutilahu.tambah',
            compact(
                'dataRutilahu',
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

                'nik' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'nama_kepala_keluarga' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'alamat' => [
                    'nullable',
                    'string',
                ],

                'rt' => [
                    'nullable',
                    'string',
                    'max:5',
                ],

                'rw' => [
                    'nullable',
                    'string',
                    'max:5',
                ],

                'kondisi_rumah' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'tingkat_prioritas' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'status_bantuan' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

            ],
            [

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'nama_kepala_keluarga.required' =>
                    'Nama kepala keluarga wajib diisi.',

                'nama_kepala_keluarga.max' =>
                    'Nama kepala keluarga maksimal 255 karakter.',

                'rt.max' =>
                    'RT maksimal 5 karakter.',

                'rw.max' =>
                    'RW maksimal 5 karakter.',

                'kondisi_rumah.max' =>
                    'Kondisi rumah maksimal 255 karakter.',

                'tingkat_prioritas.max' =>
                    'Tingkat prioritas maksimal 255 karakter.',

                'status_bantuan.max' =>
                    'Status bantuan maksimal 255 karakter.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataRutilahu = DataRutilahu::create(
            [

                'nik' =>
                    $validated['nik'] ?? null,

                'nama_kepala_keluarga' =>
                    $validated['nama_kepala_keluarga'],

                'alamat' =>
                    $validated['alamat'] ?? null,

                'rt' =>
                    $validated['rt'] ?? null,

                'rw' =>
                    $validated['rw'] ?? null,

                'kondisi_rumah' =>
                    $validated['kondisi_rumah'] ?? null,

                'tingkat_prioritas' =>
                    $validated['tingkat_prioritas'] ?? null,

                'status_bantuan' =>
                    $validated['status_bantuan'] ?? null,

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

        $dataRutilahu->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. SIAPKAN ALAMAT + RT/RW
        |--------------------------------------------------------------------------
        */

        $alamatRw = $this->buildAlamatRw(
            $dataRutilahu
        );


        /*
        |--------------------------------------------------------------------------
        | 4. SINKRONISASI CREATE KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $sync = $this->sendToGoogleSheets(
            [

                'sheet' =>
                    self::GOOGLE_SHEET_NAME,

                'action' =>
                    'create',

                'id' =>
                    $dataRutilahu->id,

                'nama_kepala_keluarga' =>
                    $dataRutilahu->nama_kepala_keluarga,

                'nik' =>
                    $dataRutilahu->nik,

                'alamat_rw' =>
                    $alamatRw,

                /*
                | Field tahun_bantuan belum tersedia
                | pada database Rutilahu saat ini.
                */
                'tahun_bantuan' =>
                    '',

                'status_bantuan' =>
                    $dataRutilahu->status_bantuan,

                'diperbarui' =>
                    $dataRutilahu->updated_at
                        ? $dataRutilahu->updated_at->format(
                            'Y-m-d H:i:s'
                        )
                        : now()->format(
                            'Y-m-d H:i:s'
                        ),

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 5. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($sync) {

            $dataRutilahu->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datarutilahu.index'
                )
                ->with(
                    'success',
                    'Data Rutilahu berhasil ditambahkan dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        |
        | Data tetap berhasil tersimpan di database Laravel.
        |
        */

        $dataRutilahu->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datarutilahu.index'
            )
            ->with(
                'warning',
                'Data Rutilahu berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data Rutilahu.
     */
    public function show(
        DataRutilahu $datarutilahu
    ) {
        $dataRutilahu = $datarutilahu;

        return view(
            'Admin.Konten.Data_rutilahu.show',
            compact('dataRutilahu')
        );
    }


    /**
     * Form edit data Rutilahu.
     */
    public function edit(
        DataRutilahu $datarutilahu
    ) {
        $dataRutilahu = $datarutilahu;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_rutilahu.tambah',
            compact(
                'dataRutilahu',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data Rutilahu.
     */
    public function update(
        Request $request,
        DataRutilahu $datarutilahu
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'nik' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'nama_kepala_keluarga' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'alamat' => [
                    'nullable',
                    'string',
                ],

                'rt' => [
                    'nullable',
                    'string',
                    'max:5',
                ],

                'rw' => [
                    'nullable',
                    'string',
                    'max:5',
                ],

                'kondisi_rumah' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'tingkat_prioritas' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'status_bantuan' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

            ],
            [

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'nama_kepala_keluarga.required' =>
                    'Nama kepala keluarga wajib diisi.',

                'nama_kepala_keluarga.max' =>
                    'Nama kepala keluarga maksimal 255 karakter.',

                'rt.max' =>
                    'RT maksimal 5 karakter.',

                'rw.max' =>
                    'RW maksimal 5 karakter.',

                'kondisi_rumah.max' =>
                    'Kondisi rumah maksimal 255 karakter.',

                'tingkat_prioritas.max' =>
                    'Tingkat prioritas maksimal 255 karakter.',

                'status_bantuan.max' =>
                    'Status bantuan maksimal 255 karakter.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | ID Laravel digunakan sebagai identifier
        | baris Google Sheets.
        |
        */

        $oldId = $datarutilahu->id;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datarutilahu->update(
            [

                'nik' =>
                    $validated['nik'] ?? null,

                'nama_kepala_keluarga' =>
                    $validated['nama_kepala_keluarga'],

                'alamat' =>
                    $validated['alamat'] ?? null,

                'rt' =>
                    $validated['rt'] ?? null,

                'rw' =>
                    $validated['rw'] ?? null,

                'kondisi_rumah' =>
                    $validated['kondisi_rumah'] ?? null,

                'tingkat_prioritas' =>
                    $validated['tingkat_prioritas'] ?? null,

                'status_bantuan' =>
                    $validated['status_bantuan'] ?? null,

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

        $datarutilahu->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. SIAPKAN ALAMAT + RT/RW
        |--------------------------------------------------------------------------
        */

        $alamatRw = $this->buildAlamatRw(
            $datarutilahu
        );


        /*
        |--------------------------------------------------------------------------
        | 4. SINKRONISASI UPDATE KE GOOGLE SHEETS
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
                    $datarutilahu->id,

                'nama_kepala_keluarga' =>
                    $datarutilahu->nama_kepala_keluarga,

                'nik' =>
                    $datarutilahu->nik,

                'alamat_rw' =>
                    $alamatRw,

                'tahun_bantuan' =>
                    '',

                'status_bantuan' =>
                    $datarutilahu->status_bantuan,

                'diperbarui' =>
                    $datarutilahu->updated_at
                        ? $datarutilahu->updated_at->format(
                            'Y-m-d H:i:s'
                        )
                        : now()->format(
                            'Y-m-d H:i:s'
                        ),

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 5. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($sync) {

            $datarutilahu->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datarutilahu.index'
                )
                ->with(
                    'success',
                    'Data Rutilahu berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datarutilahu->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datarutilahu.index'
            )
            ->with(
                'warning',
                'Data Rutilahu berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataRutilahu $datarutilahu
    ) {
        $datarutilahu->delete();


        return redirect()
            ->route(
                'datarutilahu.index'
            )
            ->with(
                'success',
                'Data Rutilahu berhasil dihapus dari database.'
            );
    }


    /**
     * Membentuk alamat yang akan dikirim ke Google Sheets.
     *
     * Format:
     * Alamat, RT xx / RW xx
     */
    private function buildAlamatRw(
        DataRutilahu $data
    ): string {

        $parts = [];


        if (
            !empty($data->alamat)
        ) {

            $parts[] =
                trim($data->alamat);
        }


        $rtRw = [];


        if (
            !empty($data->rt)
        ) {

            $rtRw[] =
                'RT ' .
                trim($data->rt);
        }


        if (
            !empty($data->rw)
        ) {

            $rtRw[] =
                'RW ' .
                trim($data->rw);
        }


        if (
            !empty($rtRw)
        ) {

            $parts[] =
                implode(
                    ' / ',
                    $rtRw
                );
        }


        return implode(
            ', ',
            $parts
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk Rutilahu.'
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
                'Gagal melakukan JSON encode untuk Google Sheets Rutilahu.',
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
            'Google Sheets Rutilahu - Initial Response',
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
                'cURL Google Sheets Rutilahu gagal.',
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
                'cURL Google Sheets Rutilahu mengalami error.',
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
                'Google Sheets Rutilahu - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets Rutilahu.',
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
            'Google Sheets Rutilahu HTTP error.',
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
