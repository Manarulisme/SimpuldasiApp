<?php

namespace App\Http\Controllers;

use App\Models\DataSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DataSekolahController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'DataSekolah';


    /**
     * Menampilkan seluruh data sekolah.
     */
    public function index()
    {
        $dataSekolah = DataSekolah::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_sekolah.index',
            compact('dataSekolah')
        );
    }


    /**
     * Form tambah data sekolah.
     */
    public function create()
    {
        $sekolah = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_sekolah.tambah',
            compact(
                'sekolah',
                'isEdit'
            )
        );
    }


    /**
     * Menyimpan data sekolah baru.
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
                    'unique:data_sekolah,id_data',
                ],

                'nama_sekolah' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'jenjang' => [
                    'required',
                    'in:TK,SD,SMP,SMA,SMK',
                ],

                'alamat' => [
                    'required',
                    'string',
                ],

                'jumlah_siswa' => [
                    'required',
                    'integer',
                    'min:0',
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

                'nama_sekolah.required' =>
                    'Nama sekolah wajib diisi.',

                'nama_sekolah.max' =>
                    'Nama sekolah maksimal 150 karakter.',

                'jenjang.required' =>
                    'Jenjang sekolah wajib dipilih.',

                'jenjang.in' =>
                    'Jenjang sekolah tidak valid.',

                'alamat.required' =>
                    'Alamat sekolah wajib diisi.',

                'jumlah_siswa.required' =>
                    'Jumlah siswa wajib diisi.',

                'jumlah_siswa.integer' =>
                    'Jumlah siswa harus berupa angka.',

                'jumlah_siswa.min' =>
                    'Jumlah siswa tidak boleh kurang dari 0.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $sekolah = DataSekolah::create(
            [

                'id_data' =>
                    $validated['id_data'],

                'nama_sekolah' =>
                    $validated['nama_sekolah'],

                'jenjang' =>
                    $validated['jenjang'],

                'alamat' =>
                    $validated['alamat'],

                'jumlah_siswa' =>
                    $validated['jumlah_siswa'],

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

        $sekolah->refresh();


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
                    $sekolah->id_data,

                'nama_sekolah' =>
                    $sekolah->nama_sekolah,

                'jenjang' =>
                    $sekolah->jenjang,

                'alamat' =>
                    $sekolah->alamat,

                'jumlah_siswa' =>
                    $sekolah->jumlah_siswa,

                'keterangan' =>
                    $sekolah->keterangan,

                'diperbarui' =>
                    $sekolah->updated_at
                        ? $sekolah->updated_at->format(
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

            $sekolah->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datasekolah.index'
                )
                ->with(
                    'success',
                    'Data sekolah berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $sekolah->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datasekolah.index'
            )
            ->with(
                'warning',
                'Data sekolah berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data sekolah.
     */
    public function show(
        DataSekolah $datasekolah
    ) {
        $sekolah = $datasekolah;

        return view(
            'Admin.Konten.Data_sekolah.show',
            compact('sekolah')
        );
    }


    /**
     * Form edit data sekolah.
     */
    public function edit(
        DataSekolah $datasekolah
    ) {
        $sekolah = $datasekolah;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_sekolah.tambah',
            compact(
                'sekolah',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data sekolah.
     */
    public function update(
        Request $request,
        DataSekolah $datasekolah
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
                        'data_sekolah',
                        'id_data'
                    )->ignore(
                        $datasekolah->id
                    ),
                ],

                'nama_sekolah' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'jenjang' => [
                    'required',
                    'in:TK,SD,SMP,SMA,SMK',
                ],

                'alamat' => [
                    'required',
                    'string',
                ],

                'jumlah_siswa' => [
                    'required',
                    'integer',
                    'min:0',
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

                'nama_sekolah.required' =>
                    'Nama sekolah wajib diisi.',

                'nama_sekolah.max' =>
                    'Nama sekolah maksimal 150 karakter.',

                'jenjang.required' =>
                    'Jenjang sekolah wajib dipilih.',

                'jenjang.in' =>
                    'Jenjang sekolah tidak valid.',

                'alamat.required' =>
                    'Alamat sekolah wajib diisi.',

                'jumlah_siswa.required' =>
                    'Jumlah siswa wajib diisi.',

                'jumlah_siswa.integer' =>
                    'Jumlah siswa harus berupa angka.',

                'jumlah_siswa.min' =>
                    'Jumlah siswa tidak boleh kurang dari 0.',

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
            $datasekolah->id_data;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datasekolah->update(
            [

                'id_data' =>
                    $validated['id_data'],

                'nama_sekolah' =>
                    $validated['nama_sekolah'],

                'jenjang' =>
                    $validated['jenjang'],

                'alamat' =>
                    $validated['alamat'],

                'jumlah_siswa' =>
                    $validated['jumlah_siswa'],

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

        $datasekolah->refresh();


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
                    $datasekolah->id_data,

                'nama_sekolah' =>
                    $datasekolah->nama_sekolah,

                'jenjang' =>
                    $datasekolah->jenjang,

                'alamat' =>
                    $datasekolah->alamat,

                'jumlah_siswa' =>
                    $datasekolah->jumlah_siswa,

                'keterangan' =>
                    $datasekolah->keterangan,

                'diperbarui' =>
                    $datasekolah->updated_at
                        ? $datasekolah->updated_at->format(
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

            $datasekolah->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datasekolah.index'
                )
                ->with(
                    'success',
                    'Data sekolah berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datasekolah->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datasekolah.index'
            )
            ->with(
                'warning',
                'Data sekolah berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data sekolah.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataSekolah $datasekolah
    ) {
        $datasekolah->delete();


        return redirect()
            ->route(
                'datasekolah.index'
            )
            ->with(
                'success',
                'Data sekolah berhasil dihapus dari database.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk DataSekolah.'
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
                'Gagal melakukan JSON encode untuk Google Sheets DataSekolah.',
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
            'Google Sheets DataSekolah - Initial Response',
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
                'cURL Google Sheets DataSekolah gagal.',
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
                'cURL Google Sheets DataSekolah mengalami error.',
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
                'Google Sheets DataSekolah - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets DataSekolah.',
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
            'Google Sheets DataSekolah HTTP error.',
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
?>
