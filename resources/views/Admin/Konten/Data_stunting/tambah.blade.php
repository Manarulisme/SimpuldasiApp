@php
$isEdit = $isEdit ?? false;

$stuntingValue = fn (
string $key,
mixed $default = ''
) => old(
$key,
data_get($stunting ?? null, $key, $default)
);
@endphp

@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Stunting - Kelurahan Binong')

@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Stunting')

@section('page_subtitle', 'Kesejahteraan Sosial · Data Stunting · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

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
    background: #fff;
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

<a href="{{ route('datastunting.index') }}">
    Data Stunting
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>

</div>

<div class="page-title-block">

<h2>
    {{ $isEdit ? 'Edit' : 'Tambah' }}
    Data Stunting
</h2>

<p>
    {{ $isEdit ? 'Perbarui' : 'Tambahkan' }}
    data stunting anak Kelurahan Binong.
</p>

</div>

<div class="form-card">

<div class="form-header">

<h3>
    {{ $isEdit ? 'Edit' : 'Form' }}
    Data Stunting
</h3>

<p>
    Lengkapi informasi pada kolom yang tersedia.
</p>

</div>

<form
    id="stuntingForm"
    method="POST"
    action="{{ $isEdit ? route('datastunting.update', $stunting->id) : route('datastunting.store') }}"
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

        Identitas Anak

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label for="nik">
                NIK
                <span class="required">*</span>
            </label>

            <input
                type="text"
                id="nik"
                name="nik"
                class="form-control"
                placeholder="Masukkan NIK"
                value="{{ $stuntingValue('nik') }}"
                maxlength="20"
                inputmode="numeric"
                required
            >

            @error('nik')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="form-group">

            <label for="nama">
                Nama Anak
                <span class="required">*</span>
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                class="form-control"
                placeholder="Nama lengkap anak"
                value="{{ $stuntingValue('nama') }}"
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

            <label for="tanggal_lahir">
                Tanggal Lahir
                <span class="required">*</span>
            </label>

            <input
                type="date"
                id="tanggal_lahir"
                name="tanggal_lahir"
                class="form-control"
                value="{{ $stuntingValue('tanggal_lahir') ? \Illuminate\Support\Carbon::parse($stuntingValue('tanggal_lahir'))->format('Y-m-d') : '' }}"
                required
            >

            @error('tanggal_lahir')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="form-group">

            <label for="jenis_kelamin">
                Jenis Kelamin
                <span class="required">*</span>
            </label>

            <select
                id="jenis_kelamin"
                name="jenis_kelamin"
                class="form-control"
                required
            >

                <option value="">
                    Pilih Jenis Kelamin
                </option>

                <option
                    value="Laki-laki"
                    @selected($stuntingValue('jenis_kelamin') === 'Laki-laki')
                >
                    Laki-laki
                </option>

                <option
                    value="Perempuan"
                    @selected($stuntingValue('jenis_kelamin') === 'Perempuan')
                >
                    Perempuan
                </option>

            </select>

            @error('jenis_kelamin')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

</div>

<div class="form-section">

    <div class="section-title">

        <span class="section-number">
            2
        </span>

        Data Pemantauan

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label for="usia">
                Usia
            </label>

            <input
                type="text"
                id="usia"
                class="form-control"
                placeholder="Otomatis dari tanggal lahir"
                readonly
            >

        </div>

        <div class="form-group">

            <label for="status">
                Status
                <span class="required">*</span>
            </label>

            <select
                id="status"
                name="status"
                class="form-control"
                required
            >

                <option value="">
                    Pilih Status
                </option>

                <option
                    value="Normal"
                    @selected($stuntingValue('status') === 'Normal')
                >
                    Normal
                </option>

                <option
                    value="Berisiko"
                    @selected($stuntingValue('status') === 'Berisiko')
                >
                    Berisiko
                </option>

                <option
                    value="Stunting"
                    @selected($stuntingValue('status') === 'Stunting')
                >
                    Stunting
                </option>

            </select>

            @error('status')
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
                placeholder="Keterangan atau catatan pemantauan"
            >{{ $stuntingValue('keterangan') }}</textarea>

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
        Pastikan data anak yang dimasukkan sudah benar.
        Data akan disimpan ke database Kelurahan Binong
        dan dapat diperbarui kembali melalui menu Edit Data.
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
        href="{{ route('datastunting.index') }}"
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

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const tanggalLahir = document.getElementById('tanggal_lahir');
    const usia = document.getElementById('usia');

    function updateUsia() {

        if (!tanggalLahir.value) {
            usia.value = '';
            return;
        }

        const tanggal = new Date(
            tanggalLahir.value + 'T00:00:00'
        );

        const hariIni = new Date();

        let tahun = hariIni.getFullYear() - tanggal.getFullYear();

        const bulan =
            hariIni.getMonth() - tanggal.getMonth();

        if (
            bulan < 0 ||
            (
                bulan === 0 &&
                hariIni.getDate() < tanggal.getDate()
            )
        ) {
            tahun--;
        }

        if (tahun >= 0) {
            usia.value = tahun + ' tahun';
        } else {
            usia.value = '';
        }
    }

    tanggalLahir.addEventListener(
        'change',
        updateUsia
    );

    updateUsia();

});
</script>

@endpush
