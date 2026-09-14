```html
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Data Sekolah - Kelurahan XXXXX
    </title>


    <!-- =====================================================
         DATATABLES CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css"
    >


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        :root {

            --primary: #087443;
            --primary-dark: #065c35;
            --primary-light: #eaf5ef;

            --sidebar: #102f47;
            --sidebar-hover: #173c58;

            --text: #263238;
            --muted: #7a858d;

            --border: #e7ebee;

            --background: #f5f7f8;

            --white: #ffffff;

            --danger: #c0392b;

            --gold: #d8a600;

        }


        body {

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: var(--background);

            color: var(--text);

            min-height: 100vh;

        }


        a {

            text-decoration: none;

            color: inherit;

        }


        button,
        input,
        select {

            font-family: inherit;

        }



        /* =====================================================
           LAYOUT
        ===================================================== */

        .dashboard {

            display: flex;

            min-height: 100vh;

        }



        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            width: 270px;

            background: var(--sidebar);

            color: white;

            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            z-index: 100;

            overflow-y: auto;

            transition: 0.3s;

        }


        .sidebar::-webkit-scrollbar {

            width: 5px;

        }


        .sidebar::-webkit-scrollbar-thumb {

            background:
                rgba(255,255,255,0.15);

            border-radius: 10px;

        }



        /* =====================================================
           SIDEBAR BRAND
        ===================================================== */

        .sidebar-brand {

            height: 82px;

            padding: 0 22px;

            display: flex;

            align-items: center;

            gap: 12px;

            border-bottom:
                1px solid
                rgba(255,255,255,0.08);

        }


        .brand-logo {

            width: 43px;

            height: 43px;

            border-radius: 50%;

            background: white;

            color: var(--primary);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 9px;

            font-weight: bold;

            flex-shrink: 0;

        }


        .brand-name strong {

            display: block;

            font-family: Georgia, serif;

            font-size: 16px;

        }


        .brand-name span {

            display: block;

            font-size: 10px;

            margin-top: 3px;

            color: #9eb1c0;

            letter-spacing: 0.4px;

        }



        /* =====================================================
           SIDEBAR MENU
        ===================================================== */

        .sidebar-menu {

            padding: 18px 12px 30px;

        }


        .menu-title {

            font-size: 10px;

            color: #7590a3;

            letter-spacing: 0.7px;

            text-transform: uppercase;

            padding: 16px 12px 8px;

        }


        .menu-item {

            display: flex;

            align-items: center;

            gap: 12px;

            min-height: 42px;

            padding: 10px 12px;

            border-radius: 7px;

            color: #dce6ed;

            font-size: 13px;

            margin-bottom: 2px;

            transition: 0.2s;

        }


        .menu-item:hover {

            background: var(--sidebar-hover);

            color: white;

        }


        .menu-item.active {

            background: #1d405c;

            color: white;

            font-weight: 600;

            position: relative;

        }


        .menu-item.active::before {

            content: "";

            position: absolute;

            left: -12px;

            top: 0;

            bottom: 0;

            width: 3px;

            background: var(--gold);

            border-radius:
                0 3px 3px 0;

        }


        .menu-icon {

            width: 19px;

            height: 19px;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            font-size: 15px;

        }


        .menu-text {

            flex: 1;

        }



        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            margin-left: 270px;

            width:
                calc(100% - 270px);

            min-height: 100vh;

        }



        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            height: 82px;

            background: white;

            border-bottom:
                1px solid
                var(--border);

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 30px;

            position: sticky;

            top: 0;

            z-index: 50;

        }


        .topbar-left {

            display: flex;

            align-items: center;

            gap: 15px;

        }


        .mobile-menu {

            display: none;

            border: none;

            background:
                var(--primary-light);

            color: var(--primary);

            width: 40px;

            height: 40px;

            border-radius: 7px;

            cursor: pointer;

            font-size: 20px;

        }


        .page-title {

            font-family: Georgia, serif;

            font-size: 25px;

            color: #18364d;

        }


        .page-subtitle {

            color: var(--muted);

            font-size: 12px;

            margin-top: 3px;

        }



        /* =====================================================
           USER AREA
        ===================================================== */

        .user-area {

            display: flex;

            align-items: center;

            gap: 14px;

        }


        .notification {

            width: 38px;

            height: 38px;

            border:
                1px solid
                var(--border);

            border-radius: 7px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 16px;

            position: relative;

            cursor: pointer;

            background: white;

        }


        .notification-dot {

            width: 7px;

            height: 7px;

            background: var(--gold);

            border-radius: 50%;

            position: absolute;

            top: 7px;

            right: 7px;

        }


        .user-profile {

            display: flex;

            align-items: center;

            gap: 10px;

            padding-left: 14px;

            border-left:
                1px solid
                var(--border);

        }


        .user-avatar {

            width: 39px;

            height: 39px;

            border-radius: 50%;

            background:
                var(--primary-light);

            color: var(--primary);

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: bold;

            font-size: 13px;

        }


        .user-info strong {

            display: block;

            font-size: 13px;

        }


        .user-info span {

            display: block;

            font-size: 11px;

            color: var(--muted);

            margin-top: 2px;

        }



        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            padding: 30px;

        }



        /* =====================================================
           PAGE HEADER
        ===================================================== */

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

            color: var(--muted);

            font-size: 12px;

            line-height: 1.6;

        }


        /* =====================================================
           BUTTON TAMBAH
        ===================================================== */

        .btn-add {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            background: var(--primary);

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

            background: var(--primary-dark);

            transform:
                translateY(-1px);

        }


        .btn-add-icon {

            font-size: 17px;

            line-height: 1;

        }



        /* =====================================================
           TABLE PANEL
        ===================================================== */

        .table-panel {

            background: white;

            border:
                1px solid
                var(--border);

            border-radius: 10px;

            overflow: hidden;

        }


        .table-panel-header {

            padding: 19px 22px;

            border-bottom:
                1px solid
                var(--border);

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

            color: var(--muted);

            margin-top: 4px;

        }


        .total-data {

            font-size: 11px;

            color: var(--muted);

            background: var(--primary-light);

            color: var(--primary);

            padding: 6px 10px;

            border-radius: 20px;

            font-weight: 600;

        }


        .table-wrapper {

            padding: 0 22px 20px;

            overflow-x: auto;

        }



        /* =====================================================
           DATATABLE STYLE
        ===================================================== */

        #dukTable {

            width: 100% !important;

            border-collapse:
                collapse !important;

            margin-top: 15px !important;

        }


        #dukTable thead th {

            background: #f8faf9;

            color: #52616b;

            font-size: 11px;

            font-weight: 600;

            padding: 13px 12px;

            border-bottom:
                1px solid
                var(--border);

            white-space: nowrap;

        }


        #dukTable tbody td {

            padding: 14px 12px;

            font-size: 12px;

            border-bottom:
                1px solid
                #f0f2f3;

            color: #39474f;

            vertical-align: middle;

        }


        #dukTable tbody tr:hover {

            background: #fafcfb;

        }


        #dukTable tbody tr:last-child td {

            border-bottom: none;

        }



        /* =====================================================
           BADGE
        ===================================================== */

        .badge {

            display: inline-block;

            padding: 5px 9px;

            border-radius: 5px;

            font-size: 10px;

            font-weight: 600;

        }


        .badge-asn {

            background:
                var(--primary-light);

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

            font-weight: 600;

            color: #18364d;

        }


        .employee-id {

            font-size: 10px;

            color: #8a969d;

            margin-top: 3px;

        }



        /* =====================================================
           ACTION BUTTON
        ===================================================== */

        .action-buttons {

            display: flex;

            align-items: center;

            gap: 6px;

        }


        .action-btn {

            width: 31px;

            height: 31px;

            border-radius: 6px;

            border:
                1px solid
                var(--border);

            background: white;

            cursor: pointer;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 13px;

            transition: 0.2s;

        }


        .action-edit {

            color: var(--primary);

        }


        .action-view {

            color: #2d6a9f;

        }


        .action-view:hover {

            background: #eef6fc;

            border-color: #c2dced;

        }


        .action-edit:hover {

            background:
                var(--primary-light);

            border-color:
                #b9ddca;

        }


        .action-delete {

            color: var(--danger);

        }


        .action-delete:hover {

            background: #fdf0ef;

            border-color: #edc5c1;

        }



        /* =====================================================
           DATATABLE CONTROLS
        ===================================================== */

        .dt-container {

            font-size: 11px;

        }


        .dt-layout-row {

            margin-top: 14px !important;

        }


        .dt-length select,
        .dt-search input {

            border:
                1px solid
                var(--border) !important;

            border-radius: 6px !important;

            font-size: 11px !important;

            padding: 7px 9px !important;

            outline: none !important;

        }


        .dt-search input:focus {

            border-color:
                var(--primary) !important;

            box-shadow:
                0 0 0 2px
                rgba(8,116,67,0.08);

        }


        .dt-info {

            color: var(--muted) !important;

            font-size: 11px !important;

        }


        .dt-paging button {

            border-radius: 5px !important;

            font-size: 11px !important;

            min-width: 30px;

        }


        .dt-paging button.current {

            background:
                var(--primary) !important;

            color: white !important;

            border-color:
                var(--primary) !important;

        }



        /* =====================================================
           MODAL
        ===================================================== */

        .modal-overlay {

            position: fixed;

            inset: 0;

            background:
                rgba(16,47,71,0.48);

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

            animation:
                modalShow 0.2s ease;

        }


        @keyframes modalShow {

            from {

                opacity: 0;

                transform:
                    translateY(10px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        .modal-header {

            padding: 19px 22px;

            border-bottom:
                1px solid
                var(--border);

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

            grid-template-columns:
                repeat(2, 1fr);

            gap: 17px;

        }


        .form-group {

            display: flex;

            flex-direction: column;

            gap: 7px;

        }


        .form-group.full {

            grid-column:
                1 / -1;

        }


        .form-label {

            font-size: 11px;

            font-weight: 600;

            color: #52616b;

        }


        .form-control {

            width: 100%;

            border:
                1px solid
                var(--border);

            border-radius: 6px;

            padding: 10px 11px;

            font-size: 12px;

            color: var(--text);

            outline: none;

            background: white;

            transition: 0.2s;

        }


        .form-control:focus {

            border-color:
                var(--primary);

            box-shadow:
                0 0 0 2px
                rgba(8,116,67,0.08);

        }


        .modal-footer {

            padding: 16px 22px;

            border-top:
                1px solid
                var(--border);

            display: flex;

            justify-content: flex-end;

            gap: 8px;

        }


        .btn-cancel {

            border:
                1px solid
                var(--border);

            background: white;

            color: #65727a;

            padding: 10px 15px;

            border-radius: 6px;

            font-size: 12px;

            cursor: pointer;

        }


        .btn-save {

            border: none;

            background: var(--primary);

            color: white;

            padding: 10px 16px;

            border-radius: 6px;

            font-size: 12px;

            font-weight: 600;

            cursor: pointer;

        }


        .btn-save:hover {

            background:
                var(--primary-dark);

        }



        /* =====================================================
           FOOTER
        ===================================================== */

        .dashboard-footer {

            margin-top: 25px;

            text-align: center;

            color: #9aa3a9;

            font-size: 11px;

            padding: 10px;

        }



        /* =====================================================
           OVERLAY MOBILE
        ===================================================== */

        .sidebar-overlay {

            display: none;

        }



        /* =====================================================
           RESPONSIVE TABLET
        ===================================================== */

        @media (max-width: 1100px) {

            .sidebar {

                width: 240px;

            }


            .main {

                margin-left: 240px;

                width:
                    calc(100% - 240px);

            }

        }



        /* =====================================================
           RESPONSIVE MOBILE
        ===================================================== */

        @media (max-width: 768px) {

            .sidebar {

                transform:
                    translateX(-100%);

                width: 270px;

            }


            .sidebar.open {

                transform:
                    translateX(0);

            }


            .main {

                margin-left: 0;

                width: 100%;

            }


            .mobile-menu {

                display: flex;

                align-items: center;

                justify-content: center;

            }


            .sidebar-overlay {

                position: fixed;

                inset: 0;

                background:
                    rgba(0,0,0,0.35);

                z-index: 90;

            }


            .sidebar-overlay.active {

                display: block;

            }


            .topbar {

                height: 70px;

                padding: 0 18px;

            }


            .page-title {

                font-size: 20px;

            }


            .page-subtitle {

                display: none;

            }


            .user-info {

                display: none;

            }


            .user-profile {

                padding-left: 8px;

                border-left: none;

            }


            .notification {

                display: none;

            }


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

                gap: 10px;

            }


            .table-wrapper {

                padding-left: 15px;

                padding-right: 15px;

            }


            .form-grid {

                grid-template-columns: 1fr;

            }


            .form-group.full {

                grid-column: auto;

            }

        }



        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 480px) {

            .page-title {

                font-size: 18px;

            }


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

</head>


<body>


<div class="dashboard">


    <!-- =====================================================
         SIDEBAR
    ===================================================== -->

    <aside
        class="sidebar"
        id="sidebar"
    >


        <!-- BRAND -->

        <div class="sidebar-brand">

            <div class="brand-logo">
                LOGO
            </div>

            <div class="brand-name">

                <strong>
                    Kelurahan XXXXX
                </strong>

                <span>
                    SISTEM INFORMASI KELURAHAN
                </span>

            </div>

        </div>



        <!-- MENU -->

        <nav class="sidebar-menu">


            <!-- BERANDA -->

            <a
                href="dashboard.html"
                class="menu-item"
            >

                <span class="menu-icon">
                    ⌂
                </span>

                <span class="menu-text">
                    Beranda
                </span>

            </a>



            <!-- KESEKRETARIATAN -->

            <div class="menu-title">
                Kesekretariatan
            </div>


            <!-- ACTIVE -->

            <a
                href="duk.html"
                class="menu-item active"
            >

                <span class="menu-icon">
                    👤
                </span>

                <span class="menu-text">
                    Data Umum Kepegawaian
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ▣
                </span>

                <span class="menu-text">
                    Data BMD
                </span>

            </a>



            <!-- KESEJAHTERAAN SOSIAL -->

            <div class="menu-title">
                Kesejahteraan Sosial
            </div>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ♡
                </span>

                <span class="menu-text">
                    Posyandu & Posbindu
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ♧
                </span>

                <span class="menu-text">
                    Data Stunting
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ♢
                </span>

                <span class="menu-text">
                    KPM / Bantuan Sosial
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ◉
                </span>

                <span class="menu-text">
                    Anak Putus Sekolah
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ▤
                </span>

                <span class="menu-text">
                    Data Sekolah
                </span>

            </a>



            <!-- EKONOMI & PEMBANGUNAN -->

            <div class="menu-title">
                Ekonomi & Pembangunan
            </div>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ♙
                </span>

                <span class="menu-text">
                    Data UMKM
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ◈
                </span>

                <span class="menu-text">
                    Data Rutillahu
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    🌱
                </span>

                <span class="menu-text">
                    Data Buruan Sae
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ♣
                </span>

                <span class="menu-text">
                    Data Pohon
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ▦
                </span>

                <span class="menu-text">
                    Fasilitas Umum & Sosial
                </span>

            </a>



            <!-- PEMERINTAHAN -->

            <div class="menu-title">
                Pemerintahan
            </div>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ◫
                </span>

                <span class="menu-text">
                    Laporan Kependudukan
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ⚑
                </span>

                <span class="menu-text">
                    Linmas & Siskamling
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ▥
                </span>

                <span class="menu-text">
                    Data RT/RW & Periode
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ◉
                </span>

                <span class="menu-text">
                    Data PKL
                </span>

            </a>



            <!-- SISTEM -->

            <div class="menu-title">
                Sistem
            </div>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ⚙
                </span>

                <span class="menu-text">
                    Pengaturan
                </span>

            </a>


            <a
                href="index.html"
                class="menu-item"
            >

                <span class="menu-icon">
                    ↪
                </span>

                <span class="menu-text">
                    Keluar
                </span>

            </a>


        </nav>

    </aside>



    <!-- OVERLAY MOBILE -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>



    <!-- =====================================================
         MAIN
    ===================================================== -->

    <main class="main">


        <!-- =================================================
             TOPBAR
        ================================================= -->

        <header class="topbar">


            <div class="topbar-left">


                <button
                    class="mobile-menu"
                    id="mobileMenu"
                >
                    ☰
                </button>


                <div>

                    <h1 class="page-title">
                        Data Sekolah
                    </h1>

                    <p class="page-subtitle">
                        Kesejahteraan Sosial · Data Sekolah
                    </p>

                </div>


            </div>



            <div class="user-area">


                <div class="notification">

                    🔔

                    <span
                        class="notification-dot"
                    ></span>

                </div>


                <div class="user-profile">

                    <div class="user-avatar">
                        AD
                    </div>

                    <div class="user-info">

                        <strong>
                            Administrator
                        </strong>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>


            </div>

        </header>



        <!-- =================================================
             CONTENT
        ================================================= -->

        <div class="content">


            <!-- PAGE HEADER -->

            <div class="content-header">


                <div>

                    <h2>
                        Data Sekolah
                    </h2>

                    <p>
                        Kelola data sekolah Kelurahan XXXXX
                        Kelurahan XXXXX.
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
            ================================================= -->

            <section class="table-panel">


                <div class="table-panel-header">

                    <div>

                        <h3>
                            Daftar Sekolah
                        </h3>

                        <p>
                            Data Sekolah Kelurahan XXXXX
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
                        id="dukTable"
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

                                    <span
                                        class="badge badge-asn"
                                    >
                                        SDN XXXXX 01
                                    </span>

                                </td>

                                <td>
                                    SD
                                </td>

                                <td>

                                    <div
                                        class="employee-name"
                                    >
                                        Jl. Melati No. 1
                                    </div>

                                </td>

                                <td>

                                    <span
                                        class="badge badge-gol"
                                    >
                                        245
                                    </span>

                                </td>

                                <td>

                                    <div
                                        class="action-buttons"
                                    >

                                        <button
                                            class="action-btn action-view"
                                            onclick="viewData(this)"
                                            title="Lihat Data"
                                        >
                                            ◉
                                        </button>

                                        <button
                                            class="action-btn action-edit"
                                            onclick="editData(this)"
                                            title="Ubah Data"
                                        >
                                            ✎
                                        </button>

                                        <button
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

                                    <span
                                        class="badge badge-asn"
                                    >
                                        SMPN XXXXX 02
                                    </span>

                                </td>

                                <td>
                                    SMP
                                </td>

                                <td>

                                    <div
                                        class="employee-name"
                                    >
                                        Jl. Mawar No. 2
                                    </div>

                                </td>

                                <td>

                                    <span
                                        class="badge badge-gol"
                                    >
                                        318
                                    </span>

                                </td>

                                <td>

                                    <div
                                        class="action-buttons"
                                    >

                                        <button
                                            class="action-btn action-view"
                                            onclick="viewData(this)"
                                            title="Lihat Data"
                                        >
                                            ◉
                                        </button>

                                        <button
                                            class="action-btn action-edit"
                                            onclick="editData(this)"
                                            title="Ubah Data"
                                        >
                                            ✎
                                        </button>

                                        <button
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

                                    <span
                                        class="badge badge-asn"
                                    >
                                        SDN XXXXX 03
                                    </span>

                                </td>

                                <td>
                                    SD
                                </td>

                                <td>

                                    <div
                                        class="employee-name"
                                    >
                                        Jl. Kenanga No. 3
                                    </div>

                                </td>

                                <td>

                                    <span
                                        class="badge badge-gol"
                                    >
                                        198
                                    </span>

                                </td>

                                <td>

                                    <div
                                        class="action-buttons"
                                    >

                                        <button
                                            class="action-btn action-view"
                                            onclick="viewData(this)"
                                            title="Lihat Data"
                                        >
                                            ◉
                                        </button>

                                        <button
                                            class="action-btn action-edit"
                                            onclick="editData(this)"
                                            title="Ubah Data"
                                        >
                                            ✎
                                        </button>

                                        <button
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

                                    <span
                                        class="badge badge-asn"
                                    >
                                        TK Melati
                                    </span>

                                </td>

                                <td>
                                    TK
                                </td>

                                <td>

                                    <div
                                        class="employee-name"
                                    >
                                        Jl. Anggrek No. 4
                                    </div>

                                </td>

                                <td>

                                    <span
                                        class="badge badge-gol"
                                    >
                                        86
                                    </span>

                                </td>

                                <td>

                                    <div
                                        class="action-buttons"
                                    >

                                        <button
                                            class="action-btn action-view"
                                            onclick="viewData(this)"
                                            title="Lihat Data"
                                        >
                                            ◉
                                        </button>

                                        <button
                                            class="action-btn action-edit"
                                            onclick="editData(this)"
                                            title="Ubah Data"
                                        >
                                            ✎
                                        </button>

                                        <button
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

                                    <span
                                        class="badge badge-pppk"
                                    >
                                        SMA XXXXX 01
                                    </span>

                                </td>

                                <td>
                                    SMA
                                </td>

                                <td>

                                    <div
                                        class="employee-name"
                                    >
                                        Jl. Flamboyan No. 5
                                    </div>

                                </td>

                                <td>

                                    <span
                                        class="badge badge-gol"
                                    >
                                        412
                                    </span>

                                </td>

                                <td>

                                    <div
                                        class="action-buttons"
                                    >

                                        <button
                                            class="action-btn action-view"
                                            onclick="viewData(this)"
                                            title="Lihat Data"
                                        >
                                            ◉
                                        </button>

                                        <button
                                            class="action-btn action-edit"
                                            onclick="editData(this)"
                                            title="Ubah Data"
                                        >
                                            ✎
                                        </button>

                                        <button
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

                © 2026 Kelurahan XXXXX ·
                Sistem Informasi Kelurahan

            </div>


        </div>


    </main>


</div>



<!-- =====================================================
     MODAL TAMBAH DATA
===================================================== -->

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
                class="modal-close"
                id="modalClose"
            >
                ×
            </button>

        </div>



        <div class="modal-body">


            <form
                id="formDUK"
            >


                <div class="form-grid">


                    <!-- JENIS -->

                    <div class="form-group">

                        <label class="form-label">
                            Nama Sekolah
                        </label>

                        <select
                            class="form-control"
                            id="nama_sekolah"
                            required
                        >

                            <option value="">
                                Pilih Jenis
                            </option>

                            <option value="SDN XXXXX 01">
                                SDN XXXXX 01
                            </option>

                            <option value="SMPN XXXXX 02">
                                SMPN XXXXX 02
                            </option>

                            <option value="SMA XXXXX 01">
                                SMA XXXXX 01
                            </option>

                        </select>

                    </div>



                    <!-- NIP -->

                    <div class="form-group">

                        <label class="form-label">
                            Jenjang
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="jenjang"
                            placeholder="Contoh: SD"
                            required
                        >

                    </div>



                    <!-- NAMA -->

                    <div class="form-group">

                        <label class="form-label">
                            Alamat
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="alamat"
                            placeholder="Alamat sekolah"
                            required
                        >

                    </div>



                    <!-- GOLONGAN -->

                    <div class="form-group">

                        <label class="form-label">
                            Jumlah Siswa
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="jumlah_siswa"
                            placeholder="Contoh: 245"
                            required
                        >

                    </div>



                    <!-- PANGKAT -->

                    <div class="form-group">

                        <label class="form-label">
                            Keterangan
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="keterangan"
                            placeholder="Keterangan sekolah"
                            required
                        >

                    </div>





                </div>


            </form>


        </div>



        <div class="modal-footer">

            <button
                class="btn-cancel"
                id="btnBatal"
            >
                Batal
            </button>

            <button
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
===================================================== -->

<div class="modal-overlay" id="modalEditOverlay">
    <div class="modal">
        <div class="modal-header">
            <h3>Edit Data Sekolah</h3>
            <button type="button" class="modal-close" id="modalEditClose" aria-label="Tutup form edit">×</button>
        </div>

        <div class="modal-body">
            <form id="formEditDUK">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="editNama">Nama Sekolah</label>
                        <input type="text" class="form-control" id="editNama" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="editJenjang">Jenjang</label>
                        <input type="text" class="form-control" id="editJenjang" required>
                    </div>

                    <div class="form-group full">
                        <label class="form-label" for="editAlamat">Alamat</label>
                        <input type="text" class="form-control" id="editAlamat" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="editSiswa">Jumlah Siswa</label>
                        <input type="number" class="form-control" id="editSiswa" required>
                    </div>

                    <div class="form-group">
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-cancel" id="btnEditBatal">Batal</button>
            <button type="button" class="btn-save" id="btnEditSimpan">Perbarui Data</button>
        </div>
    </div>
</div>


<!-- =====================================================
     JAVASCRIPT DATATABLES
===================================================== -->

<script
    src="https://code.jquery.com/jquery-3.7.1.min.js">
</script>


<script
    src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js">
</script>



<script>


    /* =====================================================
       MOBILE SIDEBAR
    ===================================================== */

    const mobileMenu =
        document.getElementById("mobileMenu");


    const sidebar =
        document.getElementById("sidebar");


    const overlay =
        document.getElementById("sidebarOverlay");


    mobileMenu.addEventListener(
        "click",
        function () {

            sidebar.classList.toggle("open");

            overlay.classList.toggle("active");

        }
    );


    overlay.addEventListener(
        "click",
        function () {

            sidebar.classList.remove("open");

            overlay.classList.remove("active");

        }
    );



    /* =====================================================
       DATATABLE
    ===================================================== */

    const table =
        new DataTable(
            "#dukTable",
            {

                pageLength: 10,

                lengthMenu: [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],

                language: {

                    search:
                        "Cari:",

                    lengthMenu:
                        "Tampilkan _MENU_ data",

                    info:
                        "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

                    infoEmpty:
                        "Tidak ada data",

                    zeroRecords:
                        "Data tidak ditemukan",

                    emptyTable:
                        "Belum ada data",

                    paginate: {

                        first:
                            "Awal",

                        last:
                            "Akhir",

                        next:
                            "›",

                        previous:
                            "‹"

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



    /* =====================================================
       MODAL
    ===================================================== */

    const btnTambah =
        document.getElementById("btnTambah");


    const modalOverlay =
        document.getElementById("modalOverlay");


    const modalClose =
        document.getElementById("modalClose");


    const btnBatal =
        document.getElementById("btnBatal");


    const btnSimpan =
        document.getElementById("btnSimpan");


    const formDUK =
        document.getElementById("formDUK");


    const modalEditOverlay =
        document.getElementById("modalEditOverlay");


    const modalEditClose =
        document.getElementById("modalEditClose");


    const btnEditBatal =
        document.getElementById("btnEditBatal");


    const btnEditSimpan =
        document.getElementById("btnEditSimpan");


    const formEditDUK =
        document.getElementById("formEditDUK");


    let selectedEditRow = null;



    function bukaModal() {

        modalOverlay.classList.add("active");

    }


    function tutupModal() {

        modalOverlay.classList.remove("active");

        formDUK.reset();

    }


    function tutupModalEdit() {

        modalEditOverlay.classList.remove("active");

        formEditDUK.reset();

    }


    modalClose.addEventListener(
        "click",
        tutupModal
    );


    btnBatal.addEventListener(
        "click",
        tutupModal
    );


    modalOverlay.addEventListener(
        "click",
        function(event) {

            if (
                event.target ===
                modalOverlay
            ) {

                tutupModal();

            }

        }
    );


    modalEditClose.addEventListener(
        "click",
        tutupModalEdit
    );


    btnEditBatal.addEventListener(
        "click",
        tutupModalEdit
    );


    modalEditOverlay.addEventListener(
        "click",
        function(event) {

            if (event.target === modalEditOverlay) {

                tutupModalEdit();

            }

        }
    );



    /* =====================================================
       SIMPAN DATA DUMMY
    ===================================================== */

    btnSimpan.addEventListener(
        "click",
        function() {


            if (
                !formDUK.checkValidity()
            ) {

                formDUK.reportValidity();

                return;

            }


            alert(
                "Data berhasil disimpan.\n\n" +
                "Pada tahap Laravel, data ini akan " +
                "disimpan ke database."
            );


            tutupModal();


        }
    );



    /* =====================================================
       VIEW DATA
    ===================================================== */

    function viewData(button) {

        const cells = button.closest("tr").cells;

        alert(
            "Detail Data Sekolah\n\n" +
            "Nama Sekolah: " + cells[0].innerText.trim() + "\n" +
            "Jenjang: " + cells[1].innerText.trim() + "\n" +
            "Alamat: " + cells[2].innerText.trim() + "\n" +
            "Jumlah Siswa: " + cells[3].innerText.trim()
        );

    }


    /* =====================================================
       EDIT DATA
    ===================================================== */

    function editData(button) {

        selectedEditRow = button.closest("tr");

        const cells = selectedEditRow.cells;

        document.getElementById("editNama").value = cells[0].innerText.trim();
        document.getElementById("editJenjang").value = cells[1].innerText.trim();
        document.getElementById("editAlamat").value = cells[2].innerText.trim();
        document.getElementById("editSiswa").value = cells[3].innerText.trim();

        modalEditOverlay.classList.add("active");

    }


    btnEditSimpan.addEventListener(
        "click",
        function() {

            if (!formEditDUK.checkValidity()) {

                formEditDUK.reportValidity();

                return;

            }

            alert(
                "Data Sekolah berhasil diperbarui.\n\n" +
                "Nama Sekolah: " + document.getElementById("editNama").value
            );

            const cells = selectedEditRow.cells;

            cells[0].innerText = document.getElementById("editNama").value;
            cells[1].innerText = document.getElementById("editJenjang").value;
            cells[2].innerText = document.getElementById("editAlamat").value;
            cells[3].innerText = document.getElementById("editSiswa").value;

            tutupModalEdit();

        }
    );



    /* =====================================================
       HAPUS DATA
    ===================================================== */

    function hapusData(button) {

        const row = button.closest("tr");
        const nama = row.cells[0].innerText.trim();


        const konfirmasi =
            confirm(
                "Apakah Anda yakin ingin menghapus data:\n\n" +
                nama +
                "?"
            );


        if (konfirmasi) {

            row.remove();

        }

    }



    /* =====================================================
       UPDATE TOTAL DATA
    ===================================================== */

    table.on(
        "draw",
        function() {

            const info =
                table.page.info();

            document.getElementById(
                "totalData"
            ).textContent =
                info.recordsDisplay +
                " Sekolah";

        }
    );


</script>


</body>

</html>
```
