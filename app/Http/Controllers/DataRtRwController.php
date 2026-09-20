<?php

namespace App\Http\Controllers;

use App\Models\DataRtRw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataRtRwController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'RTRW';


    /**
     * Menampilkan seluruh data RT & RW
     */
    public function index()
    {
        $dataRtRw = DataRtRw::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_rt_rw.index',
            compact('dataRtRw')
        );
    }


    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        $dataRtRw = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_rt_rw.tambah',
            compact(
                'dataRtRw',
                'isEdit'
            )
        );
    }


    /**
     * Menyimpan data RT & RW baru
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

                'nama_rt' => [
                    'required',
                    'string',
                    'max:150'
                ],

                'nomor_rt' => [
                    'required',
                    'string',
                    'max:20'
                ],

                'nama_rw' => [
                    'required',
                    'string',
                    'max:150'
                ],

                'nomor_rw' => [
                    'required',
                    'string',
                    'max:20'
                ],

                'tanggal_mulai' => [
                    'nullable',
                    'date'
                ],

                'tanggal_berakhir' => [
                    'nullable',
                    'date',
                    'after_or_equal:tanggal_mulai'
                ],

            ],
            [

                'nama_rt.required' =>
                    'Nama Ketua RT wajib diisi.',

                'nama_rt.max' =>
                    'Nama Ketua RT maksimal 150 karakter.',

                'nomor_rt.required' =>
                    'Nomor RT wajib diisi.',

                'nomor_rt.max' =>
                    'Nomor RT maksimal 20 karakter.',

                'nama_rw.required' =>
                    'Nama Ketua RW wajib diisi.',

                'nama_rw.max' =>
                    'Nama Ketua RW maksimal 150 karakter.',

                'nomor_rw.required' =>
                    'Nomor RW wajib diisi.',

                'nomor_rw.max' =>
                    'Nomor RW maksimal 20 karakter.',

                'tanggal_mulai.date' =>
                    'Tanggal mulai harus berupa tanggal yang valid.',

                'tanggal_berakhir.date' =>
                    'Tanggal berakhir harus berupa tanggal yang valid.',

                'tanggal_berakhir.after_or_equal' =>
                    'Tanggal berakhir tidak boleh sebelum tanggal mulai.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataRtRw = DataRtRw::create(
            [

                'nama_rt' =>
                    $validated['nama_rt'],

                'nomor_rt' =>
                    $validated['nomor_rt'],

                'nama_rw' =>
                    $validated['nama_rw'],

                'nomor_rw' =>
                    $validated['nomor_rw'],

                'tanggal_mulai' =>
                    $validated['tanggal_mulai'] ?? null,

                'tanggal_berakhir' =>
                    $validated['tanggal_berakhir'] ?? null,

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

        $dataRtRw->refresh();


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
                |----------------------------------------------------------------------
                | ID menggunakan primary key Laravel
                |----------------------------------------------------------------------
                */

                'id' =>
                    $dataRtRw->id,

                /*
                |----------------------------------------------------------------------
                | DATA RT
                |----------------------------------------------------------------------
                */

                'nomor_rt' =>
                    $dataRtRw->nomor_rt,

                'nama_rt' =>
                    $dataRtRw->nama_rt,

                /*
                |----------------------------------------------------------------------
                | DATA RW
                |----------------------------------------------------------------------
                */

                'nomor_rw' =>
                    $dataRtRw->nomor_rw,

                'nama_rw' =>
                    $dataRtRw->nama_rw,

                /*
                |----------------------------------------------------------------------
                | PERIODE JABATAN
                |----------------------------------------------------------------------
                */

                'tanggal_mulai' =>
                    $dataRtRw->tanggal_mulai
                        ? $dataRtRw->tanggal_mulai->format('Y-m-d')
                        : null,

                'tanggal_berakhir' =>
                    $dataRtRw->tanggal_berakhir
                        ? $dataRtRw->tanggal_berakhir->format('Y-m-d')
                        : null,

                /*
                |----------------------------------------------------------------------
                | WAKTU PERUBAHAN
                |----------------------------------------------------------------------
                */

                'diperbarui' =>
                    $dataRtRw->updated_at
                        ? $dataRtRw->updated_at->format(
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

            $dataRtRw->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datartrw.index'
                )
                ->with(
                    'success',
                    'Data RT & RW berhasil ditambahkan dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        |
        | Data tetap tersimpan di database Laravel.
        |
        */

        $dataRtRw->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datartrw.index'
            )
            ->with(
                'warning',
                'Data RT & RW berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data RT & RW
     */
    public function show(
        DataRtRw $datartrw
    ) {
        return view(
            'Admin.Konten.Data_rt_rw.show',
            compact('datartrw')
        );
    }


    /**
     * Menampilkan form edit data RT & RW
     */
    public function edit(
        DataRtRw $datartrw
    ) {
        $dataRtRw = $datartrw;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_rt_rw.tambah',
            compact(
                'dataRtRw',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data RT & RW
     */
    public function update(
        Request $request,
        DataRtRw $datartrw
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'nama_rt' => [
                    'required',
                    'string',
                    'max:150'
                ],

                'nomor_rt' => [
                    'required',
                    'string',
                    'max:20'
                ],

                'nama_rw' => [
                    'required',
                    'string',
                    'max:150'
                ],

                'nomor_rw' => [
                    'required',
                    'string',
                    'max:20'
                ],

                'tanggal_mulai' => [
                    'nullable',
                    'date'
                ],

                'tanggal_berakhir' => [
                    'nullable',
                    'date',
                    'after_or_equal:tanggal_mulai'
                ],

            ],
            [

                'nama_rt.required' =>
                    'Nama Ketua RT wajib diisi.',

                'nama_rt.max' =>
                    'Nama Ketua RT maksimal 150 karakter.',

                'nomor_rt.required' =>
                    'Nomor RT wajib diisi.',

                'nomor_rt.max' =>
                    'Nomor RT maksimal 20 karakter.',

                'nama_rw.required' =>
                    'Nama Ketua RW wajib diisi.',

                'nama_rw.max' =>
                    'Nama Ketua RW maksimal 150 karakter.',

                'nomor_rw.required' =>
                    'Nomor RW wajib diisi.',

                'nomor_rw.max' =>
                    'Nomor RW maksimal 20 karakter.',

                'tanggal_mulai.date' =>
                    'Tanggal mulai harus berupa tanggal yang valid.',

                'tanggal_berakhir.date' =>
                    'Tanggal berakhir harus berupa tanggal yang valid.',

                'tanggal_berakhir.after_or_equal' =>
                    'Tanggal berakhir tidak boleh sebelum tanggal mulai.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | ID primary key Laravel digunakan sebagai
        | identifier baris Google Sheets.
        |
        */

        $oldId =
            $datartrw->id;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datartrw->update(
            [

                'nama_rt' =>
                    $validated['nama_rt'],

                'nomor_rt' =>
                    $validated['nomor_rt'],

                'nama_rw' =>
                    $validated['nama_rw'],

                'nomor_rw' =>
                    $validated['nomor_rw'],

                'tanggal_mulai' =>
                    $validated['tanggal_mulai'] ?? null,

                'tanggal_berakhir' =>
                    $validated['tanggal_berakhir'] ?? null,

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

        $datartrw->refresh();


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
                |----------------------------------------------------------------------
                | ID sebelum perubahan.
                |----------------------------------------------------------------------
                */

                'old_id' =>
                    $oldId,

                /*
                |----------------------------------------------------------------------
                | ID setelah perubahan.
                |----------------------------------------------------------------------
                */

                'id' =>
                    $datartrw->id,

                /*
                |----------------------------------------------------------------------
                | DATA RT
                |----------------------------------------------------------------------
                */

                'nomor_rt' =>
                    $datartrw->nomor_rt,

                'nama_rt' =>
                    $datartrw->nama_rt,

                /*
                |----------------------------------------------------------------------
                | DATA RW
                |----------------------------------------------------------------------
                */

                'nomor_rw' =>
                    $datartrw->nomor_rw,

                'nama_rw' =>
                    $datartrw->nama_rw,

                /*
                |----------------------------------------------------------------------
                | PERIODE JABATAN
                |----------------------------------------------------------------------
                */

                'tanggal_mulai' =>
                    $datartrw->tanggal_mulai
                        ? $datartrw->tanggal_mulai->format('Y-m-d')
                        : null,

                'tanggal_berakhir' =>
                    $datartrw->tanggal_berakhir
                        ? $datartrw->tanggal_berakhir->format('Y-m-d')
                        : null,

                /*
                |----------------------------------------------------------------------
                | WAKTU PERUBAHAN
                |----------------------------------------------------------------------
                */

                'diperbarui' =>
                    $datartrw->updated_at
                        ? $datartrw->updated_at->format(
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

            $datartrw->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datartrw.index'
                )
                ->with(
                    'success',
                    'Data RT & RW berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datartrw->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datartrw.index'
            )
            ->with(
                'warning',
                'Data RT & RW berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data RT & RW
     *
     * Delete hanya dilakukan di database Laravel.
     * Google Sheets tetap menyimpan data sebagai arsip.
     */
    public function destroy(
        DataRtRw $datartrw
    ) {
        $datartrw->delete();


        return redirect()
            ->route(
                'datartrw.index'
            )
            ->with(
                'success',
                'Data RT & RW berhasil dihapus dari database.'
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
        | AMBIL URL APPS SCRIPT
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk RTRW.'
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
                'Gagal melakukan JSON encode untuk Google Sheets RTRW.',
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
            'Google Sheets RTRW - Initial Response',
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
                'cURL Google Sheets RTRW gagal.',
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
                'cURL Google Sheets RTRW mengalami error.',
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
                'Google Sheets RTRW - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets RTRW.',
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
            'Google Sheets RTRW HTTP error.',
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
