@php
$isEdit = $isEdit ?? false;

$linmasValue = fn (
string $key,
mixed $default = ''
) => old(
$key,
data_get($dataLinmas ?? null, $key, $default)
);
@endphp

@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Linmas & Siskamling - Kelurahan Binong')

@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Linmas & Siskamling')

@section('page_subtitle', 'Keamanan & Ketertiban · Linmas & Siskamling · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

@push('styles')

<style>
.linmas-page {
    padding-bottom: 30px;
}

.breadcrumb {
    display: flex;
    gap: 8px;
    color: var(--muted);
    font-size: 12px;
    margin-bottom: 18px;
}

.breadcrumb a {
    color: var(--primary);
}

.page-title-block {
    margin-bottom: 25px;
}

.page-title-block h2 {
    font: 27px Georgia, serif;
    color: #18364d;
}

.page-title-block p,
.form-header p {
    font-size: 13px;
    color: var(--muted);
    margin-top: 7px;
}

.form-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.form-header,
.form-footer {
    padding: 22px 25px;
    background: #fbfcfc;
    border-bottom: 1px solid var(--border);
}

.form-header h3 {
    font-size: 17px;
    color: #18364d;
}

.form-body {
    padding: 28px 25px;
}

.form-section {
    margin-bottom: 30px;
}

.section-title {
    display: flex;
    gap: 10px;
    align-items: center;
    color: #18364d;
    font-size: 14px;
    font-weight: bold;
    padding-bottom: 12px;
    margin-bottom: 20px;
    border-bottom: 1px solid var(--border);
}

.section-number {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 8px;
}

.required {
    color: #c0392b;
}

.form-control {
    height: 43px;
    width: 100%;
    border: 1px solid #dce2e5;
    border-radius: 7px;
    padding: 0 13px;
    font: 13px Arial, sans-serif;
    box-sizing: border-box;
    background: #fff;
    color: #263238;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.08);
}

.form-control::placeholder {
    color: #9ca3af;
}

.form-group.full {
    grid-column: 1 / -1;
}

textarea.form-control {
    height: 100px;
    padding: 12px;
    resize: vertical;
}

.field-help {
    font-size: 10px;
    color: #7b8790;
    line-height: 1.5;
    margin-top: 6px;
}

.info-box {
    display: flex;
    gap: 12px;
    padding: 14px 16px;
    background: var(--primary-light);
    border: 1px solid #d7ecdf;
    border-radius: 8px;
}

.info-icon {
    width: 24px;
    height: 24px;
    min-width: 24px;
    border-radius: 50%;
    background: var(--primary);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.info-box p {
    font-size: 12px;
    line-height: 1.6;
    color: #416052;
    margin: 0;
}

.error-message {
    color: #c0392b;
    font-size: 11px;
    margin-top: 6px;
}

.form-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid var(--border);
    border-bottom: 0;
}

.form-actions {
    display: flex;
    gap: 10px;
}

.btn {
    height: 42px;
    padding: 0 20px;
    border-radius: 7px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    border: 0;
    text-decoration: none;
    cursor: pointer;
}

.btn-secondary {
    background: #fff;
    border: 1px solid #dce2e5;
    color: #263238;
}

.btn-primary {
    background: var(--primary);
    color: #fff;
}

.btn-primary:hover {
    opacity: 0.92;
}

@media (max-width: 700px) {

    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-group.full {
        grid-column: auto;
    }

    .form-footer {
        flex-direction: column;
        align-items: stretch;
        gap: 15px;
    }

    .form-actions {
        width: 100%;
    }

    .form-actions .btn {
        flex: 1;
    }
}
</style>

@endpush

@section('content')

<div class="linmas-page">

<div class="breadcrumb">

<a href="{{ route('dashboard') }}">
    Beranda
</a>

<span>›</span>

<a href="{{ route('datalinmas.index') }}">
    Linmas & Siskamling
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>

</div>

<div class="page-title-block">

<h2>
    {{ $isEdit ? 'Edit' : 'Tambah' }} Data Linmas & Siskamling
</h2>

<p>
    {{ $isEdit ? 'Perbarui' : 'Tambahkan' }}
    data Linmas dan Siskamling Kelurahan Binong.
</p>

</div>

@if ($errors->any())

<div
    class="info-box"
    style="margin-bottom: 20px; background: #fef2f2; border-color: #fecaca;"
>

<div
    class="info-icon"
    style="background: #c0392b;"
>
    !
</div>

<div>

<p style="color: #991b1b;">
    <strong>Terjadi kesalahan:</strong>
</p>

<ul
    style="margin: 5px 0 0 0; padding-left: 18px; color: #991b1b; font-size: 12px; line-height: 1.6;"
>

@foreach ($errors->all() as $error)

<li>
    {{ $error }}
</li>

@endforeach

</ul>

</div>

</div>

@endif

<div class="form-card">

<div class="form-header">

<h3>
    {{ $isEdit ? 'Edit' : 'Form' }} Data Linmas & Siskamling
</h3>

<p>
    Lengkapi data Linmas dan Siskamling berdasarkan wilayah RW.
</p>

</div>

<form
    id="linmasForm"
    method="POST"
    action="{{ $isEdit ? route('datalinmas.update', ['datalinma' => $dataLinmas->id]) : route('datalinmas.store') }}"
>

@csrf

@if($isEdit)
@method('PUT')
@endif

<div class="form-body">

{{-- ====================================================== --}}
{{-- 1. DATA WILAYAH --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    1
</span>

Data Wilayah

</div>

<div class="form-grid">

<div class="form-group">

<label for="rw">

RW

<span class="required">*</span>

</label>

<input
type="text"
id="rw"
name="rw"
class="form-control"
placeholder="Contoh: RW 01"
value="{{ $linmasValue('rw') }}"
maxlength="10"
required

>

@error('rw')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="jumlah_linmas">

Jumlah Linmas

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_linmas"
name="jumlah_linmas"
class="form-control"
placeholder="Contoh: 10"
value="{{ $linmasValue('jumlah_linmas', 0) }}"
min="0"
required

>

@error('jumlah_linmas')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

</div>

</div>

{{-- ====================================================== --}}
{{-- 2. DATA ANGGOTA LINMAS --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    2
</span>

Data Anggota Linmas

</div>

<div class="form-grid">

<div class="form-group">

<label for="nama">

Nama Anggota

</label>

<input
type="text"
id="nama"
name="nama"
class="form-control"
placeholder="Contoh: Budi Santoso"
value="{{ $linmasValue('nama') }}"
maxlength="150"

>

@error('nama')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="nik">

NIK

</label>

<input
type="text"
id="nik"
name="nik"
class="form-control"
placeholder="Masukkan NIK"
value="{{ $linmasValue('nik') }}"
maxlength="30"

>

@error('nik')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="pekerjaan">

Pekerjaan

</label>

<input
type="text"
id="pekerjaan"
name="pekerjaan"
class="form-control"
placeholder="Contoh: Wiraswasta"
value="{{ $linmasValue('pekerjaan') }}"
maxlength="100"

>

@error('pekerjaan')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group full">

<label for="alamat">

Alamat

</label>

<textarea
id="alamat"
name="alamat"
class="form-control"
placeholder="Masukkan alamat anggota Linmas..."
>{{ $linmasValue('alamat') }}</textarea>

@error('alamat')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

</div>

</div>

{{-- ====================================================== --}}
{{-- 3. DATA SISKAMLING --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    3
</span>

Data Siskamling

</div>

<div class="form-grid">

<div class="form-group">

<label for="jumlah_poskamling">

Jumlah Poskamling

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_poskamling"
name="jumlah_poskamling"
class="form-control"
placeholder="Contoh: 3"
value="{{ $linmasValue('jumlah_poskamling', 0) }}"
min="0"
required

>

@error('jumlah_poskamling')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="titik_poskamling">

Titik Poskamling

</label>

<input
type="text"
id="titik_poskamling"
name="titik_poskamling"
class="form-control"
placeholder="Contoh: Poskamling RW 01 atau -6.943089, 107.637506"
value="{{ $linmasValue('titik_poskamling') }}"
maxlength="255"

>

<div class="field-help">
    Masukkan nama lokasi, alamat, atau koordinat titik Poskamling.
    Contoh koordinat: -6.943089, 107.637506
</div>

@error('titik_poskamling')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

</div>

</div>

{{-- ====================================================== --}}
{{-- 4. KETERANGAN --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    4
</span>

Keterangan

</div>

<div class="form-grid">

<div class="form-group full">

<label for="keterangan">

Keterangan

</label>

<textarea
id="keterangan"
name="keterangan"
class="form-control"
placeholder="Tambahkan keterangan atau informasi tambahan mengenai data Linmas dan Siskamling..."
>{{ $linmasValue('keterangan') }}</textarea>

@error('keterangan')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

</div>

</div>

{{-- ====================================================== --}}
{{-- INFO BOX --}}
{{-- ====================================================== --}}

<div class="info-box">

<div class="info-icon">
    i
</div>

<p>
    Pastikan data Linmas dan Siskamling yang dimasukkan sudah benar sebelum
    menyimpan. Data akan disimpan ke database dan dapat disinkronkan ke
    Google Sheets.
</p>

</div>

</div>

{{-- ====================================================== --}}
{{-- FORM FOOTER --}}
{{-- ====================================================== --}}

<div class="form-footer">

<span>
    <span class="required">*</span>
    Wajib diisi
</span>

<div class="form-actions">

<a
href="{{ route('datalinmas.index') }}"
class="btn btn-secondary"

>


Batal


</a>

<button
type="submit"
class="btn btn-primary"

>


{{ $isEdit ? 'Perbarui Data' : 'Simpan Data' }}


</button>

</div>

</div>

</form>

</div>

</div>

@endsection
