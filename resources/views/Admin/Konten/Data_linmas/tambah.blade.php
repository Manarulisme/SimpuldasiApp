@php

$isEdit = $isEdit ?? false;

$linmasValue = fn (
string $key,
mixed $default = ''
) => old(
$key,
data_get(
$dataLinmas ?? null,
$key,
$default
)
);

@endphp

@extends('Admin.Layout.master')

@section(
'title',
($isEdit
? 'Edit Data Linmas & Siskamling'
: 'Tambah Data Linmas & Siskamling')
. ' - Kelurahan Binong'
)

@section(
'page_title',
$isEdit
? 'Edit Data Linmas & Siskamling'
: 'Tambah Data Linmas & Siskamling'
)

@section(
'page_subtitle',
'Keamanan & Ketertiban · Linmas & Siskamling'
)

@push('styles')

<style>

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 22px;
        font-size: 11px;
        color: var(--muted);
    }

    .breadcrumb a {
        color: var(--primary);
        text-decoration: none;
    }

    .breadcrumb span {
        color: #b0b7bc;
    }

    .page-title-block {
        margin-bottom: 25px;
    }

    .page-title-block h2 {
        color: #18364d;
        font-family: Georgia, serif;
        font-size: 26px;
        margin: 0;
    }

    .page-title-block p {
        color: var(--muted);
        font-size: 12px;
        margin-top: 6px;
    }

    .form-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .form-header {
        padding: 20px 22px;
        border-bottom: 1px solid var(--border);
    }

    .form-header h3 {
        color: #18364d;
        font-size: 16px;
        margin: 0;
    }

    .form-header p {
        color: var(--muted);
        font-size: 11px;
        margin-top: 5px;
    }

    .form-body {
        padding: 25px 22px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #18364d;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .section-number {
        width: 27px;
        height: 27px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        color: #52616b;
        font-size: 11px;
        font-weight: 600;
    }

    .required {
        color: #c0392b;
    }

    .form-control {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #dfe4e7;
        border-radius: 7px;
        background: #fff;
        color: #263238;
        padding: 11px 12px;
        font-family: inherit;
        font-size: 12px;
        outline: none;
        transition:
            border-color .2s,
            box-shadow .2s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(8, 116, 67, .08);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
        line-height: 1.6;
    }

    select.form-control {
        cursor: pointer;
    }

    .form-help {
        color: #9aa4aa;
        font-size: 10px;
        line-height: 1.5;
    }

    .error-message {
        color: #c0392b;
        font-size: 10px;
        margin-top: -2px;
    }

    .validation-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 7px;
        padding: 13px 14px;
        margin-bottom: 22px;
    }

    .validation-icon {
        width: 20px;
        height: 20px;
        min-width: 20px;
        border-radius: 50%;
        background: #c0392b;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .validation-box p {
        color: #991b1b;
        font-size: 10px;
        line-height: 1.6;
        margin: 0;
    }

    .validation-box ul {
        margin: 5px 0 0;
        padding-left: 18px;
        color: #991b1b;
        font-size: 10px;
        line-height: 1.6;
    }

    .info-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: var(--primary-light);
        border: 1px solid #d6ebdf;
        border-radius: 7px;
        padding: 13px 14px;
        margin-top: 22px;
    }

    .info-icon {
        width: 20px;
        height: 20px;
        min-width: 20px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
    }

    .info-box p {
        color: #426154;
        font-size: 10px;
        line-height: 1.6;
        margin: 0;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        padding: 18px 22px;
        background: #fafbfb;
        border-top: 1px solid var(--border);
    }

    .form-footer-note {
        margin-right: auto;
        color: #7b8790;
        font-size: 10px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-width: 110px;
        padding: 10px 16px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-secondary {
        color: #52616b;
        background: white;
        border: 1px solid #dfe4e7;
    }

    .btn-secondary:hover {
        background: #f5f7f8;
    }

    .btn-primary {
        color: white;
        background: var(--primary);
        border: 1px solid var(--primary);
    }

    .btn-primary:hover {
        background: #065c35;
        border-color: #065c35;
    }

    @media (max-width: 700px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full-width {
            grid-column: auto;
        }

        .form-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .form-footer-note {
            margin-right: 0;
            text-align: center;
            order: 3;
        }

        .btn {
            width: 100%;
        }

    }

</style>

@endpush

@section('content')

<div class="breadcrumb">


<a href="{{ route('dashboard') }}">
    Beranda
</a>

<span>›</span>

<a href="{{ route('datalinmas.index') }}">
    Data Linmas & Siskamling
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>


</div>

<div class="page-title-block">


<h2>
    {{ $isEdit
        ? 'Edit Data Linmas & Siskamling'
        : 'Tambah Data Linmas & Siskamling'
    }}
</h2>

<p>
    {{ $isEdit
        ? 'Perbarui informasi Linmas dan Siskamling Kelurahan Binong.'
        : 'Tambahkan data Linmas dan Siskamling Kelurahan Binong.'
    }}
</p>


</div>

@if ($errors->any())

<div class="validation-box">


<div class="validation-icon">
    !
</div>

<div>

    <p>
        <strong>Terjadi kesalahan:</strong>
    </p>

    <ul>

        @foreach ($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

        @endforeach

    </ul>

</div>


</div>

@endif

<section class="form-card">


<div class="form-header">

    <h3>
        {{ $isEdit
            ? 'Form Edit Data Linmas & Siskamling'
            : 'Form Data Linmas & Siskamling'
        }}
    </h3>

    <p>
        Lengkapi informasi Linmas dan Siskamling berdasarkan wilayah RW.
    </p>

</div>


<form
    id="linmasForm"
    method="POST"
    action="{{ $isEdit
        ? route(
            'datalinmas.update',
            ['datalinma' => $dataLinmas->id]
        )
        : route('datalinmas.store')
    }}"
