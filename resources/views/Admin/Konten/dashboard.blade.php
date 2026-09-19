@php
$jumlahFasilitasUmum = $jumlahFasilitasUmum ?? 0;
$jumlahPohon = $jumlahPohon ?? 0;
$jumlahBuruanSae = $jumlahBuruanSae ?? 0;
$jumlahRutilahu = $jumlahRutilahu ?? 0;
$jumlahUmkm = $jumlahUmkm ?? 0;
$riwayatPerubahan = $riwayatPerubahan ?? collect();
@endphp

@extends('Admin.Layout.master')

@section('title', 'Dashboard - Kelurahan Binong')

@section('page_title', 'Beranda')

@section('page_subtitle', 'Dashboard Sistem Pengumpulan Data Terintegrasi (SIMPULDASI)')

@push('styles')

<style>
    .dashboard-page {
        width: 100%;
    }

    .welcome-card {
        background: linear-gradient(135deg, #087443 0%, #0b8f55 100%);
        border-radius: 18px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
        box-shadow: 0 8px 24px rgba(8, 116, 67, 0.15);
    }

    .welcome-card h2 {
        margin: 0 0 8px;
        font-family: Georgia, serif;
        font-size: 26px;
        font-weight: 700;
    }

    .welcome-card p {
        margin: 0;
        font-size: 14px;
        line-height: 1.7;
        opacity: .95;
        max-width: 850px;
    }

    /* ==============================
       STATISTIK
    ============================== */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e8ecef;
        border-radius: 16px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        min-height: 115px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .04);
        transition: .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, .07);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        min-width: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        background: #eef8f3;
        color: #087443;
    }

    .stat-content {
        min-width: 0;
    }

    .stat-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
        line-height: 1.4;
    }

    .stat-number {
        color: #102f47;
        font-size: 27px;
        font-weight: 700;
        line-height: 1.2;
    }

    .stat-unit {
        color: #7a8490;
        font-size: 12px;
        font-weight: 400;
    }

    /* ==============================
       GRAFIK
    ============================== */

    .chart-panel {
        background: #fff;
        border: 1px solid #e8ecef;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .04);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .chart-panel-header {
        padding: 20px 22px;
        border-bottom: 1px solid #edf0f2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .chart-panel-header h3 {
        margin: 0;
        font-family: Georgia, serif;
        color: #102f47;
        font-size: 18px;
    }

    .chart-panel-header span {
        color: #7a8490;
        font-size: 12px;
    }

    .chart-panel-body {
        padding: 22px;
    }

    .chart-container {
        position: relative;
        width: 100%;
        height: 320px;
    }

    /* ==============================
       GRID KONTEN
    ============================== */

    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(300px, 1fr);
        gap: 20px;
    }

    .panel {
        background: #fff;
        border: 1px solid #e8ecef;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .04);
        overflow: hidden;
    }

    .panel-header {
        padding: 20px 22px;
        border-bottom: 1px solid #edf0f2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .panel-header h3 {
        margin: 0;
        font-family: Georgia, serif;
        color: #102f47;
        font-size: 18px;
    }

    .panel-header span {
        color: #7a8490;
        font-size: 12px;
    }

    .panel-body {
        padding: 20px 22px;
    }

    /* ==============================
       AKSES CEPAT
    ============================== */

    .quick-links {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .quick-link {
        text-decoration: none;
        border: 1px solid #e7ece9;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #102f47;
        transition: .2s ease;
        background: #fff;
    }

    .quick-link:hover {
        border-color: #087443;
        background: #f6fbf8;
        color: #087443;
        transform: translateY(-1px);
    }

    .quick-icon {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 10px;
        background: #eef8f3;
        color: #087443;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .quick-text {
        min-width: 0;
    }

    .quick-text strong {
        display: block;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .quick-text small {
        display: block;
        color: #8a949e;
        font-size: 11px;
    }

    /* ==============================
       RIWAYAT PERUBAHAN
    ============================== */

    .history-list {
        display: flex;
        flex-direction: column;
    }

    .history-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .history-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #edf0f2;
        transition: .2s ease;
    }

    .history-link:last-child .history-item {
        border-bottom: 0;
    }

    .history-item:hover {
        padding-left: 4px;
        padding-right: 4px;
        background: #f9fbfa;
    }

    .history-left {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 0;
    }

    .history-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 10px;
        background: #eef8f3;
        color: #087443;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .history-info {
        min-width: 0;
    }

    .history-name {
        font-size: 13px;
        font-weight: 700;
        color: #102f47;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 190px;
    }

    .history-type {
        color: #8a949e;
        font-size: 11px;
        margin-top: 3px;
    }

    .history-date {
        text-align: right;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .history-date-main {
        color: #102f47;
        font-size: 11px;
        font-weight: 600;
    }

    .history-date-time {
        color: #8a949e;
        font-size: 10px;
        margin-top: 2px;
    }

    .empty-history {
        text-align: center;
        padding: 35px 15px;
        color: #8a949e;
        font-size: 13px;
    }

    .empty-history-icon {
        font-size: 28px;
        margin-bottom: 8px;
        opacity: .7;
    }

    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 1100px) {

        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .quick-links {
            grid-template-columns: 1fr;
        }

        .welcome-card {
            padding: 22px;
        }

        .welcome-card h2 {
            font-size: 22px;
        }

        .stat-card {
            padding: 18px;
        }

        .chart-panel-header {
            padding: 17px;
        }

        .chart-panel-body {
            padding: 17px;
        }

        .chart-container {
            height: 280px;
        }

        .panel-header {
            padding: 17px;
        }

        .panel-body {
            padding: 17px;
        }

        .history-name {
            max-width: 140px;
        }
    }
