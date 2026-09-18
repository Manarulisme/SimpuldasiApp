@extends('Admin.Layout.master')

@section('title', 'Data Buruan Sae - Kelurahan XXXXX')
@section('page_title', 'Data Buruan Sae')
@section('page_subtitle', 'Ketahanan Pangan · Data Buruan Sae')


@section('content')

<style>

    /* =====================================================
       PAGE HEADER
    ====================================================== */

    .content-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 22px;

    }


    .content-header h2 {

        font-family: Georgia, serif;

        font-size: 22px;

        color: #18364d;

        margin-bottom: 5px;

    }


    .content-header p {

        color: #7a858d;

        font-size: 12px;

        line-height: 1.6;

    }


    /* =====================================================
       BUTTON TAMBAH
    ====================================================== */

    .btn-add {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        background: #087443;

        color: white;

        border: none;

        border-radius: 7px;

        padding: 11px 16px;

        font-size: 12px;

        font-weight: 600;

        cursor: pointer;

        white-space: nowrap;

        transition: 0.2s;

    }


    .btn-add:hover {

        background: #065c35;

        color: white;

        transform: translateY(-1px);

    }


    .btn-add-icon {

        font-size: 17px;

        line-height: 1;

    }


    /* =====================================================
       TABLE PANEL
    ====================================================== */

    .table-panel {

        background: white;

        border: 1px solid #e7ebee;

        border-radius: 10px;

        overflow: hidden;

    }


    .table-panel-header {

        padding: 19px 22px;

        border-bottom: 1px solid #e7ebee;

        display: flex;

        align-items: center;

        justify-content: space-between;

    }


    .table-panel-header h3 {

        font-size: 15px;

        color: #18364d;

    }


    .table-panel-header p {

        font-size: 11px;

        color: #7a858d;

        margin-top: 4px;

    }


    .total-data {

        font-size: 11px;

        background: #eaf5ef;

        color: #087443;

        padding: 6px 10px;

        border-radius: 20px;

        font-weight: 600;

    }


    .table-wrapper {

        padding: 0 22px 20px;

        overflow-x: auto;

    }


    /* =====================================================
       DATATABLE
    ====================================================== */

    #buruanSaeTable {

        width: 100% !important;

        border-collapse: separate !important;

        border-spacing: 0;

        margin-top: 15px !important;

    }


    #buruanSaeTable thead th {

        background: #f8faf9;

        color: #52616b;

        font-size: 11px;

        font-weight: 600;

        padding: 13px 16px !important;

        border-bottom: 1px solid #e7ebee;

        white-space: nowrap;

    }


    #buruanSaeTable tbody td {

        padding: 14px 18px !important;

        font-size: 12px;

        border-bottom: 1px solid #f0f2f3;

        color: #39474f;

        vertical-align: middle;

    }


    #buruanSaeTable tbody tr:hover {

        background: #fafcfb;

    }


    #buruanSaeTable tbody tr:last-child td {

        border-bottom: none;

    }


    /* =====================================================
       DATA STYLE
    ====================================================== */

    .plant-name {

        font-weight: 600;

        color: #18364d;

        white-space: nowrap;

    }


    .location {

        min-width: 220px;

        max-width: 280px;

        line-height: 1.5;

        color: #52616b;

    }


    .badge {

        display: inline-block;

        padding: 5px 9px;

        border-radius: 5px;

        font-size: 10px;

        font-weight: 600;

    }


    .badge-rw {

        background: #eef6fc;

        color: #2d6a9f;

        white-space: nowrap;

    }


    .badge-plant {

        background: #eaf5ef;

        color: #087443;

        white-space: nowrap;

    }


    .area {

        font-weight: 600;

        color: #18364d;

        white-space: nowrap;

    }


    /* =====================================================
       ACTION BUTTON
    ====================================================== */

    .action-buttons {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }


    .action-btn {

        width: 31px;

        height: 31px;

        border-radius: 6px;

        border: 1px solid #e7ebee;

        background: white;

        cursor: pointer;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 13px;

        transition: 0.2s;

    }


    .action-view {

        color: #2d6a9f;

    }


    .action-view:hover {

        background: #eef6fc;

        border-color: #c2dced;

    }


    .action-edit {

        color: #087443;

    }


    .action-edit:hover {

        background: #eaf5ef;

        border-color: #b9ddca;

    }


    .action-delete {

        color: #c0392b;

    }


    .action-delete:hover {

        background: #fdf0ef;

        border-color: #edc5c1;

    }


    /* =====================================================
       DATATABLE CONTROLS
    ====================================================== */

    .dt-container {

        font-size: 11px;

    }


    .dt-layout-row {

        margin-top: 14px !important;

    }


    .dt-length select,
    .dt-search input {

        border: 1px solid #e7ebee !important;

        border-radius: 6px !important;

        font-size: 11px !important;

        padding: 7px 9px !important;

        outline: none !important;

    }


    .dt-search input:focus {

        border-color: #087443 !important;

        box-shadow:
            0 0 0 2px
            rgba(8,116,67,0.08);

    }


    .dt-info {

        color: #7a858d !important;

        font-size: 11px !important;

    }


    .dt-paging button {

        border-radius: 5px !important;

        font-size: 11px !important;

        min-width: 30px;

    }


    .dt-paging button.current {

        background: #087443 !important;

        color: white !important;

        border-color: #087443 !important;

    }


    /* =====================================================
       MODAL
    ====================================================== */

    .modal-overlay {

        position: fixed;

        inset: 0;

        background: rgba(16,47,71,0.48);

        display: none;

        align-items: center;

        justify-content: center;

        padding: 20px;

        z-index: 500;

    }


    .modal-overlay.active {

        display: flex;

    }


    .modal {

        width: 100%;

        max-width: 680px;

        background: white;

        border-radius: 10px;

        box-shadow:
            0 20px 60px
            rgba(0,0,0,0.18);

        overflow: hidden;

        animation: modalShow 0.2s ease;

    }


    @keyframes modalShow {

        from {

            opacity: 0;

            transform: translateY(10px);

        }

        to {

            opacity: 1;

            transform: translateY(0);

        }

    }


    .modal-header {

        padding: 19px 22px;

        border-bottom: 1px solid #e7ebee;

        display: flex;

        align-items: center;

        justify-content: space-between;

    }


    .modal-header h3 {

        font-family: Georgia, serif;

        font-size: 18px;

        color: #18364d;

    }


    .modal-close {

        width: 32px;

        height: 32px;

        border: none;

        background: #f4f6f7;

        color: #69767d;

        border-radius: 6px;

        cursor: pointer;

        font-size: 18px;

    }


    .modal-close:hover {

        background: #e9edef;

    }


    .modal-body {

        padding: 22px;

    }


    .form-grid {

        display: grid;

        grid-template-columns: repeat(2, 1fr);

        gap: 17px;

    }


    .form-group {

        display: flex;

        flex-direction: column;

        gap: 7px;

    }


    .form-group.full {

        grid-column: 1 / -1;

    }


    .form-label {

        font-size: 11px;

        font-weight: 600;

        color: #52616b;

    }


    .form-control {

        width: 100%;

        border: 1px solid #e7ebee;

        border-radius: 6px;

        padding: 10px 11px;

        font-size: 12px;

        color: #263238;

        outline: none;

        background: white;

        transition: 0.2s;

    }


    .form-control:focus {

        border-color: #087443;

        box-shadow:
            0 0 0 2px
            rgba(8,116,67,0.08);

    }


    textarea.form-control {

        min-height: 85px;

        resize: vertical;

    }


    .modal-footer {

        padding: 16px 22px;

        border-top: 1px solid #e7ebee;

        display: flex;

        justify-content: flex-end;

        gap: 8px;

    }


    .btn-cancel {

        border: 1px solid #e7ebee;

        background: white;

        color: #65727a;

        padding: 10px 15px;

        border-radius: 6px;

        font-size: 12px;

        cursor: pointer;

    }


    .btn-save {

        border: none;

        background: #087443;

        color: white;

        padding: 10px 16px;

        border-radius: 6px;

        font-size: 12px;

        font-weight: 600;

        cursor: pointer;

    }


    .btn-save:hover {

        background: #065c35;

    }


    /* =====================================================
       VIEW MODAL
    ====================================================== */

    .detail-grid {

        display: grid;

        grid-template-columns: repeat(2, 1fr);

        gap: 16px;

    }


    .detail-item {

        border: 1px solid #e7ebee;

        border-radius: 7px;

        padding: 12px;

        background: #fafcfb;

    }


    .detail-item.full {

        grid-column: 1 / -1;

    }


    .detail-label {

        display: block;

        font-size: 10px;

        color: #7a858d;

        margin-bottom: 5px;

    }


    .detail-value {

        font-size: 12px;

        font-weight: 600;

        color: #18364d;

    }


    /* =====================================================
       FOOTER
    ====================================================== */

    .dashboard-footer {

        margin-top: 25px;

        text-align: center;

        color: #9aa3a9;

        font-size: 11px;

        padding: 10px;

    }


    /* =====================================================
       RESPONSIVE
    ====================================================== */

    @media (max-width: 768px) {

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

            gap: 10px;

        }


        .table-wrapper {

            padding-left: 15px;

            padding-right: 15px;

        }


        .form-grid,
        .detail-grid {

            grid-template-columns: 1fr;

        }


        .form-group.full,
        .detail-item.full {

            grid-column: auto;

        }

    }


    @media (max-width: 480px) {

        .content-header h2 {

            font-size: 19px;

        }


        .table-panel-header {

            flex-direction: column;

        }


        .total-data {

            align-self: flex-start;

        }


        .modal-body {

            padding: 18px;

        }

    }

