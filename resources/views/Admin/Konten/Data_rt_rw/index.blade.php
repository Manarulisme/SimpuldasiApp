@extends('Admin.Layout.master')

@section('title', 'Data RT & RW - Kelurahan XXXXX')
@section('page_title', 'Data RT & RW')
@section('page_subtitle', 'Pemerintahan · RT & RW')

@section('content')

<style>
    .content {
        padding: 24px;
    }

    .content-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
    }

    .content-header h2 {
        margin: 0 0 5px;
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 22px;
        color: #24332b;
    }

    .content-header p {
        margin: 0;
        color: #7a8580;
        font-size: 13px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        background: #2f6b4f;
        color: #fff;
        padding: 10px 16px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .btn-add:hover {
        background: #24563f;
    }

    .btn-add-icon {
        font-size: 18px;
        line-height: 1;
    }

    .table-panel {
        background: #fff;
        border: 1px solid #e7ebee;
        border-radius: 10px;
        overflow: hidden;
    }

    .table-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 19px 22px;
        border-bottom: 1px solid #eef1f3;
    }

    .table-panel-header h3 {
        margin: 0 0 4px;
        font-size: 16px;
        color: #27352d;
    }

    .table-panel-header p {
        margin: 0;
        color: #8a9490;
        font-size: 12px;
    }

    .total-data {
        display: inline-flex;
        align-items: center;
        padding: 6px 11px;
        border-radius: 20px;
        background: #eef7f1;
        color: #2f6b4f;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .table-wrapper {
        padding: 0 22px 20px;
        overflow-x: auto;
    }

    #rtRwTable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 13px;
    }

    #rtRwTable thead th {
        background: #f7f9f8;
        color: #52605a;
        font-weight: 600;
        padding: 13px 12px;
        border-bottom: 1px solid #e5e9e7;
        text-align: left;
        white-space: nowrap;
    }

    #rtRwTable tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #eef1f0;
        color: #56625c;
        vertical-align: middle;
    }

    #rtRwTable tbody tr:last-child td {
        border-bottom: none;
    }

    #rtRwTable tbody tr:hover {
        background: #fafcfb;
    }

    .jenis {
        color: #27352d;
        font-weight: 600;
    }

    .nomor {
        color: #59655f;
        white-space: nowrap;
    }

    .rw-name {
        color: #59655f;
        white-space: nowrap;
    }

    .leader-name {
        color: #27352d;
        font-weight: 600;
        min-width: 160px;
    }

    .date {
        color: #59655f;
        white-space: nowrap;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-rt {
        background: #eef6ff;
        color: #3971a9;
    }

    .badge-rw {
        background: #edf8f1;
        color: #34734e;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-action {
        width: 31px;
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: 1px solid transparent;
        cursor: pointer;
        font-size: 14px;
        transition: 0.2s ease;
    }

    .btn-view {
        background: #eef6ff;
        color: #3675ad;
        border-color: #dcecfb;
    }

    .btn-view:hover {
        background: #dcecff;
    }

    .btn-edit {
        background: #edf8f1;
        color: #34734e;
        border-color: #dcefe3;
    }

    .btn-edit:hover {
        background: #dff1e5;
    }

    .btn-delete {
        background: #fff0f0;
        color: #c44d4d;
        border-color: #f7dddd;
    }

    .btn-delete:hover {
        background: #ffe0e0;
    }

    .dashboard-footer {
        text-align: center;
        padding: 22px 0 5px;
        color: #98a19d;
        font-size: 11px;
    }

    /* DATATABLES */

    .dt-container {
        font-size: 12px;
        color: #68736e;
    }

    .dt-layout-row {
        margin-top: 15px;
        margin-bottom: 10px;
    }

    .dt-search input,
    .dt-length select {
        border: 1px solid #dfe5e2 !important;
        border-radius: 6px !important;
        padding: 7px 10px !important;
        outline: none;
        color: #52605a;
        background: #fff;
    }

    .dt-search input:focus,
    .dt-length select:focus {
        border-color: #9dbdac !important;
        box-shadow: 0 0 0 2px rgba(47, 107, 79, 0.08);
    }

    .dt-paging-button {
        border-radius: 5px !important;
        border: 1px solid transparent !important;
        color: #5d6963 !important;
        padding: 5px 9px !important;
    }

    .dt-paging-button:hover {
        background: #eef6f1 !important;
        border-color: #dcebe1 !important;
        color: #2f6b4f !important;
    }

    .dt-paging-button.current {
        background: #2f6b4f !important;
        color: #fff !important;
        border-color: #2f6b4f !important;
    }

    /* MODAL */

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(25, 35, 30, 0.48);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 9999;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal {
        width: 100%;
        max-width: 680px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 17px 20px;
        border-bottom: 1px solid #edf0ef;
    }

    .modal-header h3 {
        margin: 0;
        color: #27352d;
        font-size: 16px;
    }

    .modal-close {
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 6px;
        background: #f3f5f4;
        color: #68736e;
        font-size: 18px;
        cursor: pointer;
    }

    .modal-close:hover {
        background: #e9edeb;
    }

    .modal-body {
        padding: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 12px;
        font-weight: 600;
        color: #53605a;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #dfe5e2;
        border-radius: 7px;
        padding: 10px 11px;
        font-family: inherit;
        font-size: 13px;
        color: #4f5d56;
        outline: none;
        background: #fff;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #8eae9d;
        box-shadow: 0 0 0 2px rgba(47, 107, 79, 0.08);
    }

    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        padding: 15px 20px;
        border-top: 1px solid #edf0ef;
        background: #fafbfa;
    }

    .btn-cancel,
    .btn-save {
        border: none;
        border-radius: 6px;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-cancel {
        background: #eef1ef;
        color: #5f6b65;
    }

    .btn-cancel:hover {
        background: #e3e8e5;
    }

    .btn-save {
        background: #2f6b4f;
        color: #fff;
    }

    .btn-save:hover {
        background: #24563f;
    }

    /* DETAIL */

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }

    .detail-item {
        padding: 13px 14px;
        border: 1px solid #edf0ef;
        border-radius: 7px;
        background: #fafcfb;
    }

    .detail-label {
        display: block;
        margin-bottom: 5px;
        color: #8a9490;
        font-size: 11px;
    }

    .detail-value {
        color: #34413a;
        font-size: 13px;
        font-weight: 600;
    }

    @media (max-width: 768px) {

        .content {
            padding: 18px;
        }

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

        .form-grid,
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .modal-overlay {
            padding: 12px;
        }

        .modal {
            max-height: 94vh;
        }
    }
