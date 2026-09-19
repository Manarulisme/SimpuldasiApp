@extends('Admin.Layout.master')

@section('title', 'Data Fasilitas Umum & Sosial - Kelurahan Binong')
@section('page_title', 'Data Fasilitas Umum & Sosial')
@section('page_subtitle', 'Sarana & Prasarana · Fasilitas Umum & Sosial')

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

    #fasilitasTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }

    #fasilitasTable thead th {
        background: #f8faf9;
        color: #52616b;
        font-size: 11px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    #fasilitasTable tbody td {
        padding: 14px 12px;
        font-size: 12px;
        border-bottom: 1px solid #f0f2f3;
        vertical-align: middle;
    }

    #fasilitasTable tbody tr:last-child td {
        border-bottom: 0;
    }


    /* =========================
       DATATABLES
    ========================= */

    #fasilitasTable_wrapper {
        font-size: 12px;
    }

    #fasilitasTable_wrapper .dt-layout-row {
        margin: 12px 0;
    }

    #fasilitasTable_wrapper .dt-length,
    #fasilitasTable_wrapper .dt-search {
        color: #52616b;
        font-size: 12px;
    }

    #fasilitasTable_wrapper .dt-length select,
    #fasilitasTable_wrapper .dt-search input {
        border: 1px solid #dfe5e8;
        border-radius: 6px;
        background: white;
        color: #52616b;
        font-size: 12px;
        padding: 7px 9px;
        outline: none;
    }

    #fasilitasTable_wrapper .dt-length select {
        margin: 0 5px;
    }

    #fasilitasTable_wrapper .dt-search input {
        margin-left: 7px;
        width: 200px;
    }

    #fasilitasTable_wrapper .dt-length select:focus,
    #fasilitasTable_wrapper .dt-search input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(8, 116, 67, 0.08);
    }

    #fasilitasTable_wrapper .dt-info {
        color: #7a858d;
        font-size: 11px;
    }

    #fasilitasTable_wrapper .dt-paging-button {
        border: 1px solid #dfe5e8 !important;
        border-radius: 6px !important;
        background: white !important;
        color: #52616b !important;
        font-size: 11px !important;
    }

    #fasilitasTable_wrapper .dt-paging-button:hover {
        background: var(--primary-light) !important;
        color: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    #fasilitasTable_wrapper .dt-paging-button.current {
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

    .badge-government {
        background: #edf4fb;
        color: #3971a9;
    }

    .badge-community {
        background: #eaf5ef;
        color: #087443;
    }

    .badge-private {
        background: #fff7e6;
        color: #a66a00;
    }

    .badge-default {
        background: #f1f3f4;
        color: #58636a;
    }


    /* =========================
       DATA FASILITAS
    ========================= */

    .facility-name {
        color: #18364d;
        font-weight: 600;
    }

    .facility-id {
        color: #8a969d;
        font-size: 10px;
        margin-top: 3px;
    }

    .location {
        color: #52616b;
        font-size: 11px;
        line-height: 1.5;
        min-width: 100px;
    }

    .address {
        color: #52616b;
        font-size: 11px;
        line-height: 1.5;
        min-width: 180px;
        max-width: 300px;
    }

    .fund-source {
        color: #52616b;
        font-size: 11px;
        line-height: 1.5;
        min-width: 130px;
    }

    .facility-type {
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

        #fasilitasTable_wrapper .dt-layout-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        #fasilitasTable_wrapper .dt-search {
            width: 100%;
        }

        #fasilitasTable_wrapper .dt-search input {
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
        Data Fasilitas Umum &amp; Sosial
    </h2>

    <p>
        Kelola data fasilitas umum dan sosial Kelurahan Binong.
    </p>

</div>


<a
    href="{{ route('datafasilitasumum.create') }}"
    class="btn-add"
>
    + Tambah Data
</a>


</div>

<section class="table-panel">


