<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/login', function () {
    return view('Admin.Konten.login');
});

Route::get('/dashboard', function () {
    return view('Admin.Konten.dashboard');
});

// Data Umum Pegawai
Route::get('/dataumumpegawai', function () {
    return view('Admin.Konten.Data_umum_pegawai.index');
});


Route::get('/tambah-data-umum-kepegawaian', function () {
    return view('Admin.Konten.Data_umum_pegawai.tambah-data-umum-kepegawaian');
});

Route::get('/edit-data-umum-kepegawaian', function () {
    return view('Admin.Konten.Data_umum_pegawai.edit');
});

// Data BMD
Route::get('/databmd', function () {
    return view('Admin.Konten.Data_bmd.index');
});

Route::get('/tambah-data-bmd', function () {
    return view('Admin.Konten.Data_bmd.tambah');
});

Route::get('/edit-data-bmd', function () {
    return view('Admin.Konten.Data_bmd.edit');
});


// Data Posyandu
Route::get('/dataposyandu', function () {
    return view('Admin.Konten.Data_posyandu.index');
});

Route::get('/tambah-data-posyandu', function () {
    return view('Admin.Konten.Data_posyandu.tambah');
});

Route::get('/edit-data-posyandu', function () {
    return view('Admin.Konten.Data_posyandu.edit');
});

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
