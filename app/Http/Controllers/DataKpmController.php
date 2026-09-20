<?php

namespace App\Http\Controllers;

use App\Models\DataKpm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DataKpmController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'Bansos';


    /**
     * Menampilkan seluruh data KPM.
     */
    public function index()
    {
        $dataKpm = DataKpm::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_kpm.index',
            compact('dataKpm')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $kpm = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_kpm.tambah',
            compact(
                'kpm',
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

                'id_data' => [
                    'required',
                    'string',
                    'max:50',
                    'unique:data_kpm,id_data',
                ],

                'nik' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:data_kpm,nik',
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

                'jenis_bantuan' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'desil' => [
                    'nullable',
                    'integer',
                    'between:1,10',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],

            ],
            [

                'id_data.required' =>
                    'ID Data KPM wajib diisi.',

                'id_data.unique' =>
                    'ID Data KPM tersebut sudah terdaftar.',

                'id_data.max' =>
                    'ID Data KPM maksimal 50 karakter.',

                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK tersebut sudah terdaftar.',

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'nama.required' =>
                    'Nama KPM wajib diisi.',

                'nama.max' =>
                    'Nama KPM maksimal 150 karakter.',

                'rw.max' =>
                    'RW maksimal 10 karakter.',

                'jenis_bantuan.required' =>
                    'Jenis bantuan wajib diisi.',

                'jenis_bantuan.max' =>
                    'Jenis bantuan maksimal 100 karakter.',

                'desil.integer' =>
                    'Desil harus berupa angka.',

                'desil.between' =>
                    'Desil harus berada antara 1 sampai 10.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $kpm = DataKpm::create(
            [

                'id_data' =>
                    $validated['id_data'],

                'nik' =>
                    $validated['nik'],

                'nama' =>
                    $validated['nama'],

                'rw' =>
                    $validated['rw'] ?? null,

                'jenis_bantuan' =>
                    $validated['jenis_bantuan'],

                'desil' =>
                    $validated['desil'] ?? null,

                'keterangan' =>
                    $validated['keterangan'] ?? null,

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

        $kpm->refresh();


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
                | ID menggunakan id_data KPM.
                */
                'id' =>
                    $kpm->id_data,

                'nama' =>
                    $kpm->nama,

                'nik' =>
                    $kpm->nik,

                'rw' =>
                    $kpm->rw,

                'jenis_bantuan' =>
                    $kpm->jenis_bantuan,

                'desil' =>
                    $kpm->desil,

                'keterangan' =>
                    $kpm->keterangan,

                'diperbarui' =>
                    $kpm->updated_at
                        ? $kpm->updated_at->format(
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

            $kpm->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datakpm.index'
                )
                ->with(
                    'success',
                    'Data KPM berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $kpm->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datakpm.index'
            )
            ->with(
                'warning',
                'Data KPM berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show(
        DataKpm $datakpm
    ) {
        $kpm = $datakpm;

        return view(
            'Admin.Konten.Data_kpm.show',
            compact('kpm')
        );
    }


    /**
     * Form edit data.
     */
    public function edit(
        DataKpm $datakpm
    ) {
        $kpm = $datakpm;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_kpm.tambah',
            compact(
                'kpm',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataKpm $datakpm
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'id_data' => [
                    'required',
                    'string',
                    'max:50',

                    Rule::unique(
                        'data_kpm',
                        'id_data'
                    )->ignore(
                        $datakpm->id
                    ),
                ],

                'nik' => [
                    'required',
                    'string',
                    'max:20',

                    Rule::unique(
                        'data_kpm',
                        'nik'
                    )->ignore(
                        $datakpm->id
                    ),
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

                'jenis_bantuan' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'desil' => [
                    'nullable',
                    'integer',
                    'between:1,10',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],

            ],
            [

                'id_data.required' =>
                    'ID Data KPM wajib diisi.',

                'id_data.unique' =>
                    'ID Data KPM tersebut sudah digunakan data lain.',

                'id_data.max' =>
                    'ID Data KPM maksimal 50 karakter.',

                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK tersebut sudah digunakan data lain.',

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'nama.required' =>
                    'Nama KPM wajib diisi.',

                'nama.max' =>
                    'Nama KPM maksimal 150 karakter.',

                'rw.max' =>
                    'RW maksimal 10 karakter.',

                'jenis_bantuan.required' =>
                    'Jenis bantuan wajib diisi.',

                'jenis_bantuan.max' =>
                    'Jenis bantuan maksimal 100 karakter.',

                'desil.integer' =>
                    'Desil harus berupa angka.',

                'desil.between' =>
                    'Desil harus berada antara 1 sampai 10.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | id_data digunakan sebagai identifier
        | baris Google Sheets.
        |
        | Jika ID berubah saat edit, Apps Script
        | akan mencari ID lama terlebih dahulu.
        |
        */

        $oldId = $datakpm->id_data;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datakpm->update(
            [

                'id_data' =>
                    $validated['id_data'],

                'nik' =>
                    $validated['nik'],

                'nama' =>
                    $validated['nama'],

                'rw' =>
                    $validated['rw'] ?? null,

                'jenis_bantuan' =>
                    $validated['jenis_bantuan'],

                'desil' =>
                    $validated['desil'] ?? null,

                'keterangan' =>
                    $validated['keterangan'] ?? null,

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

        $datakpm->refresh();


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
                    $datakpm->id_data,

                'nama' =>
                    $datakpm->nama,

                'nik' =>
                    $datakpm->nik,

                'rw' =>
                    $datakpm->rw,

                'jenis_bantuan' =>
                    $datakpm->jenis_bantuan,

                'desil' =>
                    $datakpm->desil,

                'keterangan' =>
                    $datakpm->keterangan,

                'diperbarui' =>
                    $datakpm->updated_at
                        ? $datakpm->updated_at->format(
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

            $datakpm->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datakpm.index'
                )
                ->with(
                    'success',
                    'Data KPM berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datakpm->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datakpm.index'
            )
            ->with(
                'warning',
                'Data KPM berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataKpm $datakpm
    ) {
        $datakpm->delete();


        return redirect()
            ->route(
                'datakpm.index'
            )
            ->with(
                'success',
                'Data KPM berhasil dihapus dari database.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk Bansos.'
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
                'Gagal melakukan JSON encode untuk Google Sheets Bansos.',
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
            'Google Sheets Bansos - Initial Response',
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
                'cURL Google Sheets Bansos gagal.',
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
                'cURL Google Sheets Bansos mengalami error.',
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
                'Google Sheets Bansos - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets Bansos.',
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
            'Google Sheets Bansos HTTP error.',
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
