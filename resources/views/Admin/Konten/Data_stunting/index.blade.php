@extends('Admin.Layout.master')

@section('title', 'Data Stunting - Kelurahan XXXXX')
@section('page_title', 'Data Stunting')
@section('page_subtitle', 'Kesehatan · Data Stunting')

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

    #stuntingTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 15px !important;
    }

    #stuntingTable thead th {
        background: #f8faf9;
        color: #52616b;
        font-size: 11px;
        padding: 13px 12px;
        white-space: nowrap;
    }

    #stuntingTable tbody td {
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

    .badge-normal {
        background: var(--primary-light);
        color: var(--primary);
    }

    .badge-stunting {
        background: #fff0f0;
        color: #c0392b;
    }

    .badge-risk {
        background: #fff7df;
        color: #987500;
    }

    .badge-gender {
        background: #f1f3f4;
        color: #58636a;
    }

    .child-name {
        color: #18364d;
        font-weight: 600;
    }

    .child-id {
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
    }

    .action-edit {
        color: var(--primary);
    }

    .action-delete {
        color: #c0392b;
    }

    @media (max-width: 700px) {
        .content-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush


@section('content')

<div class="content-header">
    <div>
        <h2>Data Stunting</h2>
        <p>Kelola data balita dan anak yang berkaitan dengan kondisi stunting Kelurahan XXXXX.</p>
    </div>

    <a href="{{ url('/tambah-data-stunting') }}" class="btn-add">
        + Tambah Data
    </a>
</div>


<section class="table-panel">

    <div class="table-panel-header">
        <div>
            <h3>Daftar Data Stunting</h3>
            <p>Data balita dan anak Kelurahan XXXXX</p>
        </div>

        <span class="total-data" id="totalData">
            5 Data
        </span>
    </div>


    <div class="table-wrapper">

        <table id="stuntingTable" class="display">

            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama Anak</th>
                    <th>Tanggal Lahir</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>3214011205200001</td>

                    <td>
                        <div class="child-name">
                            Ahmad Fauzan
                        </div>
                        <div class="child-id">
                            Data 001
                        </div>
                    </td>

                    <td>12 Mei 2020</td>

                    <td>6 Tahun</td>

                    <td>
                        <span class="badge badge-gender">
                            Laki-laki
                        </span>
                    </td>

                    <td>
                        <span class="badge badge-stunting">
                            Stunting
                        </span>
                    </td>

                    <td>
                        <div class="action-buttons">

                            <button
                                class="action-btn action-edit"
                                onclick="editData(this)"
                                title="Ubah">
                                ✎
                            </button>

                            <button
                                class="action-btn action-delete"
                                onclick="hapusData(this)"
                                title="Hapus">
                                ×
                            </button>

                        </div>
                    </td>
                </tr>


                <tr>
                    <td>3214012308210002</td>

                    <td>
                        <div class="child-name">
                            Siti Aisyah
                        </div>
                        <div class="child-id">
                            Data 002
                        </div>
                    </td>

                    <td>23 Agustus 2021</td>

                    <td>5 Tahun</td>

                    <td>
                        <span class="badge badge-gender">
                            Perempuan
                        </span>
                    </td>

                    <td>
                        <span class="badge badge-normal">
                            Normal
                        </span>
                    </td>

                    <td>
                        <div class="action-buttons">

                            <button
                                class="action-btn action-edit"
                                onclick="editData(this)"
                                title="Ubah">
                                ✎
                            </button>

                            <button
                                class="action-btn action-delete"
                                onclick="hapusData(this)"
                                title="Hapus">
                                ×
                            </button>

                        </div>
                    </td>
                </tr>


                <tr>
                    <td>3214011501220003</td>

                    <td>
                        <div class="child-name">
                            Bima Pratama
                        </div>
                        <div class="child-id">
                            Data 003
                        </div>
                    </td>

                    <td>15 Januari 2022</td>

                    <td>4 Tahun</td>

                    <td>
                        <span class="badge badge-gender">
                            Laki-laki
                        </span>
                    </td>

                    <td>
                        <span class="badge badge-risk">
                            Berisiko
                        </span>
                    </td>

                    <td>
                        <div class="action-buttons">

                            <button
                                class="action-btn action-edit"
                                onclick="editData(this)"
                                title="Ubah">
                                ✎
                            </button>

                            <button
                                class="action-btn action-delete"
                                onclick="hapusData(this)"
                                title="Hapus">
                                ×
                            </button>

                        </div>
                    </td>
                </tr>


                <tr>
                    <td>3214012803230004</td>

                    <td>
                        <div class="child-name">
                            Nabila Putri
                        </div>
                        <div class="child-id">
                            Data 004
                        </div>
                    </td>

                    <td>28 Maret 2023</td>

                    <td>3 Tahun</td>

                    <td>
                        <span class="badge badge-gender">
                            Perempuan
                        </span>
                    </td>

                    <td>
                        <span class="badge badge-stunting">
                            Stunting
                        </span>
                    </td>

                    <td>
                        <div class="action-buttons">

                            <button
                                class="action-btn action-edit"
                                onclick="editData(this)"
                                title="Ubah">
                                ✎
                            </button>

                            <button
                                class="action-btn action-delete"
                                onclick="hapusData(this)"
                                title="Hapus">
                                ×
                            </button>

                        </div>
                    </td>
                </tr>


                <tr>
                    <td>3214010509240005</td>

                    <td>
                        <div class="child-name">
                            Rizky Ramadhan
                        </div>
                        <div class="child-id">
                            Data 005
                        </div>
                    </td>

                    <td>05 September 2024</td>

                    <td>2 Tahun</td>

                    <td>
                        <span class="badge badge-gender">
                            Laki-laki
                        </span>
                    </td>

                    <td>
                        <span class="badge badge-normal">
                            Normal
                        </span>
                    </td>

                    <td>
                        <div class="action-buttons">

                            <button
                                class="action-btn action-edit"
                                onclick="editData(this)"
                                title="Ubah">
                                ✎
                            </button>

                            <button
                                class="action-btn action-delete"
                                onclick="hapusData(this)"
                                title="Hapus">
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

    const stuntingTable = new DataTable('#stuntingTable', {
        pageLength: 10,

        columnDefs: [
            {
                orderable: false,
                searchable: false,
                targets: 6
            }
        ]
    });


    stuntingTable.on('draw', function () {

        document.getElementById('totalData').textContent =
            stuntingTable.page.info().recordsDisplay + ' Data';

    });


    function editData(button) {

        window.location.href =
            '{{ url('/edit-data-stunting') }}';

    }


    function hapusData(button) {

        if (confirm('Hapus data stunting ini?')) {

            button.closest('tr').remove();

            stuntingTable
                .row(button.closest('tr'))
                .remove()
                .draw(false);

        }

    }

</script>

@endpush
