@extends('Admin.Layout.master')

@section('title', 'Detail Data UMKM - Kelurahan Binong')

@section('page_title', 'Detail Data UMKM')

@section('page_subtitle', 'Perekonomian · Data UMKM · Detail Data')

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

.badge-scale {
    background: #f0f2f4;
    color: #52616b;
}

.badge-active {
    background: #eaf5ef;
    color: #087443;
}

.badge-inactive {
    background: #fdeaea;
    color: #c0392b;
}

.badge-pending {
    background: #fff5dc;
    color: #9a6b00;
}

.badge-synced {
    background: #eaf5ef;
    color: #087443;
}

.badge-failed {
    background: #fdeaea;
    color: #c0392b;
}

.keterangan-box {
    padding: 16px;
    background: #f8fafb;
    border: 1px solid #edf0f2;
    border-radius: 8px;
    color: #52616b;
    font-size: 13px;
    line-height: 1.7;
    min-height: 70px;
}

.keterangan-empty {
    color: #aab2b7;
    font-style: italic;
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

<a href="{{ route('dataumkm.index') }}">
    Data UMKM
</a>

<span>›</span>

<span>
    Detail Data
</span>


</div>

<div class="page-title-block">


<h2>
    Detail Data UMKM
</h2>

<p>
    Informasi lengkap data Usaha Mikro, Kecil, dan Menengah Kelurahan Binong.
</p>


</div>

<div class="detail-card">


{{-- HEADER --}}

<div class="detail-header">

    <div class="detail-header-info">

        <h3>
            {{ $dataUmkm->nama_usaha }}
        </h3>

        <p>
            {{ $dataUmkm->nama_pelaku_usaha }}
        </p>

    </div>

    <div class="id-badge">

        @if($dataUmkm->nik)

            NIK: {{ $dataUmkm->nik }}

        @else

            ID: {{ $dataUmkm->id }}

        @endif

    </div>

</div>


<div class="detail-body">


    {{-- IDENTITAS PELAKU USAHA --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                1
            </span>

            Identitas Pelaku Usaha

        </div>


        <div class="detail-grid">


            <div class="detail-item">

                <span class="detail-label">
                    Nama Pelaku Usaha
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->nama_pelaku_usaha ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    NIK
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->nik ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Nomor KK
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->no_kk ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Nomor Telepon
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->no_telepon ?: '-' }}

                </span>

            </div>


        </div>

    </div>


    {{-- IDENTITAS USAHA --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                2
            </span>

            Identitas Usaha

        </div>


        <div class="detail-grid">


            <div class="detail-item">

                <span class="detail-label">
                    Nama Usaha
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->nama_usaha ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Jenis Usaha
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->jenis_usaha ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Produk Utama
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->produk_utama ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Skala Usaha
                </span>

                <span class="detail-value">

                    @if($dataUmkm->skala_usaha)

                        <span class="badge badge-scale">
                            {{ $dataUmkm->skala_usaha }}
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


    {{-- LOKASI USAHA --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                3
            </span>

            Lokasi Usaha

        </div>


        <div class="detail-grid">


            <div class="detail-item full">

                <span class="detail-label">
                    Alamat Usaha
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->alamat_usaha ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Kelurahan
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->kelurahan ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Kecamatan
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->kecamatan ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Kabupaten / Kota
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->kabupaten_kota ?: '-' }}

                </span>

            </div>


        </div>

    </div>


    {{-- LEGALITAS USAHA --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                4
            </span>

            Legalitas Usaha

        </div>


        <div class="detail-grid">


            <div class="detail-item">

                <span class="detail-label">
                    Nomor Induk Berusaha (NIB)
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->nib ?: '-' }}

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    NPWP
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->npwp ?: '-' }}

                </span>

            </div>


            <div class="detail-item full">

                <span class="detail-label">
                    Izin Usaha
                </span>

                <span class="detail-value">

                    {{ $dataUmkm->izin_usaha ?: '-' }}

                </span>

            </div>


        </div>

    </div>


    {{-- DATA USAHA --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                5
            </span>

            Data Usaha

        </div>


        <div class="detail-grid">


            <div class="detail-item">

                <span class="detail-label">
                    Modal Usaha
                </span>

                <span class="detail-value">

                    @if($dataUmkm->modal_usaha !== null)

                        Rp {{ number_format($dataUmkm->modal_usaha, 0, ',', '.') }}

                    @else

                        <span class="detail-value empty">
                            Belum diisi
                        </span>

                    @endif

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Omzet Bulanan
                </span>

                <span class="detail-value">

                    @if($dataUmkm->omzet_bulanan !== null)

                        Rp {{ number_format($dataUmkm->omzet_bulanan, 0, ',', '.') }}

                    @else

                        <span class="detail-value empty">
                            Belum diisi
                        </span>

                    @endif

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Jumlah Tenaga Kerja
                </span>

                <span class="detail-value">

                    @if($dataUmkm->jumlah_tenaga_kerja !== null)

                        {{ number_format($dataUmkm->jumlah_tenaga_kerja, 0, ',', '.') }}
                        orang

                    @else

                        <span class="detail-value empty">
                            Belum diisi
                        </span>

                    @endif

                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Status Usaha
                </span>

                <span class="detail-value">

                    @if($dataUmkm->status_usaha === 'Aktif')

                        <span class="badge badge-active">
                            Aktif
                        </span>

                    @elseif($dataUmkm->status_usaha === 'Tidak Aktif')

                        <span class="badge badge-inactive">
                            Tidak Aktif
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


    {{-- KETERANGAN --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                6
            </span>

            Keterangan

        </div>


        <div class="keterangan-box">

            @if($dataUmkm->keterangan)

                {{ $dataUmkm->keterangan }}

            @else

                <span class="keterangan-empty">
                    Tidak ada keterangan tambahan.
                </span>

            @endif

        </div>

    </div>


    {{-- INFORMASI DATA --}}

    <div class="detail-section">

        <div class="section-title">

            <span class="section-number">
                7
            </span>

            Informasi Data

        </div>


        @php

            $syncStatus = $dataUmkm->google_sync_status ?? 'pending';

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

                    {{ $dataUmkm->created_at
                        ? $dataUmkm->created_at->translatedFormat('d F Y, H:i') . ' WIB'
                        : '-' }}

                </strong>

            </div>


            <div class="info-item">

                <span>
                    Terakhir Diperbarui
                </span>

                <strong>

                    {{ $dataUmkm->updated_at
                        ? $dataUmkm->updated_at->translatedFormat('d F Y, H:i') . ' WIB'
                        : '-' }}

                </strong>

            </div>


        </div>

    </div>


</div>


{{-- FOOTER --}}

<div class="detail-footer">


    <a
        href="{{ route('dataumkm.index') }}"
        class="btn btn-secondary"
    >
        ← Kembali
    </a>


    <div class="detail-actions">


        <a
            href="{{ route('dataumkm.edit', ['dataumkm' => $dataUmkm->id]) }}"
            class="btn btn-primary"
        >
            ✎ Ubah Data
        </a>


    </div>


</div>


</div>

@endsection
