<?php

namespace App\Http\Controllers;

use App\Models\DataFasilitasUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataFasilitasUmumController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'FasumFasos';


    /**
     * Menampilkan seluruh data fasilitas umum dan sosial.
     */
    public function index()
    {
        $dataFasilitasUmum = DataFasilitasUmum::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_fasilitas_umum.index',
            compact('dataFasilitasUmum')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $dataFasilitasUmum = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_fasilitas_umum.tambah',
            compact(
                'dataFasilitasUmum',
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

                'jenis' => [
                    'nullable',
                    'string',
                    'in:Kesehatan,Pendidikan,Olahraga,Sosial,Ruang Terbuka,Keagamaan,Infrastruktur,Lainnya',
                ],

                'alamat' => [
                    'nullable',
                    'string',
                ],

                'sumber_dana' => [
                    'nullable',
                    'string',
                    'in:APBD,Dana Kelurahan,Dana Desa,Swadaya Masyarakat,Bantuan Pemerintah,Lainnya',
                ],

            ],
            [

                'nama.required' =>
                    'Nama fasilitas wajib diisi.',

                'nama.string' =>
                    'Nama fasilitas harus berupa teks.',

                'nama.max' =>
                    'Nama fasilitas maksimal 255 karakter.',

                'lokasi.string' =>
                    'Lokasi harus berupa teks.',

                'lokasi.max' =>
                    'Lokasi maksimal 255 karakter.',

                'jenis.in' =>
                    'Jenis fasilitas yang dipilih tidak valid.',

                'alamat.string' =>
                    'Alamat harus berupa teks.',

                'sumber_dana.in' =>
                    'Sumber dana yang dipilih tidak valid.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataFasilitasUmum = DataFasilitasUmum::create(
            [

                'nama' =>
                    $validated['nama'],

                'lokasi' =>
                    $validated['lokasi'] ?? null,

                'jenis' =>
                    $validated['jenis'] ?? null,

                'alamat' =>
                    $validated['alamat'] ?? null,

                'sumber_dana' =>
                    $validated['sumber_dana'] ?? null,

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

        $dataFasilitasUmum->refresh();


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
                | ID menggunakan ID database Laravel.
                */
                'id' =>
                    $dataFasilitasUmum->id,

                'nama' =>
                    $dataFasilitasUmum->nama,

                'lokasi' =>
                    $dataFasilitasUmum->lokasi,

                'jenis' =>
                    $dataFasilitasUmum->jenis,

                'alamat' =>
                    $dataFasilitasUmum->alamat,

                'sumber_dana' =>
                    $dataFasilitasUmum->sumber_dana,

                'diperbarui' =>
                    $dataFasilitasUmum->updated_at
                        ? $dataFasilitasUmum->updated_at->format(
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

            $dataFasilitasUmum->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datafasilitasumum.index'
                )
                ->with(
                    'success',
                    'Data fasilitas umum berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $dataFasilitasUmum->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datafasilitasumum.index'
            )
            ->with(
                'warning',
                'Data fasilitas umum berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show(
        DataFasilitasUmum $datafasilitasumum
    ) {
        $dataFasilitasUmum = $datafasilitasumum;

        return view(
            'Admin.Konten.Data_fasilitas_umum.show',
            compact('dataFasilitasUmum')
        );
    }


    /**
     * Form edit data.
     */
    public function edit(
        DataFasilitasUmum $datafasilitasumum
    ) {
        $dataFasilitasUmum = $datafasilitasumum;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_fasilitas_umum.tambah',
            compact(
                'dataFasilitasUmum',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataFasilitasUmum $datafasilitasumum
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

                'jenis' => [
                    'nullable',
                    'string',
                    'in:Kesehatan,Pendidikan,Olahraga,Sosial,Ruang Terbuka,Keagamaan,Infrastruktur,Lainnya',
                ],

                'alamat' => [
                    'nullable',
                    'string',
                ],

                'sumber_dana' => [
                    'nullable',
                    'string',
                    'in:APBD,Dana Kelurahan,Dana Desa,Swadaya Masyarakat,Bantuan Pemerintah,Lainnya',
                ],

            ],
            [

                'nama.required' =>
                    'Nama fasilitas wajib diisi.',

                'nama.string' =>
                    'Nama fasilitas harus berupa teks.',

                'nama.max' =>
                    'Nama fasilitas maksimal 255 karakter.',

                'lokasi.string' =>
                    'Lokasi harus berupa teks.',

                'lokasi.max' =>
                    'Lokasi maksimal 255 karakter.',

                'jenis.in' =>
                    'Jenis fasilitas yang dipilih tidak valid.',

                'alamat.string' =>
                    'Alamat harus berupa teks.',

                'sumber_dana.in' =>
                    'Sumber dana yang dipilih tidak valid.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | ID database digunakan sebagai identifier
        | baris Google Sheets.
        |
        */

        $oldId = $datafasilitasumum->id;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datafasilitasumum->update(
            [

                'nama' =>
                    $validated['nama'],

                'lokasi' =>
                    $validated['lokasi'] ?? null,

                'jenis' =>
                    $validated['jenis'] ?? null,

                'alamat' =>
                    $validated['alamat'] ?? null,

                'sumber_dana' =>
                    $validated['sumber_dana'] ?? null,

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

        $datafasilitasumum->refresh();


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
                    $datafasilitasumum->id,

                'nama' =>
                    $datafasilitasumum->nama,

                'lokasi' =>
                    $datafasilitasumum->lokasi,

                'jenis' =>
                    $datafasilitasumum->jenis,

                'alamat' =>
                    $datafasilitasumum->alamat,

                'sumber_dana' =>
                    $datafasilitasumum->sumber_dana,

                'diperbarui' =>
                    $datafasilitasumum->updated_at
                        ? $datafasilitasumum->updated_at->format(
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

            $datafasilitasumum->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datafasilitasumum.index'
                )
                ->with(
                    'success',
                    'Data fasilitas umum berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datafasilitasumum->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datafasilitasumum.index'
            )
            ->with(
                'warning',
                'Data fasilitas umum berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataFasilitasUmum $datafasilitasumum
    ) {
        $datafasilitasumum->delete();


        return redirect()
            ->route(
                'datafasilitasumum.index'
            )
            ->with(
                'success',
                'Data fasilitas umum berhasil dihapus dari database.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk FasumFasos.'
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
                'Gagal melakukan JSON encode untuk Google Sheets FasumFasos.',
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
            'Google Sheets FasumFasos - Initial Response',
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
                'cURL Google Sheets FasumFasos gagal.',
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
                'cURL Google Sheets FasumFasos mengalami error.',
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
                'Google Sheets FasumFasos - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets FasumFasos.',
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
            'Google Sheets FasumFasos HTTP error.',
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
