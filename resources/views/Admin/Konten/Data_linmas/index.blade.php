@extends('Admin.Layout.master')

@section('title', 'Data Linmas & Siskamling - Kelurahan Binong')
@section('page_title', 'Data Linmas & Siskamling')
@section('page_subtitle', 'Keamanan · Linmas & Siskamling')

@push('styles')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

<style>
    .content-header,
    .table-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .content-header {
        margin-bottom: 25px;
    }

    .content-header h2 {
        color: #18364d;
        font-family: Georgia, serif;
        font-size: 26px;
    }

    .content-header p,
    .table-panel-header p {
        color: var(--muted);
        font-size: 12px;
        margin-top: 6px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: white;
        border: 0;
        border-radius: 7px;
        padding: 11px 16px;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-add:hover {
        background: #065c35;
        color: white;
    }

    .table-panel {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .table-panel-header {
        padding: 20px 22px;
        border-bottom: 1px solid var(--border);
    }

    .table-panel-header h3 {
        color: #18364d;
        font-size: 16px;
    }

    .total-data {
        color: var(--primary);
        background: var(--primary-light);
        border-radius: 20px;
        padding: 6px 10px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .table-wrapper {
        padding: 0 22px 20px;
        overflow-x: auto;
    }

    #linmasTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }

    #linmasTable thead th {
        background: #f8faf9;
        color: #52616b;
        font-size: 11px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    #linmasTable tbody td {
        padding: 14px 12px;
        font-size: 12px;
        border-bottom: 1px solid #f0f2f3;
        vertical-align: middle;
    }

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-rw {
        background: #eef6fc;
        color: #2d6a9f;
    }

    .badge-count {
        background: var(--primary-light);
        color: var(--primary);
    }

    .badge-pos {
        background: #fff7df;
        color: #987500;
    }

    .badge-default {
        background: #f1f3f4;
        color: #58636a;
    }

    .linmas-name {
        color: #18364d;
        font-weight: 600;
    }

    .linmas-id {
        color: #8a969d;
        font-size: 10px;
        margin-top: 3px;
    }

    .nik {
        color: #52616b;
        font-size: 11px;
        white-space: nowrap;
    }

    .linmas-alamat {
        max-width: 220px;
        color: #52616b;
        line-height: 1.5;
    }

    .linmas-pekerjaan {
        max-width: 180px;
        color: #52616b;
        line-height: 1.5;
    }

    .linmas-keterangan {
        max-width: 220px;
        color: #52616b;
        line-height: 1.5;
    }

    /* TITIK POSKAMLING */

    .poskamling-location {
        min-width: 150px;
        line-height: 1.5;
    }

    .poskamling-coordinate {
        color: #52616b;
        font-size: 10px;
        margin-bottom: 5px;
        white-space: nowrap;
    }

    .poskamling-map {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: #2d6a9f;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .poskamling-map:hover {
        color: #24577f;
        text-decoration: underline;
    }

    /* TERAKHIR PERUBAHAN */

    .last-update {
        min-width: 125px;
        line-height: 1.5;
    }

    .last-update-date {
        color: #52616b;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .last-update-time {
        color: #8a969d;
        font-size: 10px;
        margin-top: 2px;
        white-space: nowrap;
    }

    /* ACTION */

    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .action-btn {
        width: 31px;
        height: 31px;
        border: 1px solid var(--border);
        border-radius: 6px;
        background: white;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.15s ease;
    }

    /* SHOW */

    .action-show {
        color: #52616b;
    }

    .action-show:hover {
        background: #f1f3f4;
        color: #18364d;
    }

    /* EDIT */

    .action-edit {
        color: var(--primary);
    }

    .action-edit:hover {
        background: var(--primary-light);
        color: var(--primary);
    }

    /* DELETE */

    .action-delete {
        color: #c0392b;
    }

    .action-delete:hover {
        background: #fff0ee;
        color: #c0392b;
    }

    .delete-form {
        display: inline;
        margin: 0;
        padding: 0;
    }

    .delete-form button {
        font-family: inherit;
    }

    /* DATATABLES */

    .dt-container {
        font-size: 12px;
        color: #52616b;
    }

    .dt-layout-row {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .dt-length,
    .dt-search {
        font-size: 12px;
    }

    .dt-length select,
    .dt-search input {
        border: 1px solid var(--border) !important;
        border-radius: 6px !important;
        padding: 7px 10px !important;
        font-size: 12px !important;
        outline: none;
    }

    .dt-length select:focus,
    .dt-search input:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 2px rgba(8, 116, 67, 0.08);
    }

    .dt-search input {
        margin-left: 6px !important;
        min-width: 190px;
    }

    .dt-info {
        color: #8a969d !important;
        font-size: 11px !important;
    }

    .dt-paging button {
        border-radius: 5px !important;
        font-size: 11px !important;
    }

    @media (max-width: 700px) {

        .content-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .dt-layout-row {
            gap: 10px;
        }

        .dt-search input {
            min-width: 150px;
        }

    }
</style>

@endpush

@section('content')

<div class="content-header">


<div>

    <h2>
        Data Linmas &amp; Siskamling
    </h2>

    <p>
        Kelola data Linmas dan Siskamling Kelurahan Binong.
    </p>

</div>

<a
    href="{{ route('datalinmas.create') }}"
    class="btn-add"
>
    + Tambah Data
</a>


</div>

<section class="table-panel">


<div class="table-panel-header">

    <div>

        <h3>
            Daftar Linmas &amp; Siskamling
        </h3>

        <p>
            Data anggota Linmas dan fasilitas Poskamling Kelurahan Binong
        </p>

    </div>

    <span
        class="total-data"
        id="totalData"
    >
        {{ $dataLinmas->count() }} Data
    </span>

</div>

<div class="table-wrapper">

    <table
        id="linmasTable"
        class="display"
    >

        <thead>

            <tr>

                <th>RW</th>

                <th>Jumlah Linmas</th>

                <th>Nama</th>

                <th>NIK</th>

                <th>Alamat</th>

                <th>Pekerjaan</th>

                <th>Jumlah Poskamling</th>

                <th>Titik Poskamling</th>

                <th>Keterangan</th>

                <th>Terakhir Perubahan</th>

                <th>Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse ($dataLinmas as $item)

                <tr>

                    {{-- RW --}}

                    <td>

                        @if ($item->rw)

                            <span class="badge badge-rw">
                                RW {{ $item->rw }}
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- JUMLAH LINMAS --}}

                    <td>

                        @if ($item->jumlah_linmas !== null)

                            <span class="badge badge-count">
                                {{ number_format($item->jumlah_linmas, 0, ',', '.') }}
                                Orang
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- NAMA --}}

                    <td>

                        @if ($item->nama)

                            <div class="linmas-name">
                                {{ $item->nama }}
                            </div>

                            <div class="linmas-id">
                                ID {{ $item->id }}
                            </div>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- NIK --}}

                    <td>

                        @if ($item->nik)

                            <div class="nik">
                                {{ $item->nik }}
                            </div>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- ALAMAT --}}

                    <td>

                        <div class="linmas-alamat">
                            {{ $item->alamat ?: '-' }}
                        </div>

                    </td>


                    {{-- PEKERJAAN --}}

                    <td>

                        <div class="linmas-pekerjaan">
                            {{ $item->pekerjaan ?: '-' }}
                        </div>

                    </td>


                    {{-- JUMLAH POSKAMLING --}}

                    <td>

                        @if ($item->jumlah_poskamling !== null)

                            <span class="badge badge-pos">
                                {{ number_format($item->jumlah_poskamling, 0, ',', '.') }}
                                Pos
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- TITIK POSKAMLING --}}

                    <td>

                        @if ($item->titik_poskamling)

                            <div class="poskamling-location">

                                <div class="poskamling-coordinate">
                                    {{ $item->titik_poskamling }}
                                </div>

                                <a
                                    href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->titik_poskamling) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="poskamling-map"
                                >
                                    📍 Lihat Lokasi
                                </a>

                            </div>

                        @else

                            <span class="badge badge-default">
                                Belum diisi
                            </span>

                        @endif

                    </td>


                    {{-- KETERANGAN --}}

                    <td>

                        <div class="linmas-keterangan">
                            {{ $item->keterangan ?: '-' }}
                        </div>

                    </td>


                    {{-- TERAKHIR PERUBAHAN --}}

                    <td>

                        @if ($item->updated_at)

                            <div
                                class="last-update"
                                data-order="{{ $item->updated_at->timestamp }}"
                            >

                                <div class="last-update-date">
                                    {{ $item->updated_at->locale('id')->translatedFormat('d M Y') }}
                                </div>

                                <div class="last-update-time">
                                    {{ $item->updated_at->format('H:i') }} WIB
                                </div>

                            </div>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- AKSI --}}

                    <td>

                        <div class="action-buttons">

                            {{-- SHOW --}}

                            <a
                                href="{{ route('datalinmas.show', $item->id) }}"
                                class="action-btn action-show"
                                title="Lihat Detail"
                            >
                                ◉
                            </a>


                            {{-- EDIT --}}

                            <a
                                href="{{ route('datalinmas.edit', $item->id) }}"
                                class="action-btn action-edit"
                                title="Ubah"
                            >
                                ✎
                            </a>


                            {{-- DELETE --}}

                            <form
                                action="{{ route('datalinmas.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('Yakin ingin menghapus data Linmas ini?')"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-btn action-delete"
                                    title="Hapus"
                                >
                                    ×
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="11"
                        style="text-align: center; padding: 30px; color: #8a969d;"
                    >
                        Belum ada data Linmas &amp; Siskamling.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


</section>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

<script>

    const linmasTable = new DataTable('#linmasTable', {

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        order: [],

        language: {

            lengthMenu: 'Tampilkan _MENU_ data',

            search: 'Cari:',

            searchPlaceholder: 'Cari data Linmas & Siskamling...',

            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',

            infoEmpty: 'Tidak ada data',

            infoFiltered: '(difilter dari _MAX_ total data)',

            zeroRecords: 'Data tidak ditemukan',

            paginate: {

                first: '«',

                last: '»',

                next: '›',

                previous: '‹'

            }

        },

        columnDefs: [

            {

                orderable: false,

                searchable: false,

                targets: 10

            }

        ]

    });


    linmasTable.on('draw', function () {

        document.getElementById('totalData').textContent =
            linmasTable.page.info().recordsDisplay + ' Data';

    });

</script>

@endpush
