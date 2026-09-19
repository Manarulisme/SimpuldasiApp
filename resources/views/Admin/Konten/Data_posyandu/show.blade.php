@extends('Admin.Layout.master')

@section('title', 'Detail Posyandu & Posbindu - Kelurahan Binong')
@section('page_title', 'Detail Posyandu & Posbindu')
@section('page_subtitle', 'Kesejahteraan Sosial · Posyandu & Posbindu')

@push('styles')

<style>
    .content-header {
        margin-bottom: 25px;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        color: #8a969d;
        font-size: 11px;
    }

    .breadcrumb a {
        color: #2d6a9f;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb-separator {
        color: #b4bdc2;
    }

    .content-header h2 {
        color: #18364d;
        font-family: Georgia, serif;
        font-size: 26px;
        margin: 0;
    }

    .content-header p {
        color: var(--muted);
        font-size: 12px;
        margin-top: 6px;
        margin-bottom: 0;
    }

    /* =========================
       DETAIL PANEL
    ========================= */

    .detail-panel {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .detail-header {
        padding: 22px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .detail-header-info {
        min-width: 0;
    }

    .detail-header h3 {
        color: #18364d;
        font-size: 18px;
        margin: 0;
    }

    .detail-header p {
        color: var(--muted);
        font-size: 11px;
        margin: 6px 0 0;
    }

    .id-pill {
        display: inline-flex;
        align-items: center;
        padding: 7px 11px;
        background: #f1f3f4;
        color: #52616b;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================
       SECTION
    ========================= */

    .detail-section {
        padding: 22px;
        border-bottom: 1px solid var(--border);
    }

    .detail-section:last-of-type {
        border-bottom: 0;
    }

    .section-title {
        color: #18364d;
        font-size: 13px;
        font-weight: 700;
        margin: 0 0 17px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px 22px;
    }

    .detail-item {
        min-width: 0;
    }

    .detail-label {
        color: #8a969d;
        font-size: 10px;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .detail-value {
        color: #263238;
        font-size: 12px;
        line-height: 1.5;
        word-break: break-word;
    }

    .detail-value.empty {
        color: #a0aaaf;
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    /* =========================
       BADGE
    ========================= */

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
    }

    .badge-posyandu {
        background: var(--primary-light);
        color: var(--primary);
    }

    .badge-posbindu {
        background: #fff7df;
        color: #987500;
    }

    .badge-default {
        background: #f1f3f4;
        color: #58636a;
    }

    /* =========================
       STAT BOX
    ========================= */

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }

    .stat-box {
        border: 1px solid #e7ebee;
        border-radius: 8px;
        padding: 17px;
        background: #fbfcfc;
    }

    .stat-label {
        color: #8a969d;
        font-size: 10px;
        margin-bottom: 7px;
    }

    .stat-value {
        color: #18364d;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.2;
    }

    .stat-unit {
        color: #7a858d;
        font-size: 10px;
        font-weight: 400;
        margin-left: 3px;
    }

    /* =========================
       SYNC
    ========================= */

    .sync-box {
        border: 1px solid #e7ebee;
        border-radius: 8px;
        padding: 15px;
        background: #fbfcfc;
    }

    .sync-status {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 7px;
    }

    .sync-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .sync-dot.synced {
        background: #087443;
    }

    .sync-dot.failed {
        background: #c0392b;
    }

    .sync-dot.pending {
        background: #d8a600;
    }

    .sync-title {
        color: #18364d;
        font-size: 11px;
        font-weight: 600;
    }

    .sync-description {
        color: #8a969d;
        font-size: 10px;
        line-height: 1.5;
    }

    /* =========================
       FOOTER
    ========================= */

    .detail-footer {
        padding: 18px 22px;
        background: #fbfcfc;
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .footer-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back,
    .btn-edit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 13px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-back {
        background: white;
        color: #52616b;
        border: 1px solid var(--border);
    }

    .btn-back:hover {
        background: #f5f7f8;
        color: #18364d;
    }

    .btn-edit {
        background: var(--primary);
        color: white;
        border: 1px solid var(--primary);
    }

    .btn-edit:hover {
        background: #065c35;
        color: white;
    }

    /* =========================
       TIMESTAMP
    ========================= */

    .timestamp-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }

    .timestamp-box {
        padding: 13px 15px;
        border: 1px solid #e7ebee;
        border-radius: 7px;
        background: #fbfcfc;
    }

    .timestamp-label {
        color: #8a969d;
        font-size: 10px;
        margin-bottom: 5px;
    }

    .timestamp-value {
        color: #52616b;
        font-size: 11px;
        font-weight: 600;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 800px) {

        .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }

    @media (max-width: 600px) {

        .content-header h2 {
            font-size: 23px;
        }

        .detail-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-header,
        .detail-section {
            padding: 18px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .stat-grid,
        .timestamp-grid {
            grid-template-columns: 1fr;
        }

        .detail-footer {
            padding: 15px 18px;
            align-items: stretch;
            flex-direction: column;
        }

        .footer-buttons {
            width: 100%;
        }

        .btn-back,
        .btn-edit {
            flex: 1;
        }

    }
</style>

@endpush

@section('content')

<div class="content-header">


<div class="breadcrumb">

    <a href="{{ route('dashboard') }}">
        Beranda
    </a>

    <span class="breadcrumb-separator">
        /
    </span>

    <a href="{{ route('dataposyandu.index') }}">
        Posyandu & Posbindu
    </a>

    <span class="breadcrumb-separator">
        /
    </span>

    <span>
        Detail
    </span>

</div>

<h2>
    Detail Posyandu & Posbindu
</h2>

<p>
    Informasi lengkap data Posyandu dan Posbindu Kelurahan Binong.
</p>


</div>

<section class="detail-panel">


{{-- HEADER --}}

<div class="detail-header">

    <div class="detail-header-info">

        <h3>
            {{ $dataposyandu->nama }}
        </h3>

        <p>
            Detail informasi Posyandu & Posbindu Kelurahan Binong
        </p>

    </div>

    <span class="id-pill">

        ID:
        {{ $dataposyandu->id_data ?: '-' }}

    </span>

</div>


{{-- IDENTITAS --}}

<div class="detail-section">

    <h4 class="section-title">
        Identitas Posyandu & Posbindu
    </h4>

    <div class="detail-grid">

        <div class="detail-item">

            <div class="detail-label">
                Jenis
            </div>

            <div class="detail-value">

                @if ($dataposyandu->jenis === 'Posyandu')

                    <span class="badge badge-posyandu">
                        Posyandu
                    </span>

                @elseif ($dataposyandu->jenis === 'Posbindu')

                    <span class="badge badge-posbindu">
                        Posbindu
                    </span>

                @else

                    <span class="badge badge-default">
                        {{ $dataposyandu->jenis ?: '-' }}
                    </span>

                @endif

            </div>

        </div>


        <div class="detail-item">

            <div class="detail-label">
                ID Data
            </div>

            <div class="detail-value">

                @if ($dataposyandu->id_data)

                    {{ $dataposyandu->id_data }}

                @else

                    <span class="empty">
                        ID belum diisi
                    </span>

                @endif

            </div>

        </div>


        <div class="detail-item">

            <div class="detail-label">
                RW
            </div>

            <div class="detail-value">

                @if ($dataposyandu->rw)

                    RW {{ $dataposyandu->rw }}

                @else

                    <span class="empty">
                        Belum diisi
                    </span>

                @endif

            </div>

        </div>


        <div class="detail-item full-width">

            <div class="detail-label">
                Nama Posyandu / Posbindu
            </div>

            <div class="detail-value">

                {{ $dataposyandu->nama }}

            </div>

        </div>

    </div>

</div>


{{-- DATA JUMLAH --}}

<div class="detail-section">

    <h4 class="section-title">
        Data Jumlah
    </h4>

    <div class="stat-grid">

        <div class="stat-box">

            <div class="stat-label">
                Jumlah Kader
            </div>

            <div class="stat-value">

                {{ $dataposyandu->jumlah_kader ?? 0 }}

                <span class="stat-unit">
                    Kader
                </span>

            </div>

        </div>


        <div class="stat-box">

            <div class="stat-label">
                Jumlah Balita
            </div>

            <div class="stat-value">

                {{ $dataposyandu->jumlah_balita ?? 0 }}

                <span class="stat-unit">
                    Balita
                </span>

            </div>

        </div>

    </div>

</div>


{{-- KETERANGAN --}}

<div class="detail-section">

    <h4 class="section-title">
        Keterangan
    </h4>

    <div class="detail-item">

        <div class="detail-value">

            @if ($dataposyandu->keterangan)

                {{ $dataposyandu->keterangan }}

            @else

                <span class="empty">
                    Tidak ada keterangan.
                </span>

            @endif

        </div>

    </div>

</div>


{{-- SINKRONISASI --}}

<div class="detail-section">

    <h4 class="section-title">
        Sinkronisasi Data
    </h4>

    @php

        $syncStatus = $dataposyandu->google_sync_status ?? 'pending';

    @endphp

    <div class="sync-box">

        <div class="sync-status">

            @if ($syncStatus === 'synced')

                <span class="sync-dot synced"></span>

                <span class="sync-title">
                    Tersinkronisasi
                </span>

            @elseif ($syncStatus === 'failed')

                <span class="sync-dot failed"></span>

                <span class="sync-title">
                    Sinkronisasi Gagal
                </span>

            @else

                <span class="sync-dot pending"></span>

                <span class="sync-title">
                    Menunggu Sinkronisasi
                </span>

            @endif

        </div>


        <div class="sync-description">

            @if ($syncStatus === 'synced')

                Data Posyandu & Posbindu telah berhasil disinkronkan ke Google Sheets.

                @if ($dataposyandu->google_synced_at)

                    Terakhir disinkronkan:
                    {{ $dataposyandu->google_synced_at->locale('id')->translatedFormat('d M Y H:i') }}
                    WIB.

                @endif

            @elseif ($syncStatus === 'failed')

                Data tersimpan di sistem lokal, tetapi sinkronisasi ke Google Sheets mengalami kegagalan.

            @else

                Data belum berhasil disinkronkan ke Google Sheets.

            @endif

        </div>

    </div>

</div>


{{-- TIMESTAMP --}}

<div class="detail-section">

    <h4 class="section-title">
        Informasi Data
    </h4>

    <div class="timestamp-grid">

        <div class="timestamp-box">

            <div class="timestamp-label">
                Dibuat
            </div>

            <div class="timestamp-value">

                @if ($dataposyandu->created_at)

                    {{ $dataposyandu->created_at->locale('id')->translatedFormat('d M Y') }}
                    ·
                    {{ $dataposyandu->created_at->format('H:i') }}
                    WIB

                @else

                    -

                @endif

            </div>

        </div>


        <div class="timestamp-box">

            <div class="timestamp-label">
                Terakhir Diubah
            </div>

            <div class="timestamp-value">

                @if ($dataposyandu->updated_at)

                    {{ $dataposyandu->updated_at->locale('id')->translatedFormat('d M Y') }}
                    ·
                    {{ $dataposyandu->updated_at->format('H:i') }}
                    WIB

                @else

                    -

                @endif

            </div>

        </div>

    </div>

</div>


{{-- FOOTER --}}

<div class="detail-footer">

    <a
        href="{{ route('dataposyandu.index') }}"
        class="btn-back"
    >
        ← Kembali
    </a>

    <div class="footer-buttons">

        <a
            href="{{ route('dataposyandu.edit', $dataposyandu->id) }}"
            class="btn-edit"
        >
            ✎ Ubah Data
        </a>

    </div>

</div>


</section>

@endsection