>

    @csrf

    @if ($isEdit)

        @method('PUT')

    @endif


    <div class="form-body">


        {{-- ========================================= --}}
        {{-- 1. DATA WILAYAH --}}
        {{-- ========================================= --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    1
                </span>

                Data Wilayah

            </div>


            <div class="form-grid">


                <div class="form-group">

                    <label
                        for="rw"
                        class="form-label"
                    >
                        RW
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="rw"
                        name="rw"
                        class="form-control"
                        value="{{ $linmasValue('rw') }}"
                        placeholder="Contoh: RW 01"
                        maxlength="10"
                        required
                    >

                    <span class="form-help">
                        Masukkan nomor RW sesuai wilayah Kelurahan Binong.
                    </span>

                    @error('rw')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <div class="form-group">

                    <label
                        for="jumlah_linmas"
                        class="form-label"
                    >
                        Jumlah Linmas
                        <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        id="jumlah_linmas"
                        name="jumlah_linmas"
                        class="form-control"
                        value="{{ $linmasValue('jumlah_linmas', 0) }}"
                        placeholder="Contoh: 10"
                        min="0"
                        required
                    >

                    <span class="form-help">
                        Masukkan jumlah anggota Linmas pada wilayah RW tersebut.
                    </span>

                    @error('jumlah_linmas')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


            </div>

        </div>


        {{-- ========================================= --}}
        {{-- 2. DATA ANGGOTA LINMAS --}}
        {{-- ========================================= --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    2
                </span>

                Data Anggota Linmas

            </div>


            <div class="form-grid">


                <div class="form-group">

                    <label
                        for="nama"
                        class="form-label"
                    >
                        Nama Anggota
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        value="{{ $linmasValue('nama') }}"
                        placeholder="Contoh: Budi Santoso"
                        maxlength="150"
                    >

                    @error('nama')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <div class="form-group">

                    <label
                        for="nik"
                        class="form-label"
                    >
                        NIK
                    </label>

                    <input
                        type="text"
                        id="nik"
                        name="nik"
                        class="form-control"
                        value="{{ $linmasValue('nik') }}"
                        placeholder="Masukkan NIK"
                        maxlength="30"
                    >

                    <span class="form-help">
                        Masukkan NIK sesuai dokumen kependudukan jika tersedia.
                    </span>

                    @error('nik')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <div class="form-group">

                    <label
                        for="pekerjaan"
                        class="form-label"
                    >
                        Pekerjaan
                    </label>

                    <input
                        type="text"
                        id="pekerjaan"
                        name="pekerjaan"
                        class="form-control"
                        value="{{ $linmasValue('pekerjaan') }}"
                        placeholder="Contoh: Wiraswasta"
                        maxlength="100"
                    >

                    @error('pekerjaan')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <div class="form-group full-width">

                    <label
                        for="alamat"
                        class="form-label"
                    >
                        Alamat
                    </label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        class="form-control"
                        placeholder="Masukkan alamat anggota Linmas..."
                    >{{ $linmasValue('alamat') }}</textarea>

                    @error('alamat')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


            </div>

        </div>


        {{-- ========================================= --}}
        {{-- 3. DATA SISKAMLING --}}
        {{-- ========================================= --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    3
                </span>

                Data Siskamling

            </div>


            <div class="form-grid">


                <div class="form-group">

                    <label
                        for="jumlah_poskamling"
                        class="form-label"
                    >
                        Jumlah Poskamling
                        <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        id="jumlah_poskamling"
                        name="jumlah_poskamling"
                        class="form-control"
                        value="{{ $linmasValue('jumlah_poskamling', 0) }}"
                        placeholder="Contoh: 3"
                        min="0"
                        required
                    >

                    <span class="form-help">
                        Masukkan jumlah Poskamling yang tersedia di wilayah RW.
                    </span>

                    @error('jumlah_poskamling')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <div class="form-group">

                    <label
                        for="titik_poskamling"
                        class="form-label"
                    >
                        Titik Poskamling
                    </label>

                    <input
                        type="text"
                        id="titik_poskamling"
                        name="titik_poskamling"
                        class="form-control"
                        value="{{ $linmasValue('titik_poskamling') }}"
                        placeholder="Contoh: Poskamling RW 01"
                        maxlength="255"
                    >

                    <span class="form-help">
                        Masukkan nama lokasi, alamat, atau koordinat titik Poskamling.
                    </span>

                    @error('titik_poskamling')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


            </div>

        </div>


        {{-- ========================================= --}}
        {{-- 4. KETERANGAN --}}
        {{-- ========================================= --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    4
                </span>

                Keterangan

            </div>


            <div class="form-grid">


                <div class="form-group full-width">

                    <label
                        for="keterangan"
                        class="form-label"
                    >
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="form-control"
                        placeholder="Tambahkan keterangan atau informasi tambahan mengenai data Linmas dan Siskamling..."
                    >{{ $linmasValue('keterangan') }}</textarea>

                    @error('keterangan')

                        <span class="error-message">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


            </div>

        </div>


        {{-- ========================================= --}}
        {{-- INFO BOX --}}
        {{-- ========================================= --}}

        <div class="info-box">

            <div class="info-icon">
                i
            </div>

            <p>
                Data Linmas dan Siskamling akan disimpan ke database
                Kelurahan Binong. Data yang telah tersimpan dapat
                diperbarui melalui menu Ubah Data dan dapat disinkronkan
                ke Google Sheets.
            </p>

        </div>


    </div>


    {{-- ========================================= --}}
    {{-- FORM FOOTER --}}
    {{-- ========================================= --}}

    <div class="form-footer">

        <span class="form-footer-note">
            <span class="required">*</span>
            Wajib diisi
        </span>


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


</form>


</section>

@endsection
