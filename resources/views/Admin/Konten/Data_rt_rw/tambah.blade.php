@php
$isEdit = $isEdit ?? false;

$rtRwValue = fn (
string $key,
mixed $default = ''
) => old(
$key,
data_get($dataRtRw ?? null, $key, $default)
);
@endphp

@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data RT & RW - Kelurahan Binong')

@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data RT & RW')

@section('page_subtitle', 'Kependudukan · RT & RW · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

@push('styles')

<style>
.rt-rw-page {
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
    margin: 0;
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
    margin: 0;
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

<div class="rt-rw-page">

<div class="breadcrumb">

<a href="{{ route('dashboard') }}">
    Beranda
</a>

<span>›</span>

<a href="{{ route('datartrw.index') }}">
    Data RT & RW
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>

</div>

<div class="page-title-block">

<h2>
    {{ $isEdit ? 'Edit' : 'Tambah' }} Data RT & RW
</h2>

<p>
    {{ $isEdit ? 'Perbarui' : 'Tambahkan' }}
    data pengurus RT dan RW Kelurahan Binong.
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
    {{ $isEdit ? 'Edit' : 'Form' }} Data RT & RW
</h3>

<p>
    Lengkapi data pengurus RT dan RW beserta masa kepengurusannya.
</p>

</div>

<form
    id="rtRwForm"
    method="POST"
    action="{{ $isEdit ? route('datartrw.update', ['datartrw' => $dataRtRw->id]) : route('datartrw.store') }}"
>

@csrf

@if($isEdit)

@method('PUT')

@endif

<div class="form-body">

{{-- ====================================================== --}}
{{-- 1. DATA RT --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    1
</span>

Data RT

</div>

<div class="form-grid">

<div class="form-group">

<label for="nomor_rt">

Nomor RT

<span class="required">*</span>

</label>

<input
type="text"
id="nomor_rt"
name="nomor_rt"
class="form-control"
placeholder="Contoh: RT 01"
value="{{ $rtRwValue('nomor_rt') }}"
maxlength="20"
required

>

@error('nomor_rt')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="nama_rt">

Nama Ketua RT

<span class="required">*</span>

</label>

<input
type="text"
id="nama_rt"
name="nama_rt"
class="form-control"
placeholder="Contoh: Budi Santoso"
value="{{ $rtRwValue('nama_rt') }}"
maxlength="150"
required

>

@error('nama_rt')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

</div>

</div>

{{-- ====================================================== --}}
{{-- 2. DATA RW --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    2
</span>

Data RW

</div>

<div class="form-grid">

<div class="form-group">

<label for="nomor_rw">

Nomor RW

<span class="required">*</span>

</label>

<input
type="text"
id="nomor_rw"
name="nomor_rw"
class="form-control"
placeholder="Contoh: RW 01"
value="{{ $rtRwValue('nomor_rw') }}"
maxlength="20"
required

>

@error('nomor_rw')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="nama_rw">

Nama Ketua RW

<span class="required">*</span>

</label>

<input
type="text"
id="nama_rw"
name="nama_rw"
class="form-control"
placeholder="Contoh: Hendra Wijaya"
value="{{ $rtRwValue('nama_rw') }}"
maxlength="150"
required

>

@error('nama_rw')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

</div>

</div>

{{-- ====================================================== --}}
{{-- 3. MASA KEPENGURUSAN --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    3
</span>

Masa Kepengurusan

</div>

<div class="form-grid">

<div class="form-group">

<label for="tanggal_mulai">

Tanggal Mulai

</label>

<input
type="date"
id="tanggal_mulai"
name="tanggal_mulai"
class="form-control"
value="{{ $rtRwValue('tanggal_mulai') ? \Illuminate\Support\Carbon::parse($rtRwValue('tanggal_mulai'))->format('Y-m-d') : '' }}"

>

@error('tanggal_mulai')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="tanggal_berakhir">

Tanggal Berakhir

</label>

<input
type="date"
id="tanggal_berakhir"
name="tanggal_berakhir"
class="form-control"
value="{{ $rtRwValue('tanggal_berakhir') ? \Illuminate\Support\Carbon::parse($rtRwValue('tanggal_berakhir'))->format('Y-m-d') : '' }}"

>

@error('tanggal_berakhir')

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
    Pastikan data RT dan RW yang dimasukkan sudah benar sebelum menyimpan.
    Data akan disimpan ke database dan dapat disinkronkan ke Google Sheets.
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
href="{{ route('datartrw.index') }}"
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