</style>


<!-- =====================================================
     CONTENT
====================================================== -->

<div class="content">


    <!-- =================================================
         PAGE HEADER
    ================================================== -->

    <div class="content-header">

        <div>

            <h2>
                Data Buruan Sae
            </h2>

            <p>
                Kelola data Buruan Sae
                Kelurahan XXXXX.
            </p>

        </div>


        <button
            type="button"
            class="btn-add"
            id="btnTambah"
        >

            <span class="btn-add-icon">
                +
            </span>

            Tambah Data

        </button>

    </div>


    <!-- =================================================
         TABLE
    ================================================== -->

    <section class="table-panel">


        <div class="table-panel-header">

            <div>

                <h3>
                    Daftar Buruan Sae
                </h3>

                <p>
                    Data Buruan Sae Kelurahan XXXXX
                </p>

            </div>


            <span
                class="total-data"
                id="totalData"
            >
                5 Data
            </span>

        </div>


        <div class="table-wrapper">


            <table
                id="buruanSaeTable"
                class="display"
            >

                <thead>

                    <tr>

                        <th>
                            Nama
                        </th>

                        <th>
                            Lokasi
                        </th>

                        <th>
                            RW
                        </th>

                        <th>
                            Jenis Tanaman
                        </th>

                        <th>
                            Luas Area
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <!-- =================================================
                         DATA 1
                    ================================================== -->

                    <tr>

                        <td>

                            <div class="plant-name">
                                Kelompok Tani Mekar Jaya
                            </div>

                        </td>

                        <td>

                            <div class="location">
                                Kp. Sukamaju RT 02
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 01
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-plant">
                                Sayuran
                            </span>

                        </td>

                        <td>

                            <span class="area">
                                500 m²
                            </span>

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


                    <!-- =================================================
                         DATA 2
                    ================================================== -->

                    <tr>

                        <td>

                            <div class="plant-name">
                                Kelompok Wanita Tani Sejahtera
                            </div>

                        </td>

                        <td>

                            <div class="location">
                                Kp. Mekarsari RT 04
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 02
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-plant">
                                Cabai & Tomat
                            </span>

                        </td>

                        <td>

                            <span class="area">
                                350 m²
                            </span>

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


                    <!-- =================================================
                         DATA 3
                    ================================================== -->

                    <tr>

                        <td>

                            <div class="plant-name">
                                Kelompok Tani Harapan
                            </div>

                        </td>

                        <td>

                            <div class="location">
                                Jl. Melati RT 01
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 03
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-plant">
                                Kangkung
                            </span>

                        </td>

                        <td>

                            <span class="area">
                                250 m²
                            </span>

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


                    <!-- =================================================
                         DATA 4
                    ================================================== -->

                    <tr>

                        <td>

                            <div class="plant-name">
                                Kelompok Tani Cipta Mandiri
                            </div>

                        </td>

                        <td>

                            <div class="location">
                                Kp. Cibogo RT 03
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 04
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-plant">
                                Sawi & Pakcoy
                            </span>

                        </td>

                        <td>

                            <span class="area">
                                420 m²
                            </span>

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


                    <!-- =================================================
                         DATA 5
                    ================================================== -->

                    <tr>

                        <td>

                            <div class="plant-name">
                                Kelompok Tani Sukajaya
                            </div>

                        </td>

                        <td>

                            <div class="location">
                                Kp. Sukajaya RT 05
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 05
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-plant">
                                Terong & Kacang
                            </span>

                        </td>

                        <td>

                            <span class="area">
                                300 m²
                            </span>

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


    <!-- =================================================
         FOOTER
    ================================================== -->

    <div class="dashboard-footer">

        © {{ date('Y') }} Kelurahan XXXXX ·
        Sistem Informasi Kelurahan

    </div>


