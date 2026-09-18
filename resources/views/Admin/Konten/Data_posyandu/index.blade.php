@extends('Admin.Layout.master')

@section('title', 'Data Posyandu & Posbindu - Kelurahan Binong')
@section('page_title', 'Data Posyandu & Posbindu')
@section('page_subtitle', 'Kesejahteraan Sosial · Posyandu & Posbindu')

@push('styles')

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

#posyanduTable {
    width: 100% !important;
    border-collapse: collapse !important;
    margin-top: 15px !important;
}

#posyanduTable thead th {
    background: #f8faf9;
    color: #52616b;
    font-size: 11px;
    padding: 13px 12px;
    white-space: nowrap;
}

#posyanduTable tbody td {
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

.badge-posyandu {
    background: var(--primary-light);
    color: var(--primary);
}

.badge-posbindu {
    background: #fff7df;
    color: #987500;
}

.posyandu-id {
    color: #8a969d;
    font-size: 10px;
}

.posyandu-name {
    color: #18364d;
    font-weight: 600;
}

.posyandu-keterangan {
    max-width: 260px;
    color: #52616b;
    line-height: 1.5;
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

.alert-success {
    margin-bottom: 20px;
    padding: 12px 15px;
    border-radius: 7px;
    background: #e8f7ee;
    border: 1px solid #ccebd8;
    color: #087443;
    font-size: 12px;
}

.alert-error {
    margin-bottom: 20px;
    padding: 12px 15px;
    border-radius: 7px;
    background: #fff0ee;
    border: 1px solid #f1d0cb;
    color: #c0392b;
    font-size: 12px;
}

.empty-state {
    text-align: center;
    padding: 40px 20px !important;
    color: #7a858d;
}

.empty-state-title {
    font-size: 13px;
    font-weight: 600;
    color: #52616b;
    margin-bottom: 5px;
}

.empty-state-text {
    font-size: 11px;
    color: #8a969d;
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

    .table-panel-header {
        align-items: flex-start;
        flex-direction: column;
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

<div class="content-header">


<div>
    <h2>Data Posyandu & Posbindu</h2>

    <p>
        Kelola data Posyandu dan Posbindu Kelurahan Binong.
    </p>
</div>

<a
    href="{{ route('dataposyandu.create') }}"
    class="btn-add"
>
    + Tambah Data
</a>


</div>

<section class="table-panel">


<div class="table-panel-header">

    <div>
        <h3>Daftar Posyandu & Posbindu</h3>

        <p>
            Data Posyandu & Posbindu Kelurahan Binong
        </p>
    </div>

    <span
        class="total-data"
        id="totalData"
    >
        {{ isset($dataPosyandu) ? $dataPosyandu->count() : 0 }} Data
    </span>

</div>

<div class="table-wrapper">

    <table
        id="posyanduTable"
        class="display"
    >

        <thead>

            <tr>
                <th>ID</th>
                <th>Jenis</th>
                <th>Nama</th>
                <th>RW</th>
                <th>Jumlah Kader</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>

        </thead>

        <tbody>

            @if(isset($dataPosyandu) && $dataPosyandu->count() > 0)

                @foreach($dataPosyandu as $item)

                    <tr>

                        <td>
                            <span class="posyandu-id">
                                {{ $item->id_data }}
                            </span>
                        </td>

                        <td>

                            @if($item->jenis === 'Posyandu')

                                <span class="badge badge-posyandu">
                                    Posyandu
                                </span>

                            @else

                                <span class="badge badge-posbindu">
                                    Posbindu
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="posyandu-name">
                                {{ $item->nama }}
                            </div>

                        </td>

                        <td>
                            {{ $item->rw ?: '-' }}
                        </td>

                        <td>
                            {{ $item->jumlah_kader }} Kader
                        </td>

                        <td>

                            <div class="posyandu-keterangan">
                                {{ $item->keterangan ?: '-' }}
                            </div>

                        </td>

                        <td>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('dataposyandu.show', $item->id) }}"
                                    class="action-btn action-view"
                                    title="Lihat"
                                >
                                    ◉
                                </a>

                                <a
                                    href="{{ route('dataposyandu.edit', $item->id) }}"
                                    class="action-btn action-edit"
                                    title="Ubah"
                                >
                                    ✎
                                </a>

                                <form
                                    action="{{ route('dataposyandu.destroy', $item->id) }}"
                                    method="POST"
                                    class="delete-form"
                                    onsubmit="return confirm('Yakin ingin menghapus data Posyandu & Posbindu ini?')"
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

                @endforeach

            @else

                <tr>

                    <td
                        colspan="7"
                        class="empty-state"
                    >

                        <div class="empty-state-title">
                            Belum ada data Posyandu & Posbindu
                        </div>

                        <div class="empty-state-text">
                            Silakan tambahkan data terlebih dahulu.
                        </div>

                    </td>

                </tr>

            @endif

        </tbody>

    </table>

</div>


</section>

@endsection

@push('scripts')

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const posyanduTable = new DataTable('#posyanduTable', {
        pageLength: 10,
        order: [],
        columnDefs: [
            {
                orderable: false,
                searchable: false,
                targets: 6
            }
        ]
    });

    posyanduTable.on('draw', function () {

        const totalData = document.getElementById('totalData');

        if (totalData) {
            totalData.textContent =
                posyanduTable.page.info().recordsDisplay + ' Data';
        }

    });

});
</script>

@endpush
