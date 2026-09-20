<?php

namespace App\Http\Controllers;

use App\Models\DataLinmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataLinmasController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'Linmas';

    /**
     * Menampilkan seluruh data Linmas & Siskamling.
     */
    public function index()
    {
        $dataLinmas = DataLinmas::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_linmas.index',
            compact('dataLinmas')
        );
    }

    /**
     * Form tambah data.
     */
    public function create()
    {
        $dataLinmas = null;
        $isEdit = false;

        return view(
            'Admin.Konten.Data_linmas.tambah',
            compact(
                'dataLinmas',
                'isEdit'
            )
        );
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'rw' => [
                    'required',
                    'string',
                    'max:10',
                ],

                'jumlah_linmas' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'nama' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'nik' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'alamat' => [
                    'nullable',
                    'string',
                ],

                'pekerjaan' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'jumlah_poskamling' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'titik_poskamling' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'rw.required' =>
                    'RW wajib diisi.',

                'rw.max' =>
                    'RW maksimal 10 karakter.',

                'jumlah_linmas.required' =>
                    'Jumlah Linmas wajib diisi.',

                'jumlah_linmas.integer' =>
                    'Jumlah Linmas harus berupa angka.',

                'jumlah_linmas.min' =>
                    'Jumlah Linmas tidak boleh kurang dari 0.',

                'nama.max' =>
                    'Nama maksimal 150 karakter.',

                'nik.max' =>
                    'NIK maksimal 30 karakter.',

                'pekerjaan.max' =>
                    'Pekerjaan maksimal 100 karakter.',

                'jumlah_poskamling.required' =>
                    'Jumlah Poskamling wajib diisi.',

                'jumlah_poskamling.integer' =>
                    'Jumlah Poskamling harus berupa angka.',

                'jumlah_poskamling.min' =>
                    'Jumlah Poskamling tidak boleh kurang dari 0.',

                'titik_poskamling.max' =>
                    'Titik Poskamling maksimal 255 karakter.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataLinmas = DataLinmas::create(
            [
                'rw' =>
                    $validated['rw'],

                'jumlah_linmas' =>
                    $validated['jumlah_linmas'],

                'nama' =>
                    $validated['nama'] ?? null,

                'nik' =>
                    $validated['nik'] ?? null,

                'alamat' =>
                    $validated['alamat'] ?? null,

                'pekerjaan' =>
                    $validated['pekerjaan'] ?? null,

                'jumlah_poskamling' =>
                    $validated['jumlah_poskamling'],

                'titik_poskamling' =>
                    $validated['titik_poskamling'] ?? null,

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

        $dataLinmas->refresh();

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

                'id' =>
                    $dataLinmas->id,

                'rw' =>
                    $dataLinmas->rw,

                'jumlah_linmas' =>
                    $dataLinmas->jumlah_linmas,

                'nama' =>
                    $dataLinmas->nama,

                'nik' =>
                    $dataLinmas->nik,

                'alamat' =>
                    $dataLinmas->alamat,

                'pekerjaan' =>
                    $dataLinmas->pekerjaan,

                'jumlah_poskamling' =>
                    $dataLinmas->jumlah_poskamling,

                'titik_poskamling' =>
                    $dataLinmas->titik_poskamling,

                'keterangan' =>
                    $dataLinmas->keterangan,

                'diperbarui' =>
                    $dataLinmas->updated_at
                        ? $dataLinmas->updated_at->format('Y-m-d H:i:s')
                        : now()->format('Y-m-d H:i:s'),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 4. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($sync) {

            $dataLinmas->update(
                [
                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),
                ]
            );

            return redirect()
                ->route('datalinmas.index')
                ->with(
                    'success',
                    'Data Linmas & Siskamling berhasil ditambahkan dan disinkronkan ke Google Sheets.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $dataLinmas->update(
            [
                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,
            ]
        );

        return redirect()
            ->route('datalinmas.index')
            ->with(
                'warning',
                'Data Linmas & Siskamling berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }

    /**
     * Menampilkan detail data.
     */
    public function show(DataLinmas $datalinma)
    {
        $dataLinmas = $datalinma;

        return view(
            'Admin.Konten.Data_linmas.show',
            compact('dataLinmas')
        );
    }

    /**
     * Form edit data.
     */
    public function edit(DataLinmas $datalinma)
    {
        $dataLinmas = $datalinma;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_linmas.tambah',
            compact(
                'dataLinmas',
                'isEdit'
            )
        );
    }

    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataLinmas $datalinma
    ) {
        $validated = $request->validate(
            [
                'rw' => [
                    'required',
                    'string',
                    'max:10',
                ],

                'jumlah_linmas' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'nama' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'nik' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'alamat' => [
                    'nullable',
                    'string',
                ],

                'pekerjaan' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'jumlah_poskamling' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'titik_poskamling' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'rw.required' =>
                    'RW wajib diisi.',

                'rw.max' =>
                    'RW maksimal 10 karakter.',

                'jumlah_linmas.required' =>
                    'Jumlah Linmas wajib diisi.',

                'jumlah_linmas.integer' =>
                    'Jumlah Linmas harus berupa angka.',

                'jumlah_linmas.min' =>
                    'Jumlah Linmas tidak boleh kurang dari 0.',

                'nama.max' =>
                    'Nama maksimal 150 karakter.',

                'nik.max' =>
                    'NIK maksimal 30 karakter.',

                'pekerjaan.max' =>
                    'Pekerjaan maksimal 100 karakter.',

                'jumlah_poskamling.required' =>
                    'Jumlah Poskamling wajib diisi.',

                'jumlah_poskamling.integer' =>
                    'Jumlah Poskamling harus berupa angka.',

                'jumlah_poskamling.min' =>
                    'Jumlah Poskamling tidak boleh kurang dari 0.',

                'titik_poskamling.max' =>
                    'Titik Poskamling maksimal 255 karakter.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        */

        $oldId = $datalinma->id;

        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datalinma->update(
            [
                'rw' =>
                    $validated['rw'],

                'jumlah_linmas' =>
                    $validated['jumlah_linmas'],

                'nama' =>
                    $validated['nama'] ?? null,

                'nik' =>
                    $validated['nik'] ?? null,

                'alamat' =>
                    $validated['alamat'] ?? null,

                'pekerjaan' =>
                    $validated['pekerjaan'] ?? null,

                'jumlah_poskamling' =>
                    $validated['jumlah_poskamling'],

                'titik_poskamling' =>
                    $validated['titik_poskamling'] ?? null,

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

        $datalinma->refresh();

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

                'old_id' =>
                    $oldId,

                'id' =>
                    $datalinma->id,

                'rw' =>
                    $datalinma->rw,

                'jumlah_linmas' =>
                    $datalinma->jumlah_linmas,

                'nama' =>
                    $datalinma->nama,

                'nik' =>
                    $datalinma->nik,

                'alamat' =>
                    $datalinma->alamat,

                'pekerjaan' =>
                    $datalinma->pekerjaan,

                'jumlah_poskamling' =>
                    $datalinma->jumlah_poskamling,

                'titik_poskamling' =>
                    $datalinma->titik_poskamling,

                'keterangan' =>
                    $datalinma->keterangan,

                'diperbarui' =>
                    $datalinma->updated_at
                        ? $datalinma->updated_at->format('Y-m-d H:i:s')
                        : now()->format('Y-m-d H:i:s'),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 4. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($sync) {

            $datalinma->update(
                [
                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),
                ]
            );

            return redirect()
                ->route('datalinmas.index')
                ->with(
                    'success',
                    'Data Linmas & Siskamling berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datalinma->update(
            [
                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,
            ]
        );

        return redirect()
            ->route('datalinmas.index')
            ->with(
                'warning',
                'Data Linmas & Siskamling berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }

    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(DataLinmas $datalinma)
    {
        $datalinma->delete();

        return redirect()
            ->route('datalinmas.index')
            ->with(
                'success',
                'Data Linmas & Siskamling berhasil dihapus dari database.'
            );
    }

    /**
     * Mengirim data ke Google Apps Script.
     */
    private function sendToGoogleSheets(array $data): bool
    {
        $url = env('GOOGLE_SHEETS_SCRIPT_URL');

        if (!$url) {

            Log::error(
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk Linmas.'
            );

            return false;
        }

        $jsonData = json_encode(
            $data,
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );

        if ($jsonData === false) {

            Log::error(
                'Gagal melakukan JSON encode untuk Google Sheets Linmas.',
                [
                    'data' =>
                        $data,

                    'json_error' =>
                        json_last_error_msg(),
                ]
            );

            return false;
        }

        $ch = curl_init($url);

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
                        'Content-Length: ' . strlen($jsonData),
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

        $rawResponse = curl_exec($ch);

        $httpCode = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

        $redirectUrl = curl_getinfo(
            $ch,
            CURLINFO_REDIRECT_URL
        );

        $curlErrno = curl_errno($ch);

        $curlError = curl_error($ch);

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

        curl_close($ch);

        Log::info(
            'Google Sheets Linmas - Initial Response',
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

        if ($rawResponse === false) {

            Log::error(
                'cURL Google Sheets Linmas gagal.',
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
                'cURL Google Sheets Linmas mengalami error.',
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

            $redirectUrl = trim($redirectUrl);

            $ch = curl_init($redirectUrl);

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

            $finalResponse = curl_exec($ch);

            $finalHttpCode = curl_getinfo(
                $ch,
                CURLINFO_HTTP_CODE
            );

            $finalCurlErrno = curl_errno($ch);

            $finalCurlError = curl_error($ch);

            curl_close($ch);

            Log::info(
                'Google Sheets Linmas - Redirect Response',
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

            if (
                $finalResponse === false ||
                $finalCurlErrno !== 0
            ) {

                Log::error(
                    'Gagal mengambil response redirect Google Sheets Linmas.',
                    [
                        'curl_errno' =>
                            $finalCurlErrno,

                        'curl_error' =>
                            $finalCurlError,
                    ]
                );

                return false;
            }

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

                return (bool) $decoded['success'];
            }

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

            return (bool) $decoded['success'];
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
            'Google Sheets Linmas HTTP error.',
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