</div>



<!-- =====================================================
     MODAL TAMBAH DATA
====================================================== -->

<div
    class="modal-overlay"
    id="modalOverlay"
>

    <div class="modal">


        <div class="modal-header">

            <h3>
                Tambah Data Buruan Sae
            </h3>

            <button
                type="button"
                class="modal-close"
                id="modalClose"
            >
                ×
            </button>

        </div>


        <div class="modal-body">


            <form id="formData">


                <div class="form-grid">


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="nama"
                        >
                            Nama
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nama"
                            placeholder="Masukkan nama kelompok/pengelola"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="rw"
                        >
                            RW
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="rw"
                            placeholder="Contoh: RW 01"
                            required
                        >

                    </div>


                    <div class="form-group full">

                        <label
                            class="form-label"
                            for="lokasi"
                        >
                            Lokasi
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="lokasi"
                            placeholder="Masukkan lokasi Buruan Sae"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="jenis_tanaman"
                        >
                            Jenis Tanaman
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="jenis_tanaman"
                            placeholder="Contoh: Sayuran"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="luas_area"
                        >
                            Luas Area
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="luas_area"
                            placeholder="Contoh: 500 m²"
                            required
                        >

                    </div>


                </div>


            </form>


        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn-cancel"
                id="btnBatal"
            >
                Batal
            </button>

            <button
                type="button"
                class="btn-save"
                id="btnSimpan"
            >
                Simpan Data
            </button>

        </div>


    </div>

