@extends('Admin.Layout.master')

@section('title', 'Data Anak Putus Sekolah - Kelurahan XXXXX')
@section('page_title', 'Data Anak Putus Sekolah')
@section('page_subtitle', 'Kesejahteraan Sosial · Data Anak Putus Sekolah')


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

    #anakPutusSekolahTable {

        width: 100% !important;

        border-collapse: collapse !important;

        margin-top: 15px !important;

    }


    #anakPutusSekolahTable thead th {

        background: #f8faf9;

        color: #52616b;

        font-size: 11px;

        font-weight: 600;

        padding: 13px 12px;

        border-bottom: 1px solid #e7ebee;

        white-space: nowrap;

    }


    #anakPutusSekolahTable tbody td {

        padding: 14px 12px;

        font-size: 12px;

        border-bottom: 1px solid #f0f2f3;

        color: #39474f;

        vertical-align: middle;

    }


    #anakPutusSekolahTable tbody tr:hover {

        background: #fafcfb;

    }


    #anakPutusSekolahTable tbody tr:last-child td {

        border-bottom: none;

    }


    /* =====================================================
       DATA STYLE
    ====================================================== */

    .child-name {

        font-weight: 600;

        color: #18364d;

    }


    .nik {

        font-size: 11px;

        color: #65727a;

        letter-spacing: 0.2px;

    }


    .badge {

        display: inline-block;

        padding: 5px 9px;

        border-radius: 5px;

        font-size: 10px;

        font-weight: 600;

    }


    .badge-age {

        background: #f1f3f4;

        color: #58636a;

    }


    .badge-rw {

        background: #eef6fc;

        color: #2d6a9f;

    }


    /* =====================================================
       ACTION BUTTON
    ====================================================== */

    .action-buttons {

        display: flex;

        align-items: center;

        gap: 6px;

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
                Data Anak Putus Sekolah
            </h2>

            <p>
                Kelola data anak putus sekolah
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
                    Daftar Anak Putus Sekolah
                </h3>

                <p>
                    Data anak putus sekolah Kelurahan XXXXX
                </p>

            </div>


            <span
                class="total-data"
                id="totalData"
            >
                5 Anak
            </span>

        </div>


        <div class="table-wrapper">


            <table
                id="anakPutusSekolahTable"
                class="display"
            >

                <thead>

                    <tr>

                        <th>
                            Nama Anak
                        </th>

                        <th>
                            NIK
                        </th>

                        <th>
                            RW
                        </th>

                        <th>
                            Usia
                        </th>

                        <th>
                            Jenjang Terakhir
                        </th>

                        <th>
                            Alasan
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

                            <div class="child-name">
                                Andi Pratama
                            </div>

                        </td>

                        <td>

                            <span class="nik">
                                3204011205140001
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 04
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-age">
                                14
                            </span>

                        </td>

                        <td>
                            SD Kelas 6
                        </td>

                        <td>
                            Kondisi ekonomi keluarga
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

                            <div class="child-name">
                                Siti Nurhaliza
                            </div>

                        </td>

                        <td>

                            <span class="nik">
                                3204014508120002
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 07
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-age">
                                16
                            </span>

                        </td>

                        <td>
                            SMP Kelas 8
                        </td>

                        <td>
                            Membantu orang tua bekerja
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

                            <div class="child-name">
                                Rian Saputra
                            </div>

                        </td>

                        <td>

                            <span class="nik">
                                3204012309100003
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 02
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-age">
                                13
                            </span>

                        </td>

                        <td>
                            SD Kelas 5
                        </td>

                        <td>
                            Tidak melanjutkan sekolah
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

                            <div class="child-name">
                                Maya Lestari
                            </div>

                        </td>

                        <td>

                            <span class="nik">
                                3204016711070004
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 09
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-age">
                                17
                            </span>

                        </td>

                        <td>
                            SMP Kelas 9
                        </td>

                        <td>
                            Masalah keluarga
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

                            <div class="child-name">
                                Fajar Hidayat
                            </div>

                        </td>

                        <td>

                            <span class="nik">
                                3204013403160005
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-rw">
                                RW 01
                            </span>

                        </td>

                        <td>

                            <span class="badge badge-age">
                                15
                            </span>

                        </td>

                        <td>
                            SD Kelas 6
                        </td>

                        <td>
                            Kendala biaya pendidikan
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
                Tambah Data Anak Putus Sekolah
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
                            for="nama_anak"
                        >
                            Nama Anak
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nama_anak"
                            placeholder="Masukkan nama anak"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="nik"
                        >
                            NIK
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nik"
                            placeholder="Masukkan NIK"
                            maxlength="16"
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
                            placeholder="Contoh: RW 04"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="usia"
                        >
                            Usia (Tahun)
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="usia"
                            placeholder="Contoh: 14"
                            min="1"
                            max="30"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="jenjang"
                        >
                            Jenjang Terakhir
                        </label>

                        <select
                            class="form-control"
                            id="jenjang"
                            required
                        >

                            <option value="">
                                Pilih jenjang terakhir
                            </option>

                            <option value="SD Kelas 1">
                                SD Kelas 1
                            </option>

                            <option value="SD Kelas 2">
                                SD Kelas 2
                            </option>

                            <option value="SD Kelas 3">
                                SD Kelas 3
                            </option>

                            <option value="SD Kelas 4">
                                SD Kelas 4
                            </option>

                            <option value="SD Kelas 5">
                                SD Kelas 5
                            </option>

                            <option value="SD Kelas 6">
                                SD Kelas 6
                            </option>

                            <option value="SMP Kelas 7">
                                SMP Kelas 7
                            </option>

                            <option value="SMP Kelas 8">
                                SMP Kelas 8
                            </option>

                            <option value="SMP Kelas 9">
                                SMP Kelas 9
                            </option>

                            <option value="SMA Kelas 10">
                                SMA Kelas 10
                            </option>

                            <option value="SMA Kelas 11">
                                SMA Kelas 11
                            </option>

                            <option value="SMA Kelas 12">
                                SMA Kelas 12
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="alasan"
                        >
                            Alasan Putus Sekolah
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="alasan"
                            placeholder="Masukkan alasan"
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
                Edit Data Anak Putus Sekolah
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
                            Nama Anak
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
                            for="editNIK"
                        >
                            NIK
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editNIK"
                            maxlength="16"
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


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editUsia"
                        >
                            Usia (Tahun)
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="editUsia"
                            min="1"
                            max="30"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editJenjang"
                        >
                            Jenjang Terakhir
                        </label>

                        <select
                            class="form-control"
                            id="editJenjang"
                            required
                        >

                            <option value="SD Kelas 1">
                                SD Kelas 1
                            </option>

                            <option value="SD Kelas 2">
                                SD Kelas 2
                            </option>

                            <option value="SD Kelas 3">
                                SD Kelas 3
                            </option>

                            <option value="SD Kelas 4">
                                SD Kelas 4
                            </option>

                            <option value="SD Kelas 5">
                                SD Kelas 5
                            </option>

                            <option value="SD Kelas 6">
                                SD Kelas 6
                            </option>

                            <option value="SMP Kelas 7">
                                SMP Kelas 7
                            </option>

                            <option value="SMP Kelas 8">
                                SMP Kelas 8
                            </option>

                            <option value="SMP Kelas 9">
                                SMP Kelas 9
                            </option>

                            <option value="SMA Kelas 10">
                                SMA Kelas 10
                            </option>

                            <option value="SMA Kelas 11">
                                SMA Kelas 11
                            </option>

                            <option value="SMA Kelas 12">
                                SMA Kelas 12
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editAlasan"
                        >
                            Alasan Putus Sekolah
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editAlasan"
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
                Detail Anak Putus Sekolah
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
                        Nama Anak
                    </span>

                    <span
                        class="detail-value"
                        id="viewNama"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        NIK
                    </span>

                    <span
                        class="detail-value"
                        id="viewNIK"
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


                <div class="detail-item">

                    <span class="detail-label">
                        Usia
                    </span>

                    <span
                        class="detail-value"
                        id="viewUsia"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jenjang Terakhir
                    </span>

                    <span
                        class="detail-value"
                        id="viewJenjang"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Alasan
                    </span>

                    <span
                        class="detail-value"
                        id="viewAlasan"
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
                '#anakPutusSekolahTable',
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
                            targets: 6
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
                        'nama_anak'
                    ).value;


                alert(
                    'Data berhasil disimpan.\n\n' +
                    'Nama Anak: ' +
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
                    'editNIK'
                ).value =
                    cells[1].innerText.trim();


                document.getElementById(
                    'editRW'
                ).value =
                    cells[2].innerText.trim();


                document.getElementById(
                    'editUsia'
                ).value =
                    cells[3].innerText.trim();


                document.getElementById(
                    'editJenjang'
                ).value =
                    cells[4].innerText.trim();


                document.getElementById(
                    'editAlasan'
                ).value =
                    cells[5].innerText.trim();


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

                    '<div class="child-name">' +
                    document.getElementById(
                        'editNama'
                    ).value +
                    '</div>';


                selectedRow.cells[1].innerHTML =

                    '<span class="nik">' +
                    document.getElementById(
                        'editNIK'
                    ).value +
                    '</span>';


                selectedRow.cells[2].innerHTML =

                    '<span class="badge badge-rw">' +
                    document.getElementById(
                        'editRW'
                    ).value +
                    '</span>';


                selectedRow.cells[3].innerHTML =

                    '<span class="badge badge-age">' +
                    document.getElementById(
                        'editUsia'
                    ).value +
                    '</span>';


                selectedRow.cells[4].innerText =
                    document.getElementById(
                        'editJenjang'
                    ).value;


                selectedRow.cells[5].innerText =
                    document.getElementById(
                        'editAlasan'
                    ).value;


                alert(
                    'Data berhasil diperbarui.'
                );


                tutupEdit();

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
                    'viewNIK'
                ).innerText =
                    cells[1].innerText.trim();


                document.getElementById(
                    'viewRW'
                ).innerText =
                    cells[2].innerText.trim();


                document.getElementById(
                    'viewUsia'
                ).innerText =
                    cells[3].innerText.trim() +
                    ' Tahun';


                document.getElementById(
                    'viewJenjang'
                ).innerText =
                    cells[4].innerText.trim();


                document.getElementById(
                    'viewAlasan'
                ).innerText =
                    cells[5].innerText.trim();


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
                ' Anak';

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
