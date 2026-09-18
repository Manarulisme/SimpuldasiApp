@extends('Admin.Layout.master')

@section('title', 'Data Fasilitas Umum & Sosial - Kelurahan XXXXX')
@section('page_title', 'Data Fasilitas Umum & Sosial')
@section('page_subtitle', 'Sarana & Prasarana · Fasilitas Umum & Sosial')

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

    #fasilitasTable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 13px;
    }

    #fasilitasTable thead th {
        background: #f7f9f8;
        color: #52605a;
        font-weight: 600;
        padding: 13px 12px;
        border-bottom: 1px solid #e5e9e7;
        text-align: left;
        white-space: nowrap;
    }

    #fasilitasTable tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #eef1f0;
        color: #56625c;
        vertical-align: middle;
    }

    #fasilitasTable tbody tr:last-child td {
        border-bottom: none;
    }

    #fasilitasTable tbody tr:hover {
        background: #fafcfb;
    }

    .facility-name {
        color: #27352d;
        font-weight: 600;
    }

    .location {
        color: #59655f;
        min-width: 150px;
    }

    .address {
        color: #59655f;
        min-width: 200px;
    }

    .fund-source {
        color: #59655f;
        min-width: 130px;
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

    .badge-rw {
        background: #f1f4f3;
        color: #5e6964;
    }

    .badge-government {
        background: #eef6ff;
        color: #3971a9;
    }

    .badge-community {
        background: #edf8f1;
        color: #34734e;
    }

    .badge-private {
        background: #fff7e8;
        color: #a9701d;
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
            <h2>Data Fasilitas Umum &amp; Sosial</h2>
            <p>Kelola data fasilitas umum dan sosial Kelurahan XXXXX.</p>
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
                <h3>Daftar Fasilitas Umum &amp; Sosial</h3>
                <p>Data fasilitas umum dan sosial Kelurahan XXXXX</p>
            </div>

            <span class="total-data" id="totalData">
                5 Data
            </span>

        </div>


        <div class="table-wrapper">

            <table id="fasilitasTable" class="display">

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Jenis</th>
                        <th>Alamat</th>
                        <th>Sumber Dana</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <!-- DATA 1 -->

                    <tr>

                        <td>
                            <span class="facility-name">
                                Posyandu Melati
                            </span>
                        </td>

                        <td>
                            <span class="location">
                                RW 01
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-government">
                                Kesehatan
                            </span>
                        </td>

                        <td>
                            <span class="address">
                                Kp. Sukamaju RT 02
                            </span>
                        </td>

                        <td>
                            <span class="fund-source">
                                Dana Kelurahan
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
                            <span class="facility-name">
                                Lapangan Kelurahan
                            </span>
                        </td>

                        <td>
                            <span class="location">
                                RW 02
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-community">
                                Olahraga
                            </span>
                        </td>

                        <td>
                            <span class="address">
                                Jl. Raya Kelurahan RT 01
                            </span>
                        </td>

                        <td>
                            <span class="fund-source">
                                APBD
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
                            <span class="facility-name">
                                Taman Bermain Anak
                            </span>
                        </td>

                        <td>
                            <span class="location">
                                RW 03
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-community">
                                Ruang Terbuka
                            </span>
                        </td>

                        <td>
                            <span class="address">
                                Kp. Cibogo RT 03
                            </span>
                        </td>

                        <td>
                            <span class="fund-source">
                                Swadaya Masyarakat
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
                            <span class="facility-name">
                                Balai Warga
                            </span>
                        </td>

                        <td>
                            <span class="location">
                                RW 04
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-government">
                                Sosial
                            </span>
                        </td>

                        <td>
                            <span class="address">
                                Kp. Sukajaya RT 05
                            </span>
                        </td>

                        <td>
                            <span class="fund-source">
                                Dana Desa
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
                            <span class="facility-name">
                                Perpustakaan Kelurahan
                            </span>
                        </td>

                        <td>
                            <span class="location">
                                RW 05
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-government">
                                Pendidikan
                            </span>
                        </td>

                        <td>
                            <span class="address">
                                Kp. Babakan RT 01
                            </span>
                        </td>

                        <td>
                            <span class="fund-source">
                                APBD
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

            <h3>Tambah Data Fasilitas</h3>

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

                        <label for="nama">
                            Nama
                        </label>

                        <input type="text"
                            id="nama"
                            placeholder="Contoh: Posyandu Melati"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="lokasi">
                            Lokasi
                        </label>

                        <input type="text"
                            id="lokasi"
                            placeholder="Contoh: RW 01"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="jenis">
                            Jenis
                        </label>

                        <select id="jenis" required>

                            <option value="">
                                Pilih jenis
                            </option>

                            <option value="Kesehatan">
                                Kesehatan
                            </option>

                            <option value="Pendidikan">
                                Pendidikan
                            </option>

                            <option value="Olahraga">
                                Olahraga
                            </option>

                            <option value="Sosial">
                                Sosial
                            </option>

                            <option value="Ruang Terbuka">
                                Ruang Terbuka
                            </option>

                            <option value="Keagamaan">
                                Keagamaan
                            </option>

                            <option value="Infrastruktur">
                                Infrastruktur
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="sumberDana">
                            Sumber Dana
                        </label>

                        <select id="sumberDana" required>

                            <option value="">
                                Pilih sumber dana
                            </option>

                            <option value="APBD">
                                APBD
                            </option>

                            <option value="Dana Kelurahan">
                                Dana Kelurahan
                            </option>

                            <option value="Dana Desa">
                                Dana Desa
                            </option>

                            <option value="Swadaya Masyarakat">
                                Swadaya Masyarakat
                            </option>

                            <option value="Bantuan Pemerintah">
                                Bantuan Pemerintah
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

                        </select>

                    </div>


                    <div class="form-group full">

                        <label for="alamat">
                            Alamat
                        </label>

                        <textarea
                            id="alamat"
                            placeholder="Masukkan alamat lengkap fasilitas"
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

            <h3>Edit Data Fasilitas</h3>

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

                        <label for="editNama">
                            Nama
                        </label>

                        <input type="text"
                            id="editNama"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="editLokasi">
                            Lokasi
                        </label>

                        <input type="text"
                            id="editLokasi"
                            required>

                    </div>


                    <div class="form-group">

                        <label for="editJenis">
                            Jenis
                        </label>

                        <select id="editJenis" required>

                            <option value="">
                                Pilih jenis
                            </option>

                            <option value="Kesehatan">
                                Kesehatan
                            </option>

                            <option value="Pendidikan">
                                Pendidikan
                            </option>

                            <option value="Olahraga">
                                Olahraga
                            </option>

                            <option value="Sosial">
                                Sosial
                            </option>

                            <option value="Ruang Terbuka">
                                Ruang Terbuka
                            </option>

                            <option value="Keagamaan">
                                Keagamaan
                            </option>

                            <option value="Infrastruktur">
                                Infrastruktur
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="editSumberDana">
                            Sumber Dana
                        </label>

                        <select id="editSumberDana" required>

                            <option value="">
                                Pilih sumber dana
                            </option>

                            <option value="APBD">
                                APBD
                            </option>

                            <option value="Dana Kelurahan">
                                Dana Kelurahan
                            </option>

                            <option value="Dana Desa">
                                Dana Desa
                            </option>

                            <option value="Swadaya Masyarakat">
                                Swadaya Masyarakat
                            </option>

                            <option value="Bantuan Pemerintah">
                                Bantuan Pemerintah
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

                        </select>

                    </div>


                    <div class="form-group full">

                        <label for="editAlamat">
                            Alamat
                        </label>

                        <textarea
                            id="editAlamat"
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

            <h3>Detail Fasilitas Umum &amp; Sosial</h3>

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
                        Nama
                    </span>

                    <span class="detail-value"
                        id="viewNama">
                        -
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Lokasi
                    </span>

                    <span class="detail-value"
                        id="viewLokasi">
                        -
                    </span>

                </div>


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
                        Sumber Dana
                    </span>

                    <span class="detail-value"
                        id="viewSumberDana">
                        -
                    </span>

                </div>


                <div class="detail-item full">

                    <span class="detail-label">
                        Alamat
                    </span>

                    <span class="detail-value"
                        id="viewAlamat">
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

    const table = new DataTable('#fasilitasTable', {

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
                targets: 5
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

            nama:
                cells[0].innerText.trim(),

            lokasi:
                cells[1].innerText.trim(),

            jenis:
                cells[2].innerText.trim(),

            alamat:
                cells[3].innerText.trim(),

            sumberDana:
                cells[4].innerText.trim()

        };

    }


    /* =========================
       JENIS BADGE
    ========================= */

    function getJenisClass(jenis) {

        if (
            jenis === 'Kesehatan' ||
            jenis === 'Pendidikan' ||
            jenis === 'Sosial' ||
            jenis === 'Infrastruktur'
        ) {
            return 'badge-government';
        }

        if (
            jenis === 'Olahraga' ||
            jenis === 'Ruang Terbuka' ||
            jenis === 'Keagamaan'
        ) {
            return 'badge-community';
        }

        return 'badge-private';

    }


    /* =========================
       TABLE ACTION
    ========================= */

    document
        .querySelector('#fasilitasTable tbody')
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

                document.getElementById('viewNama')
                    .textContent = data.nama;

                document.getElementById('viewLokasi')
                    .textContent = data.lokasi;

                document.getElementById('viewJenis')
                    .textContent = data.jenis;

                document.getElementById('viewAlamat')
                    .textContent = data.alamat;

                document.getElementById('viewSumberDana')
                    .textContent = data.sumberDana;

                modalViewOverlay.classList.add('show');

            }


            /* =========================
               EDIT
            ========================= */

            if (action === 'edit') {

                document.getElementById('editNama')
                    .value = data.nama;

                document.getElementById('editLokasi')
                    .value = data.lokasi;

                document.getElementById('editJenis')
                    .value = data.jenis;

                document.getElementById('editAlamat')
                    .value = data.alamat;

                document.getElementById('editSumberDana')
                    .value = data.sumberDana;

                modalEditOverlay.classList.add('show');

            }


            /* =========================
               DELETE
            ========================= */

            if (action === 'delete') {

                const confirmDelete = confirm(
                    'Apakah Anda yakin ingin menghapus data ' +
                    data.nama +
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
                    'Data fasilitas berhasil dihapus.'
                );

            }

        });


    /* =========================
       ADD DATA
    ========================= */

    formData.addEventListener('submit', function (event) {

        event.preventDefault();


        const nama =
            document.getElementById('nama')
                .value.trim();

        const lokasi =
            document.getElementById('lokasi')
                .value.trim();

        const jenis =
            document.getElementById('jenis')
                .value;

        const alamat =
            document.getElementById('alamat')
                .value.trim();

        const sumberDana =
            document.getElementById('sumberDana')
                .value;


        if (
            !nama ||
            !lokasi ||
            !jenis ||
            !alamat ||
            !sumberDana
        ) {

            alert(
                'Mohon lengkapi seluruh data.'
            );

            return;

        }


        const jenisClass =
            getJenisClass(jenis);


        table.row.add([

            `<span class="facility-name">
                ${nama}
            </span>`,

            `<span class="location">
                ${lokasi}
            </span>`,

            `<span class="badge ${jenisClass}">
                ${jenis}
            </span>`,

            `<span class="address">
                ${alamat}
            </span>`,

            `<span class="fund-source">
                ${sumberDana}
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
            'Data fasilitas berhasil ditambahkan.'
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


        const nama =
            document.getElementById('editNama')
                .value.trim();

        const lokasi =
            document.getElementById('editLokasi')
                .value.trim();

        const jenis =
            document.getElementById('editJenis')
                .value;

        const alamat =
            document.getElementById('editAlamat')
                .value.trim();

        const sumberDana =
            document.getElementById('editSumberDana')
                .value;


        if (
            !nama ||
            !lokasi ||
            !jenis ||
            !alamat ||
            !sumberDana
        ) {

            alert(
                'Mohon lengkapi seluruh data.'
            );

            return;

        }


        const jenisClass =
            getJenisClass(jenis);


        const rowData = [

            `<span class="facility-name">
                ${nama}
            </span>`,

            `<span class="location">
                ${lokasi}
            </span>`,

            `<span class="badge ${jenisClass}">
                ${jenis}
            </span>`,

            `<span class="address">
                ${alamat}
            </span>`,

            `<span class="fund-source">
                ${sumberDana}
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
            'Data fasilitas berhasil diperbarui.'
        );

        selectedRow = null;

    });

});

</script>

@endpush
