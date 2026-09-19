@php
$isEdit = $isEdit ?? false;

$rutilahuValue = fn (
string $key,
mixed $default = ''
) => old(
$key,
data_get($dataRutilahu ?? null, $key, $default)
);
@endphp

@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Rutilahu - Kelurahan Binong')

@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Rutilahu')

@section('page_subtitle', 'Perekonomian · Data Rutilahu · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

@push('styles')

<style>
.rutilahu-page {
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

<div class="rutilahu-page">

<div class="breadcrumb">


<a href="{{ route('dashboard') }}">
    Beranda
</a>

<span>›</span>

<a href="{{ route('datarutilahu.index') }}">
    Data Rutilahu
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>


</div>

<div class="page-title-block">


<h2>
    {{ $isEdit ? 'Edit' : 'Tambah' }} Data Rutilahu
</h2>

<p>
    {{ $isEdit ? 'Perbarui' : 'Tambahkan' }}
    data Rumah Tidak Layak Huni Kelurahan Binong.
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
        {{ $isEdit ? 'Edit' : 'Form' }} Data Rutilahu
    </h3>

    <p>
        Lengkapi informasi data rumah tidak layak huni pada kolom yang tersedia.
    </p>

</div>


<form
    id="rutilahuForm"
    method="POST"
    action="{{ $isEdit ? route('datarutilahu.update', ['datarutilahu' => $dataRutilahu->id]) : route('datarutilahu.store') }}"
>

    @csrf

    @if($isEdit)
        @method('PUT')
    @endif


    <div class="form-body">


        {{-- ====================================================== --}}
        {{-- 1. IDENTITAS KEPALA KELUARGA --}}
        {{-- ====================================================== --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    1
                </span>

                Identitas Kepala Keluarga

            </div>


            <div class="form-grid">


                <div class="form-group">

                    <label for="nama_kepala_keluarga">

                        Nama Kepala Keluarga

                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        id="nama_kepala_keluarga"
                        name="nama_kepala_keluarga"
                        class="form-control"
                        placeholder="Contoh: Asep Supriatna"
                        value="{{ $rutilahuValue('nama_kepala_keluarga') }}"
                        maxlength="255"
                        required
                    >

                    @error('nama_kepala_keluarga')

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
                        value="{{ $rutilahuValue('nik') }}"
                        maxlength="20"
                        inputmode="numeric"
                    >

                    @error('nik')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- 2. ALAMAT TEMPAT TINGGAL --}}
        {{-- ====================================================== --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    2
                </span>

                Alamat Tempat Tinggal

            </div>


            <div class="form-grid">


                <div class="form-group full">

                    <label for="alamat">
                        Alamat
                    </label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        class="form-control"
                        placeholder="Masukkan alamat lengkap tempat tinggal"
                    >{{ $rutilahuValue('alamat') }}</textarea>

                    @error('alamat')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <div class="form-group">

                    <label for="rt">
                        RT
                    </label>

                    <input
                        type="text"
                        id="rt"
                        name="rt"
                        class="form-control"
                        placeholder="Contoh: 001"
                        value="{{ $rutilahuValue('rt') }}"
                        maxlength="5"
                        inputmode="numeric"
                    >

                    @error('rt')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <div class="form-group">

                    <label for="rw">
                        RW
                    </label>

                    <input
                        type="text"
                        id="rw"
                        name="rw"
                        class="form-control"
                        placeholder="Contoh: 005"
                        value="{{ $rutilahuValue('rw') }}"
                        maxlength="5"
                        inputmode="numeric"
                    >

                    @error('rw')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- 3. KONDISI RUMAH --}}
        {{-- ====================================================== --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    3
                </span>

                Kondisi Rumah

            </div>


            <div class="form-grid">


                <div class="form-group">

                    <label for="kondisi_rumah">
                        Kondisi Rumah
                    </label>

                    <select
                        id="kondisi_rumah"
                        name="kondisi_rumah"
                        class="form-control"
                    >

                        <option value="">
                            Pilih Kondisi Rumah
                        </option>

                        <option
                            value="Baik"
                            @selected($rutilahuValue('kondisi_rumah') === 'Baik')
                        >
                            Baik
                        </option>

                        <option
                            value="Sedang"
                            @selected($rutilahuValue('kondisi_rumah') === 'Sedang')
                        >
                            Sedang
                        </option>

                        <option
                            value="Rusak"
                            @selected($rutilahuValue('kondisi_rumah') === 'Rusak')
                        >
                            Rusak
                        </option>

                    </select>

                    @error('kondisi_rumah')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <div class="form-group">

                    <label for="tingkat_prioritas">
                        Tingkat Prioritas
                    </label>

                    <select
                        id="tingkat_prioritas"
                        name="tingkat_prioritas"
                        class="form-control"
                    >

                        <option value="">
                            Pilih Tingkat Prioritas
                        </option>

                        <option
                            value="Tinggi"
                            @selected($rutilahuValue('tingkat_prioritas') === 'Tinggi')
                        >
                            Tinggi
                        </option>

                        <option
                            value="Sedang"
                            @selected($rutilahuValue('tingkat_prioritas') === 'Sedang')
                        >
                            Sedang
                        </option>

                        <option
                            value="Rendah"
                            @selected($rutilahuValue('tingkat_prioritas') === 'Rendah')
                        >
                            Rendah
                        </option>

                    </select>

                    @error('tingkat_prioritas')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- 4. STATUS BANTUAN --}}
        {{-- ====================================================== --}}

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    4
                </span>

                Status Bantuan

            </div>


            <div class="form-grid">


                <div class="form-group full">

                    <label for="status_bantuan">
                        Status Bantuan
                    </label>

                    <select
                        id="status_bantuan"
                        name="status_bantuan"
                        class="form-control"
                    >

                        <option value="">
                            Pilih Status Bantuan
                        </option>

                        <option
                            value="Sudah Mendapatkan"
                            @selected($rutilahuValue('status_bantuan') === 'Sudah Mendapatkan')
                        >
                            Sudah Mendapatkan
                        </option>

                        <option
                            value="Dalam Proses"
                            @selected($rutilahuValue('status_bantuan') === 'Dalam Proses')
                        >
                            Dalam Proses
                        </option>

                        <option
                            value="Belum Mendapatkan"
                            @selected($rutilahuValue('status_bantuan') === 'Belum Mendapatkan')
                        >
                            Belum Mendapatkan
                        </option>

                    </select>

                    @error('status_bantuan')

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
                Pastikan data Rutilahu yang dimasukkan sudah benar sebelum menyimpan.
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
                href="{{ route('datarutilahu.index') }}"
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