</style>


<div class="content">

    <div class="content-header">

        <div>
            <h2>Data RT &amp; RW</h2>
            <p>Kelola data RT dan RW Kelurahan XXXXX.</p>
        </div>

        <button type="button"
            class="btn-add"
            id="btnTambah">

            <span class="btn-add-icon">+</span>
            Tambah Data

        </button>

    </div>


    <section class="table-panel">

        <div class="table-panel-header">

            <div>
                <h3>Daftar RT &amp; RW</h3>
                <p>Data kepengurusan RT dan RW Kelurahan XXXXX</p>
            </div>

            <span class="total-data"
                id="totalData">
                6 Data
            </span>

        </div>


        <div class="table-wrapper">

            <table id="rtRwTable"
                class="display">

                <thead>

                    <tr>
                        <th>Jenis</th>
                        <th>Nomor</th>
                        <th>RW</th>
                        <th>Nama Ketua</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>
                            <span class="badge badge-rt">
                                RT
                            </span>
                        </td>

                        <td>
                            <span class="nomor">
                                RT 01
                            </span>
                        </td>

                        <td>
                            <span class="rw-name">
                                RW 01
                            </span>
                        </td>

                        <td>
                            <span class="leader-name">
                                Budi Santoso
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                01 Januari 2025
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                31 Desember 2029
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <button type="button"
                                    class="btn-action btn-view"
                                    title="Lihat"
                                    data-action="view">
                                    👁
                                </button>

                                <button type="button"
                                    class="btn-action btn-edit"
                                    title="Edit"
                                    data-action="edit">
                                    ✏
                                </button>

                                <button type="button"
                                    class="btn-action btn-delete"
                                    title="Hapus"
                                    data-action="delete">
                                    🗑
                                </button>

                            </div>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <span class="badge badge-rt">
                                RT
                            </span>
                        </td>

                        <td>
                            <span class="nomor">
                                RT 02
                            </span>
                        </td>

                        <td>
                            <span class="rw-name">
                                RW 01
                            </span>
                        </td>

                        <td>
                            <span class="leader-name">
                                Ahmad Hidayat
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                01 Januari 2025
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                31 Desember 2029
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <button type="button"
                                    class="btn-action btn-view"
                                    title="Lihat"
                                    data-action="view">
                                    👁
                                </button>

                                <button type="button"
                                    class="btn-action btn-edit"
                                    title="Edit"
                                    data-action="edit">
                                    ✏
                                </button>

                                <button type="button"
                                    class="btn-action btn-delete"
                                    title="Hapus"
                                    data-action="delete">
                                    🗑
                                </button>

                            </div>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <span class="badge badge-rt">
                                RT
                            </span>
                        </td>

                        <td>
                            <span class="nomor">
                                RT 03
                            </span>
                        </td>

                        <td>
                            <span class="rw-name">
                                RW 02
                            </span>
                        </td>

                        <td>
                            <span class="leader-name">
                                Dedi Kurniawan
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                15 Februari 2025
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                14 Februari 2030
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <button type="button"
                                    class="btn-action btn-view"
                                    title="Lihat"
                                    data-action="view">
                                    👁
                                </button>

                                <button type="button"
                                    class="btn-action btn-edit"
                                    title="Edit"
                                    data-action="edit">
                                    ✏
                                </button>

                                <button type="button"
                                    class="btn-action btn-delete"
                                    title="Hapus"
                                    data-action="delete">
                                    🗑
                                </button>

                            </div>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <span class="badge badge-rt">
                                RT
                            </span>
                        </td>

                        <td>
                            <span class="nomor">
                                RT 04
                            </span>
                        </td>

                        <td>
                            <span class="rw-name">
                                RW 02
                            </span>
                        </td>

                        <td>
                            <span class="leader-name">
                                Eko Prasetyo
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                15 Februari 2025
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                14 Februari 2030
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <button type="button"
                                    class="btn-action btn-view"
                                    title="Lihat"
                                    data-action="view">
                                    👁
                                </button>

                                <button type="button"
                                    class="btn-action btn-edit"
                                    title="Edit"
                                    data-action="edit">
                                    ✏
                                </button>

                                <button type="button"
                                    class="btn-action btn-delete"
                                    title="Hapus"
                                    data-action="delete">
                                    🗑
                                </button>

                            </div>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <span class="badge badge-rw">
                                RW
                            </span>
                        </td>

                        <td>
                            <span class="nomor">
                                RW 01
                            </span>
                        </td>

                        <td>
                            <span class="rw-name">
                                -
                            </span>
                        </td>

                        <td>
                            <span class="leader-name">
                                Hendra Wijaya
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                01 Januari 2025
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                31 Desember 2029
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <button type="button"
                                    class="btn-action btn-view"
                                    title="Lihat"
                                    data-action="view">
                                    👁
                                </button>

                                <button type="button"
                                    class="btn-action btn-edit"
                                    title="Edit"
                                    data-action="edit">
                                    ✏
                                </button>

                                <button type="button"
                                    class="btn-action btn-delete"
                                    title="Hapus"
                                    data-action="delete">
                                    🗑
                                </button>

                            </div>
                        </td>

                    </tr>


                    <tr>

                        <td>
                            <span class="badge badge-rw">
                                RW
                            </span>
                        </td>

                        <td>
                            <span class="nomor">
                                RW 02
                            </span>
                        </td>

                        <td>
                            <span class="rw-name">
                                -
                            </span>
                        </td>

                        <td>
                            <span class="leader-name">
                                Agus Setiawan
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                15 Februari 2025
                            </span>
                        </td>

                        <td>
                            <span class="date">
                                14 Februari 2030
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <button type="button"
                                    class="btn-action btn-view"
                                    title="Lihat"
                                    data-action="view">
                                    👁
                                </button>

                                <button type="button"
                                    class="btn-action btn-edit"
                                    title="Edit"
                                    data-action="edit">
                                    ✏
                                </button>

                                <button type="button"
                                    class="btn-action btn-delete"
                                    title="Hapus"
                                    data-action="delete">
                                    🗑
                                </button>

                            </div>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </section>


    <div class="dashboard-footer">
        © {{ date('Y') }} Kelurahan XXXXX · Sistem Informasi Kelurahan
    </div>

