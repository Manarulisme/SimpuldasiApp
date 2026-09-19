@extends('Admin.Layout.master')

@section('title', 'Laporan Bulanan - Kelurahan Binong')

@section('page_title', 'Laporan Bulanan')

@section('page_subtitle', 'Sistem · Laporan & Dokumentasi')

@push('styles')

<style>

    /* ==============================
       CONTENT HEADER
    ============================== */

    .content-header {
        margin-bottom: 24px;
    }

    .content-header h1 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #102f47;
    }

    .content-header p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 14px;
    }


    /* ==============================
       REPORT FORM PANEL
    ============================== */

    .report-panel {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 14px rgba(16, 47, 71, 0.06);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .report-panel-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e5e7eb;
        background: #fafcfb;
    }

    .report-panel-header h3 {
        margin: 0;
        color: #102f47;
        font-size: 16px;
        font-weight: 700;
    }

    .report-panel-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .report-panel-body {
        padding: 22px;
    }


    /* ==============================
       FORM
    ============================== */

    .report-form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 7px;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
    }

    .form-group select {
        width: 100%;
        height: 42px;
        padding: 0 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        background: #ffffff;
        color: #374151;
        font-size: 13px;
        outline: none;
        transition: 0.2s;
    }

    .form-group select:focus {
        border-color: #087443;
        box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.08);
    }


    /* ==============================
       FORM FOOTER
    ============================== */

    .report-form-footer {
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid #eeeeee;
        display: flex;
        justify-content: flex-end;
    }

    .btn-preview {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-width: 165px;
        height: 42px;
        padding: 0 18px;
        border: none;
        border-radius: 7px;
        background: #087443;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-preview:hover {
        background: #065d36;
    }

    .btn-preview:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }


    /* ==============================
       REPORT HISTORY
    ============================== */

    .table-panel {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 14px rgba(16, 47, 71, 0.06);
        overflow: hidden;
    }

    .table-panel-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e5e7eb;
        background: #fafcfb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .table-panel-header-left h3 {
        margin: 0;
        color: #102f47;
        font-size: 16px;
        font-weight: 700;
    }

    .table-panel-header-left p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .total-data {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 30px;
        padding: 0 10px;
        border-radius: 20px;
        background: #e8f5ef;
        color: #087443;
        font-size: 12px;
        font-weight: 700;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        padding: 0;
    }

    #tableLaporan {
        width: 100% !important;
        margin: 0 !important;
        border-collapse: collapse !important;
    }

    #tableLaporan thead th {
        padding: 12px 10px;
        background: #087443;
        color: #ffffff;
        border: none;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
    }

    #tableLaporan tbody td {
        padding: 11px 10px;
        border-bottom: 1px solid #eeeeee;
        color: #374151;
        font-size: 12px;
        vertical-align: middle;
    }

    #tableLaporan tbody tr:hover td {
        background: #f8faf9;
    }

    #tableLaporan tbody tr:last-child td {
        border-bottom: none;
    }


    /* ==============================
       TABLE CONTENT
    ============================== */

    .report-number {
        font-weight: 600;
        color: #6b7280;
    }

    .report-title-cell {
        color: #102f47;
        font-weight: 600;
    }

    .report-menu {
        display: inline-flex;
        align-items: center;
        padding: 4px 9px;
        border-radius: 20px;
        background: #eef6f2;
        color: #087443;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .report-period {
        color: #374151;
        white-space: nowrap;
    }

    .report-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .report-status.generated {
        background: #e8f5ef;
        color: #087443;
    }

    .report-status.failed {
        background: #fee2e2;
        color: #b91c1c;
    }

    .report-status.draft {
        background: #f3f4f6;
        color: #6b7280;
    }

    .report-status.pending {
        background: #fff7ed;
        color: #c2410c;
    }

    .report-date {
        color: #6b7280;
        white-space: nowrap;
    }


    /* ==============================
       ACTION
    ============================== */

    .report-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .report-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 52px;
        height: 30px;
        padding: 0 9px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .report-action-preview {
        border: 1px solid #087443;
        background: #ffffff;
        color: #087443;
    }

    .report-action-preview:hover {
        background: #087443;
        color: #ffffff;
    }


    /* ==============================
       ALERT
    ============================== */

    .report-alert {
        margin-bottom: 20px;
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 13px;
    }

    .report-alert-success {
        background: #e8f5ef;
        border: 1px solid #b8dfca;
        color: #087443;
    }

    .report-alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
    }

    .report-alert-warning {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #c2410c;
    }


    /* ==============================
       EMPTY STATE
    ============================== */

    .empty-state {
        padding: 45px 20px;
        text-align: center;
        color: #6b7280;
    }

    .empty-state-icon {
        margin-bottom: 10px;
        font-size: 28px;
        opacity: 0.6;
    }

    .empty-state-title {
        margin-bottom: 4px;
        color: #374151;
        font-size: 14px;
        font-weight: 600;
    }

    .empty-state-text {
        font-size: 12px;
    }


    /* ==============================
       DATATABLES
    ============================== */

    .dt-container {
        padding: 15px 20px 18px;
    }

    .dt-layout-row {
        margin: 0 0 12px !important;
    }

    .dt-length,
    .dt-search {
        font-size: 12px;
        color: #6b7280;
    }

    .dt-length select,
    .dt-search input {
        height: 34px;
        border: 1px solid #d1d5db !important;
        border-radius: 6px !important;
        outline: none;
        font-size: 12px;
    }

    .dt-search input {
        margin-left: 6px;
        padding: 0 9px;
    }

    .dt-search input:focus,
    .dt-length select:focus {
        border-color: #087443 !important;
        box-shadow: 0 0 0 2px rgba(8, 116, 67, 0.08);
    }

    .dt-info {
        color: #6b7280 !important;
        font-size: 12px !important;
    }

    .dt-paging-button {
        min-width: 32px !important;
        height: 32px !important;
        margin-left: 3px !important;
        border-radius: 6px !important;
        font-size: 12px !important;
    }

    .dt-paging-button.current {
        background: #087443 !important;
        border-color: #087443 !important;
        color: #ffffff !important;
    }

    .dt-paging-button:hover:not(.disabled) {
        background: #e8f5ef !important;
        border-color: #087443 !important;
        color: #087443 !important;
    }


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 900px) {

        .report-form-grid {
            grid-template-columns: 1fr;
        }

        .report-form-footer {
            justify-content: stretch;
        }

        .btn-preview {
            width: 100%;
        }

    }

    @media (max-width: 700px) {

        .content-header h1 {
            font-size: 21px;
        }

        .report-panel-body {
            padding: 16px;
        }

        .table-panel-header {
            padding: 16px;
            align-items: flex-start;
        }

        .dt-container {
            padding: 12px;
        }

    }

