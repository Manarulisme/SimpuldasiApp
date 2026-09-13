<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Dashboard Pegawai - Kelurahan XXXXX
    </title>


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


        button {

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


        /* Scrollbar */

        .sidebar::-webkit-scrollbar {

            width: 5px;

        }

        .sidebar::-webkit-scrollbar-thumb {

            background: rgba(255,255,255,0.15);

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

            background: #d8a600;

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


        .menu-arrow {

            font-size: 11px;

            color: #7f98a9;

        }



        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            margin-left: 270px;

            width: calc(100% - 270px);

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

            background: var(--primary-light);

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

            border: 1px solid var(--border);

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

            background: #d8a600;

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

            background: var(--primary-light);

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
           WELCOME
        ===================================================== */

        .welcome {

            background:

                linear-gradient(
                    110deg,
                    #087443,
                    #0d8650
                );

            color: white;

            border-radius: 12px;

            padding: 30px;

            margin-bottom: 25px;

            position: relative;

            overflow: hidden;

        }


        .welcome::after {

            content: "";

            position: absolute;

            width: 260px;

            height: 260px;

            border: 50px solid
                rgba(255,255,255,0.05);

            border-radius: 50%;

            right: -80px;

            top: -100px;

        }


        .welcome-content {

            position: relative;

            z-index: 2;

            max-width: 700px;

        }


        .welcome small {

            font-size: 12px;

            opacity: 0.8;

        }


        .welcome h2 {

            font-family: Georgia, serif;

            font-size: 27px;

            margin: 8px 0 10px;

        }


        .welcome p {

            font-size: 13px;

            line-height: 1.7;

            opacity: 0.9;

        }



        /* =====================================================
           STATISTICS
        ===================================================== */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 18px;

            margin-bottom: 25px;

        }


        .stat-card {

            background: white;

            border:
                1px solid
                var(--border);

            border-radius: 10px;

            padding: 21px;

            display: flex;

            align-items: center;

            gap: 15px;

            transition: 0.2s;

        }


        .stat-card:hover {

            transform: translateY(-2px);

            box-shadow:
                0 8px 25px
                rgba(0,0,0,0.05);

        }


        .stat-icon {

            width: 49px;

            height: 49px;

            border-radius: 9px;

            background: var(--primary-light);

            color: var(--primary);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 21px;

            flex-shrink: 0;

        }


        .stat-info span {

            display: block;

            color: var(--muted);

            font-size: 11px;

            margin-bottom: 4px;

        }


        .stat-info strong {

            font-size: 25px;

            color: #18364d;

        }



        /* =====================================================
           CONTENT GRID
        ===================================================== */

        .dashboard-grid {

            display: grid;

            grid-template-columns:
                1.45fr 1fr;

            gap: 20px;

        }


        .panel {

            background: white;

            border:
                1px solid
                var(--border);

            border-radius: 10px;

            overflow: hidden;

        }


        .panel-header {

            padding: 20px 22px;

            border-bottom:
                1px solid
                var(--border);

            display: flex;

            align-items: center;

            justify-content: space-between;

        }


        .panel-header h3 {

            font-size: 16px;

            color: #18364d;

        }


        .panel-header a {

            font-size: 12px;

            color: var(--primary);

            font-weight: 600;

        }


        .panel-body {

            padding: 20px 22px;

        }



        /* =====================================================
           QUICK ACCESS
        ===================================================== */

        .quick-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 12px;

        }


        .quick-card {

            border:
                1px solid
                var(--border);

            border-radius: 8px;

            padding: 18px 12px;

            text-align: center;

            transition: 0.2s;

        }


        .quick-card:hover {

            border-color: var(--primary);

            background: var(--primary-light);

        }


        .quick-icon {

            width: 40px;

            height: 40px;

            border-radius: 8px;

            background: var(--primary-light);

            color: var(--primary);

            margin: 0 auto 10px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

        }


        .quick-card strong {

            display: block;

            font-size: 12px;

            line-height: 1.4;

        }



        /* =====================================================
           ACTIVITY
        ===================================================== */

        .activity {

            display: flex;

            gap: 12px;

            padding: 13px 0;

            border-bottom:
                1px solid
                var(--border);

        }


        .activity:last-child {

            border-bottom: none;

        }


        .activity-icon {

            width: 34px;

            height: 34px;

            border-radius: 50%;

            background: var(--primary-light);

            color: var(--primary);

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            font-size: 13px;

        }


        .activity-content {

            flex: 1;

        }


        .activity-content strong {

            display: block;

            font-size: 12px;

            margin-bottom: 3px;

        }


        .activity-content p {

            font-size: 11px;

            color: var(--muted);

        }


        .activity-time {

            font-size: 10px;

            color: #a0a8ad;

            white-space: nowrap;

        }



        /* =====================================================
           INFORMATION
        ===================================================== */

        .info-list {

            display: flex;

            flex-direction: column;

            gap: 13px;

        }


        .info-item {

            display: flex;

            align-items: flex-start;

            gap: 12px;

        }


        .info-number {

            width: 27px;

            height: 27px;

            border-radius: 50%;

            background: var(--primary-light);

            color: var(--primary);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 11px;

            font-weight: bold;

            flex-shrink: 0;

        }


        .info-item strong {

            display: block;

            font-size: 12px;

            margin-bottom: 3px;

        }


        .info-item p {

            color: var(--muted);

            font-size: 11px;

            line-height: 1.5;

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
           OVERLAY
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

            .stats-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }

            .dashboard-grid {

                grid-template-columns: 1fr;

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


            .welcome {

                padding: 24px;

            }


            .welcome h2 {

                font-size: 23px;

            }


            .stats-grid {

                grid-template-columns: 1fr 1fr;

                gap: 12px;

            }


            .stat-card {

                padding: 15px;

                gap: 10px;

            }


            .stat-icon {

                width: 40px;

                height: 40px;

                font-size: 17px;

            }


            .stat-info strong {

                font-size: 21px;

            }


            .quick-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }

        }



        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 480px) {

            .stats-grid {

                grid-template-columns: 1fr;

            }


            .quick-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }


            .topbar-left {

                gap: 9px;

            }


            .page-title {

                font-size: 18px;

            }


            .welcome p {

                font-size: 12px;

            }

        }

    </style>

