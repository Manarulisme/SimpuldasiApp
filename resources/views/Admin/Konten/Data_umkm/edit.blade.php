@php
    $isEdit = $isEdit ?? false;
    $umkmValue = fn (string $key, mixed $default = '') => old($key, data_get($umkm ?? null, $key, $default));
@endphp

@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data UMKM - Kelurahan XXXXX')
@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data UMKM')
@section('page_subtitle', 'Ekonomi & Pembangunan · Data UMKM · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

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
        color: #18364d;
        font-family: Georgia, serif;
        font-size: 27px;
        margin-bottom: 7px;
    }

    .page-title-block p {
        color: var(--muted);
        font-size: 13px;
    }

    .form-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .form-header,
    .form-footer {
        background: #fbfcfc;
        padding: 22px 25px;
        border-bottom: 1px solid var(--border);
    }

    .form-header h3 {
        color: #18364d;
        font-size: 17px;
        margin-bottom: 5px;
    }

    .form-header p,
    .form-help,
    .required-note {
        color: var(--muted);
        font-size: 12px;
    }

    .form-body {
        padding: 28px 25px;
    }

    .form-section {
        margin-bottom: 30px;
    }

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

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        color: var(--text);
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .required {
        color: #c0392b;
    }

    .form-control {
        width: 100%;
        height: 43px;
        border: 1px solid #dce2e5;
        border-radius: 7px;
        padding: 0 13px;
        font: 13px Arial, sans-serif;
        color: var(--text);
        background: white;
    }

    textarea.form-control {
        height: 100px;
        padding: 12px 13px;
        resize: vertical;
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.08);
    }

    .form-help {
        margin-top: 6px;
        font-size: 11px;
    }

    .info-box {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 14px 16px;
        background: var(--primary-light);
        border: 1px solid #d7ecdf;
        border-radius: 8px;
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
    }

    .info-box p {
        color: #416052;
        font-size: 12px;
        line-height: 1.6;
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
        border: 0;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-secondary {
        background: white;
        color: var(--text);
        border: 1px solid #dce2e5;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn:hover {
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
            align-items: stretch;
            flex-direction: column;
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
    <a href="{{ url('/dashboard') }}">Beranda</a>

    <span>›</span>

    <a href="{{ url('/dataumkm') }}">
        Data UMKM
    </a>

    <span>›</span>

    <span>
        {{ $isEdit ? 'Edit Data' : 'Tambah Data' }}
    </span>
</div>


<div class="page-title-block">

    <h2>
        {{ $isEdit ? 'Edit Data UMKM' : 'Tambah Data UMKM' }}
    </h2>

    <p>
        {{ $isEdit
            ? 'Perbarui informasi UMKM pada Data UMKM Kelurahan XXXXX.'
            : 'Tambahkan data UMKM baru ke dalam Data UMKM Kelurahan XXXXX.'
        }}
    </p>

</div>


<div class="form-card">

    {{-- HEADER --}}
    <div class="form-header">

        <h3>
            {{ $isEdit ? 'Edit Data UMKM' : 'Form Data UMKM' }}
        </h3>

        <p>
            {{ $isEdit
                ? 'Perbarui informasi UMKM pada kolom yang tersedia.'
                : 'Silakan lengkapi informasi UMKM pada kolom yang tersedia.'
            }}
        </p>

    </div>


    <form
        id="umkmForm"
        method="POST"
        action="{{ url()->current() }}"
    >

        @csrf

        @if ($isEdit)
            @method('PUT')
        @endif


        <div class="form-body">


            {{-- SECTION 1 --}}
            <div class="form-section">

                <div class="section-title">

                    <span class="section-number">
                        1
                    </span>

                    Data Usaha

                </div>


                <div class="form-grid">


                    {{-- JENIS USAHA --}}
                    <div class="form-group">

                        <label for="jenis_usaha">

                            Jenis Usaha

                            <span class="required">
                                *
                            </span>

                        </label>


                        <select
                            id="jenis_usaha"
                            name="jenis_usaha"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Pilih Jenis Usaha
                            </option>

                            @foreach ([
                                'Kuliner',
                                'Perdagangan',
                                'Fashion',
                                'Jasa',
                                'Kerajinan',
                                'Pertanian',
                                'Peternakan',
                                'Lainnya'
                            ] as $jenis)

                                <option
                                    value="{{ $jenis }}"
                                    @selected($umkmValue('jenis_usaha') === $jenis)
                                >
                                    {{ $jenis }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- NAMA USAHA --}}
                    <div class="form-group">

                        <label for="nama_usaha">

                            Nama Usaha

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="nama_usaha"
                            name="nama_usaha"
                            class="form-control"
                            placeholder="Masukkan nama usaha"
                            value="{{ $umkmValue('nama_usaha') }}"
                            required
                        >

                    </div>


                </div>

            </div>


            {{-- SECTION 2 --}}
            <div class="form-section">

                <div class="section-title">

                    <span class="section-number">
                        2
                    </span>

                    Data Pelaku Usaha

                </div>


                <div class="form-grid">


                    {{-- NAMA PELAKU --}}
                    <div class="form-group">

                        <label for="nama_pelaku">

                            Nama Pelaku

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="nama_pelaku"
                            name="nama_pelaku"
                            class="form-control"
                            placeholder="Masukkan nama pelaku usaha"
                            value="{{ $umkmValue('nama_pelaku') }}"
                            required
                        >

                    </div>


                    {{-- NO HP --}}
                    <div class="form-group">

                        <label for="nohp">

                            NoHP

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="tel"
                            id="nohp"
                            name="nohp"
                            class="form-control"
                            placeholder="Contoh: 081234567890"
                            value="{{ $umkmValue('nohp') }}"
                            required
                        >


                        <span class="form-help">
                            Masukkan nomor HP yang aktif dan dapat dihubungi.
                        </span>

                    </div>


                </div>

            </div>


            {{-- SECTION 3 --}}
            <div class="form-section">

                <div class="section-title">

                    <span class="section-number">
                        3
                    </span>

                    Alamat Usaha

                </div>


                <div class="form-grid">


                    <div class="form-group full">

                        <label for="alamat">

                            Alamat

                            <span class="required">
                                *
                            </span>

                        </label>


                        <textarea
                            id="alamat"
                            name="alamat"
                            class="form-control"
                            placeholder="Masukkan alamat lengkap usaha"
                            required
                        >{{ $umkmValue('alamat') }}</textarea>


                        <span class="form-help">
                            Cantumkan alamat usaha secara lengkap.
                        </span>

                    </div>


                </div>

            </div>


            {{-- INFO --}}
            <div class="info-box">

                <div class="info-icon">
                    i
                </div>

                <p>

                    {{ $isEdit
                        ? 'Periksa kembali perubahan data UMKM sebelum menyimpan.'
                        : 'Pastikan data UMKM yang dimasukkan sudah benar sebelum menyimpan.'
                    }}

                </p>

            </div>


        </div>


        {{-- FOOTER --}}
        <div class="form-footer">


            <div class="required-note">

                <span class="required">
                    *
                </span>

                Wajib diisi

            </div>


            <div class="form-actions">


                <a
                    href="{{ url('/dataumkm') }}"
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


@push('scripts')

@if (!$isEdit)

<script>

    document
        .getElementById('umkmForm')
        ?.addEventListener('submit', function (event) {

            event.preventDefault();

            alert(
                'Data UMKM berhasil disimpan!\n\n' +
                'Nama Usaha: ' +
                document.getElementById('nama_usaha').value
            );

            window.location.href = '{{ url('/dataumkm') }}';

        });

</script>

@endif

@endpush
