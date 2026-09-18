@extends('Admin.Layout.master')

@section('title', 'Detail Data BMD - Kelurahan XXXXX')
@section('page_title', 'Detail Data BMD')
@section('page_subtitle', 'Kesekretariatan · Data BMD · Detail')

@push('styles')

<style>

    .breadcrumb {
        display: flex;
        gap: 8px;
        color: var(--muted);
        font-size: 12px;
        margin-bottom: 18px;
        flex-wrap: wrap;
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
        margin-bottom: 7px;
    }

    .page-title-block p {
        font-size: 13px;
        color: var(--muted);
    }

    .detail-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 22px 25px;
        background: #fbfcfc;
        border-bottom: 1px solid var(--border);
    }

    .detail-header h3 {
        font-size: 17px;
        color: #18364d;
        margin-bottom: 5px;
    }

    .detail-header p {
        font-size: 12px;
        color: var(--muted);
    }

    .detail-id {
        display: inline-flex;
        align-items: center;
        padding: 7px 11px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .detail-body {
        padding: 28px 25px;
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
        flex-shrink: 0;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0 25px;
        margin-bottom: 30px;
    }

    .detail-item {
        padding: 15px 0;
        border-bottom: 1px solid #f0f2f3;
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
        font-size: 13px;
        color: var(--text);
        font-weight: 600;
        line-height: 1.6;
    }

    .detail-value.empty {
        color: #9aa5aa;
        font-weight: normal;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: bold;
    }

    .badge-baik {
        background: #e8f5ee;
        color: #087443;
    }

    .badge-cukup {
        background: #fff7df;
        color: #9a7300;
    }

    .badge-rusak-ringan {
        background: #fff0df;
        color: #b56a00;
    }

    .badge-rusak-berat {
        background: #fdeaea;
        color: #c0392b;
    }

    .sync-box {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 8px;
        margin-top: 5px;
    }

    .sync-synced {
        background: #eaf7ef;
        border: 1px solid #ccebd8;
    }

    .sync-pending {
        background: #fff8e5;
        border: 1px solid #f2df9c;
    }

    .sync-failed {
        background: #fdecec;
        border: 1px solid #f3cccc;
    }

    .sync-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        flex-shrink: 0;
        font-weight: bold;
    }

    .sync-content strong {
        display: block;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .sync-content span {
        font-size: 11px;
        color: var(--muted);
    }

    .detail-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 18px 25px;
        background: #fbfcfc;
        border-top: 1px solid var(--border);
    }

    .footer-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        height: 40px;
        padding: 0 18px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        text-decoration: none;
        border: 0;
    }

    .btn-secondary {
        background: #fff;
        color: var(--text);
        border: 1px solid #dce2e5;
    }

    .btn-primary {
        background: var(--primary);
        color: #fff;
    }

    .btn-primary:hover {
        color: #fff;
        opacity: .9;
    }

    @media(max-width:700px) {

        .detail-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-item.full {
            grid-column: auto;
        }

        .detail-footer {
            flex-direction: column;
            align-items: stretch;
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

{{-- BREADCRUMB --}}

<div class="breadcrumb">


<a href="{{ route('dashboard') }}">
    Beranda
</a>

<span>›</span>

<a href="{{ route('databmd.index') }}">
    Data BMD
</a>

<span>›</span>

<span>
    Detail Data
</span>


</div>

{{-- TITLE --}}

<div class="page-title-block">


<h2>
    Detail Data BMD
</h2>

<p>
    Informasi lengkap barang milik daerah Kelurahan XXXXX.
</p>


</div>

{{-- DETAIL CARD --}}

<div class="detail-card">


{{-- HEADER --}}

<div class="detail-header">

    <div>

        <h3>
            {{ $databmd->nama_barang }}
        </h3>

        <p>
            Detail informasi barang milik daerah
        </p>

    </div>


    <span class="detail-id">

        {{ $databmd->id_data }}

    </span>

</div>


{{-- BODY --}}

<div class="detail-body">


    {{-- IDENTITAS --}}

    <div class="section-title">

        <span class="section-number">
            1
        </span>

        Identitas Barang

    </div>


    <div class="detail-grid">


        {{-- ID BMD --}}

        <div class="detail-item">

            <span class="detail-label">
                ID BMD
            </span>

            <div class="detail-value">
                {{ $databmd->id_data }}
            </div>

        </div>


        {{-- NAMA --}}

        <div class="detail-item">

            <span class="detail-label">
                Nama Barang
            </span>

            <div class="detail-value">
                {{ $databmd->nama_barang }}
            </div>

        </div>


        {{-- TYPE --}}

        <div class="detail-item">

            <span class="detail-label">
                Type
            </span>

            <div class="detail-value
                {{ !$databmd->type ? 'empty' : '' }}"
            >

                {{ $databmd->type ?: 'Belum diisi' }}

            </div>

        </div>


        {{-- TAHUN --}}

        <div class="detail-item">

            <span class="detail-label">
                Tahun Perolehan
            </span>

            <div class="detail-value
                {{ !$databmd->tahun_perolehan ? 'empty' : '' }}"
            >

                {{ $databmd->tahun_perolehan ?: 'Belum diisi' }}

            </div>

        </div>

    </div>


    {{-- DETAIL --}}

    <div class="section-title">

        <span class="section-number">
            2
        </span>

        Detail Barang

    </div>


    <div class="detail-grid">


        {{-- SUMBER DANA --}}

        <div class="detail-item">

            <span class="detail-label">
                Sumber Dana
            </span>

            <div class="detail-value
                {{ !$databmd->sumber_dana ? 'empty' : '' }}"
            >

                {{ $databmd->sumber_dana ?: 'Belum diisi' }}

            </div>

        </div>


        {{-- KONDISI --}}

        <div class="detail-item">

            <span class="detail-label">
                Kondisi
            </span>


            @if($databmd->kondisi)

                @php

                    $kondisiClass = match($databmd->kondisi) {

                        'Baik' => 'badge-baik',

                        'Cukup Baik' => 'badge-cukup',

                        'Rusak Ringan' => 'badge-rusak-ringan',

                        'Rusak Berat' => 'badge-rusak-berat',

                        default => '',

                    };

                @endphp


                <span class="badge {{ $kondisiClass }}">

                    {{ $databmd->kondisi }}

                </span>

            @else

                <div class="detail-value empty">
                    Belum diisi
                </div>

            @endif

        </div>


        {{-- KETERANGAN --}}

        <div class="detail-item full">

            <span class="detail-label">
                Keterangan
            </span>

            <div class="detail-value
                {{ !$databmd->keterangan ? 'empty' : '' }}"
            >

                {!! $databmd->keterangan
                    ? nl2br(e($databmd->keterangan))
                    : 'Tidak ada keterangan'
                !!}

            </div>

        </div>

    </div>


    {{-- GOOGLE SYNC --}}

    <div class="section-title">

        <span class="section-number">
            3
        </span>

        Sinkronisasi Data

    </div>


    @php

        $syncStatus =
            $databmd->google_sync_status ?? 'pending';

    @endphp


    @if($syncStatus === 'synced')

        <div class="sync-box sync-synced">

            <div class="sync-icon">
                ✓
            </div>

            <div class="sync-content">

                <strong>
                    Tersinkronisasi dengan Google Sheets
                </strong>

                <span>

                    @if($databmd->google_synced_at)

                        Terakhir disinkronkan:
                        {{ $databmd->google_synced_at->format('d/m/Y H:i:s') }}

                    @else

                        Data telah berhasil disinkronkan.

                    @endif

                </span>

            </div>

        </div>

    @elseif($syncStatus === 'failed')

        <div class="sync-box sync-failed">

            <div class="sync-icon">
                !
            </div>

            <div class="sync-content">

                <strong>
                    Sinkronisasi gagal
                </strong>

                <span>
                    Data tersimpan di database tetapi belum berhasil
                    disinkronkan ke Google Sheets.
                </span>

            </div>

        </div>

    @else

        <div class="sync-box sync-pending">

            <div class="sync-icon">
                !
            </div>

            <div class="sync-content">

                <strong>
                    Menunggu sinkronisasi
                </strong>

                <span>
                    Data belum memiliki status sinkronisasi berhasil.
                </span>

            </div>

        </div>

    @endif


    {{-- LAST UPDATE --}}

    <div
        style="
            margin-top:18px;
            font-size:11px;
            color:var(--muted);
        "
    >

        Data dibuat:
        {{ $databmd->created_at
            ? $databmd->created_at->format('d/m/Y H:i:s')
            : '-'
        }}

        &nbsp; · &nbsp;

        Terakhir diperbarui:
        {{ $databmd->updated_at
            ? $databmd->updated_at->format('d/m/Y H:i:s')
            : '-'
        }}

    </div>


</div>


{{-- FOOTER --}}

<div class="detail-footer">

    <a
        href="{{ route('databmd.index') }}"
        class="btn btn-secondary"
    >
        ← Kembali
    </a>


    <div class="footer-actions">

        <a
            href="{{ route('databmd.edit', $databmd->id) }}"
            class="btn btn-primary"
        >
            ✎ Edit Data
        </a>

    </div>

</div>


</div>

@endsection
