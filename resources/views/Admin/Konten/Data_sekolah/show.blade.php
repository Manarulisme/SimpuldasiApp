@extends('Admin.Layout.master')

@section('title', 'Detail Data Sekolah - Kelurahan Binong')
@section('page_title', 'Detail Data Sekolah')
@section('page_subtitle', 'Kesejahteraan Sosial · Data Sekolah')

@php
$syncStatus = $sekolah->google_sync_status ?? 'pending';


$syncLabel = match ($syncStatus) {
    'synced' => 'Tersinkronisasi',
    'failed' => 'Gagal Sinkronisasi',
    default => 'Menunggu Sinkronisasi',
};


@endphp

@push('styles')

<style>
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
        color: #b5bdc3;
    }

    .detail-card {
        background: #ffffff;
        border: 1px solid #e7ebee;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(16, 47, 71, 0.05);
    }

    .detail-header {
        padding: 28px 30px;
        border-bottom: 1px solid #e7ebee;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .detail-header-content h2 {
        margin: 0 0 7px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 24px;
        color: #18364d;
    }

    .detail-header-content p {
        margin: 0;
        color: #7a858d;
        font-size: 14px;
    }

    .id-pill {
        display: inline-flex;
        align-items: center;
        padding: 8px 13px;
        border-radius: 8px;
        background: #eaf5ef;
        color: #087443;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .detail-section {
        padding: 28px 30px;
        border-bottom: 1px solid #e7ebee;
    }

    .section-title {
        margin: 0 0 20px;
        font-size: 15px;
        font-weight: 700;
        color: #18364d;
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
        margin-bottom: 7px;
        color: #7a858d;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .detail-value {
        color: #263238;
        font-size: 14px;
        line-height: 1.6;
        word-break: break-word;
    }

    .detail-value.empty {
        color: #9aa3a9;
        font-style: italic;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-jenjang {
        background: #eaf5ef;
        color: #087443;
    }

    .badge-id {
        background: #f1f3f5;
        color: #53616a;
    }

    .student-stat {
        display: inline-flex;
        align-items: baseline;
        gap: 6px;
    }

    .student-number {
        font-size: 22px;
        font-weight: 800;
        color: #087443;
    }

    .student-label {
        font-size: 13px;
        color: #7a858d;
    }

    .description-box {
        padding: 15px 17px;
        border-radius: 9px;
        background: #f7f9fa;
        border: 1px solid #e7ebee;
        color: #52616a;
        font-size: 14px;
        line-height: 1.7;
        white-space: pre-line;
    }

    .sync-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .sync-box {
        padding: 17px;
        border: 1px solid #e7ebee;
        border-radius: 10px;
        background: #fafbfb;
    }

    .sync-box-label {
        margin-bottom: 7px;
        font-size: 11px;
        color: #7a858d;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        font-weight: 700;
    }

    .sync-box-value {
        color: #263238;
        font-size: 13px;
        font-weight: 700;
    }

    .sync-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .sync-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #d8a600;
    }

    .sync-dot.synced {
        background: #087443;
    }

    .sync-dot.failed {
        background: #c0392b;
    }

    .detail-footer {
        padding: 20px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: #fafbfb;
    }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 40px;
        padding: 9px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: 0.2s ease;
        border: 1px solid transparent;
    }

    .btn-back {
        background: #ffffff;
        border-color: #dfe5e8;
        color: #53616a;
    }

    .btn-back:hover {
        background: #f1f3f5;
    }

    .btn-edit {
        background: #087443;
        color: #ffffff;
    }

    .btn-edit:hover {
        background: #065c35;
    }

    .footer-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .detail-header {
            padding: 22px 20px;
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-section {
            padding: 22px 20px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .detail-item.full {
            grid-column: auto;
        }

        .sync-grid {
            grid-template-columns: 1fr;
        }

        .detail-footer {
            padding: 18px 20px;
            flex-direction: column;
            align-items: stretch;
        }

        .footer-actions {
            width: 100%;
        }

        .footer-actions .btn-detail {
            flex: 1;
        }
    }
</style>

@endpush

@section('content')

<div class="breadcrumb">
    <a href="{{ route('dashboard') }}">Beranda</a>
    <span class="breadcrumb-separator">/</span>
    <a href="{{ route('datasekolah.index') }}">Data Sekolah</a>
    <span class="breadcrumb-separator">/</span>
    <span>Detail Data</span>
</div>

<div class="detail-card">


<div class="detail-header">
    <div class="detail-header-content">
        <h2>{{ $sekolah->nama_sekolah }}</h2>
        <p>Detail informasi sekolah Kelurahan Binong</p>
    </div>

    <div class="id-pill">
        {{ $sekolah->id_data ?: 'ID belum diisi' }}
    </div>
</div>

<div class="detail-section">
    <h3 class="section-title">Identitas Sekolah</h3>

    <div class="detail-grid">

        <div class="detail-item">
            <div class="detail-label">ID Data</div>
            <div class="detail-value">
                @if ($sekolah->id_data)
                    <span class="badge badge-id">
                        {{ $sekolah->id_data }}
                    </span>
                @else
                    <span class="detail-value empty">
                        Belum diisi
                    </span>
                @endif
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Jenjang</div>
            <div class="detail-value">
                <span class="badge badge-jenjang">
                    {{ $sekolah->jenjang }}
                </span>
            </div>
        </div>

        <div class="detail-item full">
            <div class="detail-label">Nama Sekolah</div>
            <div class="detail-value">
                {{ $sekolah->nama_sekolah }}
            </div>
        </div>

        <div class="detail-item full">
            <div class="detail-label">Alamat Sekolah</div>
            <div class="detail-value">
                @if ($sekolah->alamat)
                    {{ $sekolah->alamat }}
                @else
                    <span class="detail-value empty">
                        Alamat belum diisi
                    </span>
                @endif
            </div>
        </div>

    </div>
</div>

<div class="detail-section">
    <h3 class="section-title">Data Sekolah</h3>

    <div class="detail-grid">

        <div class="detail-item">
            <div class="detail-label">Jumlah Siswa</div>
            <div class="detail-value">
                <div class="student-stat">
                    <span class="student-number">
                        {{ number_format($sekolah->jumlah_siswa ?? 0, 0, ',', '.') }}
                    </span>
                    <span class="student-label">
                        siswa
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Jenjang Pendidikan</div>
            <div class="detail-value">
                <span class="badge badge-jenjang">
                    {{ $sekolah->jenjang }}
                </span>
            </div>
        </div>

        <div class="detail-item full">
            <div class="detail-label">Keterangan</div>

            @if ($sekolah->keterangan)
                <div class="description-box">
                    {{ $sekolah->keterangan }}
                </div>
            @else
                <div class="description-box">
                    Tidak ada keterangan.
                </div>
            @endif
        </div>

    </div>
</div>

<div class="detail-section">
    <h3 class="section-title">Sinkronisasi Data</h3>

    <div class="sync-grid">

        <div class="sync-box">
            <div class="sync-box-label">Status Sinkronisasi</div>

            <div class="sync-box-value">
                <span class="sync-status">
                    <span class="sync-dot {{ $syncStatus }}"></span>
                    {{ $syncLabel }}
                </span>
            </div>
        </div>

        <div class="sync-box">
            <div class="sync-box-label">Sinkronisasi Terakhir</div>

            <div class="sync-box-value">
                @if ($sekolah->google_synced_at)
                    {{ $sekolah->google_synced_at->locale('id')->translatedFormat('d M Y') }}
                    <br>
                    <span style="font-weight: 500; color: #7a858d;">
                        {{ $sekolah->google_synced_at->format('H:i') }} WIB
                    </span>
                @else
                    Belum pernah
                @endif
            </div>
        </div>

        <div class="sync-box">
            <div class="sync-box-label">Penyimpanan</div>

            <div class="sync-box-value">
                Tersimpan di Database
            </div>
        </div>

    </div>
</div>

<div class="detail-section">
    <h3 class="section-title">Informasi Data</h3>

    <div class="detail-grid">

        <div class="detail-item">
            <div class="detail-label">Dibuat Pada</div>
            <div class="detail-value">
                @if ($sekolah->created_at)
                    {{ $sekolah->created_at->locale('id')->translatedFormat('d M Y') }}
                    <span style="color: #7a858d;">
                        · {{ $sekolah->created_at->format('H:i') }} WIB
                    </span>
                @else
                    <span class="detail-value empty">
                        Tidak tersedia
                    </span>
                @endif
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Terakhir Diperbarui</div>
            <div class="detail-value">
                @if ($sekolah->updated_at)
                    {{ $sekolah->updated_at->locale('id')->translatedFormat('d M Y') }}
                    <span style="color: #7a858d;">
                        · {{ $sekolah->updated_at->format('H:i') }} WIB
                    </span>
                @else
                    <span class="detail-value empty">
                        Tidak tersedia
                    </span>
                @endif
            </div>
        </div>

    </div>
</div>

<div class="detail-footer">

    <a href="{{ route('datasekolah.index') }}" class="btn-detail btn-back">
        ← Kembali
    </a>

    <div class="footer-actions">
        <a href="{{ route('datasekolah.edit', $sekolah->id) }}" class="btn-detail btn-edit">
            ✎ Ubah Data
        </a>
    </div>

</div>


</div>

@endsection
