@php
$isEdit = $isEdit ?? false;


$kpmValue = fn (string $key, mixed $default = '') =>
    old($key, data_get($kpm ?? null, $key, $default));


@endphp

@extends('Admin.Layout.master')

@section(
'title',
($isEdit ? 'Edit Data KPM / Bantuan Sosial' : 'Tambah Data KPM / Bantuan Sosial')
. ' - Kelurahan Binong'
)

@section(
'page_title',
$isEdit ? 'Edit Data KPM / Bantuan Sosial' : 'Tambah Data KPM / Bantuan Sosial'
)

@section(
'page_subtitle',
'Kesejahteraan Sosial · KPM / Bantuan Sosial'
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
        transition: border-color .2s, box-shadow .2s;
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
        color: var(--primary);
        font-size: 14px;
        line-height: 1;
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

<a href="{{ route('datakpm.index') }}">
    Data KPM / Bantuan Sosial
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>


</div>

<div class="page-title-block">


<h2>
    {{ $isEdit ? 'Edit Data KPM / Bantuan Sosial' : 'Tambah Data KPM / Bantuan Sosial' }}
</h2>

<p>
    {{ $isEdit
        ? 'Perbarui informasi penerima bantuan sosial Kelurahan Binong.'
        : 'Tambahkan data penerima bantuan sosial Kelurahan Binong.'
    }}
</p>


</div>

<section class="form-card">


<div class="form-header">

    <h3>
        {{ $isEdit ? 'Form Edit Data KPM' : 'Form Data KPM' }}
    </h3>

    <p>
        Lengkapi informasi penerima bantuan sosial dengan data yang sesuai.
    </p>

</div>

<form
    action="{{ $isEdit
        ? route('datakpm.update', $kpm->id)
        : route('datakpm.store')
    }}"
    method="POST"
>

    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="form-body">

        {{-- ========================================= --}}
        {{-- 1. IDENTITAS KPM --}}
        {{-- ========================================= --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    1
                </span>

                Identitas KPM

            </div>

            <div class="form-grid">

                <div class="form-group">

                    <label class="form-label">
                        ID Data KPM
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="id_data"
                        class="form-control"
                        value="{{ $kpmValue('id_data') }}"
                        placeholder="Contoh: KPM-001"
                        required
                    >

                    <span class="form-help">
                        ID unik untuk membedakan setiap data KPM.
                    </span>

                    @error('id_data')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label">
                        NIK
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="nik"
                        class="form-control"
                        value="{{ $kpmValue('nik') }}"
                        placeholder="Masukkan NIK"
                        maxlength="20"
                        required
                    >

                    <span class="form-help">
                        Masukkan NIK sesuai dokumen kependudukan.
                    </span>

                    @error('nik')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div class="form-group full-width">

                    <label class="form-label">
                        Nama KPM
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ $kpmValue('nama') }}"
                        placeholder="Masukkan nama lengkap penerima bantuan"
                        required
                    >

                    @error('nama')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label">
                        Alamat RW
                    </label>

                    <input
                        type="text"
                        name="rw"
                        class="form-control"
                        value="{{ $kpmValue('rw') }}"
                        placeholder="Contoh: 05"
                        maxlength="10"
                    >

                    <span class="form-help">
                        Isi nomor RW tempat tinggal KPM.
                    </span>

                    @error('rw')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

        </div>

        {{-- ========================================= --}}
        {{-- 2. DATA BANTUAN SOSIAL --}}
        {{-- ========================================= --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    2
                </span>

                Data Bantuan Sosial

            </div>

            <div class="form-grid">

                <div class="form-group">

                    <label class="form-label">
                        Jenis Bantuan
                        <span class="required">*</span>
                    </label>

                    <select
                        name="jenis_bantuan"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Pilih jenis bantuan
                        </option>

                        <option
                            value="PKH"
                            {{ $kpmValue('jenis_bantuan') === 'PKH' ? 'selected' : '' }}
                        >
                            PKH
                        </option>

                        <option
                            value="BPNT"
                            {{ $kpmValue('jenis_bantuan') === 'BPNT' ? 'selected' : '' }}
                        >
                            BPNT
                        </option>

                        <option
                            value="Bantuan Pangan"
                            {{ $kpmValue('jenis_bantuan') === 'Bantuan Pangan' ? 'selected' : '' }}
                        >
                            Bantuan Pangan
                        </option>

                        <option
                            value="Bantuan Sosial Lainnya"
                            {{ $kpmValue('jenis_bantuan') === 'Bantuan Sosial Lainnya' ? 'selected' : '' }}
                        >
                            Bantuan Sosial Lainnya
                        </option>

                    </select>

                    @error('jenis_bantuan')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div class="form-group">

                    <label class="form-label">
                        Desil
                    </label>

                    <select
                        name="desil"
                        class="form-control"
                    >

                        <option value="">
                            Pilih desil
                        </option>

                        @for ($i = 1; $i <= 10; $i++)

                            <option
                                value="{{ $i }}"
                                {{ (string) $kpmValue('desil') === (string) $i ? 'selected' : '' }}
                            >
                                Desil {{ $i }}
                            </option>

                        @endfor

                    </select>

                    <span class="form-help">
                        Pilih desil sesuai data kesejahteraan yang tersedia.
                    </span>

                    @error('desil')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div class="form-group full-width">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        placeholder="Tambahkan keterangan jika diperlukan..."
                    >{{ $kpmValue('keterangan') }}</textarea>

                    @error('keterangan')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

        </div>

        <div class="info-box">

            <div class="info-icon">
                ●
            </div>

            <p>
                Data KPM akan disimpan ke database Kelurahan Binong.
                Data yang telah tersimpan dapat diperbarui melalui menu Ubah Data.
            </p>

        </div>

    </div>

    <div class="form-footer">

        <a
            href="{{ route('datakpm.index') }}"
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
