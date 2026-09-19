<?php

namespace App\Http\Controllers;

use App\Models\DataBmd;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class DataBmdController extends Controller
{
    /**
     * Menampilkan seluruh data BMD
     */
    public function index()
    {
        $dataBmd = DataBmd::orderBy('updated_at', 'desc')->get();

        return view(
            'Admin.Konten.Data_bmd.index',
            compact('dataBmd')
        );
    }


    /**
     * Form tambah data
     */
    public function create()
    {
        $bmd = null;
        $isEdit = false;

        return view(
            'Admin.Konten.Data_bmd.tambah',
            compact('bmd', 'isEdit')
        );
    }


    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_data' => 'required|string|max:50|unique:data_bmd,id_data',
            'nama_barang' => 'required|string|max:150',
            'type' => 'nullable|string|max:100',
            'tahun_perolehan' => 'nullable|integer|min:1900|max:2100',
            'sumber_dana' => 'nullable|string|max:100',
            'kondisi' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
        ]);


        $bmd = DataBmd::create([
            'id_data' => $validated['id_data'],
            'nama_barang' => $validated['nama_barang'],
            'type' => $validated['type'] ?? null,
            'tahun_perolehan' => $validated['tahun_perolehan'] ?? null,
            'sumber_dana' => $validated['sumber_dana'] ?? null,
            'kondisi' => $validated['kondisi'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'google_sync_status' => 'pending',
        ]);


        /*
         * Sinkronisasi data baru ke Google Sheets
         */
        $sync = $this->sendToGoogleSheets([
            'module' => 'BMD',
            'action' => 'create',
            'id_data' => $bmd->id_data,
            'nama_barang' => $bmd->nama_barang,
            'type' => $bmd->type,
            'tahun_perolehan' => $bmd->tahun_perolehan,
            'sumber_dana' => $bmd->sumber_dana,
            'kondisi' => $bmd->kondisi,
            'keterangan' => $bmd->keterangan,
            'updated_at' => $bmd->updated_at
                ? $bmd->updated_at->format('d/m/Y H:i:s')
                : now()->format('d/m/Y H:i:s'),
        ]);


        if ($sync) {

            $bmd->update([
                'google_sync_status' => 'synced',
                'google_synced_at' => now(),
            ]);


            return redirect()
                ->route('databmd.index')
                ->with(
                    'success',
                    'Data BMD berhasil ditambahkan dan disinkronkan ke Google Sheets.'
                );
        }


        $bmd->update([
            'google_sync_status' => 'failed',
        ]);


        return redirect()
            ->route('databmd.index')
            ->with(
                'warning',
                'Data BMD berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data BMD
     */
    public function show(DataBmd $databmd)
    {
        return view(
            'Admin.Konten.Data_bmd.show',
            compact('databmd')
        );
    }


    /**
     * Form edit data
     */
    public function edit(DataBmd $databmd)
    {
        $bmd = $databmd;
        $isEdit = true;

        return view(
            'Admin.Konten.Data_bmd.tambah',
            compact('bmd', 'isEdit')
        );
    }


    /**
     * Update data
     */
    public function update(Request $request, DataBmd $databmd)
    {
        $validated = $request->validate([
            'id_data' => [
                'required',
                'string',
                'max:50',
                Rule::unique('data_bmd', 'id_data')
                    ->ignore($databmd->id),
            ],

            'nama_barang' => 'required|string|max:150',

            'type' => 'nullable|string|max:100',

            'tahun_perolehan' =>
                'nullable|integer|min:1900|max:2100',

            'sumber_dana' =>
                'nullable|string|max:100',

            'kondisi' =>
                'nullable|string|max:50',

            'keterangan' =>
                'nullable|string',
        ]);


        $databmd->update([
            'id_data' => $validated['id_data'],
            'nama_barang' => $validated['nama_barang'],
            'type' => $validated['type'] ?? null,
            'tahun_perolehan' => $validated['tahun_perolehan'] ?? null,
            'sumber_dana' => $validated['sumber_dana'] ?? null,
            'kondisi' => $validated['kondisi'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'google_sync_status' => 'pending',
        ]);


        /*
         * Sinkronisasi perubahan ke Google Sheets
         */
        $sync = $this->sendToGoogleSheets([
            'module' => 'BMD',
            'action' => 'update',
            'id_data' => $databmd->id_data,
            'nama_barang' => $databmd->nama_barang,
            'type' => $databmd->type,
            'tahun_perolehan' => $databmd->tahun_perolehan,
            'sumber_dana' => $databmd->sumber_dana,
            'kondisi' => $databmd->kondisi,
            'keterangan' => $databmd->keterangan,
            'updated_at' => $databmd->updated_at
                ? $databmd->updated_at->format('d/m/Y H:i:s')
                : now()->format('d/m/Y H:i:s'),
        ]);


        if ($sync) {

            $databmd->update([
                'google_sync_status' => 'synced',
                'google_synced_at' => now(),
            ]);


            return redirect()
                ->route('databmd.index')
                ->with(
                    'success',
                    'Data BMD berhasil diperbarui dan disinkronkan ke Google Sheets.'
                );
        }


        $databmd->update([
            'google_sync_status' => 'failed',
        ]);


        return redirect()
            ->route('databmd.index')
            ->with(
                'warning',
                'Data BMD berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Hapus data BMD
     *
     * Penghapusan hanya dilakukan pada database Laravel.
     * Tidak ada sinkronisasi delete ke Google Sheets.
     */
    public function destroy(DataBmd $databmd)
    {
        $databmd->delete();


        return redirect()
            ->route('databmd.index')
            ->with(
                'success',
                'Data BMD berhasil dihapus.'
            );
    }


    /**
     * Kirim data ke Google Sheets
     *
     * Digunakan untuk CREATE dan UPDATE.
     */
    private function sendToGoogleSheets(array $data): bool
    {
        $url = env('GOOGLE_SHEETS_WEBHOOK_URL');


        if (!$url) {

            Log::error(
                'GOOGLE_SHEETS_WEBHOOK_URL tidak ditemukan di .env'
            );

            return false;
        }


        $jsonData = json_encode(
            $data,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );


        if ($jsonData === false) {

            Log::error(
                'Gagal encode JSON Google Sheets BMD',
                [
                    'data' => $data,
                    'json_error' => json_last_error_msg(),
                ]
            );

            return false;
        }


        $ch = curl_init($url);


        curl_setopt_array($ch, [

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => $jsonData,

            CURLOPT_HTTPHEADER => [

                'Content-Type: application/json',

                'Accept: application/json',

                'Content-Length: ' . strlen($jsonData),

            ],

            CURLOPT_CONNECTTIMEOUT => 10,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_FOLLOWLOCATION => false,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_HEADER => true,

        ]);


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
            'Response Google Sheets BMD - Initial',
            [
                'http_code' => $httpCode,

                'curl_errno' => $curlErrno,

                'curl_error' => $curlError,

                'redirect_url' => $redirectUrl,

                'response_headers' => $responseHeaders,

                'response_body' => $responseBody,

                'data' => $data,
            ]
        );


        if ($rawResponse === false) {

            return false;
        }


        if ($curlErrno !== 0) {

            return false;
        }


        /*
         * Google Apps Script biasanya memberikan HTTP 302
         * menuju script.googleusercontent.com.
         *
         * URL redirect dibuka menggunakan GET.
         */
        if (
            (
                $httpCode === 301
                || $httpCode === 302
                || $httpCode === 303
            )
            && $redirectUrl
        ) {

            $redirectUrl = trim($redirectUrl);


            $ch = curl_init(
                $redirectUrl
            );


            curl_setopt_array($ch, [

                CURLOPT_RETURNTRANSFER => true,

                CURLOPT_HTTPGET => true,

                CURLOPT_HTTPHEADER => [

                    'Accept: application/json',

                ],

                CURLOPT_CONNECTTIMEOUT => 10,

                CURLOPT_TIMEOUT => 30,

                CURLOPT_FOLLOWLOCATION => false,

                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            ]);


            $finalResponse = curl_exec($ch);


            $finalHttpCode = curl_getinfo(
                $ch,
                CURLINFO_HTTP_CODE
            );


            $finalCurlErrno = curl_errno($ch);

            $finalCurlError = curl_error($ch);


            curl_close($ch);


            Log::info(
                'Response Google Sheets BMD - Redirect',
                [
                    'http_code' => $finalHttpCode,

                    'curl_errno' => $finalCurlErrno,

                    'curl_error' => $finalCurlError,

                    'response' => $finalResponse,

                    'data' => $data,
                ]
            );


            if (
                $finalResponse === false
                || $finalCurlErrno !== 0
            ) {

                return false;
            }


            $decoded = json_decode(
                $finalResponse,
                true
            );


            if (
                is_array($decoded)
                && isset($decoded['success'])
            ) {

                return (bool) $decoded['success'];
            }


            if (
                $finalHttpCode >= 200
                && $finalHttpCode < 300
            ) {

                return true;
            }


            return false;
        }


        /*
         * Jika Google tidak memberikan redirect
         * tetapi langsung memberikan JSON response.
         */
        $decoded = json_decode(
            $responseBody,
            true
        );


        if (
            is_array($decoded)
            && isset($decoded['success'])
        ) {

            return (bool) $decoded['success'];
        }


        if (
            $httpCode >= 200
            && $httpCode < 300
        ) {

            return true;
        }


        return false;
    }
}
