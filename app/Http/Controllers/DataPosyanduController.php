<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DataPosyanduController extends Controller
{
    /**
     * Menampilkan semua data Posyandu & Posbindu
     */
    public function index()
    {
        $dataPosyandu = DataPosyandu::latest()->get();

        return view(
            'Admin.Konten.Data_posyandu.index',
            compact('dataPosyandu')
        );
    }


    /**
     * Form tambah
     */
    public function create()
    {
        $isEdit = false;

        return view(
            'Admin.Konten.Data_posyandu.tambah',
            compact('isEdit')
        );
    }


    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_data' => [
                'required',
                'string',
                'max:50',
                'unique:data_posyandu,id_data',
            ],

            'jenis' => [
                'required',
                'in:Posyandu,Posbindu',
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

            'jumlah_kader' => [
                'required',
                'integer',
                'min:0',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ], [
            'id_data.required' => 'ID Data wajib diisi.',
            'id_data.unique' => 'ID Data sudah digunakan.',
            'jenis.required' => 'Jenis wajib dipilih.',
            'jenis.in' => 'Jenis Posyandu tidak valid.',
            'nama.required' => 'Nama Posyandu / Posbindu wajib diisi.',
            'jumlah_kader.required' => 'Jumlah kader wajib diisi.',
            'jumlah_kader.integer' => 'Jumlah kader harus berupa angka.',
            'jumlah_kader.min' => 'Jumlah kader tidak boleh kurang dari 0.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 1. SIMPAN KE DATABASE LARAVEL
        |--------------------------------------------------------------------------
        */

        $posyandu = DataPosyandu::create([
            'id_data' => $validated['id_data'],
            'jenis' => $validated['jenis'],
            'nama' => $validated['nama'],
            'rw' => $validated['rw'] ?? null,
            'jumlah_kader' => $validated['jumlah_kader'],
            'keterangan' => $validated['keterangan'] ?? null,

            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. KIRIM KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $berhasilSync = $this->sendToGoogleSheets([
            'action' => 'create',

            'id' => $posyandu->id,

            'id_data' => $posyandu->id_data,

            'jenis' => $posyandu->jenis,

            'nama' => $posyandu->nama,

            'rw' => $posyandu->rw,

            'jumlah_kader' => $posyandu->jumlah_kader,

            'keterangan' => $posyandu->keterangan,

            'updated_at' => $posyandu->updated_at
                ? $posyandu->updated_at->format('Y-m-d H:i:s')
                : now()->format('Y-m-d H:i:s'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | 3. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($berhasilSync) {

            $posyandu->update([
                'google_sync_status' => 'synced',
                'google_synced_at' => now(),
            ]);

        } else {

            $posyandu->update([
                'google_sync_status' => 'failed',
                'google_synced_at' => null,
            ]);
        }


        return redirect()
            ->route('dataposyandu.index')
            ->with(
                'success',
                $berhasilSync
                    ? 'Data Posyandu berhasil disimpan dan disinkronkan ke Google Sheets.'
                    : 'Data Posyandu berhasil disimpan, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Menampilkan detail data
     */
    public function show(DataPosyandu $dataposyandu)
    {
        return view(
            'Admin.Konten.Data_posyandu.show',
            compact('dataposyandu')
        );
    }


    /**
     * Form edit
     */
    public function edit(DataPosyandu $dataposyandu)
    {
        $posyandu = $dataposyandu;

        $isEdit = true;

        return view(
            'Admin.Konten.Data_posyandu.tambah',
            compact(
                'posyandu',
                'isEdit'
            )
        );
    }


    /**
     * Update data
     */
    public function update(
        Request $request,
        DataPosyandu $dataposyandu
    ) {
        $validated = $request->validate([
            'id_data' => [
                'required',
                'string',
                'max:50',

                Rule::unique(
                    'data_posyandu',
                    'id_data'
                )->ignore($dataposyandu->id),
            ],

            'jenis' => [
                'required',
                'in:Posyandu,Posbindu',
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

            'jumlah_kader' => [
                'required',
                'integer',
                'min:0',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ], [
            'id_data.required' => 'ID Data wajib diisi.',
            'id_data.unique' => 'ID Data sudah digunakan oleh data lain.',
            'jenis.required' => 'Jenis wajib dipilih.',
            'jenis.in' => 'Jenis Posyandu tidak valid.',
            'nama.required' => 'Nama Posyandu / Posbindu wajib diisi.',
            'jumlah_kader.required' => 'Jumlah kader wajib diisi.',
            'jumlah_kader.integer' => 'Jumlah kader harus berupa angka.',
            'jumlah_kader.min' => 'Jumlah kader tidak boleh kurang dari 0.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE DATABASE LARAVEL
        |--------------------------------------------------------------------------
        */

        $dataposyandu->update([
            'id_data' => $validated['id_data'],
            'jenis' => $validated['jenis'],
            'nama' => $validated['nama'],
            'rw' => $validated['rw'] ?? null,
            'jumlah_kader' => $validated['jumlah_kader'],
            'keterangan' => $validated['keterangan'] ?? null,

            'google_sync_status' => 'pending',
            'google_synced_at' => null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. REFRESH DATA
        |--------------------------------------------------------------------------
        |
        | Memastikan updated_at yang dikirim adalah
        | updated_at terbaru dari database.
        |
        */

        $dataposyandu->refresh();


        /*
        |--------------------------------------------------------------------------
        | 3. KIRIM PERUBAHAN KE GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $berhasilSync = $this->sendToGoogleSheets([
            'action' => 'update',

            'id' => $dataposyandu->id,

            'id_data' => $dataposyandu->id_data,

            'jenis' => $dataposyandu->jenis,

            'nama' => $dataposyandu->nama,

            'rw' => $dataposyandu->rw,

            'jumlah_kader' => $dataposyandu->jumlah_kader,

            'keterangan' => $dataposyandu->keterangan,

            'updated_at' => $dataposyandu->updated_at
                ? $dataposyandu->updated_at->format('Y-m-d H:i:s')
                : now()->format('Y-m-d H:i:s'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | 4. UPDATE STATUS SINKRONISASI
        |--------------------------------------------------------------------------
        */

        if ($berhasilSync) {

            $dataposyandu->update([
                'google_sync_status' => 'synced',
                'google_synced_at' => now(),
            ]);

        } else {

            $dataposyandu->update([
                'google_sync_status' => 'failed',
                'google_synced_at' => null,
            ]);
        }


        return redirect()
            ->route('dataposyandu.index')
            ->with(
                'success',
                $berhasilSync
                    ? 'Data Posyandu berhasil diperbarui dan disinkronkan ke Google Sheets.'
                    : 'Data Posyandu berhasil diperbarui, tetapi gagal disinkronkan ke Google Sheets.'
            );
    }


    /**
     * Hapus data
     */
    public function destroy(
        DataPosyandu $dataposyandu
    ) {
        $id = $dataposyandu->id;


        /*
        |--------------------------------------------------------------------------
        | 1. HAPUS DARI GOOGLE SHEETS
        |--------------------------------------------------------------------------
        */

        $berhasilSync = $this->sendToGoogleSheets([
            'action' => 'delete',

            'id' => $id,

            'id_data' => $dataposyandu->id_data,
        ]);


        /*
        |--------------------------------------------------------------------------
        | 2. JIKA GOOGLE BERHASIL, HAPUS DATABASE
        |--------------------------------------------------------------------------
        */

        if ($berhasilSync) {

            $dataposyandu->delete();

            return redirect()
                ->route('dataposyandu.index')
                ->with(
                    'success',
                    'Data Posyandu berhasil dihapus.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | 3. JIKA GOOGLE GAGAL
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('dataposyandu.index')
            ->with(
                'error',
                'Data gagal dihapus karena sinkronisasi dengan Google Sheets gagal.'
            );
    }


    /**
     * Komunikasi dengan Google Apps Script
     */
    private function sendToGoogleSheets(array $data): bool
    {
        $url = env('GOOGLE_SHEETS_WEBHOOK_URL');

        if (!$url) {

            Log::error(
                'GOOGLE_SHEETS_WEBHOOK_URL belum dikonfigurasi.'
            );

            return false;
        }


        try {

            $payload = json_encode(
                array_merge(
                    [
                        'module' => 'POSYANDU',
                    ],
                    $data
                ),
                JSON_UNESCAPED_UNICODE |
                JSON_UNESCAPED_SLASHES
            );


            $ch = curl_init($url);


            curl_setopt_array($ch, [

                CURLOPT_RETURNTRANSFER => true,

                CURLOPT_POST => true,

                CURLOPT_POSTFIELDS => $payload,

                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Accept: application/json',
                ],

                CURLOPT_CONNECTTIMEOUT => 10,

                CURLOPT_TIMEOUT => 25,

                /*
                |--------------------------------------------------------------------------
                | Jangan mengikuti redirect Google Apps Script
                |--------------------------------------------------------------------------
                */

                CURLOPT_FOLLOWLOCATION => false,

                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            ]);


            $response = curl_exec($ch);

            $curlError = curl_error($ch);

            $curlErrno = curl_errno($ch);

            $httpCode = curl_getinfo(
                $ch,
                CURLINFO_HTTP_CODE
            );

            $redirectUrl = curl_getinfo(
                $ch,
                CURLINFO_REDIRECT_URL
            );


            curl_close($ch);


            Log::info(
                'Response Google Sheets Posyandu',
                [
                    'http_code' => $httpCode,
                    'curl_errno' => $curlErrno,
                    'curl_error' => $curlError,
                    'redirect_url' => $redirectUrl,
                    'response' => $response,
                    'data' => $data,
                ]
            );


            /*
            |--------------------------------------------------------------------------
            | CEK CURL ERROR
            |--------------------------------------------------------------------------
            */

            if ($response === false) {

                Log::error(
                    'cURL Google Sheets Posyandu gagal',
                    [
                        'curl_errno' => $curlErrno,
                        'curl_error' => $curlError,
                        'data' => $data,
                    ]
                );

                return false;
            }


            /*
            |--------------------------------------------------------------------------
            | RESPONSE JSON
            |--------------------------------------------------------------------------
            */

            $result = json_decode(
                $response,
                true
            );


            if (
                is_array($result) &&
                isset($result['success'])
            ) {

                if ($result['success'] === true) {

                    Log::info(
                        'Google Sheets Posyandu berhasil disinkronkan.',
                        [
                            'response' => $result,
                            'data' => $data,
                        ]
                    );

                    return true;
                }


                Log::error(
                    'Google Apps Script Posyandu mengembalikan success=false.',
                    [
                        'response' => $result,
                        'data' => $data,
                    ]
                );

                return false;
            }


            /*
            |--------------------------------------------------------------------------
            | HTTP 302
            |--------------------------------------------------------------------------
            |
            | Apps Script dapat mengembalikan redirect setelah
            | POST berhasil diproses.
            |
            */

            if (
                $httpCode === 302 ||
                $httpCode === 301
            ) {

                Log::info(
                    'Google Apps Script Posyandu mengembalikan redirect.',
                    [
                        'http_code' => $httpCode,
                        'redirect_url' => $redirectUrl,
                        'data' => $data,
                    ]
                );

                return true;
            }


            /*
            |--------------------------------------------------------------------------
            | HTTP ERROR
            |--------------------------------------------------------------------------
            */

            if (
                $httpCode < 200 ||
                $httpCode >= 300
            ) {

                Log::error(
                    'Google Sheets Posyandu HTTP error',
                    [
                        'http_code' => $httpCode,
                        'response' => $response,
                        'data' => $data,
                    ]
                );

                return false;
            }


            return true;


        } catch (\Throwable $e) {

            Log::error(
                'Gagal menghubungi Google Sheets Posyandu',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'data' => $data,
                ]
            );

            return false;
        }
    }
}