</div>


<!-- ========================= -->
<!-- MODAL TAMBAH -->
<!-- ========================= -->

<div class="modal-overlay"
    id="modalOverlay">

    <div class="modal">

        <div class="modal-header">

            <h3>
                Tambah Data RT &amp; RW
            </h3>

            <button type="button"
                class="modal-close"
                data-close="modalOverlay">
                ×
            </button>

        </div>


        <form id="formData">

            <div class="modal-body">

                <div class="form-grid">

                    <div class="form-group">

                        <label for="jenis">
                            Jenis
                        </label>

                        <select id="jenis" required>

                            <option value="">
                                Pilih Jenis
                            </option>

                            <option value="RT">
                                RT
                            </option>

                            <option value="RW">
                                RW
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="nomor">
                            Nomor
                        </label>

                        <input
                            type="text"
                            id="nomor"
                            placeholder="Contoh: RT 01 / RW 01"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="rw">
                            RW
                        </label>

                        <select id="rw">

                            <option value="">
                                Pilih RW
                            </option>

                            <option value="RW 01">
                                RW 01
                            </option>

                            <option value="RW 02">
                                RW 02
                            </option>

                            <option value="RW 03">
                                RW 03
                            </option>

                            <option value="RW 04">
                                RW 04
                            </option>

                            <option value="RW 05">
                                RW 05
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="namaKetua">
                            Nama Ketua
                        </label>

                        <input
                            type="text"
                            id="namaKetua"
                            placeholder="Masukkan nama ketua"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="tanggalMulai">
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            id="tanggalMulai"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="tanggalBerakhir">
                            Tanggal Berakhir
                        </label>

                        <input
                            type="date"
                            id="tanggalBerakhir"
                            required
                        >

                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button type="button"
                    class="btn-cancel"
                    data-close="modalOverlay">
                    Batal
                </button>

                <button type="submit"
                    class="btn-save">
                    Simpan Data
                </button>

            </div>

        </form>

    </div>

