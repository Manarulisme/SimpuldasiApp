@php
$isEdit = $isEdit ?? false;

$umkmValue = fn (
string $key,
mixed $default = ''
) => old(
$key,
data_get($dataUmkm ?? null, $key, $default)
);
@endphp

@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data UMKM - Kelurahan Binong')

@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data UMKM')

@section('page_subtitle', 'Perekonomian · Data UMKM · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

@push('styles')

<style> .umkm-page { padding-bottom: 30px; } .breadcrumb { display: flex; gap: 8px; color: var(--muted); font-size: 12px; margin-bottom: 18px; } .breadcrumb a { color: var(--primary); } .page-title-block { margin-bottom: 25px; } .page-title-block h2 { font: 27px Georgia, serif; color: #18364d; } .page-title-block p, .form-header p { font-size: 13px; color: var(--muted); margin-top: 7px; } .form-card { background: #fff; border: 1px solid var(--border); border-radius: 10px; overflow: hidden; } .form-header, .form-footer { padding: 22px 25px; background: #fbfcfc; border-bottom: 1px solid var(--border); } .form-header h3 { font-size: 17px; color: #18364d; } .form-body { padding: 28px 25px; } .form-section { margin-bottom: 30px; } .section-title { display: flex; gap: 10px; align-items: center; color: #18364d; font-size: 14px; font-weight: bold; padding-bottom: 12px; margin-bottom: 20px; border-bottom: 1px solid var(--border); } .section-number { width: 25px; height: 25px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; } .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px 25px; } .form-group { display: flex; flex-direction: column; } .form-group label { font-size: 12px; font-weight: bold; margin-bottom: 8px; } .required { color: #c0392b; } .form-control { height: 43px; width: 100%; border: 1px solid #dce2e5; border-radius: 7px; padding: 0 13px; font: 13px Arial, sans-serif; box-sizing: border-box; background: #fff; color: #263238; } .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.08); } .form-control::placeholder { color: #9ca3af; } .form-group.full { grid-column: 1 / -1; } textarea.form-control { height: 100px; padding: 12px; resize: vertical; } .info-box { display: flex; gap: 12px; padding: 14px 16px; background: var(--primary-light); border: 1px solid #d7ecdf; border-radius: 8px; } .info-icon { width: 24px; height: 24px; min-width: 24px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; } .info-box p { font-size: 12px; line-height: 1.6; color: #416052; margin: 0; } .error-message { color: #c0392b; font-size: 11px; margin-top: 6px; } .form-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); border-bottom: 0; } .form-actions { display: flex; gap: 10px; } .btn { height: 42px; padding: 0 20px; border-radius: 7px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; border: 0; text-decoration: none; cursor: pointer; } .btn-secondary { background: #fff; border: 1px solid #dce2e5; color: #263238; } .btn-primary { background: var(--primary); color: #fff; } .btn-primary:hover { opacity: 0.92; } @media (max-width: 700px) { .form-grid { grid-template-columns: 1fr; } .form-group.full { grid-column: auto; } .form-footer { flex-direction: column; align-items: stretch; gap: 15px; } .form-actions { width: 100%; } .form-actions .btn { flex: 1; } } </style>

@endpush

@section('content')

<div class="umkm-page">
<div class="breadcrumb">

    <a href="{{ route('dashboard') }}">
        Beranda
    </a>

    <span>›</span>

    <a href="{{ route('dataumkm.index') }}">
        Data UMKM
    </a>

    <span>›</span>

    <span>
        {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
    </span>

</div>


<div class="page-title-block">

    <h2>
        {{ $isEdit ? 'Edit' : 'Tambah' }} Data UMKM
    </h2>

    <p>
        {{ $isEdit ? 'Perbarui' : 'Tambahkan' }}
        data Usaha Mikro, Kecil, dan Menengah Kelurahan Binong.
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
            {{ $isEdit ? 'Edit' : 'Form' }} Data UMKM
        </h3>

        <p>
            Lengkapi informasi data UMKM pada kolom yang tersedia.
        </p>

    </div>


    <form
        id="umkmForm"
        method="POST"
        action="{{ $isEdit ? route('dataumkm.update', ['dataumkm' => $dataUmkm->id]) : route('dataumkm.store') }}"
    >

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif


        <div class="form-body">


            {{-- ====================================================== --}}
            {{-- 1. IDENTITAS PELAKU USAHA --}}
            {{-- ====================================================== --}}

            <div class="form-section">

                <div class="section-title">

                    <span class="section-number">
                        1
                    </span>

                    Identitas Pelaku Usaha

                </div>


                <div class="form-grid">


                    <div class="form-group">

                        <label for="nama_pelaku_usaha">

                            Nama Pelaku Usaha

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            id="nama_pelaku_usaha"
                            name="nama_pelaku_usaha"
                            class="form-control"
                            placeholder="Contoh: Siti Aminah"
                            value="{{ $umkmValue('nama_pelaku_usaha') }}"
                            maxlength="255"
                            required
                        >

                        @error('nama_pelaku_usaha')

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
                            value="{{ $umkmValue('nik') }}"
                            maxlength="20"
                        >

                        @error('nik')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="no_kk">
                            Nomor KK
                        </label>

                        <input
                            type="text"
                            id="no_kk"
                            name="no_kk"
                            class="form-control"
                            placeholder="Masukkan Nomor KK"
                            value="{{ $umkmValue('no_kk') }}"
                            maxlength="20"
                        >

                        @error('no_kk')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="no_telepon">
                            Nomor Telepon
                        </label>

                        <input
                            type="text"
                            id="no_telepon"
                            name="no_telepon"
                            class="form-control"
                            placeholder="Contoh: 081234567890"
                            value="{{ $umkmValue('no_telepon') }}"
                            maxlength="20"
                        >

                        @error('no_telepon')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- 2. IDENTITAS USAHA --}}
            {{-- ====================================================== --}}

            <div class="form-section">

                <div class="section-title">

                    <span class="section-number">
                        2
                    </span>

                    Identitas Usaha

                </div>


                <div class="form-grid">


                    <div class="form-group">

                        <label for="nama_usaha">

                            Nama Usaha

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            id="nama_usaha"
                            name="nama_usaha"
                            class="form-control"
                            placeholder="Contoh: Warung Makan Berkah"
                            value="{{ $umkmValue('nama_usaha') }}"
                            maxlength="255"
                            required
                        >

                        @error('nama_usaha')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="jenis_usaha">
                            Jenis Usaha
                        </label>

                        <input
                            type="text"
                            id="jenis_usaha"
                            name="jenis_usaha"
                            class="form-control"
                            placeholder="Contoh: Kuliner"
                            value="{{ $umkmValue('jenis_usaha') }}"
                            maxlength="255"
                        >

                        @error('jenis_usaha')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="produk_utama">
                            Produk Utama
                        </label>

                        <input
                            type="text"
                            id="produk_utama"
                            name="produk_utama"
                            class="form-control"
                            placeholder="Contoh: Makanan dan Minuman"
                            value="{{ $umkmValue('produk_utama') }}"
                            maxlength="255"
                        >

                        @error('produk_utama')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="skala_usaha">
                            Skala Usaha
                        </label>

                        <select
                            id="skala_usaha"
                            name="skala_usaha"
                            class="form-control"
                        >

                            <option value="">
                                Pilih Skala Usaha
                            </option>

                            <option
                                value="Mikro"
                                @selected($umkmValue('skala_usaha') === 'Mikro')
                            >
                                Mikro
                            </option>

                            <option
                                value="Kecil"
                                @selected($umkmValue('skala_usaha') === 'Kecil')
                            >
                                Kecil
                            </option>

                            <option
                                value="Menengah"
                                @selected($umkmValue('skala_usaha') === 'Menengah')
                            >
                                Menengah
                            </option>

                        </select>

                        @error('skala_usaha')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- 3. LOKASI USAHA --}}
            {{-- ====================================================== --}}

            <div class="form-section">

                <div class="section-title">

                    <span class="section-number">
                        3
                    </span>

                    Lokasi Usaha

                </div>


                <div class="form-grid">


                    <div class="form-group full">

                        <label for="alamat_usaha">
                            Alamat Usaha
                        </label>

                        <textarea
                            id="alamat_usaha"
                            name="alamat_usaha"
                            class="form-control"
                            placeholder="Masukkan alamat lengkap usaha"
                        >{{ $umkmValue('alamat_usaha') }}</textarea>

                        @error('alamat_usaha')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="kelurahan">
                            Kelurahan
                        </label>

                        <input
                            type="text"
                            id="kelurahan"
                            name="kelurahan"
                            class="form-control"
                            placeholder="Contoh: Binong"
                            value="{{ $umkmValue('kelurahan', 'Binong') }}"
                            maxlength="255"
                        >

                        @error('kelurahan')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="kecamatan">
                            Kecamatan
                        </label>

                        <input
                            type="text"
                            id="kecamatan"
                            name="kecamatan"
                            class="form-control"
                            placeholder="Contoh: Batununggal"
                            value="{{ $umkmValue('kecamatan') }}"
                            maxlength="255"
                        >

                        @error('kecamatan')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="kabupaten_kota">
                            Kabupaten / Kota
                        </label>

                        <input
                            type="text"
                            id="kabupaten_kota"
                            name="kabupaten_kota"
                            class="form-control"
                            placeholder="Contoh: Kota Bandung"
                            value="{{ $umkmValue('kabupaten_kota') }}"
                            maxlength="255"
                        >

                        @error('kabupaten_kota')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- 4. LEGALITAS USAHA --}}
            {{-- ====================================================== --}}

            <div class="form-section">

                <div class="section-title">

                    <span class="section-number">
                        4
                    </span>

                    Legalitas Usaha

                </div>


                <div class="form-grid">


                    <div class="form-group">

                        <label for="nib">
                            NIB
                        </label>

                        <input
                            type="text"
                            id="nib"
                            name="nib"
                            class="form-control"
                            placeholder="Masukkan Nomor Induk Berusaha"
                            value="{{ $umkmValue('nib') }}"
                            maxlength="255"
                        >

                        @error('nib')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="npwp">
                            NPWP
                        </label>

                        <input
                            type="text"
                            id="npwp"
                            name="npwp"
                            class="form-control"
                            placeholder="Masukkan NPWP"
                            value="{{ $umkmValue('npwp') }}"
                            maxlength="255"
                        >

                        @error('npwp')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group full">

                        <label for="izin_usaha">
                            Izin Usaha
                        </label>

                        <input
                            type="text"
                            id="izin_usaha"
                            name="izin_usaha"
                            class="form-control"
                            placeholder="Contoh: NIB, PIRT, SIUP, Sertifikat Halal, dan lainnya"
                            value="{{ $umkmValue('izin_usaha') }}"
                            maxlength="255"
                        >

                        @error('izin_usaha')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>

            </div>


            {{-- ====================================================== --}}
            {{-- 5. DATA USAHA --}}
            {{-- ====================================================== --}}

            <div class="form-section">

                <div class="section-title">

                    <span class="section-number">
                        5
                    </span>

                    Data Usaha

                </div>


                <div class="form-grid">


                    <div class="form-group">

                        <label for="modal_usaha">
                            Modal Usaha
                        </label>

                        <input
                            type="number"
                            id="modal_usaha"
                            name="modal_usaha"
                            class="form-control"
                            min="0"
                            step="0.01"
                            placeholder="Contoh: 15000000"
                            value="{{ $umkmValue('modal_usaha') }}"
                        >

                        @error('modal_usaha')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="omzet_bulanan">
                            Omzet Bulanan
                        </label>

                        <input
                            type="number"
                            id="omzet_bulanan"
                            name="omzet_bulanan"
                            class="form-control"
                            min="0"
                            step="0.01"
                            placeholder="Contoh: 8500000"
                            value="{{ $umkmValue('omzet_bulanan') }}"
                        >

                        @error('omzet_bulanan')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="jumlah_tenaga_kerja">
                            Jumlah Tenaga Kerja
                        </label>

                        <input
                            type="number"
                            id="jumlah_tenaga_kerja"
                            name="jumlah_tenaga_kerja"
                            class="form-control"
                            min="0"
                            placeholder="Contoh: 3"
                            value="{{ $umkmValue('jumlah_tenaga_kerja', 0) }}"
                        >

                        @error('jumlah_tenaga_kerja')

                            <div class="error-message">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="status_usaha">
                            Status Usaha
                        </label>

                        <select
                            id="status_usaha"
                            name="status_usaha"
                            class="form-control"
                        >

                            <option value="">
                                Pilih Status Usaha
                            </option>

                            <option
                                value="Aktif"
                                @selected($umkmValue('status_usaha') === 'Aktif')
                            >
                                Aktif
                            </option>

                            <option
                                value="Tidak Aktif"
                                @selected($umkmValue('status_usaha') === 'Tidak Aktif')
                            >
                                Tidak Aktif
                            </option>

                        </select>

                        @error('status_usaha')

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
                        >{{ $umkmValue('keterangan') }}</textarea>

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
                    Pastikan data UMKM yang dimasukkan sudah benar sebelum menyimpan.
                    Data akan disimpan ke database dan disinkronkan ke Google Sheets.
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
                    href="{{ route('dataumkm.index') }}"
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
