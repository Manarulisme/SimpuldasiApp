@php
$isEdit = $isEdit ?? false;


$posyanduValue = fn (
    string $key,
    mixed $default = ''
) => old(
    $key,
    data_get($posyandu ?? null, $key, $default)
);


@endphp

@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Posyandu & Posbindu - Kelurahan Binong')

@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Posyandu & Posbindu')

@section('page_subtitle', 'Kesejahteraan Sosial · Posyandu & Posbindu · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

@push('styles')

<style>
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
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.08);
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

<div class="breadcrumb">


<a href="{{ route('dashboard') }}">
    Beranda
</a>

<span>›</span>

<a href="{{ route('dataposyandu.index') }}">
    Posyandu & Posbindu
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>


</div>

<div class="page-title-block">


<h2>
    {{ $isEdit ? 'Edit' : 'Tambah' }}
    Data Posyandu & Posbindu
</h2>

<p>
    {{ $isEdit ? 'Perbarui' : 'Tambahkan' }}
    data Posyandu atau Posbindu Kelurahan Binong.
</p>


</div>

<div class="form-card">


<div class="form-header">

    <h3>
        {{ $isEdit ? 'Edit' : 'Form' }}
        Data Posyandu & Posbindu
    </h3>

    <p>
        Lengkapi informasi pada kolom yang tersedia.
    </p>

</div>


<form
    id="posyanduForm"
    method="POST"
    action="{{ $isEdit ? route('dataposyandu.update', $posyandu->id) : route('dataposyandu.store') }}"
>

    @csrf

    @if($isEdit)
        @method('PUT')
    @endif


    <div class="form-body">

        <div class="form-section">

            <div class="section-title">

                <span class="section-number">
                    1
                </span>

                Data Posyandu & Posbindu

            </div>


            <div class="form-grid">


                <div class="form-group">

                    <label for="id_data">
                        ID Data
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="id_data"
                        name="id_data"
                        class="form-control"
                        placeholder="Contoh: PSY-001"
                        value="{{ $posyanduValue('id_data') }}"
                        maxlength="50"
                        required
                    >

                    @error('id_data')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="jenis">
                        Jenis
                        <span class="required">*</span>
                    </label>

                    <select
                        id="jenis"
                        name="jenis"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Pilih Jenis
                        </option>

                        <option
                            value="Posyandu"
                            @selected($posyanduValue('jenis') === 'Posyandu')
                        >
                            Posyandu
                        </option>

                        <option
                            value="Posbindu"
                            @selected($posyanduValue('jenis') === 'Posbindu')
                        >
                            Posbindu
                        </option>

                    </select>

                    @error('jenis')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="nama">
                        Nama
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        placeholder="Nama Posyandu atau Posbindu"
                        value="{{ $posyanduValue('nama') }}"
                        maxlength="150"
                        required
                    >

                    @error('nama')
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
                        placeholder="Contoh: 05"
                        value="{{ $posyanduValue('rw') }}"
                        maxlength="10"
                    >

                    @error('rw')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="jumlah_kader">
                        Jumlah Kader
                        <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        id="jumlah_kader"
                        name="jumlah_kader"
                        class="form-control"
                        min="0"
                        placeholder="Contoh: 8"
                        value="{{ $posyanduValue('jumlah_kader', 0) }}"
                        required
                    >

                    @error('jumlah_kader')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group full">

                    <label for="keterangan">
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="form-control"
                        placeholder="Keterangan tambahan"
                    >{{ $posyanduValue('keterangan') }}</textarea>

                    @error('keterangan')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


            </div>

        </div>


        <div class="info-box">

            <div class="info-icon">
                i
            </div>

            <p>
                Pastikan data Posyandu atau Posbindu yang
                dimasukkan sudah benar sebelum menyimpan.
                Data akan disimpan ke database dan
                disinkronkan ke Google Sheets.
            </p>

        </div>


    </div>


    <div class="form-footer">

        <span>
            <span class="required">*</span>
            Wajib diisi
        </span>


        <div class="form-actions">

            <a
                href="{{ route('dataposyandu.index') }}"
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

@endsection
