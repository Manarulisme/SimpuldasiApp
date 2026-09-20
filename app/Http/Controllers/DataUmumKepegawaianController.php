<?php

namespace App\Http\Controllers;

use App\Models\DataUmumKepegawaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataUmumKepegawaianController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'DUK';


    /**
     * Menampilkan seluruh data pegawai
     */
    public function index()
    {
        $pegawai = DataUmumKepegawaian::orderBy(
            'updated_at',
            'desc'
        )->get();

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
            compact(
                'pegawai',
                'isEdit'
            )
        );
    }


    /**
     * Menyimpan data pegawai baru
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

            ],
            [

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

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $pegawai = DataUmumKepegawaian::create(
            [

                'jenis' =>
                    $validated['jenis'],

                'nomor' =>
                    $validated['nomor'],

                'nama' =>
                    $validated['nama'],

                'golongan' =>
                    $validated['golongan'],

                'pangkat' =>
                    $validated['pangkat'],

                'jabatan' =>
                    $validated['jabatan'],

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

        $pegawai->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. KIRIM KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $sync = $this->sendToGoogleSheets(
            [

                'sheet' =>
                    self::GOOGLE_SHEET_NAME,

                'action' =>
                    'create',

                'id' =>
                    $pegawai->id,

                'jenis' =>
                    $pegawai->jenis,

                'nomor' =>
                    $pegawai->nomor,

                'nama' =>
                    $pegawai->nama,

                'golongan' =>
                    $pegawai->golongan,

                'pangkat' =>
                    $pegawai->pangkat,

                'jabatan' =>
                    $pegawai->jabatan,

                'diperbarui' =>
                    $pegawai->updated_at
                        ? $pegawai->updated_at->format(
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

            $pegawai->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'dataumumpegawai.index'
                )
                ->with(
                    'success',
                    'Data pegawai berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $pegawai->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'dataumumpegawai.index'
            )
            ->with(
                'warning',
                'Data pegawai berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data pegawai
     */
    public function show(
        DataUmumKepegawaian $dataumumpegawai
    ) {
        $pegawai = $dataumumpegawai;

        return view(
            'Admin.Konten.Data_umum_pegawai.show',
            compact('pegawai')
        );
    }


    /**
     * Menampilkan form edit
     */
/**

* Menampilkan form edit
  */
  public function edit(
  DataUmumKepegawaian $dataumumpegawai
  ) {
  $pegawai = $dataumumpegawai;

  $isEdit = true;

  return view(
  'Admin.Konten.Data_umum_pegawai.tambah',
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
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

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

            ],
            [

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

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataumumpegawai->update(
            [

                'jenis' =>
                    $validated['jenis'],

                'nomor' =>
                    $validated['nomor'],

                'nama' =>
                    $validated['nama'],

                'golongan' =>
                    $validated['golongan'],

                'pangkat' =>
                    $validated['pangkat'],

                'jabatan' =>
                    $validated['jabatan'],

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
        | Memastikan updated_at yang dikirim ke Google
        | adalah timestamp terbaru.
        |
        */

        $dataumumpegawai->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. KIRIM UPDATE KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $sync = $this->sendToGoogleSheets(
            [

                'sheet' =>
                    self::GOOGLE_SHEET_NAME,

                'action' =>
                    'update',

                'id' =>
                    $dataumumpegawai->id,

                'jenis' =>
                    $dataumumpegawai->jenis,

                'nomor' =>
                    $dataumumpegawai->nomor,

                'nama' =>
                    $dataumumpegawai->nama,

                'golongan' =>
                    $dataumumpegawai->golongan,

                'pangkat' =>
                    $dataumumpegawai->pangkat,

                'jabatan' =>
                    $dataumumpegawai->jabatan,

                'diperbarui' =>
                    $dataumumpegawai->updated_at
                        ? $dataumumpegawai->updated_at->format(
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

            $dataumumpegawai->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'dataumumpegawai.index'
                )
                ->with(
                    'success',
                    'Data pegawai berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $dataumumpegawai->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'dataumumpegawai.index'
            )
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
     * Data yang sudah masuk Google Sheets tetap dipertahankan
     * sebagai arsip.
     */
    public function destroy(
        DataUmumKepegawaian $dataumumpegawai
    ) {
        $dataumumpegawai->delete();

        return redirect()
            ->route(
                'dataumumpegawai.index'
            )
            ->with(
                'success',
                'Data pegawai berhasil dihapus.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env.'
            );

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | SIAPKAN JSON
        |--------------------------------------------------------------------------
        */

        $jsonData = json_encode(
            $data,
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );


        if ($jsonData === false) {

            Log::error(
                'Gagal melakukan JSON encode untuk Google Sheets.',
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
        | CURL REQUEST
        |--------------------------------------------------------------------------
        |
        | Google Apps Script Web App dapat memberikan redirect
        | setelah menerima POST.
        |
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
        | LOG RESPONSE
        |--------------------------------------------------------------------------
        */

        Log::info(
            'Google Sheets DUK - Initial Response',
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
                'cURL Google Sheets DUK gagal.',
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
                'cURL Google Sheets DUK mengalami error.',
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
            |
            | POST awal sudah diterima oleh Apps Script.
            | Request berikutnya digunakan untuk membaca
            | response hasil eksekusi.
            |
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
                'Google Sheets DUK - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets DUK.',
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
            'Google Sheets DUK HTTP error.',
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
