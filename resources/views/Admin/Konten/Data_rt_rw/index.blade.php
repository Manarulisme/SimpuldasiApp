@extends('Admin.Layout.master')

@section('title', 'Data RT & RW - Kelurahan Binong')
@section('page_title', 'Data RT & RW')
@section('page_subtitle', 'Kependudukan · RT & RW')

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
        margin: 0;
    }

    .content-header p,
    .table-panel-header p {
        color: var(--muted);
        font-size: 12px;
        margin-top: 6px;
        margin-bottom: 0;
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
        white-space: nowrap;
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
        margin: 0;
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

    #rtRwTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }

    #rtRwTable thead th {
        background: #f8faf9;
        color: #52616b;
        font-size: 11px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    #rtRwTable tbody td {
        padding: 14px 12px;
        font-size: 12px;
        border-bottom: 1px solid #f0f2f3;
        vertical-align: middle;
    }

    #rtRwTable tbody tr:last-child td {
        border-bottom: 0;
    }


    /* =========================
       DATATABLES
    ========================= */

    #rtRwTable_wrapper {
        font-size: 12px;
    }

    #rtRwTable_wrapper .dt-layout-row {
        margin: 12px 0;
    }

    #rtRwTable_wrapper .dt-length,
    #rtRwTable_wrapper .dt-search {
        color: #52616b;
        font-size: 12px;
    }

    #rtRwTable_wrapper .dt-length select,
    #rtRwTable_wrapper .dt-search input {
        border: 1px solid #dfe5e8;
        border-radius: 6px;
        background: white;
        color: #52616b;
        font-size: 12px;
        padding: 7px 9px;
        outline: none;
    }

    #rtRwTable_wrapper .dt-length select {
        margin: 0 5px;
    }

    #rtRwTable_wrapper .dt-search input {
        margin-left: 7px;
        width: 200px;
    }

    #rtRwTable_wrapper .dt-length select:focus,
    #rtRwTable_wrapper .dt-search input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(8, 116, 67, 0.08);
    }

    #rtRwTable_wrapper .dt-info {
        color: #7a858d;
        font-size: 11px;
    }

    #rtRwTable_wrapper .dt-paging-button {
        border: 1px solid #dfe5e8 !important;
        border-radius: 6px !important;
        background: white !important;
        color: #52616b !important;
        font-size: 11px !important;
    }

    #rtRwTable_wrapper .dt-paging-button:hover {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    #rtRwTable_wrapper .dt-paging-button.current {
        background: var(--primary) !important;
        color: white !important;
        border-color: var(--primary) !important;
    }


    /* =========================
       BADGE
    ========================= */

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-rt {
        background: #edf4fb;
        color: #3971a9;
    }

    .badge-rw {
        background: #eaf5ef;
        color: #087443;
    }

    .badge-date {
        background: #f4f0ff;
        color: #7053a6;
    }

    .badge-default {
        background: #f1f3f4;
        color: #58636a;
    }


    /* =========================
       DATA RT & RW
    ========================= */

    .number-area {
        color: #18364d;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .leader-name {
        color: #52616b;
        font-size: 11px;
        font-weight: 600;
        min-width: 150px;
    }

    .period-date {
        color: #52616b;
        font-size: 11px;
        white-space: nowrap;
    }


    /* =========================
       TERAKHIR PERUBAHAN
    ========================= */

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


    /* =========================
       ACTION
    ========================= */

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
        padding: 0;
    }

    .action-view {
        color: #2d6a9f;
    }

    .action-view:hover {
        background: #edf5fb;
        color: #2d6a9f;
    }

    .action-edit {
        color: var(--primary);
    }

    .action-edit:hover {
        background: var(--primary-light);
        color: var(--primary);
    }

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


    /* =========================
       ALERT
    ========================= */

    .alert-success,
    .alert-error {
        margin-bottom: 20px;
        padding: 12px 15px;
        border-radius: 7px;
        font-size: 12px;
    }

    .alert-success {
        background: #eaf5ef;
        color: #087443;
        border: 1px solid #cce7d9;
    }

    .alert-error {
        background: #fff0ee;
        color: #c0392b;
        border: 1px solid #f3d0cc;
    }


    /* =========================
       EMPTY
    ========================= */

    .empty-state {
        text-align: center;
        padding: 30px !important;
        color: #8a969d;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 700px) {

        .content-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .content-header h2 {
            font-size: 23px;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }

        .table-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        #rtRwTable_wrapper .dt-layout-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        #rtRwTable_wrapper .dt-search {
            width: 100%;
        }

        #rtRwTable_wrapper .dt-search input {
            width: 100%;
            margin-left: 5px;
        }
    }
</style>

@endpush

@section('content')

@if(session('success'))

<div class="alert-success">
    {{ session('success') }}
</div>

@endif

@if(session('error'))

<div class="alert-error">
    {{ session('error') }}