</style>

@endpush

@section('content')

<div class="content-header">


<h1>
    Laporan Bulanan
</h1>

<p>
    Buat dan lihat laporan data Kelurahan Binong berdasarkan periode bulan dan tahun.
</p>


</div>

{{-- ==========================================
ALERT
========================================== --}}

@if(session('success'))


<div class="report-alert report-alert-success">
    {{ session('success') }}
</div>


@endif

@if(session('error'))


<div class="report-alert report-alert-error">
    {{ session('error') }}
</div>


@endif

@if(session('warning'))


<div class="report-alert report-alert-warning">
    {{ session('warning') }}
</div>


@endif

{{-- ==========================================
FORM PEMBUATAN LAPORAN
========================================== --}}

<div class="report-panel">


<div class="report-panel-header">

    <h3>
        Buat Laporan Baru
    </h3>

    <p>
        Pilih menu data dan periode laporan yang ingin ditampilkan.
    </p>

</div>


<div class="report-panel-body">

    <form
        action="{{ route('laporan.preview') }}"
        method="POST"
        id="formLaporan"
    >

        @csrf

        <div class="report-form-grid">

            {{-- MENU --}}

            <div class="form-group">

                <label for="menu">
                    Menu Data
                </label>

                <select
                    name="menu"
                    id="menu"
                    required
                >

                    <option value="">
                        -- Pilih Menu Data --
                    </option>

                    @foreach($daftarMenu as $key => $nama)

                        <option
                            value="{{ $key }}"
                            {{ old('menu') == $key ? 'selected' : '' }}
                        >
                            {{ $nama }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- BULAN --}}

            <div class="form-group">

                <label for="bulan">
                    Bulan
                </label>

                <select
                    name="bulan"
                    id="bulan"
                    required
                >

                    <option value="">
                        -- Pilih Bulan --
                    </option>

                    @foreach($daftarBulan as $key => $namaBulan)

                        <option
                            value="{{ $key }}"
                            {{ old('bulan') == $key ? 'selected' : '' }}
                        >
                            {{ $namaBulan }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- TAHUN --}}

            <div class="form-group">

                <label for="tahun">
                    Tahun
                </label>

                <select
                    name="tahun"
                    id="tahun"
                    required
                >

                    <option value="">
                        -- Pilih Tahun --
                    </option>

                    @for($tahun = $tahunSekarang; $tahun >= 2020; $tahun--)

                        <option
                            value="{{ $tahun }}"
                            {{ old('tahun', $tahunSekarang) == $tahun ? 'selected' : '' }}
                        >
                            {{ $tahun }}
                        </option>

                    @endfor

                </select>

            </div>

        </div>


        <div class="report-form-footer">

            <button
                type="submit"
                class="btn-preview"
                id="btnPreview"
            >
                <i class="fas fa-eye"></i>
                Tampilkan Preview
            </button>

        </div>

    </form>

</div>


</div>

{{-- ==========================================
RIWAYAT LAPORAN
========================================== --}}

<div class="table-panel">


