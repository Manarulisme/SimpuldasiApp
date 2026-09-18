@extends('Admin.Layout.master')

@section('title', 'Data Laporan Kependudukan - Kelurahan XXXXX')
@section('page_title', 'Data Laporan Kependudukan')
@section('page_subtitle', 'Kependudukan · Laporan Kependudukan')

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

    #kependudukanTable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 13px;
    }

    #kependudukanTable thead th {
        background: #f7f9f8;
        color: #52605a;
        font-weight: 600;
        padding: 13px 12px;
        border-bottom: 1px solid #e5e9e7;
        text-align: left;
        white-space: nowrap;
    }

    #kependudukanTable tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #eef1f0;
        color: #56625c;
        vertical-align: middle;
    }

    #kependudukanTable tbody tr:last-child td {
        border-bottom: none;
    }

    #kependudukanTable tbody tr:hover {
        background: #fafcfb;
    }

    .month {
        color: #27352d;
        font-weight: 600;
        white-space: nowrap;
    }

    .year {
        color: #59655f;
        white-space: nowrap;
    }

    .number {
        color: #34413a;
        font-weight: 600;
        white-space: nowrap;
    }

    .description {
        color: #59655f;
        min-width: 200px;
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

    .badge-month {
        background: #eef6ff;
        color: #3971a9;
    }

    .badge-year {
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

    /* =========================
       DATATABLES
    ========================= */

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

    /* =========================
       MODAL
    ========================= */

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

    .form-group textarea {
        resize: vertical;
        min-height: 90px;
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

    /* =========================
       DETAIL
    ========================= */

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

    .detail-item.full {
        grid-column: 1 / -1;
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

        .form-group.full,
        .detail-item.full {
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

    <!-- =========================
         HEADER
    ========================== -->

    <div class="content-header">

        <div>
            <h2>Data Laporan Kependudukan</h2>
            <p>Kelola data laporan kependudukan Kelurahan XXXXX.</p>
        </div>

        <button type="button" class="btn-add" id="btnTambah">
            <span class="btn-add-icon">+</span>
            Tambah Data
        </button>

    </div>


    <!-- =========================
         TABLE
    ========================== -->

    <section class="table-panel">

        <div class="table-panel-header">

            <div>
                <h3>Daftar Laporan Kependudukan</h3>
                <p>Data laporan kependudukan Kelurahan XXXXX</p>
            </div>

            <span class="total-data" id="totalData">
                5 Data
            </span>

        </div>


        <div class="table-wrapper">

            <table id="kependudukanTable" class="display">

                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah KK</th>
                        <th>Jumlah Laki-Laki</th>
                        <th>Jumlah Perempuan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <!-- DATA 1 -->

                    <tr>

                        <td>
                            <span class="badge badge-month">
                                Januari
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-year">
                                2026
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.245
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                2.018
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.976
                            </span>
                        </td>

                        <td>
                            <span class="description">
                                Data kependudukan bulan Januari
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


                    <!-- DATA 2 -->

                    <tr>

                        <td>
                            <span class="badge badge-month">
                                Februari
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-year">
                                2026
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.251
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                2.026
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.984
                            </span>
                        </td>

                        <td>
                            <span class="description">
                                Data kependudukan bulan Februari
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


                    <!-- DATA 3 -->

                    <tr>

                        <td>
                            <span class="badge badge-month">
                                Maret
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-year">
                                2026
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.258
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                2.034
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.991
                            </span>
                        </td>

                        <td>
                            <span class="description">
                                Data kependudukan bulan Maret
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


                    <!-- DATA 4 -->

                    <tr>

                        <td>
                            <span class="badge badge-month">
                                April
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-year">
                                2026
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.264
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                2.041
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.998
                            </span>
                        </td>

                        <td>
                            <span class="description">
                                Data kependudukan bulan April
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


                    <!-- DATA 5 -->

                    <tr>

                        <td>
                            <span class="badge badge-month">
                                Mei
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-year">
                                2026
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                1.271
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                2.049
                            </span>
                        </td>

                        <td>
                            <span class="number">
                                2.006
                            </span>
                        </td>

                        <td>
                            <span class="description">
                                Data kependudukan bulan Mei
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


{{-- =========================
     MODAL TAMBAH DATA
========================= --}}

<div class="modal-overlay" id="modalOverlay">

    <div class="modal">

        <div class="modal-header">

            <h3>Tambah Data Kependudukan</h3>

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

                        <label for="bulan">
                            Bulan
                        </label>

                        <select id="bulan" required>

                            <option value="">
                                Pilih bulan
                            </option>

                            <option value="Januari">
                                Januari
                            </option>

                            <option value="Februari">
                                Februari
                            </option>

                            <option value="Maret">
                                Maret
                            </option>

                            <option value="April">
                                April
                            </option>

                            <option value="Mei">
                                Mei
                            </option>

                            <option value="Juni">
                                Juni
                            </option>

                            <option value="Juli">
                                Juli
                            </option>

                            <option value="Agustus">
                                Agustus
                            </option>

                            <option value="September">
                                September
                            </option>

                            <option value="Oktober">
                                Oktober
                            </option>

                            <option value="November">
                                November
                            </option>

                            <option value="Desember">
                                Desember
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="tahun">
                            Tahun
                        </label>

                        <input type="number"
                            id="tahun"
                            min="2000"
                            max="2100"
                            placeholder="Contoh: 2026"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="jumlahKK">
                            Jumlah KK
                        </label>

                        <input type="number"
                            id="jumlahKK"
                            min="0"
                            placeholder="Contoh: 1250"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="jumlahLaki">
                            Jumlah Laki-Laki
                        </label>

                        <input type="number"
                            id="jumlahLaki"
                            min="0"
                            placeholder="Contoh: 2000"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="jumlahPerempuan">
                            Jumlah Perempuan
                        </label>

                        <input type="number"
                            id="jumlahPerempuan"
                            min="0"
                            placeholder="Contoh: 1950"
                            required>

                    </div>


                    <div class="form-group full">

                        <label for="keterangan">
                            Keterangan
                        </label>

                        <textarea
                            id="keterangan"
                            placeholder="Masukkan keterangan laporan kependudukan"
                            required></textarea>

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


{{-- =========================
     MODAL EDIT DATA
========================= --}}

<div class="modal-overlay" id="modalEditOverlay">

    <div class="modal">

        <div class="modal-header">

            <h3>Edit Data Kependudukan</h3>

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

                        <label for="editBulan">
                            Bulan
                        </label>

                        <select id="editBulan" required>

                            <option value="">
                                Pilih bulan
                            </option>

                            <option value="Januari">
                                Januari
                            </option>

                            <option value="Februari">
                                Februari
                            </option>

                            <option value="Maret">
                                Maret
                            </option>

                            <option value="April">
                                April
                            </option>

                            <option value="Mei">
                                Mei
                            </option>

                            <option value="Juni">
                                Juni
                            </option>

                            <option value="Juli">
                                Juli
                            </option>

                            <option value="Agustus">
                                Agustus
                            </option>

                            <option value="September">
                                September
                            </option>

                            <option value="Oktober">
                                Oktober
                            </option>

                            <option value="November">
                                November
                            </option>

                            <option value="Desember">
                                Desember
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="editTahun">
                            Tahun
                        </label>

                        <input type="number"
                            id="editTahun"
                            min="2000"
                            max="2100"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="editJumlahKK">
                            Jumlah KK
                        </label>

                        <input type="number"
                            id="editJumlahKK"
                            min="0"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="editJumlahLaki">
                            Jumlah Laki-Laki
                        </label>

                        <input type="number"
                            id="editJumlahLaki"
                            min="0"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="editJumlahPerempuan">
                            Jumlah Perempuan
                        </label>

                        <input type="number"
                            id="editJumlahPerempuan"
                            min="0"
                            required>

                    </div>


                    <div class="form-group full">

                        <label for="editKeterangan">
                            Keterangan
                        </label>

                        <textarea
                            id="editKeterangan"
                            required></textarea>

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


{{-- =========================
     MODAL VIEW
========================= --}}

<div class="modal-overlay" id="modalViewOverlay">

    <div class="modal">

        <div class="modal-header">

            <h3>Detail Laporan Kependudukan</h3>

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
                        Bulan
                    </span>

                    <span class="detail-value"
                        id="viewBulan">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Tahun
                    </span>

                    <span class="detail-value"
                        id="viewTahun">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jumlah KK
                    </span>

                    <span class="detail-value"
                        id="viewJumlahKK">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jumlah Laki-Laki
                    </span>

                    <span class="detail-value"
                        id="viewJumlahLaki">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jumlah Perempuan
                    </span>

                    <span class="detail-value"
                        id="viewJumlahPerempuan">
                        -
                    </span>

                </div>


                <div class="detail-item full">

                    <span class="detail-label">
                        Keterangan
                    </span>

                    <span class="detail-value"
                        id="viewKeterangan">
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

    /* =========================
       DATATABLE
    ========================= */

    const table = new DataTable('#kependudukanTable', {

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


    /* =========================
       ELEMENT
    ========================= */

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

        document.getElementById('totalData').textContent =
            info.recordsDisplay + ' Data';

    }


    table.on('draw', function () {
        updateTotal();
    });


    updateTotal();


    /* =========================
       FORMAT ANGKA
    ========================= */

    function formatNumber(value) {

        return Number(value).toLocaleString('id-ID');

    }


    /* =========================
       ADD MODAL
    ========================= */

    btnTambah.addEventListener('click', function () {

        formData.reset();

        modalOverlay.classList.add('show');

    });


    /* =========================
       CLOSE MODAL
    ========================= */

    document.querySelectorAll('[data-close]')
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


    /* =========================
       CLICK OUTSIDE
    ========================= */

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
       ESC CLOSE
    ========================= */

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            modalOverlay.classList.remove('show');

            modalEditOverlay.classList.remove('show');

            modalViewOverlay.classList.remove('show');

        }

    });


    /* =========================
       GET ROW DATA
    ========================= */

    function getRowData(row) {

        const cells =
            row.querySelectorAll('td');

        return {

            bulan:
                cells[0].innerText.trim(),

            tahun:
                cells[1].innerText.trim(),

            jumlahKK:
                cells[2].innerText.trim(),

            jumlahLaki:
                cells[3].innerText.trim(),

            jumlahPerempuan:
                cells[4].innerText.trim(),

            keterangan:
                cells[5].innerText.trim()

        };

    }


    /* =========================
       TABLE ACTION
    ========================= */

    document
        .querySelector('#kependudukanTable tbody')
        .addEventListener('click', function (event) {

            const button =
                event.target.closest('.btn-action');

            if (!button) {
                return;
            }

            const row =
                button.closest('tr');

            if (!row) {
                return;
            }

            selectedRow = row;

            const data =
                getRowData(row);

            const action =
                button.getAttribute('data-action');


            /* =========================
               VIEW
            ========================= */

            if (action === 'view') {

                document.getElementById('viewBulan')
                    .textContent = data.bulan;

                document.getElementById('viewTahun')
                    .textContent = data.tahun;

                document.getElementById('viewJumlahKK')
                    .textContent = data.jumlahKK;

                document.getElementById('viewJumlahLaki')
                    .textContent = data.jumlahLaki;

                document.getElementById('viewJumlahPerempuan')
                    .textContent = data.jumlahPerempuan;

                document.getElementById('viewKeterangan')
                    .textContent = data.keterangan;

                modalViewOverlay.classList.add('show');

            }


            /* =========================
               EDIT
            ========================= */

            if (action === 'edit') {

                document.getElementById('editBulan')
                    .value = data.bulan;

                document.getElementById('editTahun')
                    .value = data.tahun;

                document.getElementById('editJumlahKK')
                    .value = data.jumlahKK.replace(/\./g, '');

                document.getElementById('editJumlahLaki')
                    .value = data.jumlahLaki.replace(/\./g, '');

                document.getElementById('editJumlahPerempuan')
                    .value = data.jumlahPerempuan.replace(/\./g, '');

                document.getElementById('editKeterangan')
                    .value = data.keterangan;

                modalEditOverlay.classList.add('show');

            }


            /* =========================
               DELETE
            ========================= */

            if (action === 'delete') {

                const confirmDelete = confirm(
                    'Apakah Anda yakin ingin menghapus laporan ' +
                    data.bulan +
                    ' ' +
                    data.tahun +
                    '?'
                );

                if (!confirmDelete) {
                    return;
                }

                table
                    .row(row)
                    .remove()
                    .draw();

                updateTotal();

                alert(
                    'Data laporan kependudukan berhasil dihapus.'
                );

            }

        });


    /* =========================
       ADD DATA
    ========================= */

    formData.addEventListener('submit', function (event) {

        event.preventDefault();


        const bulan =
            document.getElementById('bulan')
                .value;

        const tahun =
            document.getElementById('tahun')
                .value.trim();

        const jumlahKK =
            document.getElementById('jumlahKK')
                .value.trim();

        const jumlahLaki =
            document.getElementById('jumlahLaki')
                .value.trim();

        const jumlahPerempuan =
            document.getElementById('jumlahPerempuan')
                .value.trim();

        const keterangan =
            document.getElementById('keterangan')
                .value.trim();


        if (
            !bulan ||
            !tahun ||
            !jumlahKK ||
            !jumlahLaki ||
            !jumlahPerempuan ||
            !keterangan
        ) {

            alert(
                'Mohon lengkapi seluruh data.'
            );

            return;

        }


        table.row.add([

            `<span class="badge badge-month">
                ${bulan}
            </span>`,

            `<span class="badge badge-year">
                ${tahun}
            </span>`,

            `<span class="number">
                ${formatNumber(jumlahKK)}
            </span>`,

            `<span class="number">
                ${formatNumber(jumlahLaki)}
            </span>`,

            `<span class="number">
                ${formatNumber(jumlahPerempuan)}
            </span>`,

            `<span class="description">
                ${keterangan}
            </span>`,

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

        ]).draw(false);


        formData.reset();

        modalOverlay.classList.remove('show');

        updateTotal();

        alert(
            'Data laporan kependudukan berhasil ditambahkan.'
        );

    });


    /* =========================
       EDIT DATA
    ========================= */

    formEdit.addEventListener('submit', function (event) {

        event.preventDefault();


        if (!selectedRow) {
            return;
        }


        const bulan =
            document.getElementById('editBulan')
                .value;

        const tahun =
            document.getElementById('editTahun')
                .value.trim();

        const jumlahKK =
            document.getElementById('editJumlahKK')
                .value.trim();

        const jumlahLaki =
            document.getElementById('editJumlahLaki')
                .value.trim();

        const jumlahPerempuan =
            document.getElementById('editJumlahPerempuan')
                .value.trim();

        const keterangan =
            document.getElementById('editKeterangan')
                .value.trim();


        if (
            !bulan ||
            !tahun ||
            !jumlahKK ||
            !jumlahLaki ||
            !jumlahPerempuan ||
            !keterangan
        ) {

            alert(
                'Mohon lengkapi seluruh data.'
            );

            return;

        }


        const rowData = [

            `<span class="badge badge-month">
                ${bulan}
            </span>`,

            `<span class="badge badge-year">
                ${tahun}
            </span>`,

            `<span class="number">
                ${formatNumber(jumlahKK)}
            </span>`,

            `<span class="number">
                ${formatNumber(jumlahLaki)}
            </span>`,

            `<span class="number">
                ${formatNumber(jumlahPerempuan)}
            </span>`,

            `<span class="description">
                ${keterangan}
            </span>`,

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
            'Data laporan kependudukan berhasil diperbarui.'
        );

        selectedRow = null;

    });

});

</script>

@endpush