</div>

@endif

@if(session('warning'))

<div class="alert-error">
    {{ session('warning') }}
</div>

@endif

<div class="content-header">


<div>

    <h2>
        Data RT & RW
    </h2>

    <p>
        Kelola data pengurus RT dan RW Kelurahan Binong.
    </p>

</div>

<a
    href="{{ route('datartrw.create') }}"
    class="btn-add"
>
    + Tambah Data
</a>


</div>

<section class="table-panel">


<div class="table-panel-header">

    <div>

        <h3>
            Daftar RT & RW
        </h3>

        <p>
            Data pengurus RT dan RW Kelurahan Binong beserta masa kepengurusannya.
        </p>

    </div>

    <span
        class="total-data"
        id="totalData"
    >
        {{ $dataRtRw->count() }} Data
    </span>

</div>


<div class="table-wrapper">

    <table
        id="rtRwTable"
        class="display"
    >

        <thead>

            <tr>

                <th>
                    No
                </th>

                <th>
                    Nomor RT
                </th>

                <th>
                    Nama Ketua RT
                </th>

                <th>
                    Nomor RW
                </th>

                <th>
                    Nama Ketua RW
                </th>

                <th>
                    Tanggal Mulai
                </th>

                <th>
                    Tanggal Berakhir
                </th>

                <th>
                    Terakhir Perubahan
                </th>

                <th>
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse ($dataRtRw as $item)

                <tr>

                    {{-- NO --}}

                    <td>

                        <div
                            style="text-align:center;color:#7a858d;font-size:11px;"
                        >
                            {{ $loop->iteration }}
                        </div>

                    </td>


                    {{-- NOMOR RT --}}

                    <td>

                        @if($item->nomor_rt)

                            <span class="badge badge-rt">
                                {{ $item->nomor_rt }}
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- NAMA KETUA RT --}}

                    <td>

                        @if($item->nama_rt)

                            <div class="leader-name">
                                {{ $item->nama_rt }}
                            </div>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- NOMOR RW --}}

                    <td>

                        @if($item->nomor_rw)

                            <span class="badge badge-rw">
                                {{ $item->nomor_rw }}
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- NAMA KETUA RW --}}

                    <td>

                        @if($item->nama_rw)

                            <div class="leader-name">
                                {{ $item->nama_rw }}
                            </div>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- TANGGAL MULAI --}}

                    <td>

                        @if($item->tanggal_mulai)

                            <span class="badge badge-date">
                                {{ $item->tanggal_mulai->locale('id')->translatedFormat('d M Y') }}
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- TANGGAL BERAKHIR --}}

                    <td>

                        @if($item->tanggal_berakhir)

                            <span class="badge badge-date">
                                {{ $item->tanggal_berakhir->locale('id')->translatedFormat('d M Y') }}
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- TERAKHIR PERUBAHAN --}}

                    <td>

                        @if($item->updated_at)

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

                            <a
                                href="{{ route('datartrw.show', $item->id) }}"
                                class="action-btn action-view"
                                title="Lihat Detail"
                                aria-label="Lihat Detail"
                            >
                                ◉
                            </a>


                            <a
                                href="{{ route('datartrw.edit', $item->id) }}"
                                class="action-btn action-edit"
                                title="Ubah Data"
                                aria-label="Ubah Data"
                            >
                                ✎
                            </a>


                            <form
                                action="{{ route('datartrw.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('Yakin ingin menghapus data RT {{ $item->nomor_rt }} / RW {{ $item->nomor_rw }}? Data yang dihapus hanya akan dihapus dari sistem lokal.')"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-btn action-delete"
                                    title="Hapus Data"
                                    aria-label="Hapus Data"
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
                        class="empty-state"
                    >
                        Belum ada data RT & RW.
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

    const rtRwTable = new DataTable(
        '#rtRwTable',
        {

            pageLength: 10,

            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],

            language: {

                lengthMenu:
                    'Tampilkan _MENU_ data',

                search:
                    'Cari:',

                searchPlaceholder:
                    'Cari data RT & RW...',

                info:
                    'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',

                infoEmpty:
                    'Tidak ada data',

                infoFiltered:
                    '(difilter dari _MAX_ total data)',

                zeroRecords:
                    'Data tidak ditemukan',

                emptyTable:
                    'Belum ada data',

                paginate: {

                    first: '«',

                    last: '»',

                    next: '›',

                    previous: '‹'

                }

            },

            order: [],

            columnDefs: [

                {
                    orderable: false,
                    searchable: false,
                    targets: 0
                },

                {
                    orderable: false,
                    searchable: false,
                    targets: 8
                }

            ]

        }
    );


    rtRwTable.on(
        'draw',
        function () {

            document.getElementById('totalData').textContent =
                rtRwTable.page.info().recordsDisplay + ' Data';

        }
    );

</script>

@endpush