</div>



<!-- =====================================================
     MODAL EDIT DATA
====================================================== -->

<div
    class="modal-overlay"
    id="modalEditOverlay"
>

    <div class="modal">


        <div class="modal-header">

            <h3>
                Edit Data Buruan Sae
            </h3>

            <button
                type="button"
                class="modal-close"
                id="modalEditClose"
            >
                ×
            </button>

        </div>


        <div class="modal-body">


            <form id="formEdit">


                <div class="form-grid">


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editNama"
                        >
                            Nama
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editNama"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editRW"
                        >
                            RW
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editRW"
                            required
                        >

                    </div>


                    <div class="form-group full">

                        <label
                            class="form-label"
                            for="editLokasi"
                        >
                            Lokasi
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editLokasi"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editJenisTanaman"
                        >
                            Jenis Tanaman
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editJenisTanaman"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editLuasArea"
                        >
                            Luas Area
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editLuasArea"
                            required
                        >

                    </div>


                </div>


            </form>


        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn-cancel"
                id="btnEditBatal"
            >
                Batal
            </button>

            <button
                type="button"
                class="btn-save"
                id="btnEditSimpan"
            >
                Perbarui Data
            </button>

        </div>


    </div>

</div>



<!-- =====================================================
     MODAL VIEW DATA
====================================================== -->

<div
    class="modal-overlay"
    id="modalViewOverlay"
