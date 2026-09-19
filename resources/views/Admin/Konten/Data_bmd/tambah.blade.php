@extends('Admin.Layout.master')

@section('title', ($isEdit ?? false) ? 'Edit Data BMD - Kelurahan Binong' : 'Tambah Data BMD - Kelurahan Binong')

@section('page_title', ($isEdit ?? false) ? 'Edit Data BMD' : 'Tambah Data BMD')

@section('page_subtitle', 'Kesekretariatan · Data BMD')

@php
$isEdit = $isEdit ?? false;
$bmd = $bmd ?? null;
@endphp

@push('styles')

<style>
    .bmd-page {
        padding-bottom: 30px;
    }

    .bmd-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 13px;
        color: #6b7280;
    }

    .bmd-breadcrumb a {
        color: #087443;
        text-decoration: none;
        font-weight: 600;
    }

    .bmd-breadcrumb a:hover {
        text-decoration: underline;
    }

    .bmd-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .bmd-card-header {
        padding: 22px 25px;
        border-bottom: 1px solid #e5e7eb;
        background: #fafafa;
    }

    .bmd-card-header h3 {
        margin: 0 0 5px;
        font-size: 18px;
        font-weight: 700;
        color: #102f47;
    }

    .bmd-card-header p {
        margin: 0;
        font-size: 13px;
        color: #6b7280;
    }

    .bmd-card-body {
        padding: 25px;
    }

    .bmd-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .bmd-form-group {
        display: flex;
        flex-direction: column;
    }

    .bmd-form-group.full {
        grid-column: 1 / -1;
    }

    .bmd-form-group label {
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #374151;
    }

    .bmd-required {
        color: #dc2626;
    }

    .bmd-input,
    .bmd-select,
    .bmd-textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background: #ffffff;
        color: #111827;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: all 0.2s ease;
    }

    .bmd-input:focus,
    .bmd-select:focus,
    .bmd-textarea:focus {
        border-color: #087443;
        box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.10);
    }

    .bmd-input::placeholder,
    .bmd-textarea::placeholder {
        color: #9ca3af;
    }

    .bmd-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .bmd-help {
        margin-top: 6px;
        font-size: 12px;
        color: #6b7280;
        line-height: 1.5;
    }

    .bmd-error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    .bmd-alert {
        margin-bottom: 20px;
        padding: 14px 16px;
        border-radius: 9px;
        font-size: 13px;
    }

    .bmd-alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .bmd-alert-error ul {
        margin: 8px 0 0 18px;
        padding: 0;
    }

    .bmd-info {
        margin-top: 22px;
        padding: 14px 16px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 9px;
        color: #166534;
        font-size: 13px;
        line-height: 1.6;
    }

    .bmd-info strong {
        font-weight: 700;
    }

    .bmd-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 18px 25px;
        border-top: 1px solid #e5e7eb;
        background: #fafafa;
    }

    .bmd-footer-left,
    .bmd-footer-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bmd-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 40px;
        padding: 9px 17px;
        border-radius: 8px;
        border: 1px solid transparent;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .bmd-btn-secondary {
        background: #ffffff;
        border-color: #d1d5db;
        color: #374151;
    }

    .bmd-btn-secondary:hover {
        background: #f3f4f6;
    }

    .bmd-btn-primary {
        background: #087443;
        border-color: #087443;
        color: #ffffff;
    }

    .bmd-btn-primary:hover {
        background: #065c35;
        border-color: #065c35;
    }

    @media (max-width: 768px) {
        .bmd-form-grid {
            grid-template-columns: 1fr;
        }

        .bmd-form-group.full {
            grid-column: auto;
        }

        .bmd-card-body {
            padding: 18px;
        }

        .bmd-card-header {
            padding: 18px;
        }

        .bmd-card-footer {
            padding: 15px 18px;
            flex-direction: column;
            align-items: stretch;
        }

        .bmd-footer-left,
        .bmd-footer-right {
            width: 100%;
        }

        .bmd-footer-right {
            justify-content: flex-end;
        }
    }
</style>

@endpush

@section('content')

<div class="bmd-page">