<div class="table-panel-header">

    <div>

        <h3>
            Daftar Fasilitas Umum &amp; Sosial
        </h3>

        <p>
            Data fasilitas umum dan sosial Kelurahan Binong
        </p>

    </div>


    <span
        class="total-data"
        id="totalData"
    >
        {{ $dataFasilitasUmum->count() }} Data
    </span>

</div>


<div class="table-wrapper">

    <table
        id="fasilitasTable"
        class="display"
    >

        <thead>

            <tr>

                <th>
                    No
                </th>

                <th>
                    Nama
                </th>

                <th>
                    Lokasi
                </th>

                <th>
                    Jenis
                </th>

                <th>
                    Alamat
                </th>

                <th>
                    Sumber Dana
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

            @forelse ($dataFasilitasUmum as $item)

                <tr>


                    {{-- NO --}}

                    <td>

                        <div
                            style="text-align:center;color:#7a858d;font-size:11px;"
                        >
                            {{ $loop->iteration }}
                        </div>

                    </td>


                    {{-- NAMA --}}

                    <td>

                        <div class="facility-name">
                            {{ $item->nama ?: '-' }}
                        </div>

                        <div class="facility-id">
                            ID {{ $item->id }}
                        </div>

                    </td>


                    {{-- LOKASI --}}

                    <td>

                        @if($item->lokasi)

                            <div class="location">
                                {{ $item->lokasi }}
                            </div>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- JENIS --}}

                    <td>

                        @if($item->jenis === 'Kesehatan' ||
                            $item->jenis === 'Pendidikan' ||
                            $item->jenis === 'Sosial' ||
                            $item->jenis === 'Infrastruktur')

                            <span class="badge badge-government">
                                {{ $item->jenis }}
                            </span>

                        @elseif($item->jenis === 'Olahraga' ||
                                $item->jenis === 'Ruang Terbuka' ||
                                $item->jenis === 'Keagamaan')

                            <span class="badge badge-community">
                                {{ $item->jenis }}
                            </span>

                        @elseif($item->jenis)

                            <span class="badge badge-private">
                                {{ $item->jenis }}
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- ALAMAT --}}

                    <td>

                        @if($item->alamat)

                            <div class="address">
                                {{ $item->alamat }}
                            </div>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- SUMBER DANA --}}

                    <td>

                        @if($item->sumber_dana)

                            <div class="fund-source">
                                {{ $item->sumber_dana }}
                            </div>

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
                                href="{{ route('datafasilitasumum.show', $item->id) }}"
                                class="action-btn action-view"
                                title="Lihat Detail"
                                aria-label="Lihat Detail"
                            >
                                ◉
                            </a>


                            <a
                                href="{{ route('datafasilitasumum.edit', $item->id) }}"
                                class="action-btn action-edit"
                                title="Ubah Data"
                                aria-label="Ubah Data"
                            >
                                ✎
                            </a>


                            <form
                                action="{{ route('datafasilitasumum.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('Yakin ingin menghapus data fasilitas ini? Data yang dihapus hanya akan dihapus dari sistem lokal.')"
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
                        colspan="8"
                        class="empty-state"
                    >
                        Belum ada data fasilitas umum dan sosial.
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

    const fasilitasTable = new DataTable('#fasilitasTable', {

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        language: {

            lengthMenu: 'Tampilkan _MENU_ data',

            search: 'Cari:',

            searchPlaceholder: 'Cari data Fasilitas Umum & Sosial...',

            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',

            infoEmpty: 'Tidak ada data',

            infoFiltered: '(difilter dari _MAX_ total data)',

            zeroRecords: 'Data tidak ditemukan',

            emptyTable: 'Belum ada data',

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
                targets: 7
            }

        ]

    });


    fasilitasTable.on('draw', function () {

        document.getElementById('totalData').textContent =
            fasilitasTable.page.info().recordsDisplay + ' Data';

    });

</script>

@endpush