>

    <div class="modal">


        <div class="modal-header">

            <h3>
                Detail Buruan Sae
            </h3>

            <button
                type="button"
                class="modal-close"
                id="modalViewClose"
            >
                ×
            </button>

        </div>


        <div class="modal-body">


            <div class="detail-grid">


                <div class="detail-item">

                    <span class="detail-label">
                        Nama
                    </span>

                    <span
                        class="detail-value"
                        id="viewNama"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        RW
                    </span>

                    <span
                        class="detail-value"
                        id="viewRW"
                    >
                    </span>

                </div>


                <div class="detail-item full">

                    <span class="detail-label">
                        Lokasi
                    </span>

                    <span
                        class="detail-value"
                        id="viewLokasi"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jenis Tanaman
                    </span>

                    <span
                        class="detail-value"
                        id="viewJenisTanaman"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Luas Area
                    </span>

                    <span
                        class="detail-value"
                        id="viewLuasArea"
                    >
                    </span>

                </div>


            </div>


        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn-cancel"
                id="btnViewTutup"
            >
                Tutup
            </button>

        </div>


    </div>

</div>



@endsection



@push('scripts')

<script
    src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js">
</script>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =================================================
           DATATABLE
        ================================================= */

        const table =
            new DataTable(
                '#buruanSaeTable',
                {

                    pageLength: 10,

                    lengthMenu: [
                        [5, 10, 25, 50],
                        [5, 10, 25, 50]
                    ],

                    language: {

                        search:
                            'Cari:',

                        lengthMenu:
                            'Tampilkan _MENU_ data',

                        info:
                            'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',

                        infoEmpty:
                            'Tidak ada data',

                        zeroRecords:
                            'Data tidak ditemukan',

                        emptyTable:
                            'Belum ada data',

                        paginate: {

                            first:
                                'Awal',

                            last:
                                'Akhir',

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
                            targets: 5
                        }

                    ]

                }
            );


        /* =================================================
           ELEMENT MODAL
        ================================================= */

        const modalTambah =
            document.getElementById(
                'modalOverlay'
            );


        const modalEdit =
            document.getElementById(
                'modalEditOverlay'
            );


        const modalView =
            document.getElementById(
                'modalViewOverlay'
            );


        let selectedRow = null;


        /* =================================================
           TAMBAH DATA
        ================================================= */

        document.getElementById(
            'btnTambah'
        ).addEventListener(
            'click',
            function () {

                modalTambah.classList.add(
                    'active'
                );

            }
        );


        document.getElementById(
            'modalClose'
        ).addEventListener(
            'click',
            tutupTambah
        );


        document.getElementById(
            'btnBatal'
        ).addEventListener(
            'click',
            tutupTambah
        );


        function tutupTambah()
        {

            modalTambah.classList.remove(
                'active'
            );

            document.getElementById(
                'formData'
            ).reset();

        }


        /* =================================================
           SIMPAN DATA DUMMY
        ================================================= */

        document.getElementById(
            'btnSimpan'
        ).addEventListener(
            'click',
            function () {


                const form =
                    document.getElementById(
                        'formData'
                    );


                if (!form.checkValidity()) {

                    form.reportValidity();

                    return;

                }


                const nama =
                    document.getElementById(
                        'nama'
                    ).value;


                alert(
                    'Data berhasil disimpan.\n\n' +
                    'Nama: ' +
                    nama
                );


                tutupTambah();

            }
        );


        /* =================================================
           EDIT DATA
        ================================================= */

        window.editData =
            function (button)
            {

                selectedRow =
                    button.closest('tr');


                const cells =
                    selectedRow.cells;


                document.getElementById(
                    'editNama'
                ).value =
                    cells[0].innerText.trim();


                document.getElementById(
                    'editLokasi'
                ).value =
                    cells[1].innerText.trim();


                document.getElementById(
                    'editRW'
                ).value =
                    cells[2].innerText.trim();


                document.getElementById(
                    'editJenisTanaman'
                ).value =
                    cells[3].innerText.trim();


                document.getElementById(
                    'editLuasArea'
                ).value =
                    cells[4].innerText.trim();


                modalEdit.classList.add(
                    'active'
                );

            };


        document.getElementById(
            'modalEditClose'
        ).addEventListener(
            'click',
            tutupEdit
        );


        document.getElementById(
            'btnEditBatal'
        ).addEventListener(
            'click',
            tutupEdit
        );


        function tutupEdit()
        {

            modalEdit.classList.remove(
                'active'
            );

            document.getElementById(
                'formEdit'
            ).reset();

            selectedRow = null;

        }


        document.getElementById(
            'btnEditSimpan'
        ).addEventListener(
            'click',
            function ()
            {

                const form =
                    document.getElementById(
                        'formEdit'
                    );


                if (!form.checkValidity()) {

                    form.reportValidity();

                    return;

                }


                if (!selectedRow) {

                    return;

                }


                selectedRow.cells[0].innerHTML =

                    '<div class="plant-name">' +
                    document.getElementById(
                        'editNama'
                    ).value +
                    '</div>';


                selectedRow.cells[1].innerHTML =

                    '<div class="location">' +
                    document.getElementById(
                        'editLokasi'
                    ).value +
                    '</div>';


                selectedRow.cells[2].innerHTML =

                    '<span class="badge badge-rw">' +
                    document.getElementById(
                        'editRW'
                    ).value +
                    '</span>';


                selectedRow.cells[3].innerHTML =

                    '<span class="badge badge-plant">' +
                    document.getElementById(
                        'editJenisTanaman'
                    ).value +
                    '</span>';


                selectedRow.cells[4].innerHTML =

                    '<span class="area">' +
                    document.getElementById(
                        'editLuasArea'
                    ).value +
                    '</span>';


                alert(
                    'Data berhasil diperbarui.'
                );


                tutupEdit();

                table.draw(false);

            }
        );


        /* =================================================
           VIEW DATA
        ================================================= */

        window.viewData =
            function (button)
            {

                const row =
                    button.closest('tr');


                const cells =
                    row.cells;


                document.getElementById(
                    'viewNama'
                ).innerText =
                    cells[0].innerText.trim();


                document.getElementById(
                    'viewLokasi'
                ).innerText =
                    cells[1].innerText.trim();


                document.getElementById(
                    'viewRW'
                ).innerText =
                    cells[2].innerText.trim();


                document.getElementById(
                    'viewJenisTanaman'
                ).innerText =
                    cells[3].innerText.trim();


                document.getElementById(
                    'viewLuasArea'
                ).innerText =
                    cells[4].innerText.trim();


                modalView.classList.add(
                    'active'
                );

            };


        document.getElementById(
            'modalViewClose'
        ).addEventListener(
            'click',
            tutupView
        );


        document.getElementById(
            'btnViewTutup'
        ).addEventListener(
            'click',
            tutupView
        );


        function tutupView()
        {

            modalView.classList.remove(
                'active'
            );

        }


        /* =================================================
           HAPUS DATA
        ================================================= */

        window.hapusData =
            function (button)
            {

                const row =
                    button.closest('tr');


                const nama =
                    row.cells[0]
                    .innerText
                    .trim();


                const konfirmasi =
                    confirm(

                        'Apakah Anda yakin ingin menghapus data:\n\n' +
                        nama +
                        '?'

                    );


                if (konfirmasi) {

                    table
                        .row(row)
                        .remove()
                        .draw();

                }

            };


        /* =================================================
           CLOSE MODAL CLICK OUTSIDE
        ================================================= */

        modalTambah.addEventListener(
            'click',
            function (event) {

                if (
                    event.target ===
                    modalTambah
                ) {

                    tutupTambah();

                }

            }
        );


        modalEdit.addEventListener(
            'click',
            function (event) {

                if (
                    event.target ===
                    modalEdit
                ) {

                    tutupEdit();

                }

            }
        );


        modalView.addEventListener(
            'click',
            function (event) {

                if (
                    event.target ===
                    modalView
                ) {

                    tutupView();

                }

            }
        );


        /* =================================================
           UPDATE TOTAL
        ================================================= */

        function updateTotal()
        {

            const info =
                table.page.info();


            document.getElementById(
                'totalData'
            ).textContent =

                info.recordsDisplay +
                ' Data';

        }


        table.on(
            'draw',
            updateTotal
        );


        updateTotal();


    }

);

</script>

@endpush