</div>


<!-- ========================= -->
<!-- MODAL EDIT -->
<!-- ========================= -->

<div class="modal-overlay"
    id="modalEditOverlay">

    <div class="modal">

        <div class="modal-header">

            <h3>
                Edit Data RT &amp; RW
            </h3>

            <button type="button"
                class="modal-close"
                data-close="modalEditOverlay">
                ×
            </button>

        </div>


        <form id="formEdit">

            <div class="modal-body">

                <div class="form-grid">

                    <div class="form-group">

                        <label for="editJenis">
                            Jenis
                        </label>

                        <select id="editJenis" required>

                            <option value="RT">
                                RT
                            </option>

                            <option value="RW">
                                RW
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="editNomor">
                            Nomor
                        </label>

                        <input
                            type="text"
                            id="editNomor"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="editRw">
                            RW
                        </label>

                        <select id="editRw">

                            <option value="">
                                -
                            </option>

                            <option value="RW 01">
                                RW 01
                            </option>

                            <option value="RW 02">
                                RW 02
                            </option>

                            <option value="RW 03">
                                RW 03
                            </option>

                            <option value="RW 04">
                                RW 04
                            </option>

                            <option value="RW 05">
                                RW 05
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="editNamaKetua">
                            Nama Ketua
                        </label>

                        <input
                            type="text"
                            id="editNamaKetua"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="editTanggalMulai">
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            id="editTanggalMulai"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="editTanggalBerakhir">
                            Tanggal Berakhir
                        </label>

                        <input
                            type="date"
                            id="editTanggalBerakhir"
                            required
                        >

                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button type="button"
                    class="btn-cancel"
                    data-close="modalEditOverlay">
                    Batal
                </button>

                <button type="submit"
                    class="btn-save">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>


