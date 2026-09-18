<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataUmumKepegawaianController;
use App\Http\Controllers\DataBmdController;
use App\Http\Controllers\DataPosyanduController;

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

    Route::get('/dashboard', function () {
        return view('Admin.Konten.dashboard');
    })->name('dashboard');

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



// Route::get('/tambah-data-umum-kepegawaian', function () {
//     return view('Admin.Konten.Data_umum_pegawai.tambah');
// });

// });





// Route::get('/login', function () {
//     return view('Admin.Authentikasi.login');
// });

// Route::get('/dashboard', function () {
//     return view('Admin.Konten.dashboard');
// });



// Route::get('/edit-data-umum-kepegawaian', function () {
//     return view('Admin.Konten.Data_umum_pegawai.edit');
// });

// // Data BMD
// Route::get('/databmd', function () {
//     return view('Admin.Konten.Data_bmd.index');
// });

// Route::get('/tambah-data-bmd', function () {
//     return view('Admin.Konten.Data_bmd.tambah');
// });

// Route::get('/edit-data-bmd', function () {
//     return view('Admin.Konten.Data_bmd.edit');
// });


// // Data Posyandu
// Route::get('/dataposyandu', function () {
//     return view('Admin.Konten.Data_posyandu.index');
// });

// Route::get('/tambah-data-posyandu', function () {
//     return view('Admin.Konten.Data_posyandu.tambah');
// });

// Route::get('/edit-data-posyandu', function () {
//     return view('Admin.Konten.Data_posyandu.edit');
// });

// Data Stunting
Route::get('/datastunting', function () {
    return view('Admin.Konten.Data_stunting.index');
});

Route::get('/tambah-data-stunting', function () {
    return view('Admin.Konten.Data_stunting.tambah');
});

Route::get('/edit-data-stunting', function () {
    return view('Admin.Konten.Data_stunting.edit');
});

// Data KPM / Bantuan Sosial
Route::get('/datakpm', function () {
    return view('Admin.Konten.Data_kpm.index');
});

Route::get('/tambah-data-kpm', function () {
    return view('Admin.Konten.Data_kpm.tambah');
});

Route::get('/edit-data-kpm', function () {
    return view('Admin.Konten.Data_kpm.edit');
});

// Data Anak Putus Sekolah
Route::get('/dataputussekolah', function () {
    return view('Admin.Konten.Data_putus_sekolah.index');
});

Route::get('/tambah-data-putus-sekolah', function () {
    return view('Admin.Konten.Data_putus_sekolah.tambah');
});

Route::get('/edit-data-putus-sekolah', function () {
    return view('Admin.Konten.Data_putus_sekolah.edit');
});

// Data Sekolah
Route::get('/datasekolah', function () {
    return view('Admin.Konten.Data_sekolah.index');
});

Route::get('/tambah-data-sekolah', function () {
    return view('Admin.Konten.Data_sekolah.tambah');
});

Route::get('/edit-data-sekolah', function () {
    return view('Admin.Konten.Data_sekolah.edit');
});


//Data UMKM
Route::get('/dataumkm', function () {
    return view('Admin.Konten.Data_umkm.index');
});

Route::get('/tambah-data-umkm', function () {
    return view('Admin.Konten.Data_umkm.tambah');
});

// Data Rutilahu
Route::get('/datarutilahu', function () {
    return view('Admin.Konten.Data_rutilahu.index');
});


// Data Buruan Sae
Route::get('/databuruansae', function () {
    return view('Admin.Konten.Data_buruan_sae.index');
});

// Data Pohon
Route::get('/datapohon', function () {
    return view('Admin.Konten.Data_pohon.index');
});


// Data Fasilitas Umum
Route::get('/datafasilitasumum', function () {
    return view('Admin.Konten.Data_fasilitas_umum.index');
});

// Data Laporan Kependudukan
Route::get('/datalaporankependudukan', function () {
    return view('Admin.Konten.Data_laporan_penduduk.index');
});

// Data Linmas & Siskamling
Route::get('/datalinmas', function () {
    return view('Admin.Konten.Data_linmas.index');
});

// Data RT & RW
Route::get('/datartrw', function () {
    return view('Admin.Konten.Data_rt_rw.index');
});

// Data PKL
Route::get('/datapkl', function () {
    return view('Admin.Konten.Data_pkl.index');
});

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
