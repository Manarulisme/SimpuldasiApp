<?php

namespace App\Http\Controllers;

use App\Models\DataUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DataUmkmController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'UMKM';


    /**
     * Menampilkan seluruh data UMKM.
     */
    public function index()
    {
        $dataUmkm = DataUmkm::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_umkm.index',
            compact('dataUmkm')
        );
    }


    /**
     * Form tambah data UMKM.
     */
    public function create()
    {
        $dataUmkm = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_umkm.tambah',
            compact(
                'dataUmkm',
                'isEdit'
            )
        );
    }


    /**
     * Menyimpan data UMKM baru.
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

                'nama_pelaku_usaha' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'nik' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'no_kk' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'no_telepon' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'nama_usaha' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'jenis_usaha' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'alamat_usaha' => [
                    'nullable',
                    'string',
                ],

                'kelurahan' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'kecamatan' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'kabupaten_kota' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'nib' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'npwp' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'izin_usaha' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'produk_utama' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'modal_usaha' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'omzet_bulanan' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'jumlah_tenaga_kerja' => [
                    'nullable',
                    'integer',
                    'min:0',
                ],

                'skala_usaha' => [
                    'nullable',
                    'in:Mikro,Kecil,Menengah',
                ],

                'status_usaha' => [
                    'nullable',
                    'in:Aktif,Tidak Aktif',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],

            ],
            [

                'nama_pelaku_usaha.required' =>
                    'Nama pelaku usaha wajib diisi.',

                'nama_pelaku_usaha.max' =>
                    'Nama pelaku usaha maksimal 255 karakter.',

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'no_kk.max' =>
                    'Nomor KK maksimal 20 karakter.',

                'no_telepon.max' =>
                    'Nomor telepon maksimal 20 karakter.',

                'nama_usaha.required' =>
                    'Nama usaha wajib diisi.',

                'nama_usaha.max' =>
                    'Nama usaha maksimal 255 karakter.',

                'skala_usaha.in' =>
                    'Skala usaha tidak valid.',

                'status_usaha.in' =>
                    'Status usaha tidak valid.',

                'modal_usaha.numeric' =>
                    'Modal usaha harus berupa angka.',

                'omzet_bulanan.numeric' =>
                    'Omzet bulanan harus berupa angka.',

                'jumlah_tenaga_kerja.integer' =>
                    'Jumlah tenaga kerja harus berupa angka bulat.',

                'jumlah_tenaga_kerja.min' =>
                    'Jumlah tenaga kerja tidak boleh kurang dari 0.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataUmkm = DataUmkm::create(
            [

                'nama_pelaku_usaha' =>
                    $validated['nama_pelaku_usaha'],

                'nik' =>
                    $validated['nik'] ?? null,

                'no_kk' =>
                    $validated['no_kk'] ?? null,

                'no_telepon' =>
                    $validated['no_telepon'] ?? null,

                'nama_usaha' =>
                    $validated['nama_usaha'],

                'jenis_usaha' =>
                    $validated['jenis_usaha'] ?? null,

                'alamat_usaha' =>
                    $validated['alamat_usaha'] ?? null,

                'kelurahan' =>
                    $validated['kelurahan'] ?? null,

                'kecamatan' =>
                    $validated['kecamatan'] ?? null,

                'kabupaten_kota' =>
                    $validated['kabupaten_kota'] ?? null,

                'nib' =>
                    $validated['nib'] ?? null,

                'npwp' =>
                    $validated['npwp'] ?? null,

                'izin_usaha' =>
                    $validated['izin_usaha'] ?? null,

                'produk_utama' =>
                    $validated['produk_utama'] ?? null,

                'modal_usaha' =>
                    $validated['modal_usaha'] ?? null,

                'omzet_bulanan' =>
                    $validated['omzet_bulanan'] ?? null,

                'jumlah_tenaga_kerja' =>
                    $validated['jumlah_tenaga_kerja'] ?? null,

                'skala_usaha' =>
                    $validated['skala_usaha'] ?? null,

                'status_usaha' =>
                    $validated['status_usaha'] ?? null,

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

        $dataUmkm->refresh();


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
                | ID menggunakan primary key Laravel.
                */
                'id' =>
                    $dataUmkm->id,

                'jenis_usaha' =>
                    $dataUmkm->jenis_usaha,

                'nama_usaha' =>
                    $dataUmkm->nama_usaha,

                'nama_pelaku_usaha' =>
                    $dataUmkm->nama_pelaku_usaha,

                'alamat_usaha' =>
                    $dataUmkm->alamat_usaha,

                'no_telepon' =>
                    $dataUmkm->no_telepon,

                'diperbarui' =>
                    $dataUmkm->updated_at
                        ? $dataUmkm->updated_at->format(
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

            $dataUmkm->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'dataumkm.index'
                )
                ->with(
                    'success',
                    'Data UMKM berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $dataUmkm->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'dataumkm.index'
            )
            ->with(
                'warning',
                'Data UMKM berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data UMKM.
     */
    public function show(
        DataUmkm $dataumkm
    ) {
        $dataUmkm = $dataumkm;

        return view(
            'Admin.Konten.Data_umkm.show',
            compact('dataUmkm')
        );
    }


    /**
     * Form edit data UMKM.
     */
    public function edit(
        DataUmkm $dataumkm
    ) {
        $dataUmkm = $dataumkm;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_umkm.tambah',
            compact(
                'dataUmkm',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data UMKM.
     */
    public function update(
        Request $request,
        DataUmkm $dataumkm
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'nama_pelaku_usaha' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'nik' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'no_kk' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'no_telepon' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'nama_usaha' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'jenis_usaha' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'alamat_usaha' => [
                    'nullable',
                    'string',
                ],

                'kelurahan' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'kecamatan' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'kabupaten_kota' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'nib' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'npwp' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'izin_usaha' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'produk_utama' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'modal_usaha' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'omzet_bulanan' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'jumlah_tenaga_kerja' => [
                    'nullable',
                    'integer',
                    'min:0',
                ],

                'skala_usaha' => [
                    'nullable',
                    'in:Mikro,Kecil,Menengah',
                ],

                'status_usaha' => [
                    'nullable',
                    'in:Aktif,Tidak Aktif',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],

            ],
            [

                'nama_pelaku_usaha.required' =>
                    'Nama pelaku usaha wajib diisi.',

                'nama_pelaku_usaha.max' =>
                    'Nama pelaku usaha maksimal 255 karakter.',

                'nik.max' =>
                    'NIK maksimal 20 karakter.',

                'no_kk.max' =>
                    'Nomor KK maksimal 20 karakter.',

                'no_telepon.max' =>
                    'Nomor telepon maksimal 20 karakter.',

                'nama_usaha.required' =>
                    'Nama usaha wajib diisi.',

                'nama_usaha.max' =>
                    'Nama usaha maksimal 255 karakter.',

                'skala_usaha.in' =>
                    'Skala usaha tidak valid.',

                'status_usaha.in' =>
                    'Status usaha tidak valid.',

                'modal_usaha.numeric' =>
                    'Modal usaha harus berupa angka.',

                'omzet_bulanan.numeric' =>
                    'Omzet bulanan harus berupa angka.',

                'jumlah_tenaga_kerja.integer' =>
                    'Jumlah tenaga kerja harus berupa angka bulat.',

                'jumlah_tenaga_kerja.min' =>
                    'Jumlah tenaga kerja tidak boleh kurang dari 0.',

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
            $dataumkm->id;


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataumkm->update(
            [

                'nama_pelaku_usaha' =>
                    $validated['nama_pelaku_usaha'],

                'nik' =>
                    $validated['nik'] ?? null,

                'no_kk' =>
                    $validated['no_kk'] ?? null,

                'no_telepon' =>
                    $validated['no_telepon'] ?? null,

                'nama_usaha' =>
                    $validated['nama_usaha'],

                'jenis_usaha' =>
                    $validated['jenis_usaha'] ?? null,

                'alamat_usaha' =>
                    $validated['alamat_usaha'] ?? null,

                'kelurahan' =>
                    $validated['kelurahan'] ?? null,

                'kecamatan' =>
                    $validated['kecamatan'] ?? null,

                'kabupaten_kota' =>
                    $validated['kabupaten_kota'] ?? null,

                'nib' =>
                    $validated['nib'] ?? null,

                'npwp' =>
                    $validated['npwp'] ?? null,

                'izin_usaha' =>
                    $validated['izin_usaha'] ?? null,

                'produk_utama' =>
                    $validated['produk_utama'] ?? null,

                'modal_usaha' =>
                    $validated['modal_usaha'] ?? null,

                'omzet_bulanan' =>
                    $validated['omzet_bulanan'] ?? null,

                'jumlah_tenaga_kerja' =>
                    $validated['jumlah_tenaga_kerja'] ?? null,

                'skala_usaha' =>
                    $validated['skala_usaha'] ?? null,

                'status_usaha' =>
                    $validated['status_usaha'] ?? null,

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

        $dataumkm->refresh();


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
                    $dataumkm->id,

                'jenis_usaha' =>
                    $dataumkm->jenis_usaha,

                'nama_usaha' =>
                    $dataumkm->nama_usaha,

                'nama_pelaku_usaha' =>
                    $dataumkm->nama_pelaku_usaha,

                'alamat_usaha' =>
                    $dataumkm->alamat_usaha,

                'no_telepon' =>
                    $dataumkm->no_telepon,

                'diperbarui' =>
                    $dataumkm->updated_at
                        ? $dataumkm->updated_at->format(
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

            $dataumkm->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'dataumkm.index'
                )
                ->with(
                    'success',
                    'Data UMKM berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $dataumkm->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'dataumkm.index'
            )
            ->with(
                'warning',
                'Data UMKM berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data UMKM.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataUmkm $dataumkm
    ) {
        $dataumkm->delete();


        return redirect()
            ->route(
                'dataumkm.index'
            )
            ->with(
                'success',
                'Data UMKM berhasil dihapus dari database.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk UMKM.'
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
                'Gagal melakukan JSON encode untuk Google Sheets UMKM.',
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
            'Google Sheets UMKM - Initial Response',
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
                'cURL Google Sheets UMKM gagal.',
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
                'cURL Google Sheets UMKM mengalami error.',
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
                'Google Sheets UMKM - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets UMKM.',
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
            'Google Sheets UMKM HTTP error.',
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