<!-- ========================= -->
<!-- MODAL VIEW -->
<!-- ========================= -->

<div class="modal-overlay"
    id="modalViewOverlay">

    <div class="modal">

        <div class="modal-header">

            <h3>
                Detail Data RT &amp; RW
            </h3>

            <button type="button"
                class="modal-close"
                data-close="modalViewOverlay">
                ×
            </button>

        </div>


        <div class="modal-body">

            <div class="detail-grid">

                <div class="detail-item">

                    <span class="detail-label">
                        Jenis
                    </span>

                    <span class="detail-value"
                        id="viewJenis">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Nomor
                    </span>

                    <span class="detail-value"
                        id="viewNomor">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        RW
                    </span>

                    <span class="detail-value"
                        id="viewRw">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Nama Ketua
                    </span>

                    <span class="detail-value"
                        id="viewNamaKetua">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Tanggal Mulai
                    </span>

                    <span class="detail-value"
                        id="viewTanggalMulai">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Tanggal Berakhir
                    </span>

                    <span class="detail-value"
                        id="viewTanggalBerakhir">
                        -
                    </span>

                </div>

            </div>

        </div>


        <div class="modal-footer">

            <button type="button"
                class="btn-cancel"
                data-close="modalViewOverlay">
                Tutup
            </button>

        </div>

    </div>

</div>


@endsection


