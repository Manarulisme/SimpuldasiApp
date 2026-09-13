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

Route::get('/dataumumpegawai', function () {
    return view('Admin.Konten.dataumumpegawai');
});


Route::get('/tambah-data-umum-kepegawaian', function () {
    return view('Admin.Konten.tambah-data-umum-kepegawaian');
});
