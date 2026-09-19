@extends('Admin.Layout.master')

@section('title', 'Data Sekolah - Kelurahan Binong')
@section('page_title', 'Data Sekolah')
@section('page_subtitle', 'Kesejahteraan Sosial · Data Sekolah')

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

    #sekolahTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }

    #sekolahTable thead th {
        background: #f8faf9;
        color: #52616b;
        font-size: 11px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    #sekolahTable tbody td {
        padding: 14px 12px;
        font-size: 12px;
        border-bottom: 1px solid #f0f2f3;
        vertical-align: middle;
    }

    /* BADGE */

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
    }

    .badge-tk {
        background: #fff0f5;
        color: #b04a72;
    }

    .badge-sd {
        background: var(--primary-light);
        color: var(--primary);
    }

    .badge-smp {
        background: #eef5ff;
        color: #356aa0;
    }

    .badge-sma {
        background: #f3efff;
        color: #6b4fa1;
    }

    .badge-smk {
        background: #fff7df;
        color: #987500;
    }

    .badge-default {
        background: #f1f3f4;
        color: #58636a;
    }

    /* NAMA SEKOLAH */

    .school-name {
        color: #18364d;
        font-weight: 600;
        line-height: 1.4;
    }

    .school-id {
        color: #8a969d;
        font-size: 10px;
        margin-top: 3px;
    }

    /* ALAMAT */

    .school-address {
        max-width: 260px;
        color: #52616b;
        line-height: 1.5;
    }

    /* JUMLAH SISWA */

    .student-count {
        color: #18364d;
        font-size: 15px;
        font-weight: 700;
    }

    .student-label {
        color: #8a969d;
        font-size: 10px;
        margin-top: 2px;
    }

    /* KETERANGAN */

    .school-keterangan {
        max-width: 220px;
        color: #52616b;
        line-height: 1.5;
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
        Data Sekolah
    </h2>

    <p>
        Kelola data sekolah yang berada di wilayah Kelurahan Binong.
    </p>

</div>

<a
    href="{{ route('datasekolah.create') }}"
    class="btn-add"
>
    + Tambah Data
</a>


</div>

<section class="table-panel">


<div class="table-panel-header">

    <div>

        <h3>
            Daftar Data Sekolah
        </h3>

        <p>
            Data sekolah Kelurahan Binong
        </p>

    </div>

    <span
        class="total-data"
        id="totalData"
    >
        {{ $dataSekolah->count() }} Data
    </span>

</div>


<div class="table-wrapper">

    <table
        id="sekolahTable"
        class="display"
    >

        <thead>

            <tr>

                <th>ID Data</th>

                <th>Nama Sekolah</th>

                <th>Jenjang</th>

                <th>Alamat</th>

                <th>Jumlah Siswa</th>

                <th>Keterangan</th>

                <th>Terakhir Perubahan</th>

                <th>Aksi</th>

            </tr>

        </thead>


        <tbody>

            @forelse ($dataSekolah as $item)

                <tr>

                    {{-- ID DATA --}}

                    <td>

                        <div class="school-name">
                            {{ $item->id_data }}
                        </div>

                        <div class="school-id">
                            SEKOLAH
                        </div>

                    </td>


                    {{-- NAMA SEKOLAH --}}

                    <td>

                        <div class="school-name">
                            {{ $item->nama_sekolah }}
                        </div>

                    </td>


                    {{-- JENJANG --}}

                    <td>

                        @if ($item->jenjang === 'TK')

                            <span class="badge badge-tk">
                                TK
                            </span>

                        @elseif ($item->jenjang === 'SD')

                            <span class="badge badge-sd">
                                SD
                            </span>

                        @elseif ($item->jenjang === 'SMP')

                            <span class="badge badge-smp">
                                SMP
                            </span>

                        @elseif ($item->jenjang === 'SMA')

                            <span class="badge badge-sma">
                                SMA
                            </span>

                        @elseif ($item->jenjang === 'SMK')

                            <span class="badge badge-smk">
                                SMK
                            </span>

                        @else

                            <span class="badge badge-default">
                                {{ $item->jenjang ?: '-' }}
                            </span>

                        @endif

                    </td>


                    {{-- ALAMAT --}}

                    <td>

                        <div class="school-address">
                            {{ $item->alamat ?: '-' }}
                        </div>

                    </td>


                    {{-- JUMLAH SISWA --}}

                    <td>

                        <div class="student-count">
                            {{ number_format($item->jumlah_siswa ?? 0, 0, ',', '.') }}
                        </div>

                        <div class="student-label">
                            Siswa
                        </div>

                    </td>


                    {{-- KETERANGAN --}}

                    <td>

                        <div class="school-keterangan">
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
                                href="{{ route('datasekolah.show', $item->id) }}"
                                class="action-btn action-show"
                                title="Lihat Detail"
                            >
                                ◉
                            </a>


                            {{-- EDIT --}}

                            <a
                                href="{{ route('datasekolah.edit', $item->id) }}"
                                class="action-btn action-edit"
                                title="Ubah"
                            >
                                ✎
                            </a>


                            {{-- DELETE --}}

                            <form
                                action="{{ route('datasekolah.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('Yakin ingin menghapus data sekolah ini?')"
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
                        Belum ada data sekolah.
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

    const sekolahTable = new DataTable('#sekolahTable', {

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        order: [],

        language: {

            lengthMenu: 'Tampilkan _MENU_ data',

            search: 'Cari:',

            searchPlaceholder: 'Cari data sekolah...',

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

                targets: 7

            }

        ]

    });


    sekolahTable.on('draw', function () {

        document.getElementById('totalData').textContent =
            sekolahTable.page.info().recordsDisplay + ' Data';

    });

</script>

@endpush
