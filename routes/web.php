<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataUmumKepegawaianController;
use App\Http\Controllers\DataBmdController;
use App\Http\Controllers\DataPosyanduController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataStuntingController;
use App\Http\Controllers\DataKpmController;
use App\Http\Controllers\DataAnakPutusSekolahController;
use App\Http\Controllers\DataSekolahController;
use App\Http\Controllers\DataUmkmController;
use App\Http\Controllers\DataRutilahuController;
use App\Http\Controllers\DataBuruanSaeController;
use App\Http\Controllers\DataPohonController;
use App\Http\Controllers\DataFasilitasUmumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataLaporanPendudukController;
use App\Http\Controllers\DataLinmasController;
use App\Http\Controllers\DataRtRwController;
use App\Http\Controllers\DataPklController;
use App\Http\Controllers\LaporanController;









Route::get('/', function () {
    return view('index');
});

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Data Umum Pegawai
// Route::get('/dataumumpegawai', function () {
//     return view('Admin.Konten.Data_umum_pegawai.index');

Route::resource('dataumumpegawai', DataUmumKepegawaianController::class);


});


Route::resource(
'databmd',
DataBmdController::class
);

Route::resource(
'dataposyandu',
DataPosyanduController::class
);

Route::resource(
'datastunting',
DataStuntingController::class
);

Route::resource(
'datakpm',
DataKpmController::class
);

Route::resource(
'dataputussekolah',
DataAnakPutusSekolahController::class
);

Route::resource(
'datasekolah',
DataSekolahController::class
);

Route::resource(
'dataumkm',
DataUmkmController::class
);


Route::resource(
'datarutilahu',
DataRutilahuController::class
);

Route::resource(
'databuruansae',
DataBuruanSaeController::class);

Route::resource(
'datapohon',
DataPohonController::class);

Route::resource(
'datafasilitasumum',
DataFasilitasUmumController::class);

Route::resource('datalaporanpenduduk', DataLaporanPendudukController::class);

Route::resource('datalinmas', DataLinmasController::class);

Route::resource('datartrw', DataRtRwController::class);

Route::resource('datapkl', DataPklController::class);


Route::resource(
'pengaturan_user',
UserController::class
)->parameters([
'pengaturan_user' => 'user',
]);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

Route::post('/laporan/preview', [LaporanController::class, 'preview'])->name('laporan.preview');

Route::post('/laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');


Route::get('/php-info', function () {
    return [
        'php_version' => PHP_VERSION,
        'php_binary' => PHP_BINARY,
        'php_ini' => php_ini_loaded_file(),
        'php_ini_scanned' => php_ini_scanned_files(),

        'curl_version' => curl_version()['version'] ?? null,
        'curl_ssl' => curl_version()['ssl_version'] ?? null,

        'curl_cainfo' => ini_get('curl.cainfo'),
        'openssl_cafile' => ini_get('openssl.cafile'),

        'loaded_extensions' => get_loaded_extensions(),
    ];
});

Route::get('/test-google-ssl', function () {

    $url = 'https://script.google.com';

    try {
        $response = Http::timeout(30)->get($url);

        return [
            'success' => true,
            'status' => $response->status(),
            'body' => substr($response->body(), 0, 500),
            'curl_ssl' => curl_version()['ssl_version'] ?? null,
            'curl_version' => curl_version()['version'] ?? null,
        ];

    } catch (\Throwable $e) {

        return [
            'success' => false,
            'error' => $e->getMessage(),
            'curl_ssl' => curl_version()['ssl_version'] ?? null,
            'curl_version' => curl_version()['version'] ?? null,
        ];
    }
});
