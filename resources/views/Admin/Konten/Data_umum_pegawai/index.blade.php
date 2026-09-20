@extends('Admin.Layout.master')

@section('title', 'Data Umum Kepegawaian - Kelurahan Binong')
@section('page_title', 'Data Umum Kepegawaian')
@section('page_subtitle', 'Kesekretariatan · Data Umum Kepegawaian')

@push('styles')

<link
    rel="stylesheet"
    href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css"
>

<style>
    /* =========================================
       CONTENT HEADER
    ========================================= */

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


    /* =========================================
       BUTTON TAMBAH
    ========================================= */

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


    /* =========================================
       TABLE PANEL
    ========================================= */

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


    /* =========================================
       TABLE
    ========================================= */

    #pegawaiTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }

    #pegawaiTable thead th {
        background: #f8faf9;
        color: #52616b;
        font-size: 11px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    #pegawaiTable tbody td {
        padding: 14px 12px;
        font-size: 12px;
        border-bottom: 1px solid #f0f2f3;
        vertical-align: middle;
    }


    /* =========================================
       BADGE
    ========================================= */

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
    }

    .badge-asn {
        background: var(--primary-light);
        color: var(--primary);
    }

    .badge-pppk {
        background: #fff7df;
        color: #987500;
    }

    .badge-gol {
        background: #f1f3f4;
        color: #58636a;
    }

    .badge-default {
        background: #f1f3f4;
        color: #58636a;
    }


    /* =========================================
       NAMA PEGAWAI
    ========================================= */

    .employee-name {
        color: #18364d;
        font-weight: 600;
    }

    .employee-id {
        color: #8a969d;
        font-size: 10px;
        margin-top: 3px;
    }


    /* =========================================
       LAST UPDATE
    ========================================= */

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


    /* =========================================
       SYNC STATUS
    ========================================= */

    .sync-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 600;
        white-space: nowrap;
    }

    .sync-synced {
        background: #e9f7ef;
        color: #087443;
    }

    .sync-pending {
        background: #fff7df;
        color: #987500;
    }

    .sync-failed {
        background: #fff0ee;
        color: #c0392b;
    }

    .sync-unknown {
        background: #f1f3f4;
        color: #58636a;
    }


    /* =========================================
       ACTION BUTTON
    ========================================= */

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
    }


    /* SHOW */

    .action-show {
        color: #36566d;
    }

    .action-show:hover {
        background: #eef3f7;
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


    /* =========================================
       DELETE FORM
    ========================================= */

    .delete-form {
        display: inline;
        margin: 0;
        padding: 0;
    }

    .delete-form button {
        font-family: inherit;
    }


    /* =========================================
       DATATABLES
    ========================================= */

    .dt-container {
        font-size: 12px;
        color: var(--text);
    }

    .dt-length,
    .dt-search {
        margin-bottom: 10px;
    }

    .dt-length label,
    .dt-search label {
        color: #52616b;
        font-size: 11px;
    }

    .dt-length select {
        margin: 0 5px;
        padding: 6px 28px 6px 9px;
        border: 1px solid #dce2e5;
        border-radius: 6px;
        font-size: 11px;
        color: var(--text);
        background: white;
    }

    .dt-search input {
        margin-left: 6px !important;
        padding: 7px 10px !important;
        border: 1px solid #dce2e5 !important;
        border-radius: 6px !important;
        font-size: 11px !important;
        outline: none;
    }

    .dt-search input:focus {
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 2px rgba(8, 116, 67, 0.08);
    }

    .dt-info {
        color: #7a858d;
        font-size: 11px;
    }

    .dt-paging button {
        font-size: 11px !important;
        border-radius: 5px !important;
    }

    .dt-paging .current {
        background: var(--primary) !important;
        color: white !important;
        border-color: var(--primary) !important;
    }


    /* =========================================
       MOBILE
    ========================================= */

    @media (max-width: 700px) {

        .content-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .table-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .dt-layout-row {
            gap: 10px;
        }

        .dt-search {
            text-align: left !important;
        }

        .dt-search input {
            margin-left: 0 !important;
            margin-top: 5px;
            width: 100%;
        }

    }
</style>

@endpush

@section('content')

<div class="content-header">


<div>

    <h2>
        Data Umum Kepegawaian
    </h2>

    <p>
        Kelola data pegawai dan aparatur Kelurahan Binong.
    </p>

</div>


<a
    href="{{ route('dataumumpegawai.create') }}"
    class="btn-add"
>
    + Tambah Data
</a>


</div>

<section class="table-panel">


<div class="table-panel-header">

    <div>

        <h3>
            Daftar Pegawai
        </h3>

        <p>
            Data Umum Kepegawaian Kelurahan Binong
        </p>

    </div>


    <span
        class="total-data"
        id="totalData"
    >
        {{ $pegawai->count() }} Pegawai
    </span>

</div>


<div class="table-wrapper">

    <table
        id="pegawaiTable"
        class="display"
    >

        <thead>

            <tr>

                <th>
                    Jenis
                </th>

                <th>
                    NIP / NRP / TT
                </th>

                <th>
                    Nama
                </th>

                <th>
                    Golongan
                </th>

                <th>
                    Pangkat
                </th>

                <th>
                    Jabatan
                </th>

                <th>
                    Terakhir Perubahan
                </th>

                <th>
                    Sinkronisasi
                </th>

                <th>
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse ($pegawai as $item)

                <tr>

                    {{-- JENIS --}}

                    <td>

                        @if ($item->jenis)

                            @if ($item->jenis === 'PPPK')

                                <span class="badge badge-pppk">
                                    {{ $item->jenis }}
                                </span>

                            @elseif ($item->jenis === 'ASN')

                                <span class="badge badge-asn">
                                    {{ $item->jenis }}
                                </span>

                            @else

                                <span class="badge badge-default">
                                    {{ $item->jenis }}
                                </span>

                            @endif

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- NIP / NRP / TT --}}

                    <td>

                        @if ($item->nomor)

                            {{ $item->nomor }}

                        @else

                            <span style="color:#9aa5aa;">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- NAMA --}}

                    <td>

                        <div class="employee-name">
                            {{ $item->nama }}
                        </div>

                        <div class="employee-id">
                            Pegawai
                            {{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                        </div>

                    </td>


                    {{-- GOLONGAN --}}

                    <td>

                        @if ($item->golongan)

                            <span class="badge badge-gol">
                                {{ $item->golongan }}
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- PANGKAT --}}

                    <td>
                        {{ $item->pangkat ?: '-' }}
                    </td>


                    {{-- JABATAN --}}

                    <td>
                        {{ $item->jabatan ?: '-' }}
                    </td>


                    {{-- TERAKHIR PERUBAHAN --}}

                    <td>

                        @if ($item->updated_at)

                            <div
                                class="last-update"
                                data-order="{{ $item->updated_at->timestamp }}"
                            >

                                <div class="last-update-date">

                                    {{ $item->updated_at
                                        ->locale('id')
                                        ->translatedFormat('d M Y')
                                    }}

                                </div>

                                <div class="last-update-time">

                                    {{ $item->updated_at->format('H:i') }}
                                    WIB

                                </div>

                            </div>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- STATUS SINKRONISASI --}}

                    <td>

                        @if ($item->google_sync_status === 'synced')

                            <span class="sync-status sync-synced">
                                ✓ Synced
                            </span>

                        @elseif ($item->google_sync_status === 'pending')

                            <span class="sync-status sync-pending">
                                ⟳ Pending
                            </span>

                        @elseif ($item->google_sync_status === 'failed')

                            <span class="sync-status sync-failed">
                                ! Failed
                            </span>

                        @else

                            <span class="sync-status sync-unknown">
                                — Belum Sync
                            </span>

                        @endif

                    </td>


                    {{-- AKSI --}}

                    <td>

                        <div class="action-buttons">

                            {{-- SHOW --}}

                            <a
                                href="{{ route('dataumumpegawai.show', $item->id) }}"
                                class="action-btn action-show"
                                title="Lihat Detail"
                            >
                                ◉
                            </a>


                            {{-- EDIT --}}

                            <a
                                href="{{ route('dataumumpegawai.edit', $item->id) }}"
                                class="action-btn action-edit"
                                title="Ubah"
                            >
                                ✎
                            </a>


                            {{-- DELETE --}}

                            <form
                                action="{{ route('dataumumpegawai.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('Yakin ingin menghapus data pegawai ini?')"
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
                        colspan="9"
                        style="
                            text-align:center;
                            padding:30px;
                            color:#8a969d;
                        "
                    >
                        Belum ada data pegawai.
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

    const pegawaiTable = new DataTable(
        '#pegawaiTable',
        {

            pageLength: 10,

            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],

            /*
             * Urutan awal mengikuti hasil Controller.
             */

            order: [],

            language: {

                lengthMenu:
                    'Tampilkan _MENU_ data',

                search:
                    'Cari:',

                searchPlaceholder:
                    'Cari data pegawai...',

                info:
                    'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',

                infoEmpty:
                    'Tidak ada data',

                infoFiltered:
                    '(difilter dari _MAX_ total data)',

                zeroRecords:
                    'Data tidak ditemukan',

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
                    targets: 8
                }

            ]

        }
    );


    /*
     * Update jumlah data pada badge
     * setiap kali tabel berubah.
     */

    pegawaiTable.on(
        'draw',
        function () {

            document.getElementById(
                'totalData'
            ).textContent =
                pegawaiTable.page.info()
                    .recordsDisplay +
                ' Pegawai';

        }
    );

</script>

@endpush
