@extends('Admin.Layout.master')

@section('title', 'Data Sekolah - Kelurahan XXXXX')
@section('page_title', 'Data Sekolah')
@section('page_subtitle', 'Kesejahteraan Sosial · Data Sekolah')


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

    #sekolahTable {

        width: 100% !important;

        border-collapse: collapse !important;

        margin-top: 15px !important;

    }


    #sekolahTable thead th {

        background: #f8faf9;

        color: #52616b;

        font-size: 11px;

        font-weight: 600;

        padding: 13px 12px;

        border-bottom: 1px solid #e7ebee;

        white-space: nowrap;

    }


    #sekolahTable tbody td {

        padding: 14px 12px;

        font-size: 12px;

        border-bottom: 1px solid #f0f2f3;

        color: #39474f;

        vertical-align: middle;

    }


    #sekolahTable tbody tr:hover {

        background: #fafcfb;

    }


    #sekolahTable tbody tr:last-child td {

        border-bottom: none;

    }


    /* =====================================================
       DATA STYLE
    ====================================================== */

    .school-name {

        font-weight: 600;

        color: #18364d;

    }


    .school-address {

        font-size: 11px;

        color: #65727a;

        line-height: 1.5;

    }


    .badge {

        display: inline-block;

        padding: 5px 9px;

        border-radius: 5px;

        font-size: 10px;

        font-weight: 600;

    }


    .badge-sd {

        background: #eaf5ef;

        color: #087443;

    }


    .badge-smp {

        background: #eef6fc;

        color: #2d6a9f;

    }


    .badge-sma {

        background: #fff7df;

        color: #987500;

    }


    .badge-tk {

        background: #f1f3f4;

        color: #58636a;

    }


    .badge-siswa {

        background: #f1f3f4;

        color: #58636a;

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
                Data Sekolah
            </h2>

            <p>
                Kelola data sekolah Kelurahan XXXXX.
            </p>

        </div>


        <a
            href="{{ url('/tambah-data-sekolah') }}"
            class="btn-add"
            id="btnTambah"
        >

            <span class="btn-add-icon">
                +
            </span>

            Tambah Data

        </a>

    </div>


    <!-- =================================================
         TABLE
    ================================================== -->

    <section class="table-panel">


        <div class="table-panel-header">

            <div>

                <h3>
                    Daftar Sekolah
                </h3>

                <p>
                    Data sekolah Kelurahan XXXXX
                </p>

            </div>


            <span
                class="total-data"
                id="totalData"
            >
                5 Sekolah
            </span>

        </div>


        <div class="table-wrapper">


            <table
                id="sekolahTable"
                class="display"
            >

                <thead>

                    <tr>

                        <th>
                            Nama Sekolah
                        </th>

                        <th>
                            Jenjang
                        </th>

                        <th>
                            Alamat
                        </th>

                        <th>
                            Jumlah Siswa
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <!-- DATA 1 -->

                    <tr>

                        <td>

                            <div class="school-name">
                                SDN XXXXX 01
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-sd">
                                SD
                            </span>

                        </td>

                        <td>

                            <div class="school-address">
                                Jl. Melati No. 1
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-siswa">
                                245
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


                    <!-- DATA 2 -->

                    <tr>

                        <td>

                            <div class="school-name">
                                SMPN XXXXX 02
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-smp">
                                SMP
                            </span>

                        </td>

                        <td>

                            <div class="school-address">
                                Jl. Mawar No. 2
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-siswa">
                                318
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


                    <!-- DATA 3 -->

                    <tr>

                        <td>

                            <div class="school-name">
                                SDN XXXXX 03
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-sd">
                                SD
                            </span>

                        </td>

                        <td>

                            <div class="school-address">
                                Jl. Kenanga No. 3
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-siswa">
                                198
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


                    <!-- DATA 4 -->

                    <tr>

                        <td>

                            <div class="school-name">
                                TK Melati
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-tk">
                                TK
                            </span>

                        </td>

                        <td>

                            <div class="school-address">
                                Jl. Anggrek No. 4
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-siswa">
                                86
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


                    <!-- DATA 5 -->

                    <tr>

                        <td>

                            <div class="school-name">
                                SMA XXXXX 01
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-sma">
                                SMA
                            </span>

                        </td>

                        <td>

                            <div class="school-address">
                                Jl. Flamboyan No. 5
                            </div>

                        </td>

                        <td>

                            <span class="badge badge-siswa">
                                412
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


    <!-- FOOTER -->

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
                Tambah Data Sekolah
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


            <form id="formSekolah">


                <div class="form-grid">


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="nama_sekolah"
                        >
                            Nama Sekolah
                        </label>

                        <select
                            class="form-control"
                            id="nama_sekolah"
                            required
                        >

                            <option value="">
                                Pilih nama sekolah
                            </option>

                            <option value="SDN XXXXX 01">
                                SDN XXXXX 01
                            </option>

                            <option value="SMPN XXXXX 02">
                                SMPN XXXXX 02
                            </option>

                            <option value="SDN XXXXX 03">
                                SDN XXXXX 03
                            </option>

                            <option value="TK Melati">
                                TK Melati
                            </option>

                            <option value="SMA XXXXX 01">
                                SMA XXXXX 01
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="jenjang"
                        >
                            Jenjang
                        </label>

                        <select
                            class="form-control"
                            id="jenjang"
                            required
                        >

                            <option value="">
                                Pilih jenjang
                            </option>

                            <option value="TK">
                                TK
                            </option>

                            <option value="SD">
                                SD
                            </option>

                            <option value="SMP">
                                SMP
                            </option>

                            <option value="SMA">
                                SMA
                            </option>

                            <option value="SMK">
                                SMK
                            </option>

                        </select>

                    </div>


                    <div class="form-group full">

                        <label
                            class="form-label"
                            for="alamat"
                        >
                            Alamat
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="alamat"
                            placeholder="Masukkan alamat sekolah"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="jumlah_siswa"
                        >
                            Jumlah Siswa
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="jumlah_siswa"
                            placeholder="Contoh: 245"
                            min="0"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="keterangan"
                        >
                            Keterangan
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="keterangan"
                            placeholder="Keterangan sekolah"
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
                Edit Data Sekolah
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
                            Nama Sekolah
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
                            for="editJenjang"
                        >
                            Jenjang
                        </label>

                        <select
                            class="form-control"
                            id="editJenjang"
                            required
                        >

                            <option value="TK">
                                TK
                            </option>

                            <option value="SD">
                                SD
                            </option>

                            <option value="SMP">
                                SMP
                            </option>

                            <option value="SMA">
                                SMA
                            </option>

                            <option value="SMK">
                                SMK
                            </option>

                        </select>

                    </div>


                    <div class="form-group full">

                        <label
                            class="form-label"
                            for="editAlamat"
                        >
                            Alamat
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editAlamat"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editSiswa"
                        >
                            Jumlah Siswa
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="editSiswa"
                            min="0"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            class="form-label"
                            for="editKeterangan"
                        >
                            Keterangan
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="editKeterangan"
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
                Detail Data Sekolah
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
                        Nama Sekolah
                    </span>

                    <span
                        class="detail-value"
                        id="viewNama"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jenjang
                    </span>

                    <span
                        class="detail-value"
                        id="viewJenjang"
                    >
                    </span>

                </div>


                <div class="detail-item full">

                    <span class="detail-label">
                        Alamat
                    </span>

                    <span
                        class="detail-value"
                        id="viewAlamat"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Jumlah Siswa
                    </span>

                    <span
                        class="detail-value"
                        id="viewSiswa"
                    >
                    </span>

                </div>


                <div class="detail-item">

                    <span class="detail-label">
                        Keterangan
                    </span>

                    <span
                        class="detail-value"
                        id="viewKeterangan"
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


        /* =====================================================
           DATATABLE
        ====================================================== */

        const table =
            new DataTable(
                '#sekolahTable',
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
                            targets: 4
                        }

                    ]

                }
            );


        /* =====================================================
           MODAL
        ====================================================== */

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


        const formSekolah =
            document.getElementById(
                'formSekolah'
            );


        const formEdit =
            document.getElementById(
                'formEdit'
            );


        let selectedRow = null;


        /* =====================================================
           TAMBAH DATA
        ====================================================== */

        document.getElementById(
            'btnTambah'
        ).addEventListener(
            'click',
            function (event) {

                /*
                 * Karena tombol sekarang berupa link,
                 * biarkan menuju halaman tambah data.
                 */

            }
        );


        function tutupTambah()
        {

            modalTambah.classList.remove(
                'active'
            );

            formSekolah.reset();

        }


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


        /* =====================================================
           VIEW DATA
        ====================================================== */

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
                    'viewJenjang'
                ).innerText =
                    cells[1].innerText.trim();


                document.getElementById(
                    'viewAlamat'
                ).innerText =
                    cells[2].innerText.trim();


                document.getElementById(
                    'viewSiswa'
                ).innerText =
                    cells[3].innerText.trim() +
                    ' Siswa';


                document.getElementById(
                    'viewKeterangan'
                ).innerText =
                    '-';


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


        /* =====================================================
           EDIT DATA
        ====================================================== */

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
                    'editJenjang'
                ).value =
                    cells[1].innerText.trim();


                document.getElementById(
                    'editAlamat'
                ).value =
                    cells[2].innerText.trim();


                document.getElementById(
                    'editSiswa'
                ).value =
                    cells[3].innerText.trim();


                document.getElementById(
                    'editKeterangan'
                ).value =
                    '';


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

            formEdit.reset();

            selectedRow = null;

        }


        document.getElementById(
            'btnEditSimpan'
        ).addEventListener(
            'click',
            function ()
            {

                if (!formEdit.checkValidity()) {

                    formEdit.reportValidity();

                    return;

                }


                if (!selectedRow) {

                    return;

                }


                selectedRow.cells[0].innerHTML =

                    '<div class="school-name">' +
                    document.getElementById(
                        'editNama'
                    ).value +
                    '</div>';


                const jenjang =
                    document.getElementById(
                        'editJenjang'
                    ).value;


                let badgeClass =
                    'badge-sd';


                if (jenjang === 'SMP') {

                    badgeClass =
                        'badge-smp';

                }
                else if (jenjang === 'SMA') {

                    badgeClass =
                        'badge-sma';

                }
                else if (jenjang === 'TK') {

                    badgeClass =
                        'badge-tk';

                }


                selectedRow.cells[1].innerHTML =

                    '<span class="badge ' +
                    badgeClass +
                    '">' +
                    jenjang +
                    '</span>';


                selectedRow.cells[2].innerHTML =

                    '<div class="school-address">' +
                    document.getElementById(
                        'editAlamat'
                    ).value +
                    '</div>';


                selectedRow.cells[3].innerHTML =

                    '<span class="badge badge-siswa">' +
                    document.getElementById(
                        'editSiswa'
                    ).value +
                    '</span>';


                alert(
                    'Data Sekolah berhasil diperbarui.'
                );


                tutupEdit();

            }
        );


        /* =====================================================
           HAPUS DATA
        ====================================================== */

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


        /* =====================================================
           MODAL OVERLAY
        ====================================================== */

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


        /* =====================================================
           UPDATE TOTAL
        ====================================================== */

        function updateTotal()
        {

            const info =
                table.page.info();


            document.getElementById(
                'totalData'
            ).textContent =

                info.recordsDisplay +
                ' Sekolah';

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