@push('scripts')

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const table = new DataTable('#rtRwTable', {

        pageLength: 10,

        lengthMenu: [
            [5, 10, 25, 50],
            [5, 10, 25, 50]
        ],

        language: {

            search: 'Cari:',

            lengthMenu: 'Tampilkan _MENU_ data',

            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',

            infoEmpty: 'Tidak ada data',

            zeroRecords: 'Data tidak ditemukan',

            emptyTable: 'Belum ada data',

            paginate: {
                first: 'Awal',
                last: 'Akhir',
                next: '›',
                previous: '‹'
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


    const modalOverlay =
        document.getElementById('modalOverlay');

    const modalEditOverlay =
        document.getElementById('modalEditOverlay');

    const modalViewOverlay =
        document.getElementById('modalViewOverlay');

    const btnTambah =
        document.getElementById('btnTambah');

    const formData =
        document.getElementById('formData');

    const formEdit =
        document.getElementById('formEdit');


    let selectedRow = null;


    /* =========================
       UPDATE TOTAL
    ========================= */

    function updateTotal() {

        const info = table.page.info();

        document.getElementById('totalData')
            .textContent =
            info.recordsDisplay + ' Data';

    }


    table.on('draw', function () {

        updateTotal();

    });


    updateTotal();


    /* =========================
       TAMBAH
    ========================= */

    btnTambah.addEventListener('click', function () {

        formData.reset();

        modalOverlay.classList.add('show');

    });


    /* =========================
       CLOSE MODAL
    ========================= */

    document
        .querySelectorAll('[data-close]')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const target =
                    document.getElementById(
                        button.getAttribute('data-close')
                    );

                if (target) {

                    target.classList.remove('show');

                }

            });

        });


    [
        modalOverlay,
        modalEditOverlay,
        modalViewOverlay
    ].forEach(function (modal) {

        modal.addEventListener('click', function (event) {

            if (event.target === modal) {

                modal.classList.remove('show');

            }

        });

    });


    /* =========================
       ESCAPE
    ========================= */

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            modalOverlay.classList.remove('show');

            modalEditOverlay.classList.remove('show');

            modalViewOverlay.classList.remove('show');

        }

    });


    /* =========================
       FORMAT DATE
    ========================= */

    function formatDate(dateString) {

        if (!dateString) return '-';

        const parts =
            dateString.split('-');

        if (parts.length !== 3) {
            return dateString;
        }

        const months = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        return (
            parseInt(parts[2]) +
            ' ' +
            months[parseInt(parts[1]) - 1] +
            ' ' +
            parts[0]
        );

    }


    /* =========================
       DATE TO INPUT
    ========================= */

    function convertDateToInput(dateText) {

        if (!dateText || dateText === '-') {
            return '';
        }

        const months = {
            'Januari': '01',
            'Februari': '02',
            'Maret': '03',
            'April': '04',
            'Mei': '05',
            'Juni': '06',
            'Juli': '07',
            'Agustus': '08',
            'September': '09',
            'Oktober': '10',
            'November': '11',
            'Desember': '12'
        };

        const parts =
            dateText.split(' ');

        if (parts.length !== 3) {
            return '';
        }

        const day =
            parts[0].padStart(2, '0');

        const month =
            months[parts[1]];

        const year =
            parts[2];

        if (!month) {
            return '';
        }

        return year + '-' + month + '-' + day;

    }


    /* =========================
       GET ROW DATA
    ========================= */

    function getRowData(row) {

        const cells =
            row.querySelectorAll('td');

        return {

            jenis:
                cells[0].innerText.trim(),

            nomor:
                cells[1].innerText.trim(),

            rw:
                cells[2].innerText.trim(),

            namaKetua:
                cells[3].innerText.trim(),

            tanggalMulai:
                cells[4].innerText.trim(),

            tanggalBerakhir:
                cells[5].innerText.trim()

        };

    }


    /* =========================
       JENIS CLASS
    ========================= */

    function getJenisClass(jenis) {

        if (jenis === 'RT') {
            return 'badge-rt';
        }

        return 'badge-rw';

    }


    /* =========================
       TABLE ACTION
    ========================= */

    document
        .querySelector('#rtRwTable tbody')
        .addEventListener('click', function (event) {

            const button =
                event.target.closest('.btn-action');

            if (!button) return;


            const row =
                button.closest('tr');

            if (!row) return;


            selectedRow = row;


            const data =
                getRowData(row);


            const action =
                button.getAttribute('data-action');


            /* VIEW */

            if (action === 'view') {

                document.getElementById('viewJenis')
                    .textContent =
                    data.jenis;

                document.getElementById('viewNomor')
                    .textContent =
                    data.nomor;

                document.getElementById('viewRw')
                    .textContent =
                    data.rw;

                document.getElementById('viewNamaKetua')
                    .textContent =
                    data.namaKetua;

                document.getElementById('viewTanggalMulai')
                    .textContent =
                    data.tanggalMulai;

                document.getElementById('viewTanggalBerakhir')
                    .textContent =
                    data.tanggalBerakhir;

                modalViewOverlay.classList.add('show');

            }


            /* EDIT */

            if (action === 'edit') {

                document.getElementById('editJenis')
                    .value =
                    data.jenis;

                document.getElementById('editNomor')
                    .value =
                    data.nomor;

                document.getElementById('editRw')
                    .value =
                    data.rw === '-' ? '' : data.rw;

                document.getElementById('editNamaKetua')
                    .value =
                    data.namaKetua;

                document.getElementById('editTanggalMulai')
                    .value =
                    convertDateToInput(
                        data.tanggalMulai
                    );

                document.getElementById('editTanggalBerakhir')
                    .value =
                    convertDateToInput(
                        data.tanggalBerakhir
                    );

                modalEditOverlay.classList.add('show');

            }


            /* DELETE */

            if (action === 'delete') {

                const confirmDelete =
                    confirm(
                        'Apakah Anda yakin ingin menghapus data ' +
                        data.jenis +
                        ' ' +
                        data.nomor +
                        '?'
                    );


                if (!confirmDelete) return;


                table
                    .row(row)
                    .remove()
                    .draw();


                updateTotal();


                alert(
                    'Data RT & RW berhasil dihapus.'
                );

            }

        });


    /* =========================
       FORM TAMBAH
    ========================= */

    formData.addEventListener('submit', function (event) {

        event.preventDefault();


        const jenis =
            document.getElementById('jenis')
                .value;

        const nomor =
            document.getElementById('nomor')
                .value.trim();

        const rw =
            document.getElementById('rw')
                .value;

        const namaKetua =
            document.getElementById('namaKetua')
                .value.trim();

        const tanggalMulai =
            document.getElementById('tanggalMulai')
                .value;

        const tanggalBerakhir =
            document.getElementById('tanggalBerakhir')
                .value;


        if (
            !jenis ||
            !nomor ||
            !namaKetua ||
            !tanggalMulai ||
            !tanggalBerakhir
        ) {

            alert(
                'Mohon lengkapi seluruh data.'
            );

            return;

        }


        if (
            jenis === 'RT' &&
            !rw
        ) {

            alert(
                'RW wajib dipilih untuk data RT.'
            );

            return;

        }


        if (
            tanggalBerakhir < tanggalMulai
        ) {

            alert(
                'Tanggal berakhir tidak boleh sebelum tanggal mulai.'
            );

            return;

        }


        const jenisClass =
            getJenisClass(jenis);


        const rowData = [

            `<span class="badge ${jenisClass}">${jenis}</span>`,

            `<span class="nomor">${nomor}</span>`,

            `<span class="rw-name">${rw || '-'}</span>`,

            `<span class="leader-name">${namaKetua}</span>`,

            `<span class="date">${formatDate(tanggalMulai)}</span>`,

            `<span class="date">${formatDate(tanggalBerakhir)}</span>`,

            `
            <div class="action-buttons">

                <button type="button"
                    class="btn-action btn-view"
                    title="Lihat"
                    data-action="view">
                    👁
                </button>

                <button type="button"
                    class="btn-action btn-edit"
                    title="Edit"
                    data-action="edit">
                    ✏
                </button>

                <button type="button"
                    class="btn-action btn-delete"
                    title="Hapus"
                    data-action="delete">
                    🗑
                </button>

            </div>
            `

        ];


        table
            .row
            .add(rowData)
            .draw(false);


        formData.reset();

        modalOverlay.classList.remove('show');

        updateTotal();


        alert(
            'Data RT & RW berhasil ditambahkan.'
        );

    });


    /* =========================
       FORM EDIT
    ========================= */

    formEdit.addEventListener('submit', function (event) {

        event.preventDefault();


        if (!selectedRow) return;


        const jenis =
            document.getElementById('editJenis')
                .value;

        const nomor =
            document.getElementById('editNomor')
                .value.trim();

        const rw =
            document.getElementById('editRw')
                .value;

        const namaKetua =
            document.getElementById('editNamaKetua')
                .value.trim();

        const tanggalMulai =
            document.getElementById('editTanggalMulai')
                .value;

        const tanggalBerakhir =
            document.getElementById('editTanggalBerakhir')
                .value;


        if (
            !jenis ||
            !nomor ||
            !namaKetua ||
            !tanggalMulai ||
            !tanggalBerakhir
        ) {

            alert(
                'Mohon lengkapi seluruh data.'
            );

            return;

        }


        if (
            jenis === 'RT' &&
            !rw
        ) {

            alert(
                'RW wajib dipilih untuk data RT.'
            );

            return;

        }


        if (
            tanggalBerakhir < tanggalMulai
        ) {

            alert(
                'Tanggal berakhir tidak boleh sebelum tanggal mulai.'
            );

            return;

        }


        const jenisClass =
            getJenisClass(jenis);


        const rowData = [

            `<span class="badge ${jenisClass}">${jenis}</span>`,

            `<span class="nomor">${nomor}</span>`,

            `<span class="rw-name">${rw || '-'}</span>`,

            `<span class="leader-name">${namaKetua}</span>`,

            `<span class="date">${formatDate(tanggalMulai)}</span>`,

            `<span class="date">${formatDate(tanggalBerakhir)}</span>`,

            `
            <div class="action-buttons">

                <button type="button"
                    class="btn-action btn-view"
                    title="Lihat"
                    data-action="view">
                    👁
                </button>

                <button type="button"
                    class="btn-action btn-edit"
                    title="Edit"
                    data-action="edit">
                    ✏
                </button>

                <button type="button"
                    class="btn-action btn-delete"
                    title="Hapus"
                    data-action="delete">
                    🗑
                </button>

            </div>
            `

        ];


        table
            .row(selectedRow)
            .data(rowData)
            .draw(false);


        modalEditOverlay.classList.remove('show');

        updateTotal();


        alert(
            'Data RT & RW berhasil diperbarui.'
        );


        selectedRow = null;

    });

});

</script>

@endpush