</style>

@endpush

@section('content')

<div class="dashboard-page">


{{-- ==========================================
     WELCOME
=========================================== --}}

<div class="welcome-card">

    <h2>
        Selamat Datang di Sistem Pengumpulan Data Terintegrasi (SIMPULDASI)
    </h2>

    <p>
        Kelola dan pantau berbagai data Kelurahan Binong secara terintegrasi
        melalui satu sistem informasi. Data yang tersimpan dapat digunakan
        untuk mendukung pelayanan, administrasi, serta kebutuhan pelaporan kelurahan.
    </p>

</div>


{{-- ==========================================
     STATISTIK UTAMA
=========================================== --}}

<div class="stats-grid">


    {{-- Fasilitas Umum --}}

    <div class="stat-card">

        <div class="stat-icon">
            🏢
        </div>

        <div class="stat-content">

            <div class="stat-label">
                Fasilitas Umum & Sosial
            </div>

            <div class="stat-number">

                {{ number_format($jumlahFasilitasUmum, 0, ',', '.') }}

                <span class="stat-unit">
                    Data
                </span>

            </div>

        </div>

    </div>


    {{-- Pohon --}}

    <div class="stat-card">

        <div class="stat-icon">
            🌳
        </div>

        <div class="stat-content">

            <div class="stat-label">
                Data Pohon
            </div>

            <div class="stat-number">

                {{ number_format($jumlahPohon, 0, ',', '.') }}

                <span class="stat-unit">
                    Data
                </span>

            </div>

        </div>

    </div>


    {{-- Buruan Sae --}}

    <div class="stat-card">

        <div class="stat-icon">
            🌱
        </div>

        <div class="stat-content">

            <div class="stat-label">
                Data Buruan Sae
            </div>

            <div class="stat-number">

                {{ number_format($jumlahBuruanSae, 0, ',', '.') }}

                <span class="stat-unit">
                    Data
                </span>

            </div>

        </div>

    </div>


    {{-- Rutilahu --}}

    <div class="stat-card">

        <div class="stat-icon">
            🏠
        </div>

        <div class="stat-content">

            <div class="stat-label">
                Data Rutilahu
            </div>

            <div class="stat-number">

                {{ number_format($jumlahRutilahu, 0, ',', '.') }}

                <span class="stat-unit">
                    Data
                </span>

            </div>

        </div>

    </div>

</div>


{{-- ==========================================
     GRAFIK JUMLAH DATA
=========================================== --}}

<div class="chart-panel">

    <div class="chart-panel-header">

        <h3>
            Jumlah Data per Kategori
        </h3>

        <span>
            Data tersimpan dalam sistem
        </span>

    </div>

    <div class="chart-panel-body">

        <div class="chart-container">

            <canvas id="dataKategoriChart"></canvas>

        </div>

    </div>

</div>


{{-- ==========================================
     KONTEN DASHBOARD
=========================================== --}}

