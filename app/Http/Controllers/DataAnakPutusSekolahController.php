<?php

namespace App\Http\Controllers;

use App\Models\DataAnakPutusSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DataAnakPutusSekolahController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'AnakPutusSekolah';


    /**
     * Menampilkan seluruh data anak putus sekolah.
     */
    public function index()
    {
        $dataPutusSekolah = DataAnakPutusSekolah::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_putus_sekolah.index',
            compact('dataPutusSekolah')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $putusSekolah = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_putus_sekolah.tambah',
            compact(
                'putusSekolah',
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
                    'unique:data_anak_putus_sekolah,id_data',
                ],

                'nik' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:data_anak_putus_sekolah,nik',
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

                'usia' => [
                    'required',
                    'integer',
                    'between:1,30',
                ],

                'jenjang_terakhir' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'alasan' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],

            ],
            [

                'id_data.required' =>
                    'ID Data wajib diisi.',

                'id_data.unique' =>
                    'ID Data sudah digunakan.',

                'id_data.max' =>
                    'ID Data maksimal 50 karakter.',

                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK sudah terdaftar.',

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'nama.required' =>
                    'Nama anak wajib diisi.',

                'nama.max' =>
                    'Nama anak maksimal 150 karakter.',

                'rw.max' =>
                    'RW maksimal 10 karakter.',

                'usia.required' =>
                    'Usia wajib diisi.',

                'usia.integer' =>
                    'Usia harus berupa angka.',

                'usia.between' =>
                    'Usia harus antara 1 sampai 30 tahun.',

                'jenjang_terakhir.required' =>
                    'Jenjang terakhir wajib dipilih.',

                'jenjang_terakhir.max' =>
                    'Jenjang terakhir maksimal 100 karakter.',

                'alasan.required' =>
                    'Alasan putus sekolah wajib diisi.',

                'alasan.max' =>
                    'Alasan putus sekolah maksimal 255 karakter.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $putusSekolah = DataAnakPutusSekolah::create(
            [

                'id_data' =>
                    $validated['id_data'],

                'nik' =>
                    $validated['nik'],

                'nama' =>
                    $validated['nama'],

                'rw' =>
                    $validated['rw'] ?? null,

                'usia' =>
                    $validated['usia'],

                'jenjang_terakhir' =>
                    $validated['jenjang_terakhir'],

                'alasan' =>
                    $validated['alasan'],

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

        $putusSekolah->refresh();


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
                |--------------------------------------------------------------------------
                | ID menggunakan id_data sebagai identifier
                |--------------------------------------------------------------------------
                */

                'id' =>
                    $putusSekolah->id_data,

                'nama' =>
                    $putusSekolah->nama,

                'nik' =>
                    $putusSekolah->nik,

                'rw' =>
                    $putusSekolah->rw,

                'usia' =>
                    $putusSekolah->usia,

                'jenjang_terakhir' =>
                    $putusSekolah->jenjang_terakhir,

                'alasan' =>
                    $putusSekolah->alasan,

                'keterangan' =>
                    $putusSekolah->keterangan,

                'diperbarui' =>
                    $putusSekolah->updated_at
                        ? $putusSekolah->updated_at->format(
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

            $putusSekolah->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'dataputussekolah.index'
                )
                ->with(
                    'success',
                    'Data anak putus sekolah berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $putusSekolah->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'dataputussekolah.index'
            )
            ->with(
                'warning',
                'Data anak putus sekolah berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show(
        DataAnakPutusSekolah $dataputussekolah
    ) {
        $putusSekolah = $dataputussekolah;

        return view(
            'Admin.Konten.Data_putus_sekolah.show',
            compact('putusSekolah')
        );
    }


    /**
     * Form edit data.
     */
    public function edit(
        DataAnakPutusSekolah $dataputussekolah
    ) {
        $putusSekolah = $dataputussekolah;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_putus_sekolah.tambah',
            compact(
                'putusSekolah',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataAnakPutusSekolah $dataputussekolah
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
                        'data_anak_putus_sekolah',
                        'id_data'
                    )->ignore(
                        $dataputussekolah->id
                    ),
                ],

                'nik' => [
                    'required',
                    'string',
                    'max:20',

                    Rule::unique(
                        'data_anak_putus_sekolah',
                        'nik'
                    )->ignore(
                        $dataputussekolah->id
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

                'usia' => [
                    'required',
                    'integer',
                    'between:1,30',
                ],

                'jenjang_terakhir' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'alasan' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],

            ],
            [

                'id_data.required' =>
                    'ID Data wajib diisi.',

                'id_data.unique' =>
                    'ID Data sudah digunakan data lain.',

                'id_data.max' =>
                    'ID Data maksimal 50 karakter.',

                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK sudah digunakan data lain.',

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'nama.required' =>
                    'Nama anak wajib diisi.',

                'nama.max' =>
                    'Nama anak maksimal 150 karakter.',

                'rw.max' =>
                    'RW maksimal 10 karakter.',

                'usia.required' =>
                    'Usia wajib diisi.',

                'usia.integer' =>
                    'Usia harus berupa angka.',

                'usia.between' =>
                    'Usia harus antara 1 sampai 30 tahun.',

                'jenjang_terakhir.required' =>
                    'Jenjang terakhir wajib dipilih.',

                'jenjang_terakhir.max' =>
                    'Jenjang terakhir maksimal 100 karakter.',

                'alasan.required' =>
                    'Alasan putus sekolah wajib diisi.',

                'alasan.max' =>
                    'Alasan putus sekolah maksimal 255 karakter.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | id_data digunakan sebagai identifier baris
        | Google Sheets.
        |
        | Jika id_data berubah, Apps Script akan mencari
        | old_id kemudian menggantinya dengan ID baru.
        |
        */

        $oldId =
            $dataputussekolah->id_data;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataputussekolah->update(
            [

                'id_data' =>
                    $validated['id_data'],

                'nik' =>
                    $validated['nik'],

                'nama' =>
                    $validated['nama'],

                'rw' =>
                    $validated['rw'] ?? null,

                'usia' =>
                    $validated['usia'],

                'jenjang_terakhir' =>
                    $validated['jenjang_terakhir'],

                'alasan' =>
                    $validated['alasan'],

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

        $dataputussekolah->refresh();


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
                |--------------------------------------------------------------------------
                | ID lama digunakan Apps Script untuk mencari
                | baris yang akan diperbarui.
                |--------------------------------------------------------------------------
                */

                'old_id' =>
                    $oldId,

                /*
                |--------------------------------------------------------------------------
                | ID baru yang ditulis ke Google Sheets.
                |--------------------------------------------------------------------------
                */

                'id' =>
                    $dataputussekolah->id_data,

                'nama' =>
                    $dataputussekolah->nama,

                'nik' =>
                    $dataputussekolah->nik,

                'rw' =>
                    $dataputussekolah->rw,

                'usia' =>
                    $dataputussekolah->usia,

                'jenjang_terakhir' =>
                    $dataputussekolah->jenjang_terakhir,

                'alasan' =>
                    $dataputussekolah->alasan,

                'keterangan' =>
                    $dataputussekolah->keterangan,

                'diperbarui' =>
                    $dataputussekolah->updated_at
                        ? $dataputussekolah->updated_at->format(
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

            $dataputussekolah->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'dataputussekolah.index'
                )
                ->with(
                    'success',
                    'Data anak putus sekolah berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $dataputussekolah->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'dataputussekolah.index'
            )
            ->with(
                'warning',
                'Data anak putus sekolah berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataAnakPutusSekolah $dataputussekolah
    ) {
        $dataputussekolah->delete();


        return redirect()
            ->route(
                'dataputussekolah.index'
            )
            ->with(
                'success',
                'Data anak putus sekolah berhasil dihapus dari database.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk AnakPutusSekolah.'
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
                'Gagal melakukan JSON encode untuk Google Sheets AnakPutusSekolah.',
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
            'Google Sheets AnakPutusSekolah - Initial Response',
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
                'cURL Google Sheets AnakPutusSekolah gagal.',
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
                'cURL Google Sheets AnakPutusSekolah mengalami error.',
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
                'Google Sheets AnakPutusSekolah - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets AnakPutusSekolah.',
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
            'Google Sheets AnakPutusSekolah HTTP error.',
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
