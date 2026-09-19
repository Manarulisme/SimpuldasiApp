@php
$isEdit = $isEdit ?? false;

$pendudukValue = fn (
string $key,
mixed $default = ''
) => old(
$key,
data_get($dataLaporanPenduduk ?? null, $key, $default)
);
@endphp

@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Laporan Penduduk - Kelurahan Binong')

@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Laporan Penduduk')

@section('page_subtitle', 'Kependudukan · Laporan Penduduk · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

@push('styles')

<style>
.laporan-penduduk-page {
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

<div class="laporan-penduduk-page">

<div class="breadcrumb">

<a href="{{ route('dashboard') }}">
    Beranda
</a>

<span>›</span>

<a href="{{ route('datalaporanpenduduk.index') }}">
    Laporan Penduduk
</a>

<span>›</span>

<span>
    {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
</span>

</div>

<div class="page-title-block">

<h2>
    {{ $isEdit ? 'Edit' : 'Tambah' }} Data Laporan Penduduk
</h2>

<p>
    {{ $isEdit ? 'Perbarui' : 'Tambahkan' }}
    data laporan kependudukan Kelurahan Binong.
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
    {{ $isEdit ? 'Edit' : 'Form' }} Data Laporan Penduduk
</h3>

<p>
    Lengkapi data laporan kependudukan berdasarkan periode yang tersedia.
</p>

</div>

<form
    id="laporanPendudukForm"
    method="POST"
    action="{{ $isEdit ? route('datalaporanpenduduk.update', ['datalaporanpenduduk' => $dataLaporanPenduduk->id]) : route('datalaporanpenduduk.store') }}"
>

@csrf

@if($isEdit)
@method('PUT')
@endif

<div class="form-body">

{{-- ====================================================== --}}
{{-- 1. PERIODE LAPORAN --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    1
</span>

Periode Laporan

</div>

<div class="form-grid">

<div class="form-group">

<label for="bulan">

Bulan

<span class="required">*</span>

</label>

<select
id="bulan"
name="bulan"
class="form-control"
required

>

<option value="">
    Pilih Bulan
</option>

<option
    value="Januari"
    {{ $pendudukValue('bulan') === 'Januari' ? 'selected' : '' }}
>
    Januari
</option>

<option
    value="Februari"
    {{ $pendudukValue('bulan') === 'Februari' ? 'selected' : '' }}
>
    Februari
</option>

<option
    value="Maret"
    {{ $pendudukValue('bulan') === 'Maret' ? 'selected' : '' }}
>
    Maret
</option>

<option
    value="April"
    {{ $pendudukValue('bulan') === 'April' ? 'selected' : '' }}
>
    April
</option>

<option
    value="Mei"
    {{ $pendudukValue('bulan') === 'Mei' ? 'selected' : '' }}
>
    Mei
</option>

<option
    value="Juni"
    {{ $pendudukValue('bulan') === 'Juni' ? 'selected' : '' }}
>
    Juni
</option>

<option
    value="Juli"
    {{ $pendudukValue('bulan') === 'Juli' ? 'selected' : '' }}
>
    Juli
</option>

<option
    value="Agustus"
    {{ $pendudukValue('bulan') === 'Agustus' ? 'selected' : '' }}
>
    Agustus
</option>

<option
    value="September"
    {{ $pendudukValue('bulan') === 'September' ? 'selected' : '' }}
>
    September
</option>

<option
    value="Oktober"
    {{ $pendudukValue('bulan') === 'Oktober' ? 'selected' : '' }}
>
    Oktober
</option>

<option
    value="November"
    {{ $pendudukValue('bulan') === 'November' ? 'selected' : '' }}
>
    November
</option>

<option
    value="Desember"
    {{ $pendudukValue('bulan') === 'Desember' ? 'selected' : '' }}
>
    Desember
</option>

</select>

@error('bulan')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="tahun">

Tahun

<span class="required">*</span>

</label>

<input
type="number"
id="tahun"
name="tahun"
class="form-control"
placeholder="Contoh: 2026"
value="{{ $pendudukValue('tahun') }}"
min="2000"
max="2100"
required

>

@error('tahun')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

</div>

</div>

{{-- ====================================================== --}}
{{-- 2. DATA KEPALA KELUARGA & JENIS KELAMIN --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    2
</span>

Data Kependudukan

</div>

<div class="form-grid">

<div class="form-group">

<label for="jumlah_kk">

Jumlah Kepala Keluarga

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_kk"
name="jumlah_kk"
class="form-control"
placeholder="Contoh: 1250"
value="{{ $pendudukValue('jumlah_kk', 0) }}"
min="0"
required

>

@error('jumlah_kk')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="jumlah_laki_laki">

Jumlah Laki-Laki

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_laki_laki"
name="jumlah_laki_laki"
class="form-control"
placeholder="Contoh: 1985"
value="{{ $pendudukValue('jumlah_laki_laki', 0) }}"
min="0"
required

>

@error('jumlah_laki_laki')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="jumlah_perempuan">

Jumlah Perempuan

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_perempuan"
name="jumlah_perempuan"
class="form-control"
placeholder="Contoh: 2010"
value="{{ $pendudukValue('jumlah_perempuan', 0) }}"
min="0"
required

>

@error('jumlah_perempuan')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

</div>

</div>

{{-- ====================================================== --}}
{{-- 3. PERUBAHAN DATA PENDUDUK --}}
{{-- ====================================================== --}}

<div class="form-section">

<div class="section-title">

<span class="section-number">
    3
</span>

Perubahan Data Penduduk

</div>

<div class="form-grid">

<div class="form-group">

<label for="jumlah_kematian">

Jumlah Kematian

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_kematian"
name="jumlah_kematian"
class="form-control"
placeholder="Contoh: 8"
value="{{ $pendudukValue('jumlah_kematian', 0) }}"
min="0"
required

>

@error('jumlah_kematian')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="jumlah_kelahiran">

Jumlah Kelahiran

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_kelahiran"
name="jumlah_kelahiran"
class="form-control"
placeholder="Contoh: 15"
value="{{ $pendudukValue('jumlah_kelahiran', 0) }}"
min="0"
required

>

@error('jumlah_kelahiran')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="jumlah_pindah_datang">

Pindah Datang

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_pindah_datang"
name="jumlah_pindah_datang"
class="form-control"
placeholder="Contoh: 12"
value="{{ $pendudukValue('jumlah_pindah_datang', 0) }}"
min="0"
required

>

@error('jumlah_pindah_datang')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="jumlah_pindah_keluar">

Pindah Keluar

<span class="required">*</span>

</label>

<input
type="number"
id="jumlah_pindah_keluar"
name="jumlah_pindah_keluar"
class="form-control"
placeholder="Contoh: 10"
value="{{ $pendudukValue('jumlah_pindah_keluar', 0) }}"
min="0"
required

>

@error('jumlah_pindah_keluar')

<div class="error-message">
    {{ $message }}
</div>

@enderror

</div>

<div class="form-group">

<label for="penduduk_sementara">

Penduduk Sementara

<span class="required">*</span>

</label>

<input
type="number"
id="penduduk_sementara"
name="penduduk_sementara"
class="form-control"
placeholder="Contoh: 5"
value="{{ $pendudukValue('penduduk_sementara', 0) }}"
min="0"
required

>

@error('penduduk_sementara')

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
placeholder="Tambahkan keterangan atau informasi tambahan mengenai laporan ini..."
>{{ $pendudukValue('keterangan') }}</textarea>

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
    Pastikan data laporan penduduk yang dimasukkan sudah benar sebelum menyimpan.
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
href="{{ route('datalaporanpenduduk.index') }}"
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
