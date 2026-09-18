@extends('Admin.Layout.master')

@section('title', 'Data Umum Kepegawaian - Kelurahan Cibinong')
@section('page_title', 'Data Umum Kepegawaian')
@section('page_subtitle', 'Kesekretariatan · Data Umum Kepegawaian')

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

    .employee-name {
        color: #18364d;
        font-weight: 600;
    }

    .employee-id {
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
        text-decoration: none;
        font-size: 15px;
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

    /* Supaya form delete tidak merusak layout tombol */
    .delete-form {
        display: inline;
        margin: 0;
        padding: 0;
    }

    .delete-form button {
        font-family: inherit;
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
        <h2>Data Umum Kepegawaian</h2>
        <p>
            Kelola data pegawai dan aparatur Kelurahan Cibinong.
        </p>
    </div>

    <a href="{{ route('dataumumpegawai.create') }}" class="btn-add">
        + Tambah Data
    </a>

</div>


<section class="table-panel">

    <div class="table-panel-header">

        <div>
            <h3>Daftar Pegawai</h3>
            <p>
                Data Umum Kepegawaian Kelurahan Cibinong
            </p>
        </div>

        <span class="total-data" id="totalData">
            {{ $pegawai->count() }} Pegawai
        </span>

    </div>


    <div class="table-wrapper">

        <table id="pegawaiTable" class="display">

            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>NIP / NRP / TT</th>
                    <th>Nama</th>
                    <th>Golongan</th>
                    <th>Pangkat</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>


            <tbody>

                @forelse ($pegawai as $item)

                    <tr>

                        {{-- JENIS --}}
                        <td>

                            <span class="badge
                                {{ $item->jenis == 'PPPK'
                                    ? 'badge-pppk'
                                    : 'badge-asn' }}">

                                {{ $item->jenis }}

                            </span>

                        </td>


                        {{-- NIP / NRP / TT --}}
                        <td>
                            {{ $item->nomor }}
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

                            <span class="badge badge-gol">
                                {{ $item->golongan }}
                            </span>

                        </td>


                        {{-- PANGKAT --}}
                        <td>
                            {{ $item->pangkat }}
                        </td>


                        {{-- JABATAN --}}
                        <td>
                            {{ $item->jabatan }}
                        </td>


                        {{-- AKSI --}}
                        <td>

                            <div class="action-buttons">

                                {{-- =========================
                                     TOMBOL EDIT
                                ========================== --}}
                                <a
                                    href="{{ route('dataumumpegawai.edit', $item->id) }}"
                                    class="action-btn action-edit"
                                    title="Ubah"
                                >
                                    ✎
                                </a>


                                {{-- =========================
                                     TOMBOL DELETE
                                ========================== --}}
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

                        <td colspan="7" style="text-align: center; padding: 30px; color: #8a969d;">

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

    const pegawaiTable = new DataTable('#pegawaiTable', {

        pageLength: 10,

        columnDefs: [

            {
                orderable: false,
                searchable: false,
                targets: 6
            }

        ]

    });


    pegawaiTable.on('draw', function () {

        document.getElementById('totalData').textContent =
            pegawaiTable.page.info().recordsDisplay + ' Pegawai';

    });

</script>

@endpush