<div class="dashboard-grid">


    {{-- ======================================
         AKSES CEPAT
    ======================================= --}}

    <div class="panel">

        <div class="panel-header">

            <h3>
                Akses Cepat
            </h3>

            <span>
                Menu Data
            </span>

        </div>


        <div class="panel-body">

            <div class="quick-links">


                {{-- UMKM --}}

                <a
                    href="{{ route('dataumkm.index') }}"
                    class="quick-link"
                >

                    <div class="quick-icon">
                        🏪
                    </div>

                    <div class="quick-text">

                        <strong>
                            Data UMKM
                        </strong>

                        <small>
                            {{ number_format($jumlahUmkm, 0, ',', '.') }}
                            data tersimpan
                        </small>

                    </div>

                </a>


                {{-- Rutilahu --}}

                <a
                    href="{{ route('datarutilahu.index') }}"
                    class="quick-link"
                >

                    <div class="quick-icon">
                        🏠
                    </div>

                    <div class="quick-text">

                        <strong>
                            Data Rutilahu
                        </strong>

                        <small>
                            {{ number_format($jumlahRutilahu, 0, ',', '.') }}
                            data tersimpan
                        </small>

                    </div>

                </a>


                {{-- Buruan Sae --}}

                <a
                    href="{{ route('databuruansae.index') }}"
                    class="quick-link"
                >

                    <div class="quick-icon">
                        🌱
                    </div>

                    <div class="quick-text">

                        <strong>
                            Data Buruan Sae
                        </strong>

                        <small>
                            {{ number_format($jumlahBuruanSae, 0, ',', '.') }}
                            data tersimpan
                        </small>

                    </div>

                </a>


                {{-- Pohon --}}

                <a
                    href="{{ route('datapohon.index') }}"
                    class="quick-link"
                >

                    <div class="quick-icon">
                        🌳
                    </div>

                    <div class="quick-text">

                        <strong>
                            Data Pohon
                        </strong>

                        <small>
                            {{ number_format($jumlahPohon, 0, ',', '.') }}
                            data tersimpan
                        </small>

                    </div>

                </a>


                {{-- Fasilitas Umum --}}

                <a
                    href="{{ route('datafasilitasumum.index') }}"
                    class="quick-link"
                >

                    <div class="quick-icon">
                        🏢
                    </div>

                    <div class="quick-text">

                        <strong>
                            Fasilitas Umum & Sosial
                        </strong>

                        <small>
                            {{ number_format($jumlahFasilitasUmum, 0, ',', '.') }}
                            data tersimpan
                        </small>

                    </div>

                </a>


                {{-- Dashboard --}}

                <a
                    href="{{ route('dashboard') }}"
                    class="quick-link"
                >

                    <div class="quick-icon">
                        ⌂
                    </div>

                    <div class="quick-text">

                        <strong>
                            Dashboard
                        </strong>

                        <small>
                            Ringkasan sistem
                        </small>

                    </div>

                </a>


            </div>

        </div>

    </div>


    {{-- ======================================
         RIWAYAT PERUBAHAN DATA
    ======================================= --}}

    <div class="panel">

        <div class="panel-header">

            <h3>
                Riwayat Perubahan Data
            </h3>

            <span>
                5 perubahan terakhir
            </span>

        </div>


        <div class="panel-body">

            @if($riwayatPerubahan->count() > 0)

                <div class="history-list">

                    @foreach($riwayatPerubahan as $riwayat)

                        <a
                            href="{{ $riwayat['route'] }}"
                            class="history-link"
                        >

                            <div class="history-item">

                                <div class="history-left">


                                    {{-- Icon --}}

                                    <div class="history-icon">

                                        @if($riwayat['jenis'] === 'UMKM')

                                            🏪

                                        @elseif($riwayat['jenis'] === 'Rutilahu')

                                            🏠

                                        @elseif($riwayat['jenis'] === 'Buruan Sae')

                                            🌱

                                        @elseif($riwayat['jenis'] === 'Pohon')

                                            🌳

                                        @else

                                            🏢

                                        @endif

                                    </div>


                                    {{-- Informasi --}}

                                    <div class="history-info">

                                        <div class="history-name">

                                            {{ $riwayat['nama'] }}

                                        </div>

                                        <div class="history-type">

                                            {{ $riwayat['jenis'] }}

                                            · ID {{ $riwayat['id'] }}

                                        </div>

                                    </div>

                                </div>


                                {{-- Waktu --}}

                                <div class="history-date">

                                    <div class="history-date-main">

                                        {{ $riwayat['updated_at']->locale('id')->translatedFormat('d M Y') }}

                                    </div>

                                    <div class="history-date-time">

                                        {{ $riwayat['updated_at']->format('H:i') }}

                                        WIB

                                    </div>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                <div class="empty-history">

                    <div class="empty-history-icon">
                        ◷
                    </div>

                    Belum ada riwayat perubahan data.

                </div>

            @endif

        </div>

    </div>

</div>


</div>

@endsection

@push('scripts')

{{-- Chart.js --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('dataKategoriChart');

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'UMKM',
                'Rutilahu',
                'Buruan Sae',
                'Pohon',
                'Fasilitas Umum & Sosial'
            ],

            datasets: [

                {

                    label: 'Jumlah Data',

                    data: [
                        {{ $jumlahUmkm }},
                        {{ $jumlahRutilahu }},
                        {{ $jumlahBuruanSae }},
                        {{ $jumlahPohon }},
                        {{ $jumlahFasilitasUmum }}
                    ],

                    backgroundColor: [
                        '#087443',
                        '#0b8f55',
                        '#4f9f70',
                        '#6cab82',
                        '#102f47'
                    ],

                    borderRadius: 8,

                    borderWidth: 0

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                },

                tooltip: {

                    callbacks: {

                        label: function (context) {

                            return ' ' + context.raw + ' Data';

                        }

                    }

                }

            },

            scales: {

                x: {

                    grid: {
                        display: false
                    },

                    ticks: {

                        color: '#6b7280',

                        font: {
                            size: 12
                        }

                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        precision: 0,

                        color: '#6b7280',

                        font: {
                            size: 11
                        }

                    },

                    grid: {

                        color: '#edf0f2'

                    }

                }

            }

        }

    });

});

</script>

@endpush
