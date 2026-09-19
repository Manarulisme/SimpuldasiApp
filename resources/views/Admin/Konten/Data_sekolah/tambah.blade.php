@extends('Admin.Layout.master')

@php
$isEdit = $isEdit ?? false;


$sekolahValue = fn (
    string $key,
    mixed $default = ''
) => old(
    $key,
    data_get($sekolah ?? null, $key, $default)
);


@endphp

@section('title', $isEdit ? 'Edit Data Sekolah - Kelurahan Binong' : 'Tambah Data Sekolah - Kelurahan Binong')

@section('page_title', $isEdit ? 'Edit Data Sekolah' : 'Tambah Data Sekolah')

@section('page_subtitle', 'Kesejahteraan Sosial · Data Sekolah · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

@push('styles')

<style>

    /* =========================
       BREADCRUMB
    ========================== */

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--muted);
        font-size: 12px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .breadcrumb a {
        color: var(--primary);
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }


    /* =========================
       PAGE TITLE
    ========================== */

    .page-title {
        margin-bottom: 25px;
    }

    .page-title h2 {
        font-family: Georgia, serif;
        font-size: 27px;
        color: #18364d;
        margin-bottom: 7px;
    }

    .page-title p {
        font-size: 13px;
        color: var(--muted);
    }


    /* =========================
       FORM CARD
    ========================== */

    .form-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
    }

    .form-header {
        padding: 22px 25px;
        border-bottom: 1px solid var(--border);
        background: #fbfcfc;
    }

    .form-header h3 {
        font-size: 17px;
        color: #18364d;
        margin-bottom: 5px;
    }

    .form-header p {
        font-size: 12px;
        color: var(--muted);
    }

    .form-body {
        padding: 28px 25px;
    }


    /* =========================
       FORM SECTION
    ========================== */

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
        font-size: 14px;
        color: #18364d;
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
        font-size: 12px;
        font-weight: bold;
        flex-shrink: 0;
    }


    /* =========================
       FORM GRID
    ========================== */

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px 25px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 12px;
        font-weight: bold;
        color: var(--text);
        margin-bottom: 8px;
    }

    .required {
        color: #c0392b;
    }


    /* =========================
       FORM CONTROL
    ========================== */

    .form-control {
        width: 100%;
        height: 43px;
        border: 1px solid #dce2e5;
        border-radius: 7px;
        padding: 0 13px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        color: var(--text);
        background: white;
        outline: none;
        transition: 0.2s;
    }

    textarea.form-control {
        height: 105px;
        padding: 12px 13px;
        resize: vertical;
        line-height: 1.5;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.08);
    }

    .form-control::placeholder {
        color: #aab2b7;
    }

    select.form-control {
        cursor: pointer;
    }

    .form-help {
        font-size: 11px;
        color: var(--muted);
        margin-top: 6px;
    }


    /* =========================
       VALIDATION
    ========================== */

    .field-error {
        font-size: 11px;
        color: #c0392b;
        margin-top: 6px;
    }

    .form-control.is-invalid {
        border-color: #c0392b;
    }


    /* =========================
       INFO BOX
    ========================== */

    .info-box {
        margin-top: 25px;
        padding: 14px 16px;
        background: var(--primary-light);
        border: 1px solid #d7ecdf;
        border-radius: 8px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .info-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }

    .info-box p {
        font-size: 12px;
        line-height: 1.6;
        color: #416052;
    }


    /* =========================
       FORM FOOTER
    ========================== */

    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-top: 1px solid var(--border);
        background: #fbfcfc;
    }

    .required-note {
        font-size: 11px;
        color: var(--muted);
    }

    .form-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        height: 42px;
        padding: 0 20px;
        border-radius: 7px;
        border: none;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }

    .btn-secondary {
        background: white;
        color: var(--text);
        border: 1px solid #dce2e5;
    }

    .btn-secondary:hover {
        background: #f2f4f5;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: #065c35;
    }


    /* =========================
       MOBILE
    ========================== */

    @media (max-width: 900px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

    }


    @media (max-width: 768px) {

        .form-body {
            padding: 22px 18px;
        }

        .form-header {
            padding: 20px 18px;
        }

        .form-footer {
            padding: 18px;
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


    @media (max-width: 480px) {

        .page-title h2 {
            font-size: 23px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions .btn {
            width: 100%;
        }

    }

</style>

@endpush

@section('content')

<!-- =========================
     BREADCRUMB
========================== -->

<div class="breadcrumb">


<a href="{{ route('dashboard') }}">
    Beranda
</a>

<span>›</span>

<a href="{{ route('datasekolah.index') }}">
    Data Sekolah
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>


</div>

<!-- =========================
     PAGE TITLE
========================== -->

<div class="page-title">


<h2>
    {{ $isEdit ? 'Edit Data Sekolah' : 'Tambah Data Sekolah' }}
</h2>

<p>
    {{ $isEdit
        ? 'Perbarui informasi data sekolah Kelurahan Binong.'
        : 'Tambahkan data sekolah yang berada di wilayah Kelurahan Binong.'
    }}
</p>


</div>

<!-- =========================
     FORM CARD
========================== -->

<div class="form-card">


<!-- FORM HEADER -->

<div class="form-header">

    <h3>
        Form Data Sekolah
    </h3>

    <p>
        Silakan lengkapi informasi sekolah pada kolom yang tersedia.
    </p>

</div>


<!-- FORM -->

<form
    id="sekolahForm"
    method="POST"
    action="{{ $isEdit
        ? route('datasekolah.update', $sekolah->id)
        : route('datasekolah.store')
    }}"
>

    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif


    <div class="form-body">


        <!-- =========================
             SECTION 1
        ========================== -->

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    1
                </span>

                Identitas Sekolah

            </div>


            <div class="form-grid">


                <!-- ID DATA -->

                <div class="form-group">

                    <label for="id_data">

                        ID Data
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        id="id_data"
                        name="id_data"
                        class="form-control @error('id_data') is-invalid @enderror"
                        placeholder="Contoh: SEK-001"
                        value="{{ $sekolahValue('id_data') }}"
                        required
                    >

                    @error('id_data')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                    <span class="form-help">
                        Gunakan ID unik untuk setiap data sekolah.
                    </span>

                </div>


                <!-- NAMA SEKOLAH -->

                <div class="form-group">

                    <label for="nama_sekolah">

                        Nama Sekolah
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        id="nama_sekolah"
                        name="nama_sekolah"
                        class="form-control @error('nama_sekolah') is-invalid @enderror"
                        placeholder="Contoh: SDN Binong 01"
                        value="{{ $sekolahValue('nama_sekolah') }}"
                        required
                    >

                    @error('nama_sekolah')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <!-- JENJANG -->

                <div class="form-group">

                    <label for="jenjang">

                        Jenjang
                        <span class="required">*</span>

                    </label>

                    <select
                        id="jenjang"
                        name="jenjang"
                        class="form-control @error('jenjang') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Pilih Jenjang
                        </option>

                        <option
                            value="TK"
                            @selected($sekolahValue('jenjang') === 'TK')
                        >
                            TK
                        </option>

                        <option
                            value="SD"
                            @selected($sekolahValue('jenjang') === 'SD')
                        >
                            SD
                        </option>

                        <option
                            value="SMP"
                            @selected($sekolahValue('jenjang') === 'SMP')
                        >
                            SMP
                        </option>

                        <option
                            value="SMA"
                            @selected($sekolahValue('jenjang') === 'SMA')
                        >
                            SMA
                        </option>

                        <option
                            value="SMK"
                            @selected($sekolahValue('jenjang') === 'SMK')
                        >
                            SMK
                        </option>

                    </select>

                    @error('jenjang')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                    <span class="form-help">
                        Pilih jenjang pendidikan sekolah.
                    </span>

                </div>


                <!-- ALAMAT -->

                <div class="form-group full">

                    <label for="alamat">

                        Alamat Sekolah
                        <span class="required">*</span>

                    </label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Contoh: Jl. Melati No. 1, Kelurahan Binong"
                        required
                    >{{ $sekolahValue('alamat') }}</textarea>

                    @error('alamat')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

        </div>


        <!-- =========================
             SECTION 2
        ========================== -->

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    2
                </span>

                Data Sekolah

            </div>


            <div class="form-grid">


                <!-- JUMLAH SISWA -->

                <div class="form-group">

                    <label for="jumlah_siswa">

                        Jumlah Siswa
                        <span class="required">*</span>

                    </label>

                    <input
                        type="number"
                        id="jumlah_siswa"
                        name="jumlah_siswa"
                        class="form-control @error('jumlah_siswa') is-invalid @enderror"
                        placeholder="Contoh: 245"
                        min="0"
                        value="{{ $sekolahValue('jumlah_siswa') }}"
                        required
                    >

                    @error('jumlah_siswa')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                    <span class="form-help">
                        Masukkan jumlah siswa yang terdaftar.
                    </span>

                </div>


                <!-- KETERANGAN -->

                <div class="form-group">

                    <label for="keterangan">
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="form-control @error('keterangan') is-invalid @enderror"
                        placeholder="Keterangan tambahan mengenai sekolah"
                    >{{ $sekolahValue('keterangan') }}</textarea>

                    @error('keterangan')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

        </div>


        <!-- =========================
             INFO
        ========================== -->

        <div class="info-box">

            <div class="info-icon">
                i
            </div>

            <p>

                Pastikan ID data, nama sekolah, jenjang, alamat,
                dan jumlah siswa sudah benar sebelum menyimpan data.

            </p>

        </div>

    </div>


    <!-- =========================
         FORM FOOTER
    ========================== -->

    <div class="form-footer">

        <div class="required-note">

            <span class="required">*</span>
            Wajib diisi

        </div>


        <div class="form-actions">

            <a
                href="{{ route('datasekolah.index') }}"
                class="btn btn-secondary"
            >
                Batal
            </a>


            <button
                type="submit"
                class="btn btn-primary"
            >

                {{ $isEdit
                    ? 'Perbarui Data'
                    : 'Simpan Data'
                }}

            </button>

        </div>

    </div>

</form>


</div>

@endsection
