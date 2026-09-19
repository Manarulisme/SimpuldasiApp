@extends('Admin.Layout.master')

@section('title', 'Data KPM / Bantuan Sosial - Kelurahan Binong')

@section('page_title', 'Data KPM / Bantuan Sosial')

@section('page_subtitle', 'Kesejahteraan Sosial · KPM / Bantuan Sosial')

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

    #kpmTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }

    #kpmTable thead th {
        background: #f8faf9;
        color: #52616b;
        font-size: 11px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    #kpmTable tbody td {
        padding: 14px 12px;
        font-size: 12px;
        border-bottom: 1px solid #f0f2f3;
        vertical-align: middle;
    }

    .kpm-name {
        color: #18364d;
        font-weight: 600;
    }

    .kpm-id {
        color: #8a969d;
        font-size: 10px;
        margin-top: 3px;
    }

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-pkh {
        background: var(--primary-light);
        color: var(--primary);
    }

    .badge-bpnt {
        background: #fff7df;
        color: #987500;
    }

    .badge-pangan {
        background: #f1f3f4;
        color: #58636a;
    }

    .badge-lainnya {
        background: #eef6fc;
        color: #2d6a9f;
    }

    .badge-desil {
        background: #f1f3f4;
        color: #58636a;
    }

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
        font-size: 13px;
        text-decoration: none;
    }

    .action-view {
        color: #2d6a9f;
    }

    .action-view:hover {
        background: #eef6fc;
        border-color: #c2dced;
    }

    .action-edit {
        color: var(--primary);
    }

    .action-edit:hover {
        background: var(--primary-light);
        border-color: #b9ddca;
    }

    .action-delete {
        color: #c0392b;
    }

    .action-delete:hover {
        background: #fdf0ef;
        border-color: #edc5c1;
    }

    .delete-form {
        display: inline-flex;
        margin: 0;
    }

    .last-update {
        white-space: nowrap;
        line-height: 1.5;
    }

    .last-update-date {
        color: #52616b;
        font-size: 11px;
    }

    .last-update-time {
        color: #9aa4aa;
        font-size: 10px;
    }

    .text-muted {
        color: #9aa4aa;
    }

    @media (max-width: 700px) {
        .content-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }
    }
</style>

@endpush

@section('content')

<div class="content-header">


<div>
    <h2>Data KPM / Bantuan Sosial</h2>

    <p>
        Kelola data penerima bantuan sosial Kelurahan Binong.
    </p>
</div>

<a
    href="{{ route('datakpm.create') }}"
    class="btn-add"
>
    + Tambah Data
</a>


</div>

<section class="table-panel">


<div class="table-panel-header">

    <div>
        <h3>Daftar KPM</h3>

        <p>
            Data KPM / Bantuan Sosial Kelurahan Binong
        </p>
    </div>

    <span
        class="total-data"
        id="totalData"
    >
        {{ $dataKpm->count() }} KPM
    </span>

</div>

<div class="table-wrapper">

    <table
        id="kpmTable"
        class="display"
    >

        <thead>
            <tr>
                <th>Nama KPM</th>
                <th>NIK</th>
                <th>Alamat RW</th>
                <th>Jenis Bantuan</th>
                <th>Desil</th>
                <th>Keterangan</th>
                <th>Terakhir Perubahan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($dataKpm as $item)

                <tr>

                    <td>
                        <div class="kpm-name">
                            {{ $item->nama }}
                        </div>

                        <div class="kpm-id">
                            {{ $item->id_data ?? 'ID belum diisi' }}
                        </div>
                    </td>

                    <td>
                        {{ $item->nik }}
                    </td>

                    <td>
                        @if ($item->rw)
                            RW {{ $item->rw }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>

                        @php
                            $jenisBantuan = strtolower($item->jenis_bantuan ?? '');
                        @endphp

                        @if ($jenisBantuan === 'pkh')

                            <span class="badge badge-pkh">
                                PKH
                            </span>

                        @elseif ($jenisBantuan === 'bpnt')

                            <span class="badge badge-bpnt">
                                BPNT
                            </span>

                        @elseif ($jenisBantuan === 'bantuan pangan')

                            <span class="badge badge-pangan">
                                Bantuan Pangan
                            </span>

                        @else

                            <span class="badge badge-lainnya">
                                {{ $item->jenis_bantuan ?? '-' }}
                            </span>

                        @endif

                    </td>

                    <td>

                        @if ($item->desil)
                            <span class="badge badge-desil">
                                Desil {{ $item->desil }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif

                    </td>

                    <td>
                        {{ $item->keterangan ?: '-' }}
                    </td>

                    <td
                        data-order="{{ optional($item->updated_at)->timestamp ?? 0 }}"
                    >

                        @if ($item->updated_at)

                            <div class="last-update">

                                <div class="last-update-date">
                                    {{ $item->updated_at->locale('id')->translatedFormat('d M Y') }}
                                </div>

                                <div class="last-update-time">
                                    {{ $item->updated_at->format('H:i') }} WIB
                                </div>

                            </div>

                        @else

                            <span class="text-muted">-</span>

                        @endif

                    </td>

                    <td>

                        <div class="action-buttons">

                            <a
                                href="{{ route('datakpm.show', $item->id) }}"
                                class="action-btn action-view"
                                title="Lihat Data"
                            >
                                ◉
                            </a>

                            <a
                                href="{{ route('datakpm.edit', $item->id) }}"
                                class="action-btn action-edit"
                                title="Ubah Data"
                            >
                                ✎
                            </a>

                            <form
                                action="{{ route('datakpm.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data KPM {{ addslashes($item->nama) }}?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-btn action-delete"
                                    title="Hapus Data"
                                >
                                    ×
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="8" style="text-align: center; padding: 30px;">
                        Belum ada data KPM / Bantuan Sosial.
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

    const kpmTable = new DataTable('#kpmTable', {

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        order: [],

        language: {

            search: "Cari:",

            searchPlaceholder: "Cari data KPM...",

            lengthMenu: "Tampilkan _MENU_ data",

            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            infoEmpty: "Tidak ada data",

            infoFiltered: "(difilter dari _MAX_ total data)",

            zeroRecords: "Data tidak ditemukan",

            emptyTable: "Belum ada data",

            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "›",
                previous: "‹"
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

    kpmTable.on('draw', function () {

        document.getElementById('totalData').textContent =
            kpmTable.page.info().recordsDisplay + ' KPM';

    });

</script>

@endpush
