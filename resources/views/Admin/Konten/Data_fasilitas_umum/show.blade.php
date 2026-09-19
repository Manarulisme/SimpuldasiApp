@extends('Admin.Layout.master')

@section('title', 'Detail Data Fasilitas Umum & Sosial - Kelurahan Binong')

@section('page_title', 'Detail Data Fasilitas Umum & Sosial')

@section('page_subtitle', 'Sarana & Prasarana · Fasilitas Umum & Sosial · Detail Data')

@push('styles')

<style>
.breadcrumb {
    display: flex;
    gap: 8px;
    align-items: center;
    color: var(--muted);
    font-size: 12px;
    margin-bottom: 18px;
}

.breadcrumb a {
    color: var(--primary);
    text-decoration: none;
}

.page-title-block {
    margin-bottom: 25px;
}

.page-title-block h2 {
    font: 27px Georgia, serif;
    color: #18364d;
}

.page-title-block p {
    font-size: 13px;
    color: var(--muted);
    margin-top: 7px;
}

.detail-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.detail-header {
    padding: 23px 25px;
    background: #fbfcfc;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.detail-header-info h3 {
    font-size: 18px;
    color: #18364d;
    margin-bottom: 6px;
}

.detail-header-info p {
    font-size: 12px;
    color: var(--muted);
}

.id-badge {
    padding: 8px 12px;
    background: var(--primary-light);
    color: var(--primary);
    border-radius: 6px;
    font-size: 11px;
    font-weight: bold;
    white-space: nowrap;
}

.detail-body {
    padding: 28px 25px;
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
    font-size: 12px;
    font-weight: bold;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px 25px;
}

.detail-item {
    padding: 15px 16px;
    border: 1px solid #edf0f2;
    border-radius: 8px;
    background: #fff;
}

.detail-item.full {
    grid-column: 1 / -1;
}

.detail-label {
    display: block;
    font-size: 11px;
    color: var(--muted);
    margin-bottom: 7px;
}

.detail-value {
    display: block;
    font-size: 13px;
    color: var(--text);
    font-weight: 600;
    line-height: 1.5;
}

.detail-value.empty {
    color: #aab2b7;
    font-weight: normal;
    font-style: italic;
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: bold;
}

.badge-location {
    background: #f0f2f4;
    color: #52616b;
}

.badge-community {
    background: #eaf5ef;
    color: #087443;
}

.badge-government {
    background: #eef2ff;
    color: #4056a1;
}

.badge-private {
    background: #fff5dc;
    color: #9a6b00;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.info-item {
    padding: 15px;
    background: #f8fafb;
    border: 1px solid #edf0f2;
    border-radius: 8px;
}

.info-item span {
    display: block;
    font-size: 11px;
    color: var(--muted);
    margin-bottom: 7px;
}

.info-item strong {
    display: block;
    font-size: 12px;
    color: var(--text);
}

.status-sync {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: bold;
}

.status-sync.synced {
    background: #eaf5ef;
    color: #087443;
}

.status-sync.failed {
    background: #fdeaea;
    color: #c0392b;
}

.status-sync.pending {
    background: #fff5dc;
    color: #9a6b00;
}

.detail-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    border-top: 1px solid var(--border);
    background: #fbfcfc;
}

.detail-actions {
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
    text-decoration: none;
    cursor: pointer;
}

.btn-secondary {
    background: #fff;
    border: 1px solid #dce2e5;
    color: #263238;
}

.btn-secondary:hover {
    background: #f2f4f5;
}

.btn-primary {
    background: var(--primary);
    color: #fff;
}

.btn-primary:hover {
    opacity: 0.92;
}

