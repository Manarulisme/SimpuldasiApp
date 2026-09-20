<?php

namespace App\Http\Controllers;

use App\Models\DataStunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DataStuntingController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'Stunting';


    /**
     * Menampilkan seluruh data Stunting.
     */
    public function index()
    {
        $dataStunting = DataStunting::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_stunting.index',
            compact('dataStunting')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $stunting = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_stunting.tambah',
            compact(
                'stunting',
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
                    'required',
                    'string',
                    'max:20',
                    'unique:data_stunting,nik',
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'rw' => [
                    'required',
                    'string',
                    'max:3',
                ],

                'tanggal_lahir' => [
                    'required',
                    'date',
                ],

                'jenis_kelamin' => [
                    'required',
                    'in:Laki-laki,Perempuan',
                ],

                'status' => [
                    'required',
                    'in:Normal,Berisiko,Stunting',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],

            ],
            [

                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK tersebut sudah terdaftar.',

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'nama.required' =>
                    'Nama anak wajib diisi.',

                'nama.max' =>
                    'Nama anak maksimal 150 karakter.',

                'rw.required' =>
                    'RW wajib diisi.',

                'rw.max' =>
                    'RW maksimal 3 karakter.',

                'tanggal_lahir.required' =>
                    'Tanggal lahir wajib diisi.',

                'tanggal_lahir.date' =>
                    'Format tanggal lahir tidak valid.',

                'jenis_kelamin.required' =>
                    'Jenis kelamin wajib dipilih.',

                'jenis_kelamin.in' =>
                    'Jenis kelamin tidak valid.',

                'status.required' =>
                    'Status stunting wajib dipilih.',

                'status.in' =>
                    'Status stunting tidak valid.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $stunting = DataStunting::create(
            [

                'nik' =>
                    $validated['nik'],

                'nama' =>
                    $validated['nama'],

                'rw' =>
                    $validated['rw'],

                'tanggal_lahir' =>
                    $validated['tanggal_lahir'],

                'jenis_kelamin' =>
                    $validated['jenis_kelamin'],

                'status' =>
                    $validated['status'],

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

        $stunting->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. HITUNG USIA DALAM BULAN
        |--------------------------------------------------------------------------
        */

        $usiaBulan = 0;

        if ($stunting->tanggal_lahir) {

            $hariIni = now();

            $usiaBulan =
                (
                    ($hariIni->year - $stunting->tanggal_lahir->year)
                    * 12
                )
                +
                (
                    $hariIni->month -
                    $stunting->tanggal_lahir->month
                );

            if (
                $hariIni->day <
                $stunting->tanggal_lahir->day
            ) {
                $usiaBulan--;
            }

            $usiaBulan = max(
                0,
                $usiaBulan
            );
        }


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

                /*
                | ID menggunakan primary key Laravel.
                */
                'id' =>
                    $stunting->id,

                'nama' =>
                    $stunting->nama,

                'nik' =>
                    $stunting->nik,

                'rw' =>
                    $stunting->rw,

                'usia_bulan' =>
                    $usiaBulan,

                'status' =>
                    $stunting->status,

                'keterangan' =>
                    $stunting->keterangan,

                'diperbarui' =>
                    $stunting->updated_at
                        ? $stunting->updated_at->format(
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

            $stunting->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datastunting.index'
                )
                ->with(
                    'success',
                    'Data stunting berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $stunting->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datastunting.index'
            )
            ->with(
                'warning',
                'Data stunting berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show(
        DataStunting $datastunting
    ) {
        $stunting = $datastunting;

        return view(
            'Admin.Konten.Data_stunting.show',
            compact('stunting')
        );
    }


    /**
     * Form edit data.
     */
    public function edit(
        DataStunting $datastunting
    ) {
        $stunting = $datastunting;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_stunting.tambah',
            compact(
                'stunting',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataStunting $datastunting
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'nik' => [
                    'required',
                    'string',
                    'max:20',

                    Rule::unique(
                        'data_stunting',
                        'nik'
                    )->ignore(
                        $datastunting->id
                    ),
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'rw' => [
                    'required',
                    'string',
                    'max:3',
                ],

                'tanggal_lahir' => [
                    'required',
                    'date',
                ],

                'jenis_kelamin' => [
                    'required',
                    'in:Laki-laki,Perempuan',
                ],

                'status' => [
                    'required',
                    'in:Normal,Berisiko,Stunting',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],

            ],
            [

                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK tersebut sudah digunakan data lain.',

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'nama.required' =>
                    'Nama anak wajib diisi.',

                'nama.max' =>
                    'Nama anak maksimal 150 karakter.',

                'rw.required' =>
                    'RW wajib diisi.',

                'rw.max' =>
                    'RW maksimal 3 karakter.',

                'tanggal_lahir.required' =>
                    'Tanggal lahir wajib diisi.',

                'tanggal_lahir.date' =>
                    'Format tanggal lahir tidak valid.',

                'jenis_kelamin.required' =>
                    'Jenis kelamin wajib dipilih.',

                'jenis_kelamin.in' =>
                    'Jenis kelamin tidak valid.',

                'status.required' =>
                    'Status stunting wajib dipilih.',

                'status.in' =>
                    'Status stunting tidak valid.',

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
        | ID tidak berubah saat edit.
        |
        */

        $oldId = $datastunting->id;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datastunting->update(
            [

                'nik' =>
                    $validated['nik'],

                'nama' =>
                    $validated['nama'],

                'rw' =>
                    $validated['rw'],

                'tanggal_lahir' =>
                    $validated['tanggal_lahir'],

                'jenis_kelamin' =>
                    $validated['jenis_kelamin'],

                'status' =>
                    $validated['status'],

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

        $datastunting->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. HITUNG USIA DALAM BULAN
        |--------------------------------------------------------------------------
        */

        $usiaBulan = 0;

        if ($datastunting->tanggal_lahir) {

            $hariIni = now();

            $usiaBulan =
                (
                    ($hariIni->year - $datastunting->tanggal_lahir->year)
                    * 12
                )
                +
                (
                    $hariIni->month -
                    $datastunting->tanggal_lahir->month
                );

            if (
                $hariIni->day <
                $datastunting->tanggal_lahir->day
            ) {
                $usiaBulan--;
            }

            $usiaBulan = max(
                0,
                $usiaBulan
            );
        }


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
                    $datastunting->id,

                'nama' =>
                    $datastunting->nama,

                'nik' =>
                    $datastunting->nik,

                'rw' =>
                    $datastunting->rw,

                'usia_bulan' =>
                    $usiaBulan,

                'status' =>
                    $datastunting->status,

                'keterangan' =>
                    $datastunting->keterangan,

                'diperbarui' =>
                    $datastunting->updated_at
                        ? $datastunting->updated_at->format(
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

            $datastunting->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datastunting.index'
                )
                ->with(
                    'success',
                    'Data stunting berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datastunting->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datastunting.index'
            )
            ->with(
                'warning',
                'Data stunting berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataStunting $datastunting
    ) {
        $datastunting->delete();


        return redirect()
            ->route(
                'datastunting.index'
            )
            ->with(
                'success',
                'Data stunting berhasil dihapus dari database.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk Stunting.'
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
                'Gagal melakukan JSON encode untuk Google Sheets Stunting.',
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
            'Google Sheets Stunting - Initial Response',
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
                'cURL Google Sheets Stunting gagal.',
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
                'cURL Google Sheets Stunting mengalami error.',
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
                'Google Sheets Stunting - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets Stunting.',
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
            'Google Sheets Stunting HTTP error.',
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