<div class="table-panel-header">

    <div class="table-panel-header-left">

        <h3>
            Riwayat Laporan
        </h3>

        <p>
            Daftar laporan yang pernah dibuat melalui SIMPULDASI.
        </p>

    </div>

    <div class="total-data">
        {{ $laporan->count() }}
    </div>

</div>


<div class="table-wrapper">

    @if($laporan->count())

        <table
            id="tableLaporan"
            class="display"
            style="width:100%"
        >

            <thead>

                <tr>

                    <th>
                        No
                    </th>

                    <th>
                        Judul Laporan
                    </th>

                    <th>
                        Menu
                    </th>

                    <th>
                        Periode
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Dibuat
                    </th>

                    <th>
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @foreach($laporan as $index => $item)

                    <tr>

                        <td class="text-center">

                            <span class="report-number">
                                {{ $index + 1 }}
                            </span>

                        </td>


                        <td>

                            <div class="report-title-cell">
                                {{ $item->judul_laporan ?: '-' }}
                            </div>

                        </td>


                        <td>

                            @php

                                $namaMenuRiwayat =
                                    $daftarMenu[$item->menu]
                                    ?? $item->menu;

                            @endphp

                            <span class="report-menu">
                                {{ $namaMenuRiwayat }}
                            </span>

                        </td>


                        <td>

                            @php

                                $namaBulanRiwayat =
                                    $daftarBulan[$item->bulan]
                                    ?? '-';

                            @endphp

                            <span class="report-period">
                                {{ $namaBulanRiwayat }}
                                {{ $item->tahun }}
                            </span>

                        </td>


                        <td>

                            @php

                                $status =
                                    strtolower(
                                        $item->status ?? 'draft'
                                    );

                            @endphp

                            <span class="report-status {{ $status }}">

                                @if($status === 'generated')

                                    Berhasil

                                @elseif($status === 'failed')

                                    Gagal

                                @elseif($status === 'pending')

                                    Menunggu

                                @else

                                    Draft

                                @endif

                            </span>

                        </td>


                        <td>

                            <span class="report-date">

                                {{ $item->created_at
                                    ? $item->created_at->format('d/m/Y H:i')
                                    : '-' }}

                            </span>

                        </td>


                        <td>

                            <div class="report-actions">

                                <form
                                    action="{{ route('laporan.preview') }}"
                                    method="POST"
                                    style="display:inline;"
                                >

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="menu"
                                        value="{{ $item->menu }}"
                                    >

                                    <input
                                        type="hidden"
                                        name="bulan"
                                        value="{{ $item->bulan }}"
                                    >

                                    <input
                                        type="hidden"
                                        name="tahun"
                                        value="{{ $item->tahun }}"
                                    >

                                    <button
                                        type="submit"
                                        class="report-action report-action-preview"
                                    >
                                        <i class="fas fa-eye"></i>
                                        Lihat
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="empty-state">

            <div class="empty-state-icon">
                ▤
            </div>

            <div class="empty-state-title">
                Belum Ada Riwayat Laporan
            </div>

            <div class="empty-state-text">
                Laporan yang sudah dibuat akan muncul di sini.
            </div>

        </div>

    @endif

</div>


</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* ==========================================
       DATA TABLES
    ========================================== */

    if (
        typeof DataTable !== 'undefined' &&
        document.querySelector('#tableLaporan')
    ) {

        new DataTable('#tableLaporan', {

            pageLength: 10,

            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],

            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Tidak ada data',
                infoFiltered: '(difilter dari _MAX_ total data)',
                zeroRecords: 'Data tidak ditemukan',
                emptyTable: 'Belum ada data laporan',

                paginate: {
                    first: 'Pertama',
                    last: 'Terakhir',
                    next: '›',
                    previous: '‹'
                }
            },

            /*
             * Mempertahankan urutan dari Controller.
             */
            order: [],

            columnDefs: [

                {
                    targets: 0,
                    orderable: false,
                    searchable: false
                },

                {
                    targets: 6,
                    orderable: false,
                    searchable: false
                }

            ],

            drawCallback: function () {

                var api = this.api();

                var info = api.page.info();

                api.rows({
                    page: 'current'
                }).every(function (rowIdx, tableLoop, rowLoop) {

                    var cell = this
                        .node()
                        .querySelector('td:first-child');

                    if (cell) {

                        cell.innerHTML =
                            '<span class="report-number">' +
                            (
                                info.start +
                                rowLoop +
                                1
                            ) +
                            '</span>';

                    }

                });

            }

        });

    }


    /* ==========================================
       SUBMIT PREVIEW
    ========================================== */

    var formLaporan =
        document.getElementById('formLaporan');

    var btnPreview =
        document.getElementById('btnPreview');


    if (formLaporan && btnPreview) {

        formLaporan.addEventListener(
            'submit',
            function () {

                btnPreview.disabled = true;

                btnPreview.innerHTML =
                    '<i class="fas fa-spinner fa-spin"></i> ' +
                    'Memproses Preview...';

            }
        );

    }

});

</script>

@endpush