@media (max-width: 800px) {

    .detail-grid {
        grid-template-columns: 1fr;
    }

    .detail-item.full {
        grid-column: auto;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .detail-header {
        align-items: flex-start;
        flex-direction: column;
    }

}

@media (max-width: 600px) {

    .detail-body {
        padding: 22px 18px;
    }

    .detail-header {
        padding: 20px 18px;
    }

    .detail-footer {
        padding: 18px;
        flex-direction: column;
        align-items: stretch;
        gap: 15px;
    }

    .detail-actions {
        width: 100%;
    }

    .detail-actions .btn {
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

<a href="{{ route('datafasilitasumum.index') }}">
    Fasilitas Umum & Sosial
</a>

<span>›</span>

<span>
    Detail Data
</span>

</div>

<div class="page-title-block">

<h2>
    Detail Data Fasilitas Umum & Sosial
</h2>

<p>
    Informasi lengkap data fasilitas umum dan sosial Kelurahan Binong.
</p>

</div>

<div class="detail-card">

{{-- HEADER --}}

<div class="detail-header">

<div class="detail-header-info">


<h3>
    {{ $dataFasilitasUmum->nama ?: 'Data Fasilitas Umum & Sosial' }}
</h3>

<p>
    {{ $dataFasilitasUmum->lokasi ?: 'Lokasi belum diisi' }}
</p>


</div>

<div class="id-badge">
    ID: {{ $dataFasilitasUmum->id }}
</div>

</div>

<div class="detail-body">

{{-- IDENTITAS FASILITAS --}}

<div class="detail-section">


<div class="section-title">

    <span class="section-number">
        1
    </span>

    Identitas Fasilitas

</div>

<div class="detail-grid">

    <div class="detail-item full">

        <span class="detail-label">
            Nama Fasilitas
        </span>

        <span class="detail-value">

            {{ $dataFasilitasUmum->nama ?: '-' }}

        </span>

    </div>

</div>


</div>

{{-- LOKASI FASILITAS --}}

<div class="detail-section">


<div class="section-title">

    <span class="section-number">
        2
    </span>

    Lokasi Fasilitas

</div>

<div class="detail-grid">

    <div class="detail-item">

        <span class="detail-label">
            Lokasi
        </span>

        <span class="detail-value">

            @if($dataFasilitasUmum->lokasi)

                <span class="badge badge-location">
                    {{ $dataFasilitasUmum->lokasi }}
                </span>

            @else

                <span class="detail-value empty">
                    Belum diisi
                </span>

            @endif

        </span>

    </div>

    <div class="detail-item">

        <span class="detail-label">
            Jenis Fasilitas
        </span>

        <span class="detail-value">

            @if(in_array($dataFasilitasUmum->jenis, ['Kesehatan', 'Pendidikan', 'Sosial', 'Infrastruktur']))

                <span class="badge badge-government">
                    {{ $dataFasilitasUmum->jenis }}
                </span>

            @elseif(in_array($dataFasilitasUmum->jenis, ['Olahraga', 'Ruang Terbuka', 'Keagamaan']))

                <span class="badge badge-community">
                    {{ $dataFasilitasUmum->jenis }}
                </span>

            @elseif($dataFasilitasUmum->jenis)

                <span class="badge badge-private">
                    {{ $dataFasilitasUmum->jenis }}
                </span>

            @else

                <span class="detail-value empty">
                    Belum diisi
                </span>

            @endif

        </span>

    </div>

</div>


</div>

{{-- ALAMAT FASILITAS --}}

<div class="detail-section">


<div class="section-title">

    <span class="section-number">
        3
    </span>

    Alamat Fasilitas

</div>

<div class="detail-grid">

    <div class="detail-item full">

        <span class="detail-label">
            Alamat
        </span>

        <span class="detail-value">

            @if($dataFasilitasUmum->alamat)

                {{ $dataFasilitasUmum->alamat }}

            @else

                <span class="detail-value empty">
                    Belum diisi
                </span>

            @endif

        </span>

    </div>

</div>


</div>

{{-- SUMBER DANA --}}

<div class="detail-section">


<div class="section-title">

    <span class="section-number">
        4
    </span>

    Sumber Dana

</div>

<div class="detail-grid">

    <div class="detail-item">

        <span class="detail-label">
            Sumber Dana
        </span>

        <span class="detail-value">

            @if($dataFasilitasUmum->sumber_dana)

                <span class="badge badge-location">
                    {{ $dataFasilitasUmum->sumber_dana }}
                </span>

            @else

                <span class="detail-value empty">
                    Belum diisi
                </span>

            @endif

        </span>

    </div>

</div>


</div>

{{-- INFORMASI DATA --}}

<div class="detail-section">


<div class="section-title">

    <span class="section-number">
        5
    </span>

    Informasi Data

</div>

@php

    $syncStatus = $dataFasilitasUmum->google_sync_status ?? 'pending';

@endphp

<div class="info-grid">

    <div class="info-item">

        <span>
            Status Data
        </span>

        @if($syncStatus === 'synced')

            <strong>

                <span class="status-sync synced">
                    ● Tersinkronisasi
                </span>

            </strong>

        @elseif($syncStatus === 'failed')

            <strong>

                <span class="status-sync failed">
                    ● Gagal Sinkronisasi
                </span>

            </strong>

        @else

            <strong>

                <span class="status-sync pending">
                    ● Menunggu Sinkronisasi
                </span>

            </strong>

        @endif

    </div>

    <div class="info-item">

        <span>
            Dibuat
        </span>

        <strong>

            {{ $dataFasilitasUmum->created_at
                ? $dataFasilitasUmum->created_at->translatedFormat('d F Y, H:i') . ' WIB'
                : '-' }}

        </strong>

    </div>

    <div class="info-item">

        <span>
            Terakhir Diperbarui
        </span>

        <strong>

            {{ $dataFasilitasUmum->updated_at
                ? $dataFasilitasUmum->updated_at->translatedFormat('d F Y, H:i') . ' WIB'
                : '-' }}

        </strong>

    </div>

</div>


</div>

</div>

{{-- FOOTER --}}

<div class="detail-footer">

<a
href="{{ route('datafasilitasumum.index') }}"
class="btn btn-secondary"

>


← Kembali


</a>

<div class="detail-actions">


<a
    href="{{ route('datafasilitasumum.edit', ['datafasilitasumum' => $dataFasilitasUmum->id]) }}"
    class="btn btn-primary"
>
    ✎ Ubah Data
</a>


</div>

</div>

</div>

@endsection