{{-- Breadcrumb --}}
<div class="bmd-breadcrumb">

    <a href="{{ route('databmd.index') }}">
        Data BMD
    </a>

    <span>/</span>

    <span>
        {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
    </span>

</div>

{{-- Validation Error --}}
@if ($errors->any())

    <div class="bmd-alert bmd-alert-error">

        <strong>Terjadi kesalahan:</strong>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<div class="bmd-card">

    {{-- Header --}}
    <div class="bmd-card-header">

        <h3>
            {{ $isEdit ? 'Edit Data BMD' : 'Tambah Data BMD' }}
        </h3>

        <p>
            {{ $isEdit
                ? 'Perbarui informasi Barang Milik Daerah yang sudah tersimpan.'
                : 'Masukkan informasi Barang Milik Daerah yang akan ditambahkan.'
            }}
        </p>

    </div>

    {{-- Body --}}
    <div class="bmd-card-body">

        <form
            method="POST"
            action="{{ $isEdit
                ? route('databmd.update', $bmd->id)
                : route('databmd.store')
            }}"
        >

            @csrf

            @if ($isEdit)
                @method('PUT')
            @endif

            <div class="bmd-form-grid">

                {{-- ID BMD --}}
                <div class="bmd-form-group">

                    <label for="id_data">

                        ID BMD

                        <span class="bmd-required">*</span>

                    </label>

                    <input
                        type="text"
                        id="id_data"
                        name="id_data"
                        class="bmd-input"
                        value="{{ old('id_data', $bmd->id_data ?? '') }}"
                        placeholder="Contoh: BMD-001"
                        maxlength="50"
                        required
                    >

                    <div class="bmd-help">

                        ID diisi secara manual oleh pihak kelurahan.

                        Contoh: BMD-001, BMD-2025-001, BMD-MBL-001.

                    </div>

                    @error('id_data')

                        <div class="bmd-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                {{-- Nama Barang --}}
                <div class="bmd-form-group">

                    <label for="nama_barang">

                        Nama Barang

                        <span class="bmd-required">*</span>

                    </label>

                    <input
                        type="text"
                        id="nama_barang"
                        name="nama_barang"
                        class="bmd-input"
                        value="{{ old('nama_barang', $bmd->nama_barang ?? '') }}"
                        placeholder="Contoh: Meja"
                        maxlength="150"
                        required
                    >

                    @error('nama_barang')

                        <div class="bmd-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                {{-- Type --}}
                <div class="bmd-form-group">

                    <label for="type">
                        Type
                    </label>

                    <input
                        type="text"
                        id="type"
                        name="type"
                        class="bmd-input"
                        value="{{ old('type', $bmd->type ?? '') }}"
                        placeholder="Contoh: Sarana"
                        maxlength="150"
                    >

                    @error('type')

                        <div class="bmd-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                {{-- Tahun Perolehan --}}
                <div class="bmd-form-group">

                    <label for="tahun_perolehan">
                        Tahun Perolehan
                    </label>

                    <input
                        type="number"
                        id="tahun_perolehan"
                        name="tahun_perolehan"
                        class="bmd-input"
                        value="{{ old('tahun_perolehan', $bmd->tahun_perolehan ?? '') }}"
                        placeholder="Contoh: 2025"
                        min="1900"
                        max="2100"
                    >

                    @error('tahun_perolehan')

                        <div class="bmd-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                {{-- Sumber Dana --}}
                <div class="bmd-form-group">

                    <label for="sumber_dana">
                        Sumber Dana
                    </label>

                    <input
                        type="text"
                        id="sumber_dana"
                        name="sumber_dana"
                        class="bmd-input"
                        value="{{ old('sumber_dana', $bmd->sumber_dana ?? '') }}"
                        placeholder="Contoh: BOS"
                        maxlength="100"
                    >

                    @error('sumber_dana')

                        <div class="bmd-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                {{-- Kondisi --}}
                <div class="bmd-form-group">

                    <label for="kondisi">
                        Kondisi
                    </label>

                    <select
                        id="kondisi"
                        name="kondisi"
                        class="bmd-select"
                    >

                        <option value="">
                            -- Pilih Kondisi --
                        </option>

                        <option
                            value="Baik"
                            {{ old('kondisi', $bmd->kondisi ?? '') === 'Baik' ? 'selected' : '' }}
                        >
                            Baik
                        </option>

                        <option
                            value="Rusak Ringan"
                            {{ old('kondisi', $bmd->kondisi ?? '') === 'Rusak Ringan' ? 'selected' : '' }}
                        >
                            Rusak Ringan
                        </option>

                        <option
                            value="Rusak Berat"
                            {{ old('kondisi', $bmd->kondisi ?? '') === 'Rusak Berat' ? 'selected' : '' }}
                        >
                            Rusak Berat
                        </option>

                    </select>

                    @error('kondisi')

                        <div class="bmd-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                {{-- Keterangan --}}
                <div class="bmd-form-group full">

                    <label for="keterangan">
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        class="bmd-textarea"
                        placeholder="Masukkan keterangan tambahan jika diperlukan..."
                    >{{ old('keterangan', $bmd->keterangan ?? '') }}</textarea>

                    @error('keterangan')

                        <div class="bmd-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

            {{-- Information --}}
            <div class="bmd-info">

                <strong>Informasi:</strong>

                Data yang disimpan akan masuk ke database aplikasi
                dan secara otomatis dikirim ke Google Sheets.

            </div>

            {{-- Footer --}}
            <div class="bmd-card-footer">

                <div class="bmd-footer-left">

                    <a
                        href="{{ route('databmd.index') }}"
                        class="bmd-btn bmd-btn-secondary"
                    >
                        Batal
                    </a>

                </div>

                <div class="bmd-footer-right">

                    <button
                        type="submit"
                        class="bmd-btn bmd-btn-primary"
                    >
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


</div>

@endsection
