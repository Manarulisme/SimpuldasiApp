@extends('Admin.Layout.master')

@section('title', 'Detail Data Anak Putus Sekolah - Kelurahan Binong')

@section('page_title', 'Detail Data Anak Putus Sekolah')

@section('page_subtitle', 'Kesejahteraan Sosial · Data Anak Putus Sekolah')

@php
$syncStatus = $putusSekolah->google_sync_status ?? 'pending';
@endphp

@push('styles')

<style>
    .detail-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 22px;
        font-size: 13px;
        color: #7a858d;
        flex-wrap: wrap;
    }

    .breadcrumb a {
        color: #087443;
        text-decoration: none;
        font-weight: 600;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb-separator {
        color: #aab2b7;
    }

    .page-heading {
        margin-bottom: 24px;
    }

    .page-heading h1 {
        margin: 0 0 7px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 30px;
        line-height: 1.25;
        color: #18364d;
        font-weight: 700;
    }

    .page-heading p {
        margin: 0;
        color: #7a858d;
        font-size: 14px;
    }

    .detail-card {
        background: #ffffff;
        border: 1px solid #e7ebee;
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(16, 47, 71, 0.06);
        overflow: hidden;
    }

    .detail-header {
        padding: 28px;
        border-bottom: 1px solid #edf0f2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .detail-header-content {
        min-width: 0;
    }

    .detail-header h2 {
        margin: 0 0 7px;
        color: #18364d;
        font-size: 23px;
        line-height: 1.3;
        font-weight: 700;
        word-break: break-word;
    }

    .detail-header p {
        margin: 0;
        color: #7a858d;
        font-size: 13px;
    }

    .id-pill {
        flex-shrink: 0;
        padding: 8px 13px;
        border-radius: 8px;
        background: #eaf5ef;
        color: #087443;
        font-size: 12px;
        font-weight: 700;
        border: 1px solid #d8ebe1;
    }

    .detail-section {
        padding: 26px 28px;
        border-bottom: 1px solid #edf0f2;
    }

    .detail-section:last-of-type {
        border-bottom: none;
    }

    .section-heading {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 22px;
    }

    .section-number {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 9px;
        background: #eaf5ef;
        color: #087443;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
    }

    .section-heading h3 {
        margin: 0 0 4px;
        color: #18364d;
        font-size: 17px;
        font-weight: 700;
    }

    .section-heading p {
        margin: 0;
        color: #7a858d;
        font-size: 13px;
        line-height: 1.5;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 24px;
    }

    .detail-item {
        min-width: 0;
    }

    .detail-item.full {
        grid-column: 1 / -1;
    }

    .detail-label {
        margin-bottom: 6px;
        color: #8a949b;
        font-size: 12px;
        font-weight: 600;
    }

    .detail-value {
        color: #263238;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.5;
        word-break: break-word;
    }

    .detail-value.muted {
        color: #9aa3a9;
        font-weight: 400;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        min-height: 27px;
        padding: 4px 10px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        box-sizing: border-box;
    }

    .badge-rw {
        background: #f0f3f5;
        color: #52616a;
        border: 1px solid #e1e6e9;
    }

    .badge-jenjang {
        background: #eef4fa;
        color: #365a77;
        border: 1px solid #d9e5ef;
    }

    .badge-alasan {
        background: #fff7df;
        color: #8a6900;
        border: 1px solid #f1df9e;
    }

    .description-box {
        padding: 15px 17px;
        background: #f8fafb;
        border: 1px solid #e7ebee;
        border-radius: 10px;
        color: #52616a;
        font-size: 13px;
        line-height: 1.7;
        white-space: pre-line;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .stat-box {
        padding: 18px;
        border: 1px solid #e7ebee;
        border-radius: 11px;
        background: #fafbfb;
    }

    .stat-label {
        margin-bottom: 7px;
        color: #8a949b;
        font-size: 12px;
        font-weight: 600;
    }

    .stat-value {
        color: #18364d;
        font-size: 21px;
        font-weight: 700;
    }

    .sync-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .sync-box {
        padding: 16px;
        border: 1px solid #e7ebee;
        border-radius: 10px;
        background: #fafbfb;
    }

    .sync-label {
        margin-bottom: 7px;
        color: #8a949b;
        font-size: 12px;
        font-weight: 600;
    }

    .sync-status {
        font-size: 13px;
        font-weight: 700;
    }

    .sync-status.synced {
        color: #087443;
    }

    .sync-status.failed {
        color: #c62828;
    }

    .sync-status.pending {
        color: #a77900;
    }

    .sync-time {
        margin-top: 5px;
        color: #8a949b;
        font-size: 11px;
        line-height: 1.4;
    }

    .timestamp-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .timestamp-box {
        padding: 15px 16px;
        border: 1px solid #e7ebee;
        border-radius: 10px;
        background: #fafbfb;
    }

    .timestamp-label {
        margin-bottom: 6px;
        color: #8a949b;
        font-size: 12px;
        font-weight: 600;
    }

    .timestamp-value {
        color: #52616a;
        font-size: 13px;
        font-weight: 600;
    }

    .detail-footer {
        padding: 20px 28px;
        background: #fafbfb;
        border-top: 1px solid #edf0f2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .footer-note {
        color: #8a949b;
        font-size: 12px;
    }

    .footer-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn {
        min-height: 42px;
        padding: 9px 17px;
        border-radius: 8px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        box-sizing: border-box;
        transition: all .2s ease;
    }

    .btn-secondary {
        background: #ffffff;
        color: #52616a;
        border: 1px solid #dce2e6;
    }

    .btn-secondary:hover {
        background: #f5f7f8;
        border-color: #cbd3d8;
    }

    .btn-primary {
        background: #087443;
        color: #ffffff;
        border: 1px solid #087443;
        box-shadow: 0 2px 5px rgba(8, 116, 67, 0.16);
    }

    .btn-primary:hover {
        background: #075f37;
        border-color: #075f37;
    }

    @media (max-width: 768px) {
        .page-heading h1 {
            font-size: 25px;
        }

        .detail-header {
            padding: 22px 18px;
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-section {
            padding: 22px 18px;
        }

        .detail-grid,
        .stats-grid,
        .timestamp-grid {
            grid-template-columns: 1fr;
        }

        .detail-item.full {
            grid-column: auto;
        }

        .sync-grid {
            grid-template-columns: 1fr;
        }

        .detail-footer {
            padding: 18px;
            flex-direction: column;
            align-items: stretch;
        }

        .footer-note {
            text-align: center;
        }

        .footer-actions {
            width: 100%;
        }

        .footer-actions .btn {
            flex: 1;
        }
    }
</style>

@endpush

@section('content')

<div class="detail-page">


<div class="breadcrumb">
    <a href="{{ route('dashboard') }}">Beranda</a>
    <span class="breadcrumb-separator">›</span>
    <a href="{{ route('dataputussekolah.index') }}">Data Anak Putus Sekolah</a>
    <span class="breadcrumb-separator">›</span>
    <span>Detail Data</span>
</div>

<div class="page-heading">
    <h1>Detail Data Anak Putus Sekolah</h1>
    <p>Informasi lengkap data anak putus sekolah di Kelurahan Binong.</p>
</div>

<div class="detail-card">

    {{-- HEADER --}}
    <div class="detail-header">

        <div class="detail-header-content">
            <h2>{{ $putusSekolah->nama }}</h2>
            <p>Data Anak Putus Sekolah · Kelurahan Binong</p>
        </div>

        <div class="id-pill">
            {{ $putusSekolah->id_data ?: 'ID belum diisi' }}
        </div>

    </div>

    {{-- SECTION 1 --}}
    <div class="detail-section">

        <div class="section-heading">
            <div class="section-number">01</div>

            <div>
                <h3>Identitas Anak</h3>
                <p>Informasi dasar anak yang tercatat dalam data kelurahan.</p>
            </div>
        </div>

        <div class="detail-grid">

            <div class="detail-item">
                <div class="detail-label">ID Data</div>
                <div class="detail-value">
                    {{ $putusSekolah->id_data ?: '-' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">NIK</div>
                <div class="detail-value">
                    {{ $putusSekolah->nik ?: '-' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Nama Anak</div>
                <div class="detail-value">
                    {{ $putusSekolah->nama ?: '-' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">RW</div>
                <div class="detail-value">
                    @if ($putusSekolah->rw)
                        <span class="badge badge-rw">
                            {{ $putusSekolah->rw }}
                        </span>
                    @else
                        <span class="detail-value muted">Belum diisi</span>
                    @endif
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Usia</div>
                <div class="detail-value">
                    {{ $putusSekolah->usia }} tahun
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Jenjang Pendidikan Terakhir</div>
                <div class="detail-value">
                    <span class="badge badge-jenjang">
                        {{ $putusSekolah->jenjang_terakhir }}
                    </span>
                </div>
            </div>

        </div>

    </div>

    {{-- SECTION 2 --}}
    <div class="detail-section">

        <div class="section-heading">
            <div class="section-number">02</div>

            <div>
                <h3>Data Putus Sekolah</h3>
                <p>Informasi mengenai kondisi dan alasan anak tidak melanjutkan pendidikan.</p>
            </div>
        </div>

        <div class="detail-grid">

            <div class="detail-item full">
                <div class="detail-label">Alasan Putus Sekolah</div>

                <div class="detail-value">
                    <span class="badge badge-alasan">
                        {{ $putusSekolah->alasan ?: '-' }}
                    </span>
                </div>
            </div>

            <div class="detail-item full">
                <div class="detail-label">Keterangan</div>

                @if ($putusSekolah->keterangan)
                    <div class="description-box">
                        {{ $putusSekolah->keterangan }}
                    </div>
                @else
                    <div class="detail-value muted">
                        Tidak ada keterangan.
                    </div>
                @endif
            </div>

        </div>

    </div>

    {{-- SECTION 3 --}}
    <div class="detail-section">

        <div class="section-heading">
            <div class="section-number">03</div>

            <div>
                <h3>Sinkronisasi Data</h3>
                <p>Status penyimpanan dan sinkronisasi data.</p>
            </div>
        </div>

        <div class="sync-grid">

            <div class="sync-box">
                <div class="sync-label">Status Sinkronisasi</div>

                @if ($syncStatus === 'synced')
                    <div class="sync-status synced">
                        Tersinkronisasi
                    </div>

                @elseif ($syncStatus === 'failed')
                    <div class="sync-status failed">
                        Gagal Sinkronisasi
                    </div>

                @else
                    <div class="sync-status pending">
                        Menunggu Sinkronisasi
                    </div>
                @endif

                @if ($putusSekolah->google_synced_at)
                    <div class="sync-time">
                        {{ $putusSekolah->google_synced_at->locale('id')->translatedFormat('d M Y, H:i') }}
                        WIB
                    </div>
                @else
                    <div class="sync-time">
                        Belum pernah disinkronkan
                    </div>
                @endif
            </div>

            <div class="sync-box">
                <div class="sync-label">Penyimpanan</div>

                <div class="sync-status synced">
                    Tersimpan di Database
                </div>

                <div class="sync-time">
                    Data tersedia di sistem kelurahan.
                </div>
            </div>

            <div class="sync-box">
                <div class="sync-label">Status Data</div>

                <div class="sync-status synced">
                    Data Aktif
                </div>

                <div class="sync-time">
                    Data tercatat dalam sistem.
                </div>
            </div>

        </div>

    </div>

    {{-- SECTION 4 --}}
    <div class="detail-section">

        <div class="section-heading">
            <div class="section-number">04</div>

            <div>
                <h3>Informasi Data</h3>
                <p>Waktu pencatatan dan perubahan terakhir data.</p>
            </div>
        </div>

        <div class="timestamp-grid">

            <div class="timestamp-box">
                <div class="timestamp-label">Dibuat Pada</div>

                <div class="timestamp-value">
                    {{ $putusSekolah->created_at
                        ? $putusSekolah->created_at->locale('id')->translatedFormat('d M Y, H:i')
                        : '-' }}
                    @if ($putusSekolah->created_at)
                        WIB
                    @endif
                </div>
            </div>

            <div class="timestamp-box">
                <div class="timestamp-label">Terakhir Diperbarui</div>

                <div class="timestamp-value">
                    {{ $putusSekolah->updated_at
                        ? $putusSekolah->updated_at->locale('id')->translatedFormat('d M Y, H:i')
                        : '-' }}
                    @if ($putusSekolah->updated_at)
                        WIB
                    @endif
                </div>
            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    <div class="detail-footer">

        <div class="footer-note">
            Data Anak Putus Sekolah · Kelurahan Binong
        </div>

        <div class="footer-actions">

            <a
                href="{{ route('dataputussekolah.index') }}"
                class="btn btn-secondary"
            >
                Kembali
            </a>

            <a
                href="{{ route('dataputussekolah.edit', $putusSekolah->id) }}"
                class="btn btn-primary"
            >
                Ubah Data
            </a>

        </div>

    </div>

</div>


</div>

@endsection