</head>


<body>


<div class="dashboard">


    <!-- =====================================================
         SIDEBAR
    ===================================================== -->

    <aside class="sidebar" id="sidebar">


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
                class="menu-item active"
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


            <a href="#" class="menu-item">

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



            <!-- PENGATURAN -->

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


            <a href="index.html" class="menu-item">

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
                        Beranda
                    </h1>

                    <p class="page-subtitle">
                        Dashboard Sistem Informasi Kelurahan
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



            <!-- WELCOME -->

            <section class="welcome">

                <div class="welcome-content">

                    <small>
                        SISTEM INFORMASI KELURAHAN
                    </small>

                    <h2>
                        Selamat Datang, Administrator
                    </h2>

                    <p>
                        Kelola data dan informasi Kelurahan
                        XXXXX melalui dashboard ini. Pastikan
                        seluruh data pelayanan dan administrasi
                        selalu diperbarui secara berkala.
                    </p>

                </div>

            </section>



            <!-- =================================================
                 STATISTICS
            ================================================= -->

            <section class="stats-grid">


                <div class="stat-card">

                    <div class="stat-icon">
                        👥
                    </div>

                    <div class="stat-info">

                        <span>
                            Total Penduduk
                        </span>

                        <strong>
                            0
                        </strong>

                    </div>

                </div>



                <div class="stat-card">

                    <div class="stat-icon">
                        👤
                    </div>

                    <div class="stat-info">

                        <span>
                            Total Pegawai
                        </span>

                        <strong>
                            0
                        </strong>

                    </div>

                </div>



                <div class="stat-card">

                    <div class="stat-icon">
                        ▣
                    </div>

                    <div class="stat-info">

                        <span>
                            Data BMD
                        </span>

                        <strong>
                            0
                        </strong>

                    </div>

                </div>



                <div class="stat-card">

                    <div class="stat-icon">
                        ◫
                    </div>

                    <div class="stat-info">

                        <span>
                            Modul Aktif
                        </span>

                        <strong>
                            18
                        </strong>

                    </div>

                </div>


            </section>



            <!-- =================================================
                 DASHBOARD GRID
            ================================================= -->

            <section class="dashboard-grid">



                <!-- QUICK ACCESS -->

                <div class="panel">


                    <div class="panel-header">

                        <h3>
                            Akses Cepat
                        </h3>

                        <a href="#">
                            Lihat Semua
                        </a>

                    </div>


                    <div class="panel-body">


                        <div class="quick-grid">


                            <a
                                href="#"
                                class="quick-card"
                            >

                                <div class="quick-icon">
                                    👥
                                </div>

                                <strong>
                                    Data Penduduk
                                </strong>

                            </a>



                            <a
                                href="#"
                                class="quick-card"
                            >

                                <div class="quick-icon">
                                    🏪
                                </div>

                                <strong>
                                    Data UMKM
                                </strong>

                            </a>



                            <a
                                href="#"
                                class="quick-card"
                            >

                                <div class="quick-icon">
                                    🏫
                                </div>

                                <strong>
                                    Data Sekolah
                                </strong>

                            </a>



                            <a
                                href="#"
                                class="quick-card"
                            >

                                <div class="quick-icon">
                                    🏥
                                </div>

                                <strong>
                                    Posyandu
                                </strong>

                            </a>



                            <a
                                href="#"
                                class="quick-card"
                            >

                                <div class="quick-icon">
                                    📊
                                </div>

                                <strong>
                                    Laporan
                                </strong>

                            </a>



                            <a
                                href="#"
                                class="quick-card"
                            >

                                <div class="quick-icon">
                                    ⚙
                                </div>

                                <strong>
                                    Pengaturan
                                </strong>

                            </a>


                        </div>


                    </div>

                </div>



                <!-- AKTIVITAS -->

                <div class="panel">


                    <div class="panel-header">

                        <h3>
                            Aktivitas Terbaru
                        </h3>

                        <a href="#">
                            Semua
                        </a>

                    </div>


                    <div class="panel-body">


                        <div class="activity">


                            <div class="activity-icon">
                                ✓
                            </div>


                            <div class="activity-content">

                                <strong>
                                    Sistem berhasil diperbarui
                                </strong>

                                <p>
                                    Modul dashboard aktif
                                </p>

                            </div>


                            <span class="activity-time">
                                Baru saja
                            </span>


                        </div>



                        <div class="activity">


                            <div class="activity-icon">
                                👤
                            </div>


                            <div class="activity-content">

                                <strong>
                                    Data pegawai
                                </strong>

                                <p>
                                    Menunggu pembaruan data
                                </p>

                            </div>


                            <span class="activity-time">
                                Hari ini
                            </span>


                        </div>



                        <div class="activity">


                            <div class="activity-icon">
                                ▣
                            </div>


                            <div class="activity-content">

                                <strong>
                                    Data BMD
                                </strong>

                                <p>
                                    Belum ada data terbaru
                                </p>

                            </div>


                            <span class="activity-time">
                                Hari ini
                            </span>


                        </div>



                        <div class="activity">


                            <div class="activity-icon">
                                📊
                            </div>


                            <div class="activity-content">

                                <strong>
                                    Laporan bulanan
                                </strong>

                                <p>
                                    Periode laporan belum dibuat
                                </p>

                            </div>


                            <span class="activity-time">
                                —
                            </span>


                        </div>


                    </div>

                </div>



            </section>



            <!-- =================================================
                 INFORMATION
            ================================================= -->

            <section
                class="panel"
                style="margin-top:20px;"
            >


                <div class="panel-header">

                    <h3>
                        Informasi Sistem
                    </h3>

                </div>


                <div class="panel-body">


                    <div class="info-list">


                        <div class="info-item">

                            <div class="info-number">
                                1
                            </div>

                            <div>

                                <strong>
                                    Perbarui Data Secara Berkala
                                </strong>

                                <p>
                                    Pastikan setiap data pada
                                    masing-masing modul selalu
                                    diperbarui sesuai kondisi
                                    terbaru.
                                </p>

                            </div>

                        </div>



                        <div class="info-item">

                            <div class="info-number">
                                2
                            </div>

                            <div>

                                <strong>
                                    Periksa Kelengkapan Data
                                </strong>

                                <p>
                                    Periksa kembali data sebelum
                                    digunakan untuk kebutuhan
                                    laporan atau administrasi.
                                </p>

                            </div>

                        </div>



                        <div class="info-item">

                            <div class="info-number">
                                3
                            </div>

                            <div>

                                <strong>
                                    Keamanan Akun
                                </strong>

                                <p>
                                    Jangan membagikan username
                                    dan password kepada pihak lain.
                                </p>

                            </div>

                        </div>


                    </div>


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
     JAVASCRIPT
===================================================== -->

<script>


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



    /* =================================================
       ACTIVE MENU
    ================================================= */

    const menuItems =
        document.querySelectorAll(
            ".menu-item"
        );


    menuItems.forEach(
        function(item) {

            item.addEventListener(
                "click",
                function() {

                    menuItems.forEach(
                        function(menu) {

                            menu.classList.remove(
                                "active"
                            );

                        }
                    );


                    this.classList.add(
                        "active"
                    );

                }
            );

        }
    );


</script>


</body>

</html>
