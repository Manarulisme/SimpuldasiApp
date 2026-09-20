<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DataPosyanduController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'Posyandu';


    /**
     * Menampilkan seluruh data Posyandu & Posbindu
     */
    public function index()
    {
        $dataPosyandu = DataPosyandu::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_posyandu.index',
            compact('dataPosyandu')
        );
    }


    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        $posyandu = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_posyandu.tambah',
            compact(
                'posyandu',
                'isEdit'
            )
        );
    }


    /**
     * Menyimpan data Posyandu / Posbindu baru
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
                    'unique:data_posyandu,id_data'
                ],

                'jenis' => [
                    'required',
                    'in:Posyandu,Posbindu'
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:150'
                ],

                'rw' => [
                    'nullable',
                    'string',
                    'max:10'
                ],

                'jumlah_kader' => [
                    'required',
                    'integer',
                    'min:0'
                ],

                'jumlah_balita' => [
                    'required',
                    'integer',
                    'min:0'
                ],

                'keterangan' => [
                    'nullable',
                    'string'
                ],

            ],
            [

                'id_data.required' =>
                    'ID Data wajib diisi.',

                'id_data.unique' =>
                    'ID Data sudah digunakan.',

                'jenis.required' =>
                    'Jenis wajib dipilih.',

                'jenis.in' =>
                    'Jenis Posyandu tidak valid.',

                'nama.required' =>
                    'Nama Posyandu / Posbindu wajib diisi.',

                'jumlah_kader.required' =>
                    'Jumlah kader wajib diisi.',

                'jumlah_kader.integer' =>
                    'Jumlah kader harus berupa angka.',

                'jumlah_kader.min' =>
                    'Jumlah kader tidak boleh kurang dari 0.',

                'jumlah_balita.required' =>
                    'Jumlah balita wajib diisi.',

                'jumlah_balita.integer' =>
                    'Jumlah balita harus berupa angka.',

                'jumlah_balita.min' =>
                    'Jumlah balita tidak boleh kurang dari 0.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $posyandu = DataPosyandu::create(
            [

                'id_data' =>
                    $validated['id_data'],

                'jenis' =>
                    $validated['jenis'],

                'nama' =>
                    $validated['nama'],

                'rw' =>
                    $validated['rw'] ?? null,

                'jumlah_kader' =>
                    $validated['jumlah_kader'],

                'jumlah_balita' =>
                    $validated['jumlah_balita'],

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
        | Memastikan ID dan updated_at sudah merupakan
        | data terbaru dari database.
        |
        */

        $posyandu->refresh();


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
                | ID Google Sheets menggunakan id_data,
                | bukan primary key Laravel.
                */
                'id' =>
                    $posyandu->id_data,

                'jenis' =>
                    $posyandu->jenis,

                'nama' =>
                    $posyandu->nama,

                'rw' =>
                    $posyandu->rw,

                'jumlah_kader' =>
                    $posyandu->jumlah_kader,

                'jumlah_balita' =>
                    $posyandu->jumlah_balita,

                'keterangan' =>
                    $posyandu->keterangan,

                'diperbarui' =>
                    $posyandu->updated_at
                        ? $posyandu->updated_at->format(
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

            $posyandu->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'dataposyandu.index'
                )
                ->with(
                    'success',
                    'Data Posyandu berhasil ditambahkan dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        |
        | Data tetap dianggap berhasil tersimpan di database.
        |
        */

        $posyandu->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'dataposyandu.index'
            )
            ->with(
                'warning',
                'Data Posyandu berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data Posyandu / Posbindu
     */
    public function show(
        DataPosyandu $dataposyandu
    ) {
        return view(
            'Admin.Konten.Data_posyandu.show',
            compact('dataposyandu')
        );
    }


    /**
     * Menampilkan form edit
     */
    public function edit(
        DataPosyandu $dataposyandu
    ) {
        $posyandu = $dataposyandu;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_posyandu.tambah',
            compact(
                'posyandu',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data Posyandu / Posbindu
     */
    public function update(
        Request $request,
        DataPosyandu $dataposyandu
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
                        'data_posyandu',
                        'id_data'
                    )->ignore(
                        $dataposyandu->id
                    ),
                ],

                'jenis' => [
                    'required',
                    'in:Posyandu,Posbindu'
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:150'
                ],

                'rw' => [
                    'nullable',
                    'string',
                    'max:10'
                ],

                'jumlah_kader' => [
                    'required',
                    'integer',
                    'min:0'
                ],

                'jumlah_balita' => [
                    'required',
                    'integer',
                    'min:0'
                ],

                'keterangan' => [
                    'nullable',
                    'string'
                ],

            ],
            [

                'id_data.required' =>
                    'ID Data wajib diisi.',

                'id_data.unique' =>
                    'ID Data sudah digunakan oleh data lain.',

                'jenis.required' =>
                    'Jenis wajib dipilih.',

                'jenis.in' =>
                    'Jenis Posyandu tidak valid.',

                'nama.required' =>
                    'Nama Posyandu / Posbindu wajib diisi.',

                'jumlah_kader.required' =>
                    'Jumlah kader wajib diisi.',

                'jumlah_kader.integer' =>
                    'Jumlah kader harus berupa angka.',

                'jumlah_kader.min' =>
                    'Jumlah kader tidak boleh kurang dari 0.',

                'jumlah_balita.required' =>
                    'Jumlah balita wajib diisi.',

                'jumlah_balita.integer' =>
                    'Jumlah balita harus berupa angka.',

                'jumlah_balita.min' =>
                    'Jumlah balita tidak boleh kurang dari 0.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | Dibutuhkan jika ID Data diubah saat edit.
        |
        | Contoh:
        |
        | ID lama : POS-001
        | ID baru : POS-002
        |
        | Google Sheets akan mencari POS-001
        | kemudian mengganti baris tersebut menjadi POS-002.
        |
        */

        $oldId = $dataposyandu->id_data;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataposyandu->update(
            [

                'id_data' =>
                    $validated['id_data'],

                'jenis' =>
                    $validated['jenis'],

                'nama' =>
                    $validated['nama'],

                'rw' =>
                    $validated['rw'] ?? null,

                'jumlah_kader' =>
                    $validated['jumlah_kader'],

                'jumlah_balita' =>
                    $validated['jumlah_balita'],

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

        $dataposyandu->refresh();


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
                | untuk mencari baris yang harus di-update.
                */
                'old_id' =>
                    $oldId,

                /*
                | ID baru yang akan ditulis.
                */
                'id' =>
                    $dataposyandu->id_data,

                'jenis' =>
                    $dataposyandu->jenis,

                'nama' =>
                    $dataposyandu->nama,

                'rw' =>
                    $dataposyandu->rw,

                'jumlah_kader' =>
                    $dataposyandu->jumlah_kader,

                'jumlah_balita' =>
                    $dataposyandu->jumlah_balita,

                'keterangan' =>
                    $dataposyandu->keterangan,

                'diperbarui' =>
                    $dataposyandu->updated_at
                        ? $dataposyandu->updated_at->format(
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

            $dataposyandu->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'dataposyandu.index'
                )
                ->with(
                    'success',
                    'Data Posyandu berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $dataposyandu->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'dataposyandu.index'
            )
            ->with(
                'warning',
                'Data Posyandu berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data Posyandu / Posbindu
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataPosyandu $dataposyandu
    ) {
        $dataposyandu->delete();


        return redirect()
            ->route(
                'dataposyandu.index'
            )
            ->with(
                'success',
                'Data Posyandu berhasil dihapus dari database.'
            );
    }


    /**
     * Mengirim data ke Google Apps Script
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk Posyandu.'
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
                'Gagal melakukan JSON encode untuk Google Sheets Posyandu.',
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
            'Google Sheets Posyandu - Initial Response',
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
                'cURL Google Sheets Posyandu gagal.',
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
                'cURL Google Sheets Posyandu mengalami error.',
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
                'Google Sheets Posyandu - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets Posyandu.',
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
            'Google Sheets Posyandu HTTP error.',
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
