@extends('Admin.Layout.master')

@section('title', 'Data KPM / Bantuan Sosial - Kelurahan XXXXX')
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

    .badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
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

    .kpm-name {
        color: #18364d;
        font-weight: 600;
    }

    .kpm-id {
        color: #8a969d;
        font-size: 10px;
        margin-top: 3px;
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
        Kelola data penerima bantuan sosial Kelurahan XXXXX.
    </p>
</div>

<a
    href="{{ url('/tambah-data-kpm') }}"
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
            Data KPM / Bantuan Sosial Kelurahan XXXXX
        </p>
    </div>

    <span
        class="total-data"
        id="totalData"
    >
        5 KPM
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
                <th>Aksi</th>
            </tr>
        </thead>


        <tbody>

            <tr>
                <td>
                    <div class="kpm-name">
                        Rina Wulandari
                    </div>
                    <div class="kpm-id">
                        KPM 001
                    </div>
                </td>

                <td>
                    3204014202850001
                </td>

                <td>
                    RW 05
                </td>

                <td>
                    <span class="badge badge-pkh">
                        PKH
                    </span>
                </td>

                <td>
                    Desil 2
                </td>

                <td>
                    Untuk administrasi kelurahan
                </td>

                <td>
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="action-btn action-view"
                            onclick="viewData(this)"
                            title="Lihat Data"
                        >
                            ◉
                        </button>

                        <button
                            type="button"
                            class="action-btn action-edit"
                            onclick="editData(this)"
                            title="Ubah Data"
                        >
                            ✎
                        </button>

                        <button
                            type="button"
                            class="action-btn action-delete"
                            onclick="hapusData(this)"
                            title="Hapus Data"
                        >
                            ×
                        </button>

                    </div>
                </td>
            </tr>


            <tr>
                <td>
                    <div class="kpm-name">
                        Agus Setiawan
                    </div>
                    <div class="kpm-id">
                        KPM 002
                    </div>
                </td>

                <td>
                    3204011801780002
                </td>

                <td>
                    RW 03
                </td>

                <td>
                    <span class="badge badge-bpnt">
                        BPNT
                    </span>
                </td>

                <td>
                    Desil 3
                </td>

                <td>
                    Ruang pelayanan umum
                </td>

                <td>
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="action-btn action-view"
                            onclick="viewData(this)"
                            title="Lihat Data"
                        >
                            ◉
                        </button>

                        <button
                            type="button"
                            class="action-btn action-edit"
                            onclick="editData(this)"
                            title="Ubah Data"
                        >
                            ✎
                        </button>

                        <button
                            type="button"
                            class="action-btn action-delete"
                            onclick="hapusData(this)"
                            title="Hapus Data"
                        >
                            ×
                        </button>

                    </div>
                </td>
            </tr>


            <tr>
                <td>
                    <div class="kpm-name">
                        Sulastri
                    </div>
                    <div class="kpm-id">
                        KPM 003
                    </div>
                </td>

                <td>
                    3204015606900003
                </td>

                <td>
                    RW 08
                </td>

                <td>
                    <span class="badge badge-pkh">
                        PKH
                    </span>
                </td>

                <td>
                    Desil 1
                </td>

                <td>
                    Cetak dokumen dan laporan
                </td>

                <td>
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="action-btn action-view"
                            onclick="viewData(this)"
                            title="Lihat Data"
                        >
                            ◉
                        </button>

                        <button
                            type="button"
                            class="action-btn action-edit"
                            onclick="editData(this)"
                            title="Ubah Data"
                        >
                            ✎
                        </button>

                        <button
                            type="button"
                            class="action-btn action-delete"
                            onclick="hapusData(this)"
                            title="Hapus Data"
                        >
                            ×
                        </button>

                    </div>
                </td>
            </tr>


            <tr>
                <td>
                    <div class="kpm-name">
                        Bambang Haryanto
                    </div>
                    <div class="kpm-id">
                        KPM 004
                    </div>
                </td>

                <td>
                    3204011205640004
                </td>

                <td>
                    RW 02
                </td>

                <td>
                    <span class="badge badge-pangan">
                        Bantuan Pangan
                    </span>
                </td>

                <td>
                    Desil 4
                </td>

                <td>
                    Area tunggu masyarakat
                </td>

                <td>
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="action-btn action-view"
                            onclick="viewData(this)"
                            title="Lihat Data"
                        >
                            ◉
                        </button>

                        <button
                            type="button"
                            class="action-btn action-edit"
                            onclick="editData(this)"
                            title="Ubah Data"
                        >
                            ✎
                        </button>

                        <button
                            type="button"
                            class="action-btn action-delete"
                            onclick="hapusData(this)"
                            title="Hapus Data"
                        >
                            ×
                        </button>

                    </div>
                </td>
            </tr>


            <tr>
                <td>
                    <div class="kpm-name">
                        Nurhayati
                    </div>
                    <div class="kpm-id">
                        KPM 005
                    </div>
                </td>

                <td>
                    3204016303720005
                </td>

                <td>
                    RW 11
                </td>

                <td>
                    <span class="badge badge-bpnt">
                        BPNT
                    </span>
                </td>

                <td>
                    Desil 2
                </td>

                <td>
                    Operasional kelurahan
                </td>

                <td>
                    <div class="action-buttons">

                        <button
                            type="button"
                            class="action-btn action-view"
                            onclick="viewData(this)"
                            title="Lihat Data"
                        >
                            ◉
                        </button>

                        <button
                            type="button"
                            class="action-btn action-edit"
                            onclick="editData(this)"
                            title="Ubah Data"
                        >
                            ✎
                        </button>

                        <button
                            type="button"
                            class="action-btn action-delete"
                            onclick="hapusData(this)"
                            title="Hapus Data"
                        >
                            ×
                        </button>

                    </div>
                </td>
            </tr>

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
            [5, 10, 25, 50],
            [5, 10, 25, 50]
        ],

        language: {

            search: "Cari:",

            lengthMenu: "Tampilkan _MENU_ data",

            info:
                "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            infoEmpty:
                "Tidak ada data",

            zeroRecords:
                "Data tidak ditemukan",

            emptyTable:
                "Belum ada data",

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
                targets: 6
            }
        ]

    });


    kpmTable.on('draw', function () {

        document.getElementById('totalData').textContent =
            kpmTable.page.info().recordsDisplay + ' KPM';

    });


    function viewData(button) {

        const cells = button.closest('tr').cells;

        alert(
            'Detail KPM / Bantuan Sosial\n\n' +
            'Nama KPM: ' + cells[0].innerText.trim() + '\n' +
            'NIK: ' + cells[1].innerText.trim() + '\n' +
            'Alamat RW: ' + cells[2].innerText.trim() + '\n' +
            'Jenis Bantuan: ' + cells[3].innerText.trim() + '\n' +
            'Desil: ' + cells[4].innerText.trim() + '\n' +
            'Keterangan: ' + cells[5].innerText.trim()
        );

    }


    function editData(button) {

        const row = button.closest('tr');

        const nik =
            row.cells[1].innerText.trim();

        window.location.href =
            '{{ url('/edit-data-kpm') }}/' + nik;

    }


    function hapusData(button) {

        const row = button.closest('tr');

        const nama =
            row.cells[0].innerText.trim();

        if (
            confirm(
                'Apakah Anda yakin ingin menghapus data:\n\n' +
                nama +
                '?'
            )
        ) {

            kpmTable
                .row(row)
                .remove()
                .draw(false);

        }

    }

</script>

@endpush
