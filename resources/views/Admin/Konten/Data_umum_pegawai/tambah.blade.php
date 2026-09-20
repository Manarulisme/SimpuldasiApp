@php
$isEdit = $isEdit ?? false;


$pegawaiValue = fn (
    string $key,
    mixed $default = ''
) => old(
    $key,
    data_get(
        $pegawai ?? null,
        $key,
        $default
    )
);


@endphp

@extends('Admin.Layout.master')

@section(
'title',
($isEdit ? 'Edit' : 'Tambah') .
' Data Kepegawaian - Kelurahan Binong'
)

@section(
'page_title',
($isEdit ? 'Edit' : 'Tambah') .
' Data Kepegawaian'
)

@section(
'page_subtitle',
'Kesekretariatan · Data Umum Kepegawaian · ' .
($isEdit ? 'Edit Data' : 'Tambah Data')
)

@push('styles')

<style>

    /* =========================================
       BREADCRUMB
    ========================================= */

    .breadcrumb {
        display: flex;
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


    /* =========================================
       PAGE TITLE
    ========================================= */

    .page-title-block {
        margin-bottom: 25px;
    }

    .page-title-block h2 {
        color: #18364d;
        font-family: Georgia, serif;
        font-size: 27px;
        margin-bottom: 7px;
    }

    .page-title-block p {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }


    /* =========================================
       FORM CARD
    ========================================= */

    .form-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }


    /* =========================================
       FORM HEADER
    ========================================= */

    .form-header {
        background: #fbfcfc;
        padding: 22px 25px;
        border-bottom: 1px solid var(--border);
    }

    .form-header h3 {
        color: #18364d;
        font-size: 17px;
        margin-bottom: 5px;
    }

    .form-header p {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.6;
    }


    /* =========================================
       FORM BODY
    ========================================= */

    .form-body {
        padding: 28px 25px;
    }

    .form-section {
        margin-bottom: 30px;
    }


    /* =========================================
       SECTION TITLE
    ========================================= */

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
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
        flex-shrink: 0;
    }


    /* =========================================
       FORM GRID
    ========================================= */

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


    /* =========================================
       LABEL
    ========================================= */

    .form-group label {
        color: var(--text);
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .required {
        color: #c0392b;
    }


    /* =========================================
       FORM CONTROL
    ========================================= */

    .form-control {
        width: 100%;
        height: 43px;
        border: 1px solid #dce2e5;
        border-radius: 7px;
        padding: 0 13px;
        font: 13px Arial, sans-serif;
        color: var(--text);
        background: white;
        box-sizing: border-box;
    }

    textarea.form-control {
        height: 100px;
        padding: 12px 13px;
        resize: vertical;
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(
            8,
            116,
            67,
            0.08
        );
    }


    /* =========================================
       FORM HELP
    ========================================= */

    .form-help {
        color: var(--muted);
        margin-top: 6px;
        font-size: 11px;
        line-height: 1.5;
    }


    /* =========================================
       VALIDATION ERROR
    ========================================= */

    .validation-errors {
        margin-bottom: 25px;
        padding: 15px 18px;
        background: #fff5f4;
        border: 1px solid #f1c9c5;
        border-radius: 8px;
        color: #a93226;
        font-size: 12px;
        line-height: 1.7;
    }

    .validation-errors strong {
        display: block;
        margin-bottom: 5px;
    }

    .validation-errors ul {
        margin: 0;
        padding-left: 18px;
    }


    /* =========================================
       GOOGLE SHEETS INFO BOX
    ========================================= */

    .info-box {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 14px 16px;
        background: var(--primary-light);
        border: 1px solid #d7ecdf;
        border-radius: 8px;
        margin-top: 5px;
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
        font-weight: bold;
        font-size: 12px;
    }

    .info-box p {
        color: #416052;
        font-size: 12px;
        line-height: 1.6;
        margin: 0;
    }


    /* =========================================
       SYNC INFO
    ========================================= */

    .sync-info {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 14px 16px;
        background: #f8faf9;
        border: 1px solid #e3e9e6;
        border-radius: 8px;
        margin-top: 15px;
    }

    .sync-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid #d7e1dc;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: bold;
    }

    .sync-info p {
        color: #52616b;
        font-size: 11px;
        line-height: 1.6;
        margin: 0;
    }

    .sync-info strong {
        color: #18364d;
    }


    /* =========================================
       FORM FOOTER
    ========================================= */

    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fbfcfc;
        padding: 22px 25px;
        border-top: 1px solid var(--border);
    }

    .required-note {
        color: var(--muted);
        font-size: 12px;
    }


    /* =========================================
       FORM ACTIONS
    ========================================= */

    .form-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        height: 42px;
        padding: 0 20px;
        border: 0;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        box-sizing: border-box;
    }

    .btn-secondary {
        background: white;
        color: var(--text);
        border: 1px solid #dce2e5;
    }

    .btn-secondary:hover {
        background: #f5f7f7;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: #065c35;
    }


    /* =========================================
       MOBILE
    ========================================= */

    @media (max-width: 700px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-body {
            padding: 22px 18px;
        }

        .form-header {
            padding: 20px 18px;
        }

        .form-footer {
            align-items: stretch;
            flex-direction: column;
            gap: 15px;
            padding: 20px 18px;
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

{{-- =========================================
BREADCRUMB
========================================= --}}

<div class="breadcrumb">


<a href="{{ url('/dashboard') }}">
    Beranda
</a>

<span>
    ›
</span>

<a href="{{ url('/dataumumpegawai') }}">
    Data Kepegawaian
</a>

<span>
    ›
</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>


</div>

{{-- =========================================
PAGE TITLE
========================================= --}}

<div class="page-title-block">


<h2>
    {{ $isEdit
        ? 'Edit Data Umum Kepegawaian'
        : 'Tambah Data Umum Kepegawaian'
    }}
</h2>

<p>
    {{ $isEdit
        ? 'Perbarui informasi pegawai pada Data Umum Kepegawaian Kelurahan Binong.'
        : 'Tambahkan data pegawai baru ke dalam Data Umum Kepegawaian Kelurahan Binong.'
    }}
</p>


</div>

{{-- =========================================
VALIDATION ERROR
========================================= --}}

@if ($errors->any())


<div class="validation-errors">

    <strong>
        Terdapat kesalahan pada data yang dimasukkan:
    </strong>

    <ul>

        @foreach ($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

        @endforeach

    </ul>

</div>


@endif

{{-- =========================================
FORM CARD
========================================= --}}

<div class="form-card">


{{-- FORM HEADER --}}

<div class="form-header">

    <h3>
        {{ $isEdit
            ? 'Edit Data Pegawai'
            : 'Form Data Pegawai'
        }}
    </h3>

    <p>
        {{ $isEdit
            ? 'Perbarui informasi pegawai pada kolom yang tersedia.'
            : 'Silakan lengkapi informasi pegawai pada kolom yang tersedia.'
        }}
    </p>

</div>


{{-- FORM --}}

<form
    id="pegawaiForm"
    method="POST"
    action="{{ $isEdit
        ? route(
            'dataumumpegawai.update',
            $pegawai->id
        )
        : route(
            'dataumumpegawai.store'
        )
    }}"
>

    @csrf

    @if ($isEdit)

        @method('PUT')

    @endif


    <div class="form-body">


        {{-- =========================================
             SECTION 1
        ========================================= --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    1
                </span>

                Data Identitas Pegawai

            </div>


            <div class="form-grid">


                {{-- JENIS --}}

                <div class="form-group">

                    <label for="jenis">

                        Jenis Pegawai

                        <span class="required">
                            *
                        </span>

                    </label>


                    <select
                        id="jenis"
                        name="jenis"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Pilih Jenis Pegawai
                        </option>

                        <option
                            value="ASN"
                            @selected(
                                $pegawaiValue('jenis') === 'ASN'
                            )
                        >
                            ASN
                        </option>

                        <option
                            value="PPPK"
                            @selected(
                                $pegawaiValue('jenis') === 'PPPK'
                            )
                        >
                            PPPK
                        </option>

                        <option
                            value="Non-ASN"
                            @selected(
                                $pegawaiValue('jenis') === 'Non-ASN'
                            )
                        >
                            Non-ASN
                        </option>

                    </select>

                </div>


                {{-- NOMOR --}}

                <div class="form-group">

                    <label for="nomor">

                        NIP / NRP / TT

                        <span class="required">
                            *
                        </span>

                    </label>

                    <input
                        type="text"
                        id="nomor"
                        name="nomor"
                        class="form-control"
                        placeholder="Masukkan NIP / NRP / TT"
                        value="{{ $pegawaiValue('nomor') }}"
                        required
                    >

                    <span class="form-help">
                        Sesuaikan dengan jenis dan status kepegawaian.
                    </span>

                </div>


                {{-- NAMA --}}

                <div class="form-group full">

                    <label for="nama">

                        Nama Lengkap

                        <span class="required">
                            *
                        </span>

                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        placeholder="Masukkan nama lengkap pegawai"
                        value="{{ $pegawaiValue('nama') }}"
                        required
                    >

                </div>

            </div>

        </div>


        {{-- =========================================
             SECTION 2
        ========================================= --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    2
                </span>

                Data Kepegawaian

            </div>


            <div class="form-grid">


                {{-- GOLONGAN --}}

                <div class="form-group">

                    <label for="golongan">

                        Golongan

                        <span class="required">
                            *
                        </span>

                    </label>


                    <select
                        id="golongan"
                        name="golongan"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Pilih Golongan
                        </option>


                        @foreach (
                            [
                                'I/a',
                                'I/b',
                                'I/c',
                                'I/d',
                                'II/a',
                                'II/b',
                                'II/c',
                                'II/d',
                                'III/a',
                                'III/b',
                                'III/c',
                                'III/d',
                                'IV/a',
                                'IV/b',
                                'IV/c',
                                'IV/d',
                                'IV/e',
                                'IX'
                            ] as $golongan
                        )

                            <option
                                value="{{ $golongan }}"
                                @selected(
                                    $pegawaiValue('golongan') === $golongan
                                )
                            >
                                {{ $golongan }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- PANGKAT --}}

                <div class="form-group">

                    <label for="pangkat">

                        Pangkat

                        <span class="required">
                            *
                        </span>

                    </label>

                    <input
                        type="text"
                        id="pangkat"
                        name="pangkat"
                        class="form-control"
                        placeholder="Contoh: Penata"
                        value="{{ $pegawaiValue('pangkat') }}"
                        required
                    >

                </div>


                {{-- JABATAN --}}

                <div class="form-group full">

                    <label for="jabatan">

                        Jabatan

                        <span class="required">
                            *
                        </span>

                    </label>

                    <input
                        type="text"
                        id="jabatan"
                        name="jabatan"
                        class="form-control"
                        placeholder="Contoh: Kasi Pemerintahan"
                        value="{{ $pegawaiValue('jabatan') }}"
                        required
                    >

                </div>

            </div>

        </div>


        {{-- =========================================
             SECTION 3
        ========================================== --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    3
                </span>

                Keterangan

            </div>


            <div class="form-grid">

                <div class="form-group full">

                    <label for="keterangan">
                        Keterangan Tambahan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="form-control"
                        placeholder="Masukkan keterangan tambahan jika diperlukan..."
                    >{{ $pegawaiValue('keterangan') }}</textarea>

                    <span class="form-help">
                        Keterangan ini disimpan di database Kelurahan Binong.
                    </span>

                </div>

            </div>

        </div>


        {{-- =========================================
             INFO
        ========================================== --}}

        <div class="info-box">

            <div class="info-icon">
                i
            </div>

            <p>

                {{ $isEdit
                    ? 'Periksa kembali perubahan data pegawai sebelum menyimpan.'
                    : 'Pastikan data pegawai yang dimasukkan sudah benar sebelum menyimpan.'
                }}

            </p>

        </div>


        {{-- =========================================
             GOOGLE SHEETS
        ========================================== --}}

        <div class="sync-info">

            <div class="sync-icon">
                ✓
            </div>

            <p>

                <strong>
                    Sinkronisasi Google Sheets
                </strong>

                <br>

                {{ $isEdit
                    ? 'Setelah diperbarui, data akan otomatis disinkronkan ke Google Sheets pada tab DUK berdasarkan ID pegawai.'
                    : 'Setelah disimpan, data akan otomatis disinkronkan ke Google Sheets pada tab DUK.'
                }}

                <br>

                Jika sinkronisasi gagal, data tetap tersimpan di sistem Kelurahan Binong dan status sinkronisasi akan ditandai sebagai gagal.

            </p>

        </div>


    </div>


    {{-- =========================================
         FORM FOOTER
    ========================================== --}}

    <div class="form-footer">

        <div class="required-note">

            <span class="required">
                *
            </span>

            Wajib diisi

        </div>


        <div class="form-actions">

            <a
                href="{{ url('/dataumumpegawai') }}"
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
