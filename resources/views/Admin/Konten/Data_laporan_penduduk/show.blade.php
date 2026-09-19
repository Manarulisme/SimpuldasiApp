@extends('Admin.Layout.master')

@section('title', 'Detail Data Laporan Penduduk - Kelurahan Binong')

@section('page_title', 'Detail Data Laporan Penduduk')

@section('page_subtitle', 'Kependudukan · Laporan Penduduk · Detail Data')

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

.badge-month {
    background: #eef6ff;
    color: #3971a9;
}

.badge-year {
    background: #edf8f1;
    color: #34734e;
}

.badge-count {
    background: #f3f6f4;
    color: #52605a;
}

.badge-death {
    background: #fff0f0;
    color: #b74b4b;
}

.badge-birth {
    background: #edf8f1;
    color: #34734e;
}

.badge-in {
    background: #eef6ff;
    color: #3971a9;
}

.badge-out {
    background: #fff8e8;
    color: #956c17;
}

.badge-temporary {
    background: #f4f0ff;
    color: #7053a6;
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

<a href="{{ route('datalaporanpenduduk.index') }}">
    Laporan Penduduk
</a>

<span>›</span>

<span>
    Detail Data
</span>

</div>

<div class="page-title-block">

<h2>
    Detail Data Laporan Penduduk
</h2>

<p>
    Informasi lengkap laporan kependudukan Kelurahan Binong berdasarkan periode laporan.
</p>

</div>

<div class="detail-card">

{{-- HEADER --}}

<div class="detail-header">

<div class="detail-header-info">

<h3>
    {{ $dataLaporanPenduduk->bulan ?: 'Periode Laporan' }}
    {{ $dataLaporanPenduduk->tahun ?: '' }}
</h3>

<p>
    Laporan Kependudukan Kelurahan Binong
</p>

</div>

<div class="id-badge">
    ID: {{ $dataLaporanPenduduk->id }}
</div>

</div>

<div class="detail-body">

{{-- PERIODE LAPORAN --}}

<div class="detail-section">

<div class="section-title">

<span class="section-number">
    1
</span>

Periode Laporan

</div>

<div class="detail-grid">

<div class="detail-item">

<span class="detail-label">
    Bulan
</span>

<span class="detail-value">

@if($dataLaporanPenduduk->bulan)

<span class="badge badge-month">
    {{ $dataLaporanPenduduk->bulan }}
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
    Tahun
</span>

<span class="detail-value">

@if($dataLaporanPenduduk->tahun)

<span class="badge badge-year">
    {{ $dataLaporanPenduduk->tahun }}
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

{{-- DATA KEPENDUDUKAN --}}

<div class="detail-section">

<div class="section-title">

<span class="section-number">
    2
</span>

Data Kependudukan

</div>

<div class="detail-grid">

<div class="detail-item">

<span class="detail-label">
    Jumlah Kepala Keluarga
</span>

<span class="detail-value">

<span class="badge badge-count">
    {{ number_format($dataLaporanPenduduk->jumlah_kk ?? 0, 0, ',', '.') }}
</span>

</span>

</div>

<div class="detail-item">

<span class="detail-label">
    Jumlah Laki-Laki
</span>

<span class="detail-value">

<span class="badge badge-count">
    {{ number_format($dataLaporanPenduduk->jumlah_laki_laki ?? 0, 0, ',', '.') }}
</span>

</span>

</div>

<div class="detail-item">

<span class="detail-label">
    Jumlah Perempuan
</span>

<span class="detail-value">

<span class="badge badge-count">
    {{ number_format($dataLaporanPenduduk->jumlah_perempuan ?? 0, 0, ',', '.') }}
</span>

</span>

</div>

<div class="detail-item">

<span class="detail-label">
    Total Penduduk
</span>

<span class="detail-value">

<span class="badge badge-count">
    {{ number_format(
        ($dataLaporanPenduduk->jumlah_laki_laki ?? 0)
        + ($dataLaporanPenduduk->jumlah_perempuan ?? 0),
        0,
        ',',
        '.'
    ) }}
</span>

</span>

</div>

</div>

</div>

{{-- PERUBAHAN DATA PENDUDUK --}}

<div class="detail-section">

<div class="section-title">

<span class="section-number">
    3
</span>

Perubahan Data Penduduk

</div>

<div class="detail-grid">

<div class="detail-item">

<span class="detail-label">
    Jumlah Kematian
</span>

<span class="detail-value">

<span class="badge badge-death">
    {{ number_format($dataLaporanPenduduk->jumlah_kematian ?? 0, 0, ',', '.') }}
</span>

</span>

</div>

<div class="detail-item">

<span class="detail-label">
    Jumlah Kelahiran
</span>

<span class="detail-value">

<span class="badge badge-birth">
    {{ number_format($dataLaporanPenduduk->jumlah_kelahiran ?? 0, 0, ',', '.') }}
</span>

</span>

</div>

<div class="detail-item">

<span class="detail-label">
    Pindah Datang
</span>

<span class="detail-value">

<span class="badge badge-in">
    {{ number_format($dataLaporanPenduduk->jumlah_pindah_datang ?? 0, 0, ',', '.') }}
</span>

</span>

</div>

<div class="detail-item">

<span class="detail-label">
    Pindah Keluar
</span>

<span class="detail-value">

<span class="badge badge-out">
    {{ number_format($dataLaporanPenduduk->jumlah_pindah_keluar ?? 0, 0, ',', '.') }}
</span>

</span>

</div>

<div class="detail-item">

<span class="detail-label">
    Penduduk Sementara
</span>

<span class="detail-value">

<span class="badge badge-temporary">
    {{ number_format($dataLaporanPenduduk->penduduk_sementara ?? 0, 0, ',', '.') }}
</span>

</span>

</div>

</div>

</div>

{{-- KETERANGAN --}}

<div class="detail-section">

<div class="section-title">

<span class="section-number">
    4
</span>

Keterangan

</div>

<div class="detail-grid">

<div class="detail-item full">

<span class="detail-label">
    Keterangan
</span>

<span class="detail-value">

@if($dataLaporanPenduduk->keterangan)

{{ $dataLaporanPenduduk->keterangan }}

@else

<span class="detail-value empty">
    Belum ada keterangan
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

$syncStatus = $dataLaporanPenduduk->google_sync_status ?? 'pending';

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

{{ $dataLaporanPenduduk->created_at
? $dataLaporanPenduduk->created_at->translatedFormat('d F Y, H:i') . ' WIB'
: '-' }}

</strong>

</div>

<div class="info-item">

<span>
    Terakhir Diperbarui
</span>

<strong>

{{ $dataLaporanPenduduk->updated_at
? $dataLaporanPenduduk->updated_at->translatedFormat('d F Y, H:i') . ' WIB'
: '-' }}

</strong>

</div>

</div>

</div>

</div>

{{-- FOOTER --}}

<div class="detail-footer">

<a
href="{{ route('datalaporanpenduduk.index') }}"
class="btn btn-secondary"

>

← Kembali

</a>

<div class="detail-actions">

<a
href="{{ route('datalaporanpenduduk.edit', ['datalaporanpenduduk' => $dataLaporanPenduduk->id]) }}"
class="btn btn-primary"

>

✎ Ubah Data

</a>

</div>

</div>

</div>

@endsection
