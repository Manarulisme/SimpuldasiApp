<?php

namespace App\Http\Controllers;

use App\Models\DataLaporanPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataLaporanPendudukController extends Controller
{
    /**
     * Nama sheet Google Spreadsheet
     */
    private const GOOGLE_SHEET_NAME = 'Kependudukan';


    /**
     * Menampilkan seluruh data laporan penduduk.
     */
    public function index()
    {
        $dataLaporanPenduduk = DataLaporanPenduduk::orderBy(
            'updated_at',
            'desc'
        )->get();

        return view(
            'Admin.Konten.Data_laporan_penduduk.index',
            compact('dataLaporanPenduduk')
        );
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        $dataLaporanPenduduk = null;

        $isEdit = false;

        return view(
            'Admin.Konten.Data_laporan_penduduk.tambah',
            compact(
                'dataLaporanPenduduk',
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

                'bulan' => [
                    'required',
                    'string',
                    'in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
                ],

                'tahun' => [
                    'required',
                    'integer',
                    'min:2000',
                    'max:2100',
                ],

                'jumlah_kk' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_laki_laki' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_perempuan' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_kematian' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_kelahiran' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_pindah_datang' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_pindah_keluar' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'penduduk_sementara' => [
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

                'bulan.required' =>
                    'Bulan wajib dipilih.',

                'bulan.in' =>
                    'Bulan yang dipilih tidak valid.',

                'tahun.required' =>
                    'Tahun wajib diisi.',

                'tahun.integer' =>
                    'Tahun harus berupa angka.',

                'tahun.min' =>
                    'Tahun minimal 2000.',

                'tahun.max' =>
                    'Tahun maksimal 2100.',

                'jumlah_kk.required' =>
                    'Jumlah KK wajib diisi.',

                'jumlah_kk.integer' =>
                    'Jumlah KK harus berupa angka.',

                'jumlah_kk.min' =>
                    'Jumlah KK tidak boleh kurang dari 0.',

                'jumlah_laki_laki.required' =>
                    'Jumlah laki-laki wajib diisi.',

                'jumlah_laki_laki.integer' =>
                    'Jumlah laki-laki harus berupa angka.',

                'jumlah_laki_laki.min' =>
                    'Jumlah laki-laki tidak boleh kurang dari 0.',

                'jumlah_perempuan.required' =>
                    'Jumlah perempuan wajib diisi.',

                'jumlah_perempuan.integer' =>
                    'Jumlah perempuan harus berupa angka.',

                'jumlah_perempuan.min' =>
                    'Jumlah perempuan tidak boleh kurang dari 0.',

                'jumlah_kematian.required' =>
                    'Jumlah kematian wajib diisi.',

                'jumlah_kematian.integer' =>
                    'Jumlah kematian harus berupa angka.',

                'jumlah_kematian.min' =>
                    'Jumlah kematian tidak boleh kurang dari 0.',

                'jumlah_kelahiran.required' =>
                    'Jumlah kelahiran wajib diisi.',

                'jumlah_kelahiran.integer' =>
                    'Jumlah kelahiran harus berupa angka.',

                'jumlah_kelahiran.min' =>
                    'Jumlah kelahiran tidak boleh kurang dari 0.',

                'jumlah_pindah_datang.required' =>
                    'Jumlah pindah datang wajib diisi.',

                'jumlah_pindah_datang.integer' =>
                    'Jumlah pindah datang harus berupa angka.',

                'jumlah_pindah_datang.min' =>
                    'Jumlah pindah datang tidak boleh kurang dari 0.',

                'jumlah_pindah_keluar.required' =>
                    'Jumlah pindah keluar wajib diisi.',

                'jumlah_pindah_keluar.integer' =>
                    'Jumlah pindah keluar harus berupa angka.',

                'jumlah_pindah_keluar.min' =>
                    'Jumlah pindah keluar tidak boleh kurang dari 0.',

                'penduduk_sementara.required' =>
                    'Jumlah penduduk sementara wajib diisi.',

                'penduduk_sementara.integer' =>
                    'Jumlah penduduk sementara harus berupa angka.',

                'penduduk_sementara.min' =>
                    'Jumlah penduduk sementara tidak boleh kurang dari 0.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE
        |--------------------------------------------------------------------------
        */

        $dataLaporanPenduduk = DataLaporanPenduduk::create(
            [

                'bulan' =>
                    $validated['bulan'],

                'tahun' =>
                    $validated['tahun'],

                'jumlah_kk' =>
                    $validated['jumlah_kk'],

                'jumlah_laki_laki' =>
                    $validated['jumlah_laki_laki'],

                'jumlah_perempuan' =>
                    $validated['jumlah_perempuan'],

                'jumlah_kematian' =>
                    $validated['jumlah_kematian'],

                'jumlah_kelahiran' =>
                    $validated['jumlah_kelahiran'],

                'jumlah_pindah_datang' =>
                    $validated['jumlah_pindah_datang'],

                'jumlah_pindah_keluar' =>
                    $validated['jumlah_pindah_keluar'],

                'penduduk_sementara' =>
                    $validated['penduduk_sementara'],

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

        $dataLaporanPenduduk->refresh();


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
                    $dataLaporanPenduduk->id,

                'bulan' =>
                    $dataLaporanPenduduk->bulan,

                'tahun' =>
                    $dataLaporanPenduduk->tahun,

                'jumlah_kk' =>
                    $dataLaporanPenduduk->jumlah_kk,

                'jumlah_laki_laki' =>
                    $dataLaporanPenduduk->jumlah_laki_laki,

                'jumlah_perempuan' =>
                    $dataLaporanPenduduk->jumlah_perempuan,

                'jumlah_kematian' =>
                    $dataLaporanPenduduk->jumlah_kematian,

                'jumlah_kelahiran' =>
                    $dataLaporanPenduduk->jumlah_kelahiran,

                'jumlah_pindah_datang' =>
                    $dataLaporanPenduduk->jumlah_pindah_datang,

                'jumlah_pindah_keluar' =>
                    $dataLaporanPenduduk->jumlah_pindah_keluar,

                'penduduk_sementara' =>
                    $dataLaporanPenduduk->penduduk_sementara,

                'keterangan' =>
                    $dataLaporanPenduduk->keterangan,

                'diperbarui' =>
                    $dataLaporanPenduduk->updated_at
                        ? $dataLaporanPenduduk->updated_at->format(
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

            $dataLaporanPenduduk->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datalaporanpenduduk.index'
                )
                ->with(
                    'success',
                    'Data laporan penduduk berhasil ditambahkan dan disinkronkan ke Google Sheets.'
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

        $dataLaporanPenduduk->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datalaporanpenduduk.index'
            )
            ->with(
                'warning',
                'Data laporan penduduk berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data laporan penduduk.
     */
    public function show(
        DataLaporanPenduduk $datalaporanpenduduk
    ) {
        $dataLaporanPenduduk = $datalaporanpenduduk;

        return view(
            'Admin.Konten.Data_laporan_penduduk.show',
            compact('dataLaporanPenduduk')
        );
    }


    /**
     * Form edit data.
     */
    public function edit(
        DataLaporanPenduduk $datalaporanpenduduk
    ) {
        $dataLaporanPenduduk = $datalaporanpenduduk;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_laporan_penduduk.tambah',
            compact(
                'dataLaporanPenduduk',
                'isEdit'
            )
        );
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        DataLaporanPenduduk $datalaporanpenduduk
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [

                'bulan' => [
                    'required',
                    'string',
                    'in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
                ],

                'tahun' => [
                    'required',
                    'integer',
                    'min:2000',
                    'max:2100',
                ],

                'jumlah_kk' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_laki_laki' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_perempuan' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_kematian' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_kelahiran' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_pindah_datang' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'jumlah_pindah_keluar' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'penduduk_sementara' => [
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

                'bulan.required' =>
                    'Bulan wajib dipilih.',

                'bulan.in' =>
                    'Bulan yang dipilih tidak valid.',

                'tahun.required' =>
                    'Tahun wajib diisi.',

                'tahun.integer' =>
                    'Tahun harus berupa angka.',

                'tahun.min' =>
                    'Tahun minimal 2000.',

                'tahun.max' =>
                    'Tahun maksimal 2100.',

                'jumlah_kk.required' =>
                    'Jumlah KK wajib diisi.',

                'jumlah_kk.integer' =>
                    'Jumlah KK harus berupa angka.',

                'jumlah_kk.min' =>
                    'Jumlah KK tidak boleh kurang dari 0.',

                'jumlah_laki_laki.required' =>
                    'Jumlah laki-laki wajib diisi.',

                'jumlah_laki_laki.integer' =>
                    'Jumlah laki-laki harus berupa angka.',

                'jumlah_laki_laki.min' =>
                    'Jumlah laki-laki tidak boleh kurang dari 0.',

                'jumlah_perempuan.required' =>
                    'Jumlah perempuan wajib diisi.',

                'jumlah_perempuan.integer' =>
                    'Jumlah perempuan harus berupa angka.',

                'jumlah_perempuan.min' =>
                    'Jumlah perempuan tidak boleh kurang dari 0.',

                'jumlah_kematian.required' =>
                    'Jumlah kematian wajib diisi.',

                'jumlah_kematian.integer' =>
                    'Jumlah kematian harus berupa angka.',

                'jumlah_kematian.min' =>
                    'Jumlah kematian tidak boleh kurang dari 0.',

                'jumlah_kelahiran.required' =>
                    'Jumlah kelahiran wajib diisi.',

                'jumlah_kelahiran.integer' =>
                    'Jumlah kelahiran harus berupa angka.',

                'jumlah_kelahiran.min' =>
                    'Jumlah kelahiran tidak boleh kurang dari 0.',

                'jumlah_pindah_datang.required' =>
                    'Jumlah pindah datang wajib diisi.',

                'jumlah_pindah_datang.integer' =>
                    'Jumlah pindah datang harus berupa angka.',

                'jumlah_pindah_datang.min' =>
                    'Jumlah pindah datang tidak boleh kurang dari 0.',

                'jumlah_pindah_keluar.required' =>
                    'Jumlah pindah keluar wajib diisi.',

                'jumlah_pindah_keluar.integer' =>
                    'Jumlah pindah keluar harus berupa angka.',

                'jumlah_pindah_keluar.min' =>
                    'Jumlah pindah keluar tidak boleh kurang dari 0.',

                'penduduk_sementara.required' =>
                    'Jumlah penduduk sementara wajib diisi.',

                'penduduk_sementara.integer' =>
                    'Jumlah penduduk sementara harus berupa angka.',

                'penduduk_sementara.min' =>
                    'Jumlah penduduk sementara tidak boleh kurang dari 0.',

            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN ID LAMA
        |--------------------------------------------------------------------------
        |
        | ID database digunakan sebagai identifier
        | baris Google Sheets.
        |
        | Jika ID berubah karena perubahan primary key,
        | Apps Script dapat menggunakan old_id.
        |
        */

        $oldId = $datalaporanpenduduk->id;


        /*
        |--------------------------------------------------------------------------
        | 2. UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $datalaporanpenduduk->update(
            [

                'bulan' =>
                    $validated['bulan'],

                'tahun' =>
                    $validated['tahun'],

                'jumlah_kk' =>
                    $validated['jumlah_kk'],

                'jumlah_laki_laki' =>
                    $validated['jumlah_laki_laki'],

                'jumlah_perempuan' =>
                    $validated['jumlah_perempuan'],

                'jumlah_kematian' =>
                    $validated['jumlah_kematian'],

                'jumlah_kelahiran' =>
                    $validated['jumlah_kelahiran'],

                'jumlah_pindah_datang' =>
                    $validated['jumlah_pindah_datang'],

                'jumlah_pindah_keluar' =>
                    $validated['jumlah_pindah_keluar'],

                'penduduk_sementara' =>
                    $validated['penduduk_sementara'],

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
        | 3. REFRESH DATA
        |--------------------------------------------------------------------------
        */

        $datalaporanpenduduk->refresh();


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
                | ID yang ditulis kembali ke Sheet.
                */
                'id' =>
                    $datalaporanpenduduk->id,

                'bulan' =>
                    $datalaporanpenduduk->bulan,

                'tahun' =>
                    $datalaporanpenduduk->tahun,

                'jumlah_kk' =>
                    $datalaporanpenduduk->jumlah_kk,

                'jumlah_laki_laki' =>
                    $datalaporanpenduduk->jumlah_laki_laki,

                'jumlah_perempuan' =>
                    $datalaporanpenduduk->jumlah_perempuan,

                'jumlah_kematian' =>
                    $datalaporanpenduduk->jumlah_kematian,

                'jumlah_kelahiran' =>
                    $datalaporanpenduduk->jumlah_kelahiran,

                'jumlah_pindah_datang' =>
                    $datalaporanpenduduk->jumlah_pindah_datang,

                'jumlah_pindah_keluar' =>
                    $datalaporanpenduduk->jumlah_pindah_keluar,

                'penduduk_sementara' =>
                    $datalaporanpenduduk->penduduk_sementara,

                'keterangan' =>
                    $datalaporanpenduduk->keterangan,

                'diperbarui' =>
                    $datalaporanpenduduk->updated_at
                        ? $datalaporanpenduduk->updated_at->format(
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

            $datalaporanpenduduk->update(
                [

                    'google_sync_status' =>
                        'synced',

                    'google_synced_at' =>
                        now(),

                ]
            );


            return redirect()
                ->route(
                    'datalaporanpenduduk.index'
                )
                ->with(
                    'success',
                    'Data laporan penduduk berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE SHEETS GAGAL
        |--------------------------------------------------------------------------
        */

        $datalaporanpenduduk->update(
            [

                'google_sync_status' =>
                    'failed',

                'google_synced_at' =>
                    null,

            ]
        );


        return redirect()
            ->route(
                'datalaporanpenduduk.index'
            )
            ->with(
                'warning',
                'Data laporan penduduk berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menghapus data.
     *
     * Delete hanya dilakukan pada database Laravel.
     * Data Google Sheets tetap dipertahankan sebagai arsip.
     */
    public function destroy(
        DataLaporanPenduduk $datalaporanpenduduk
    ) {
        $datalaporanpenduduk->delete();


        return redirect()
            ->route(
                'datalaporanpenduduk.index'
            )
            ->with(
                'success',
                'Data laporan penduduk berhasil dihapus dari database.'
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
                'GOOGLE_SHEETS_SCRIPT_URL tidak ditemukan di file .env untuk Kependudukan.'
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
                'Gagal melakukan JSON encode untuk Google Sheets Kependudukan.',
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
            'Google Sheets Kependudukan - Initial Response',
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
                'cURL Google Sheets Kependudukan gagal.',
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
                'cURL Google Sheets Kependudukan mengalami error.',
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
                'Google Sheets Kependudukan - Redirect Response',
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
                    'Gagal mengambil response redirect Google Sheets Kependudukan.',
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
            'Google Sheets Kependudukan HTTP error.',
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
