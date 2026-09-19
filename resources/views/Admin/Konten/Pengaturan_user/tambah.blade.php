@extends('Admin.Layout.master')

@section('title', ($isEdit ?? false) ? 'Edit User - Kelurahan Binong' : 'Tambah User - Kelurahan Binong')

@section('page_title', ($isEdit ?? false) ? 'Edit User' : 'Tambah User')

@section('page_subtitle', 'Sistem · Pengaturan User')

@php
$isEdit = $isEdit ?? false;
$user = $user ?? null;
@endphp

@push('styles')

<style>
    .user-page {
        padding-bottom: 30px;
    }

    .user-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 13px;
        color: #6b7280;
    }

    .user-breadcrumb a {
        color: #087443;
        text-decoration: none;
        font-weight: 600;
    }

    .user-breadcrumb a:hover {
        text-decoration: underline;
    }

    .user-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .user-card-header {
        padding: 22px 25px;
        border-bottom: 1px solid #e5e7eb;
        background: #fafafa;
    }

    .user-card-header h3 {
        margin: 0 0 5px;
        font-size: 18px;
        font-weight: 700;
        color: #102f47;
    }

    .user-card-header p {
        margin: 0;
        font-size: 13px;
        color: #6b7280;
    }

    .user-card-body {
        padding: 25px;
    }

    .user-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .user-form-group {
        display: flex;
        flex-direction: column;
    }

    .user-form-group.full {
        grid-column: 1 / -1;
    }

    .user-form-group label {
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #374151;
    }

    .user-required {
        color: #dc2626;
    }

    .user-input,
    .user-select {
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

    .user-input:focus,
    .user-select:focus {
        border-color: #087443;
        box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.10);
    }

    .user-input::placeholder {
        color: #9ca3af;
    }

    .user-select {
        cursor: pointer;
    }

    .user-help {
        margin-top: 6px;
        font-size: 12px;
        color: #6b7280;
        line-height: 1.5;
    }

    .user-error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    .user-input-error {
        border-color: #dc2626 !important;
    }

    .user-alert {
        margin-bottom: 20px;
        padding: 14px 16px;
        border-radius: 9px;
        font-size: 13px;
    }

    .user-alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .user-alert-error ul {
        margin: 8px 0 0 18px;
        padding: 0;
    }

    .user-alert-error li {
        margin-bottom: 3px;
    }

    .user-password-section {
        grid-column: 1 / -1;
        margin-top: 5px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .user-password-title {
        margin-bottom: 5px;
        font-size: 14px;
        font-weight: 700;
        color: #102f47;
    }

    .user-password-description {
        margin-bottom: 18px;
        font-size: 12px;
        color: #6b7280;
    }

    .user-info {
        margin-top: 22px;
        padding: 14px 16px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 9px;
        color: #166534;
        font-size: 13px;
        line-height: 1.6;
    }

    .user-info strong {
        font-weight: 700;
    }

    .user-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 18px 25px;
        border-top: 1px solid #e5e7eb;
        background: #fafafa;
    }

    .user-footer-left,
    .user-footer-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-btn {
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

    .user-btn-secondary {
        background: #ffffff;
        border-color: #d1d5db;
        color: #374151;
    }

    .user-btn-secondary:hover {
        background: #f3f4f6;
    }

    .user-btn-primary {
        background: #087443;
        border-color: #087443;
        color: #ffffff;
    }

    .user-btn-primary:hover {
        background: #065c35;
        border-color: #065c35;
    }

    @media (max-width: 768px) {

        .user-form-grid {
            grid-template-columns: 1fr;
        }

        .user-form-group.full,
        .user-password-section {
            grid-column: auto;
        }

        .user-card-body {
            padding: 18px;
        }

        .user-card-header {
            padding: 18px;
        }

        .user-card-footer {
            padding: 15px 18px;
            flex-direction: column;
            align-items: stretch;
        }

        .user-footer-left,
        .user-footer-right {
            width: 100%;
        }

        .user-footer-right {
            justify-content: flex-end;
        }
    }
</style>

@endpush

@section('content')

<div class="user-page">


<div class="user-breadcrumb">

    <a href="{{ route('pengaturan_user.index') }}">
        Pengaturan User
    </a>

    <span>/</span>

    <span>
        {{ $isEdit ? 'Edit User' : 'Tambah User' }}
    </span>

</div>

@if ($errors->any())

    <div class="user-alert user-alert-error">

        <strong>Terjadi kesalahan:</strong>

        <ul>

            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif

<div class="user-card">

    <div class="user-card-header">

        <h3>
            {{ $isEdit ? 'Edit User' : 'Tambah User' }}
        </h3>

        <p>
            {{ $isEdit
                ? 'Perbarui informasi akun pengguna yang sudah terdaftar.'
                : 'Masukkan informasi akun pengguna yang akan ditambahkan.'
            }}
        </p>

    </div>

    <div class="user-card-body">

        <form
            method="POST"
            action="{{ $isEdit
                ? route('pengaturan_user.update', $user->id)
                : route('pengaturan_user.store')
            }}"
        >

            @csrf

            @if ($isEdit)

                @method('PUT')

            @endif

            <div class="user-form-grid">

                <div class="user-form-group">

                    <label for="name">

                        Nama

                        <span class="user-required">*</span>

                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="user-input @error('name') user-input-error @enderror"
                        value="{{ old('name', $user->name ?? '') }}"
                        placeholder="Masukkan nama pengguna"
                        maxlength="100"
                        required
                    >

                    @error('name')

                        <div class="user-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="user-form-group">

                    <label for="jabatan">

                        Jabatan

                        <span class="user-required">*</span>

                    </label>

                    <select
                        id="jabatan"
                        name="jabatan"
                        class="user-select @error('jabatan') user-input-error @enderror"
                        required
                    >

                        <option value="">
                            -- Pilih Jabatan --
                        </option>

                        @foreach ($jabatanOptions as $jabatan)

                            <option
                                value="{{ $jabatan }}"
                                {{ old('jabatan', $user->jabatan ?? '') === $jabatan ? 'selected' : '' }}
                            >
                                {{ $jabatan }}
                            </option>

                        @endforeach

                    </select>

                    @error('jabatan')

                        <div class="user-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="user-form-group full">

                    <label for="email">

                        Email

                        <span class="user-required">*</span>

                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="user-input @error('email') user-input-error @enderror"
                        value="{{ old('email', $user->email ?? '') }}"
                        placeholder="contoh@kelurahanbinong.id"
                        maxlength="255"
                        required
                    >

                    <div class="user-help">
                        Email digunakan sebagai username untuk login ke sistem.
                    </div>

                    @error('email')

                        <div class="user-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="user-password-section">

                    <div class="user-password-title">
                        {{ $isEdit ? 'Ubah Password' : 'Password' }}
                    </div>

                    <div class="user-password-description">

                        {{ $isEdit
                            ? 'Kosongkan password jika tidak ingin mengubah password pengguna.'
                            : 'Password digunakan untuk login ke sistem dan minimal 8 karakter.'
                        }}

                    </div>

                    <div class="user-form-grid">

                        <div class="user-form-group">

                            <label for="password">

                                {{ $isEdit ? 'Password Baru' : 'Password' }}

                                @if (!$isEdit)

                                    <span class="user-required">*</span>

                                @endif

                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="user-input @error('password') user-input-error @enderror"
                                placeholder="{{ $isEdit ? 'Masukkan password baru' : 'Masukkan password' }}"
                                minlength="8"
                                {{ !$isEdit ? 'required' : '' }}
                            >

                            <div class="user-help">
                                Minimal 8 karakter.
                            </div>

                            @error('password')

                                <div class="user-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="user-form-group">

                            <label for="password_confirmation">

                                Konfirmasi {{ $isEdit ? 'Password Baru' : 'Password' }}

                                @if (!$isEdit)

                                    <span class="user-required">*</span>

                                @endif

                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="user-input"
                                placeholder="Ulangi password"
                                minlength="8"
                                {{ !$isEdit ? 'required' : '' }}
                            >

                            <div class="user-help">
                                Masukkan kembali password yang sama.
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="user-info">

                <strong>Informasi:</strong>

                {{ $isEdit
                    ? 'Perubahan data akan langsung disimpan ke database aplikasi.'
                    : 'Akun yang ditambahkan dapat digunakan untuk login ke sistem Kelurahan Binong.'
                }}

            </div>

            <div class="user-card-footer">

                <div class="user-footer-left">

                    <a
                        href="{{ route('pengaturan_user.index') }}"
                        class="user-btn user-btn-secondary"
                    >
                        Batal
                    </a>

                </div>

                <div class="user-footer-right">

                    <button
                        type="submit"
                        class="user-btn user-btn-primary"
                    >
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan User' }}
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


</div>

@endsection
