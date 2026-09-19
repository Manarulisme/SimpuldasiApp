@extends('Admin.Layout.master')

@section('title', 'Data Anak Putus Sekolah - Kelurahan Binong')
@section('page_title', 'Data Anak Putus Sekolah')
@section('page_subtitle', 'Kesejahteraan Sosial · Data Anak Putus Sekolah')

@push('styles')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

<style>

    /* =====================================================
       PAGE HEADER
    ====================================================== */

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


    /* =====================================================
       BUTTON TAMBAH
    ====================================================== */

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


    /* =====================================================
       TABLE PANEL
    ====================================================== */

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


    /* =====================================================
       DATATABLE
    ====================================================== */

    #anakPutusSekolahTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }

    #anakPutusSekolahTable thead th {
        background: #f8faf9;
        color: #52616b;
        font-size: 11px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    #anakPutusSekolahTable tbody td {
        padding: 14px 12px;
        font-size: 12px;
        border-bottom: 1px solid #f0f2f3;
        vertical-align: middle;
        color: #39474f;
    }


    /* =====================================================
       DATA
    ====================================================== */

    .child-name {
        color: #18364d;
        font-weight: 600;
    }

    .child-id {
        color: #8a969d;
        font-size: 10px;
        margin-top: 3px;
    }

    .nik {
        color: #52616b;
        font-size: 11px;
        white-space: nowrap;
    }


    /* =====================================================
       BADGE
    ====================================================== */

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

    .badge-age {
        background: #f1f3f4;
        color: #58636a;
    }

    .badge-jenjang {
        background: #f4f0fa;
        color: #6d4a8d;
    }

    .badge-default {
        background: #f1f3f4;
        color: #58636a;
    }


    /* =====================================================
       ALASAN
    ====================================================== */

    .alasan {
        max-width: 230px;
        color: #52616b;
        line-height: 1.5;
    }


    /* =====================================================
       TERAKHIR PERUBAHAN
    ====================================================== */

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


    /* =====================================================
       ACTION
    ====================================================== */

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


    /* =====================================================
       DATATABLE CONTROLS
    ====================================================== */

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


    /* =====================================================
       RESPONSIVE
    ====================================================== */

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
        Data Anak Putus Sekolah
    </h2>

    <p>
        Kelola data anak putus sekolah Kelurahan Binong.
    </p>

</div>


<a
    href="{{ route('dataputussekolah.create') }}"
    class="btn-add"
>
    + Tambah Data
</a>


</div>

<section class="table-panel">


<div class="table-panel-header">

    <div>

        <h3>
            Daftar Anak Putus Sekolah
        </h3>

        <p>
            Data anak putus sekolah Kelurahan Binong
        </p>

    </div>


    <span
        class="total-data"
        id="totalData"
    >
        {{ $dataPutusSekolah->count() }} Data
    </span>

</div>


<div class="table-wrapper">

    <table
        id="anakPutusSekolahTable"
        class="display"
    >

        <thead>

            <tr>

                <th>
                    Nama Anak
                </th>

                <th>
                    NIK
                </th>

                <th>
                    RW
                </th>

                <th>
                    Usia
                </th>

                <th>
                    Jenjang Terakhir
                </th>

                <th>
                    Alasan
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

            @forelse ($dataPutusSekolah as $item)

                <tr>


                    {{-- NAMA ANAK --}}

                    <td>

                        <div class="child-name">
                            {{ $item->nama }}
                        </div>

                        <div class="child-id">
                            {{ $item->id_data }}
                        </div>

                    </td>


                    {{-- NIK --}}

                    <td>

                        <span class="nik">
                            {{ $item->nik }}
                        </span>

                    </td>


                    {{-- RW --}}

                    <td>

                        @if ($item->rw)

                            <span class="badge badge-rw">

                                {{ str_starts_with(strtoupper($item->rw), 'RW')
                                    ? $item->rw
                                    : 'RW ' . $item->rw }}

                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- USIA --}}

                    <td>

                        @if ($item->usia !== null)

                            <span class="badge badge-age">
                                {{ $item->usia }} Tahun
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- JENJANG --}}

                    <td>

                        @if ($item->jenjang_terakhir)

                            <span class="badge badge-jenjang">
                                {{ $item->jenjang_terakhir }}
                            </span>

                        @else

                            <span class="badge badge-default">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- ALASAN --}}

                    <td>

                        <div class="alasan">
                            {{ $item->alasan ?: '-' }}
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
                                href="{{ route('dataputussekolah.show', $item->id) }}"
                                class="action-btn action-show"
                                title="Lihat Detail"
                            >
                                ◉
                            </a>


                            {{-- EDIT --}}

                            <a
                                href="{{ route('dataputussekolah.edit', $item->id) }}"
                                class="action-btn action-edit"
                                title="Ubah"
                            >
                                ✎
                            </a>


                            {{-- DELETE --}}

                            <form
                                action="{{ route('dataputussekolah.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('Yakin ingin menghapus data anak putus sekolah ini?')"
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
                        colspan="8"
                        style="text-align: center; padding: 30px; color: #8a969d;"
                    >
                        Belum ada data anak putus sekolah.
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

    const anakPutusSekolahTable =
        new DataTable(
            '#anakPutusSekolahTable',
            {

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],

                order: [],

                language: {

                    lengthMenu:
                        'Tampilkan _MENU_ data',

                    search:
                        'Cari:',

                    searchPlaceholder:
                        'Cari data anak...',

                    info:
                        'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',

                    infoEmpty:
                        'Tidak ada data',

                    infoFiltered:
                        '(difilter dari _MAX_ total data)',

                    zeroRecords:
                        'Data tidak ditemukan',

                    paginate: {

                        first:
                            '«',

                        last:
                            '»',

                        next:
                            '›',

                        previous:
                            '‹'

                    }

                },

                columnDefs: [

                    {

                        orderable: false,
                        searchable: false,
                        targets: 7

                    }

                ]

            }
        );


    anakPutusSekolahTable.on(
        'draw',
        function () {

            document.getElementById(
                'totalData'
            ).textContent =

                anakPutusSekolahTable
                    .page
                    .info()
                    .recordsDisplay
                + ' Data';

        }
    );

</script>

@endpush
