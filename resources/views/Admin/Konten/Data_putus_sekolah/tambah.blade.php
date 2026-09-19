@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit Data Anak Putus Sekolah' : 'Tambah Data Anak Putus Sekolah') . ' - Kelurahan Binong')

@section('page_title', $isEdit ? 'Edit Data Anak Putus Sekolah' : 'Tambah Data Anak Putus Sekolah')

@section('page_subtitle', 'Kesejahteraan Sosial · Data Anak Putus Sekolah')

@php
$isEdit = $isEdit ?? false;
$putusSekolah = $putusSekolah ?? null;


$value = function ($field, $default = '') use ($putusSekolah) {
    return old($field, data_get($putusSekolah, $field, $default));
};


@endphp

@push('styles')

<style>
    .form-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 22px;
        font-size: 13px;
        color: #7a858d;
        flex-wrap: wrap;
    }

    .breadcrumb a {
        color: #087443;
        text-decoration: none;
        font-weight: 600;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb-separator {
        color: #aab2b7;
    }

    .page-heading {
        margin-bottom: 24px;
    }

    .page-heading h1 {
        margin: 0 0 7px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 30px;
        line-height: 1.25;
        color: #18364d;
        font-weight: 700;
    }

    .page-heading p {
        margin: 0;
        color: #7a858d;
        font-size: 14px;
    }

    .form-card {
        background: #ffffff;
        border: 1px solid #e7ebee;
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(16, 47, 71, 0.06);
        overflow: hidden;
    }

    .form-section {
        padding: 26px 28px;
        border-bottom: 1px solid #edf0f2;
    }

    .form-section:last-of-type {
        border-bottom: none;
    }

    .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 22px;
    }

    .section-number {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 9px;
        background: #eaf5ef;
        color: #087443;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
    }

    .section-heading h2 {
        margin: 0 0 4px;
        color: #18364d;
        font-size: 17px;
        font-weight: 700;
    }

    .section-heading p {
        margin: 0;
        color: #7a858d;
        font-size: 13px;
        line-height: 1.5;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        margin-bottom: 8px;
        color: #263238;
        font-size: 13px;
        font-weight: 700;
    }

    .required {
        color: #dc3545;
    }

    .form-control,
    .form-select {
        width: 100%;
        min-height: 44px;
        padding: 10px 13px;
        border: 1px solid #dce2e6;
        border-radius: 8px;
        background: #ffffff;
        color: #263238;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
        box-sizing: border-box;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #087443;
        box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.10);
    }

    .form-control::placeholder {
        color: #a3adb4;
    }

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
        line-height: 1.5;
    }

    .form-help {
        margin-top: 6px;
        color: #8a949b;
        font-size: 12px;
        line-height: 1.45;
    }

    .input-with-prefix {
        position: relative;
    }

    .input-with-prefix .form-control {
        padding-left: 48px;
    }

    .input-prefix {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #087443;
        font-size: 13px;
        font-weight: 700;
        pointer-events: none;
    }

    .info-box {
        margin-top: 22px;
        padding: 14px 16px;
        border: 1px solid #d8ebe1;
        border-radius: 10px;
        background: #f3faf6;
        display: flex;
        align-items: flex-start;
        gap: 11px;
    }

    .info-icon {
        width: 24px;
        height: 24px;
        min-width: 24px;
        border-radius: 50%;
        background: #087443;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }

    .info-box strong {
        display: block;
        margin-bottom: 3px;
        color: #18364d;
        font-size: 13px;
    }

    .info-box span {
        color: #66747d;
        font-size: 12px;
        line-height: 1.5;
    }

    .error-message {
        margin-top: 6px;
        color: #dc3545;
        font-size: 12px;
    }

    .has-error {
        border-color: #dc3545 !important;
    }

    .form-footer {
        padding: 20px 28px;
        background: #fafbfb;
        border-top: 1px solid #edf0f2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .footer-note {
        color: #8a949b;
        font-size: 12px;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn {
        min-height: 42px;
        padding: 9px 17px;
        border-radius: 8px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        cursor: pointer;
        transition: all .2s ease;
        box-sizing: border-box;
    }

    .btn-secondary {
        background: #ffffff;
        color: #52616a;
        border: 1px solid #dce2e6;
    }

    .btn-secondary:hover {
        background: #f5f7f8;
        border-color: #cbd3d8;
    }

    .btn-primary {
        background: #087443;
        color: #ffffff;
        border: 1px solid #087443;
        box-shadow: 0 2px 5px rgba(8, 116, 67, 0.16);
    }

    .btn-primary:hover {
        background: #075f37;
        border-color: #075f37;
    }

    .alert-error {
        margin-bottom: 20px;
        padding: 14px 16px;
        border-radius: 10px;
        background: #fff4f4;
        border: 1px solid #f2caca;
        color: #a52626;
        font-size: 13px;
    }

    .alert-error strong {
        display: block;
        margin-bottom: 5px;
    }

    .alert-error ul {
        margin: 5px 0 0 18px;
        padding: 0;
    }

    @media (max-width: 768px) {
        .page-heading h1 {
            font-size: 25px;
        }

        .form-section {
            padding: 22px 18px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 17px;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-footer {
            padding: 18px;
            flex-direction: column;
            align-items: stretch;
        }

        .footer-note {
            text-align: center;
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

<div class="form-page">


<div class="breadcrumb">
    <a href="{{ route('dashboard') }}">Beranda</a>
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('dataputussekolah.index') }}">Data Anak Putus Sekolah</a>
    <span class="breadcrumb-separator">›</span>
    <span>{{ $isEdit ? 'Edit Data' : 'Tambah Data' }}</span>
</div>

<div class="page-heading">
    <h1>{{ $isEdit ? 'Edit Data Anak Putus Sekolah' : 'Tambah Data Anak Putus Sekolah' }}</h1>
    <p>
        {{ $isEdit
            ? 'Perbarui informasi anak putus sekolah di Kelurahan Binong.'
            : 'Tambahkan data anak putus sekolah di Kelurahan Binong.' }}
    </p>
</div>

@if ($errors->any())
    <div class="alert-error">
        <strong>Data belum dapat disimpan.</strong>
        Silakan periksa kembali isian berikut:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ $isEdit
        ? route('dataputussekolah.update', $putusSekolah->id)
        : route('dataputussekolah.store') }}"
    method="POST"
>

    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="form-card">

        {{-- SECTION 1 --}}
        <div class="form-section">

            <div class="section-heading">
                <div class="section-number">01</div>
                <div>
                    <h2>Identitas Anak</h2>
                    <p>Informasi dasar anak yang tercatat dalam data kelurahan.</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label" for="id_data">
                        ID Data <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="id_data"
                        name="id_data"
                        class="form-control @error('id_data') has-error @enderror"
                        value="{{ $value('id_data') }}"
                        placeholder="Contoh: APS-001"
                        maxlength="50"
                        required
                    >

                    <div class="form-help">
                        Gunakan ID unik untuk setiap data anak putus sekolah.
                    </div>

                    @error('id_data')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="nik">
                        NIK <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="nik"
                        name="nik"
                        class="form-control @error('nik') has-error @enderror"
                        value="{{ $value('nik') }}"
                        placeholder="Masukkan NIK"
                        maxlength="20"
                        inputmode="numeric"
                        required
                    >

                    <div class="form-help">
                        Masukkan Nomor Induk Kependudukan sesuai dokumen kependudukan.
                    </div>

                    @error('nik')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="nama">
                        Nama Anak <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control @error('nama') has-error @enderror"
                        value="{{ $value('nama') }}"
                        placeholder="Masukkan nama lengkap anak"
                        maxlength="150"
                        required
                    >

                    @error('nama')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="rw">
                        RW
                    </label>

                    <input
                        type="text"
                        id="rw"
                        name="rw"
                        class="form-control @error('rw') has-error @enderror"
                        value="{{ $value('rw') }}"
                        placeholder="Contoh: RW 05"
                        maxlength="10"
                    >

                    <div class="form-help">
                        Isi sesuai wilayah RW tempat tinggal anak.
                    </div>

                    @error('rw')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="usia">
                        Usia <span class="required">*</span>
                    </label>

                    <div class="input-with-prefix">
                        <span class="input-prefix">Usia</span>

                        <input
                            type="number"
                            id="usia"
                            name="usia"
                            class="form-control @error('usia') has-error @enderror"
                            value="{{ $value('usia') }}"
                            placeholder="Masukkan usia"
                            min="1"
                            max="30"
                            required
                        >
                    </div>

                    <div class="form-help">
                        Usia anak saat data dicatat, dalam tahun.
                    </div>

                    @error('usia')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="jenjang_terakhir">
                        Jenjang Terakhir <span class="required">*</span>
                    </label>

                    <select
                        id="jenjang_terakhir"
                        name="jenjang_terakhir"
                        class="form-select @error('jenjang_terakhir') has-error @enderror"
                        required
                    >
                        <option value="">Pilih jenjang terakhir</option>

                        <option value="SD Kelas 1" {{ $value('jenjang_terakhir') === 'SD Kelas 1' ? 'selected' : '' }}>
                            SD Kelas 1
                        </option>

                        <option value="SD Kelas 2" {{ $value('jenjang_terakhir') === 'SD Kelas 2' ? 'selected' : '' }}>
                            SD Kelas 2
                        </option>

                        <option value="SD Kelas 3" {{ $value('jenjang_terakhir') === 'SD Kelas 3' ? 'selected' : '' }}>
                            SD Kelas 3
                        </option>

                        <option value="SD Kelas 4" {{ $value('jenjang_terakhir') === 'SD Kelas 4' ? 'selected' : '' }}>
                            SD Kelas 4
                        </option>

                        <option value="SD Kelas 5" {{ $value('jenjang_terakhir') === 'SD Kelas 5' ? 'selected' : '' }}>
                            SD Kelas 5
                        </option>

                        <option value="SD Kelas 6" {{ $value('jenjang_terakhir') === 'SD Kelas 6' ? 'selected' : '' }}>
                            SD Kelas 6
                        </option>

                        <option value="SMP Kelas 7" {{ $value('jenjang_terakhir') === 'SMP Kelas 7' ? 'selected' : '' }}>
                            SMP Kelas 7
                        </option>

                        <option value="SMP Kelas 8" {{ $value('jenjang_terakhir') === 'SMP Kelas 8' ? 'selected' : '' }}>
                            SMP Kelas 8
                        </option>

                        <option value="SMP Kelas 9" {{ $value('jenjang_terakhir') === 'SMP Kelas 9' ? 'selected' : '' }}>
                            SMP Kelas 9
                        </option>

                        <option value="SMA/SMK Kelas 10" {{ $value('jenjang_terakhir') === 'SMA/SMK Kelas 10' ? 'selected' : '' }}>
                            SMA/SMK Kelas 10
                        </option>

                        <option value="SMA/SMK Kelas 11" {{ $value('jenjang_terakhir') === 'SMA/SMK Kelas 11' ? 'selected' : '' }}>
                            SMA/SMK Kelas 11
                        </option>

                        <option value="SMA/SMK Kelas 12" {{ $value('jenjang_terakhir') === 'SMA/SMK Kelas 12' ? 'selected' : '' }}>
                            SMA/SMK Kelas 12
                        </option>

                        <option value="Tidak Tamat SD" {{ $value('jenjang_terakhir') === 'Tidak Tamat SD' ? 'selected' : '' }}>
                            Tidak Tamat SD
                        </option>

                        <option value="Tidak Tamat SMP" {{ $value('jenjang_terakhir') === 'Tidak Tamat SMP' ? 'selected' : '' }}>
                            Tidak Tamat SMP
                        </option>

                        <option value="Tidak Tamat SMA/SMK" {{ $value('jenjang_terakhir') === 'Tidak Tamat SMA/SMK' ? 'selected' : '' }}>
                            Tidak Tamat SMA/SMK
                        </option>
                    </select>

                    @error('jenjang_terakhir')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

            </div>

        </div>

        {{-- SECTION 2 --}}
        <div class="form-section">

            <div class="section-heading">
                <div class="section-number">02</div>
                <div>
                    <h2>Data Putus Sekolah</h2>
                    <p>Informasi mengenai kondisi dan alasan anak tidak melanjutkan pendidikan.</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group full">
                    <label class="form-label" for="alasan">
                        Alasan Putus Sekolah <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="alasan"
                        name="alasan"
                        class="form-control @error('alasan') has-error @enderror"
                        value="{{ $value('alasan') }}"
                        placeholder="Contoh: Kondisi ekonomi keluarga"
                        maxlength="255"
                        required
                    >

                    <div class="form-help">
                        Jelaskan alasan utama anak berhenti atau tidak melanjutkan sekolah.
                    </div>

                    @error('alasan')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label" for="keterangan">
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="form-control @error('keterangan') has-error @enderror"
                        placeholder="Tambahkan keterangan atau informasi lain yang diperlukan"
                    >{{ $value('keterangan') }}</textarea>

                    <div class="form-help">
                        Kolom ini dapat digunakan untuk mencatat informasi tambahan terkait kondisi anak.
                    </div>

                    @error('keterangan')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="info-box">
                <div class="info-icon">i</div>
                <div>
                    <strong>Informasi Data</strong>
                    <span>
                        Pastikan data yang dimasukkan sesuai dengan kondisi dan informasi
                        terbaru yang dimiliki Kelurahan Binong.
                    </span>
                </div>
            </div>

        </div>

        {{-- FOOTER --}}
        <div class="form-footer">

            <div class="footer-note">
                <span class="required">*</span> Wajib diisi
            </div>

            <div class="form-actions">

                <a
                    href="{{ route('dataputussekolah.index') }}"
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

    </div>

</form>


</div>

@endsection
