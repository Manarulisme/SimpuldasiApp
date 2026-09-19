@extends('Admin.Layout.master')

@section('title', 'Detail Data KPM / Bantuan Sosial - Kelurahan Binong')

@section('page_title', 'Detail Data KPM / Bantuan Sosial')

@section('page_subtitle', 'Kesejahteraan Sosial · KPM / Bantuan Sosial · Detail Data')

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

    .detail-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 22px;
        border-bottom: 1px solid var(--border);
    }

    .detail-header-main h3 {
        color: #18364d;
        font-size: 18px;
        margin: 0;
    }

    .detail-header-main p {
        color: var(--muted);
        font-size: 11px;
        margin-top: 6px;
    }

    .id-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 20px;
        padding: 7px 11px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .detail-body {
        padding: 25px 22px;
    }

    .detail-section {
        margin-bottom: 30px;
    }

    .detail-section:last-child {
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

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px 20px;
    }

    .detail-item {
        border: 1px solid #edf0f2;
        border-radius: 8px;
        padding: 14px;
        background: #fcfdfd;
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-label {
        color: #8a969d;
        font-size: 10px;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #263238;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.5;
        word-break: break-word;
    }

    .detail-value.normal {
        font-weight: 400;
    }

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
    }

    .badge-pkh {
        background: var(--primary-light);
        color: var(--primary);
    }

    .badge-bpnt {
        background: #fff7df;
        color: #987500;
    }

    .badge-pangan {
        background: #f1f3f4;
        color: #58636a;
    }

    .badge-lainnya {
        background: #eef6fc;
        color: #2d6a9f;
    }

    .badge-desil {
        background: #f1f3f4;
        color: #58636a;
    }

    .sync-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .sync-box {
        border: 1px solid #edf0f2;
        border-radius: 8px;
        padding: 14px;
        background: #fcfdfd;
    }

    .sync-label {
        color: #8a969d;
        font-size: 10px;
        margin-bottom: 7px;
    }

    .sync-value {
        font-size: 11px;
        font-weight: 600;
    }

    .sync-synced {
        color: var(--primary);
    }

    .sync-failed {
        color: #c0392b;
    }

    .sync-pending {
        color: #987500;
    }

    .timestamp-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px 20px;
        margin-top: 15px;
    }

    .timestamp-item {
        color: #52616b;
        font-size: 11px;
    }

    .timestamp-item strong {
        display: block;
        color: #8a969d;
        font-size: 10px;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .detail-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 18px 22px;
        background: #fafbfb;
        border-top: 1px solid var(--border);
    }

    .footer-actions {
        display: flex;
        gap: 10px;
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

    .text-muted {
        color: #9aa4aa;
        font-weight: 400;
    }

    @media (max-width: 700px) {

        .detail-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-grid,
        .timestamp-grid {
            grid-template-columns: 1fr;
        }

        .detail-item.full-width {
            grid-column: auto;
        }

        .sync-grid {
            grid-template-columns: 1fr;
        }

        .detail-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .footer-actions {
            flex-direction: column;
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
    Detail Data
</span>


</div>

<div class="page-title-block">


<h2>
    Detail Data KPM / Bantuan Sosial
</h2>

<p>
    Informasi lengkap penerima bantuan sosial Kelurahan Binong.
</p>


</div>

<section class="detail-card">


<div class="detail-header">

    <div class="detail-header-main">

        <h3>
            {{ $kpm->nama }}
        </h3>

        <p>
            Detail informasi penerima bantuan sosial Kelurahan Binong
        </p>

    </div>

    <div class="id-pill">

        ID Data:
        {{ $kpm->id_data ?: 'Belum diisi' }}

    </div>

</div>

<div class="detail-body">

    {{-- ========================================= --}}
    {{-- 1. IDENTITAS KPM --}}
    {{-- ========================================= --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                1
            </span>

            Identitas KPM

        </div>

        <div class="detail-grid">

            <div class="detail-item">

                <div class="detail-label">
                    ID Data KPM
                </div>

                <div class="detail-value">
                    {{ $kpm->id_data ?: '-' }}
                </div>

            </div>

            <div class="detail-item">

                <div class="detail-label">
                    NIK
                </div>

                <div class="detail-value">
                    {{ $kpm->nik ?: '-' }}
                </div>

            </div>

            <div class="detail-item">

                <div class="detail-label">
                    Nama Lengkap
                </div>

                <div class="detail-value">
                    {{ $kpm->nama ?: '-' }}
                </div>

            </div>

            <div class="detail-item">

                <div class="detail-label">
                    Alamat RW
                </div>

                <div class="detail-value">

                    @if ($kpm->rw)
                        RW {{ $kpm->rw }}
                    @else
                        <span class="text-muted">Belum diisi</span>
                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- 2. DATA BANTUAN SOSIAL --}}
    {{-- ========================================= --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                2
            </span>

            Data Bantuan Sosial

        </div>

        <div class="detail-grid">

            <div class="detail-item">

                <div class="detail-label">
                    Jenis Bantuan
                </div>

                <div class="detail-value">

                    @php
                        $jenisBantuan = strtolower($kpm->jenis_bantuan ?? '');
                    @endphp

                    @if ($jenisBantuan === 'pkh')

                        <span class="badge badge-pkh">
                            PKH
                        </span>

                    @elseif ($jenisBantuan === 'bpnt')

                        <span class="badge badge-bpnt">
                            BPNT
                        </span>

                    @elseif ($jenisBantuan === 'bantuan pangan')

                        <span class="badge badge-pangan">
                            Bantuan Pangan
                        </span>

                    @else

                        <span class="badge badge-lainnya">
                            {{ $kpm->jenis_bantuan ?: '-' }}
                        </span>

                    @endif

                </div>

            </div>

            <div class="detail-item">

                <div class="detail-label">
                    Desil
                </div>

                <div class="detail-value">

                    @if ($kpm->desil)

                        <span class="badge badge-desil">
                            Desil {{ $kpm->desil }}
                        </span>

                    @else

                        <span class="text-muted">
                            Belum diisi
                        </span>

                    @endif

                </div>

            </div>

            <div class="detail-item full-width">

                <div class="detail-label">
                    Keterangan
                </div>

                <div class="detail-value normal">

                    @if ($kpm->keterangan)
                        {{ $kpm->keterangan }}
                    @else
                        <span class="text-muted">
                            Tidak ada keterangan.
                        </span>
                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- 3. SINKRONISASI DATA --}}
    {{-- ========================================= --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                3
            </span>

            Sinkronisasi Data

        </div>

        @php
            $syncStatus = $kpm->google_sync_status ?? 'pending';
        @endphp

        <div class="sync-grid">

            <div class="sync-box">

                <div class="sync-label">
                    Status Data
                </div>

                @if ($syncStatus === 'synced')

                    <div class="sync-value sync-synced">
                        Tersinkronisasi
                    </div>

                @elseif ($syncStatus === 'failed')

                    <div class="sync-value sync-failed">
                        Gagal Sinkronisasi
                    </div>

                @else

                    <div class="sync-value sync-pending">
                        Menunggu Sinkronisasi
                    </div>

                @endif

            </div>

            <div class="sync-box">

                <div class="sync-label">
                    Terakhir Sinkronisasi
                </div>

                <div class="sync-value">

                    @if ($kpm->google_synced_at)

                        {{ $kpm->google_synced_at->locale('id')->translatedFormat('d M Y') }}

                        <br>

                        <span class="text-muted">
                            {{ $kpm->google_synced_at->format('H:i') }} WIB
                        </span>

                    @else

                        <span class="text-muted">
                            Belum pernah
                        </span>

                    @endif

                </div>

            </div>

            <div class="sync-box">

                <div class="sync-label">
                    Status Penyimpanan
                </div>

                <div class="sync-value sync-synced">
                    Tersimpan di Database
                </div>

            </div>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- 4. INFORMASI DATA --}}
    {{-- ========================================= --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                4
            </span>

            Informasi Data

        </div>

        <div class="timestamp-grid">

            <div class="timestamp-item">

                <strong>
                    Dibuat Pada
                </strong>

                @if ($kpm->created_at)

                    {{ $kpm->created_at->locale('id')->translatedFormat('d M Y') }}

                    ·

                    {{ $kpm->created_at->format('H:i') }} WIB

                @else

                    <span class="text-muted">
                        -
                    </span>

                @endif

            </div>

            <div class="timestamp-item">

                <strong>
                    Terakhir Diperbarui
                </strong>

                @if ($kpm->updated_at)

                    {{ $kpm->updated_at->locale('id')->translatedFormat('d M Y') }}

                    ·

                    {{ $kpm->updated_at->format('H:i') }} WIB

                @else

                    <span class="text-muted">
                        -
                    </span>

                @endif

            </div>

        </div>

    </div>

</div>

<div class="detail-footer">

    <a
        href="{{ route('datakpm.index') }}"
        class="btn btn-secondary"
    >
        ← Kembali
    </a>

    <div class="footer-actions">

        <a
            href="{{ route('datakpm.edit', $kpm->id) }}"
            class="btn btn-primary"
        >
            ✎ Ubah Data
        </a>

    </div>

</div>


</section>

@endsection
