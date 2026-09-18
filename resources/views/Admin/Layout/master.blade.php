```blade
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Sistem Informasi Kelurahan')
    </title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('Assets/Image/logo_simpuldasi.png') }}"
    >

    <style>

        :root {
            --primary: #087443;
            --primary-light: #eaf5ef;
            --sidebar: #102f47;
            --sidebar-hover: #173c58;
            --text: #263238;
            --muted: #7a858d;
            --border: #e7ebee;
            --background: #f5f7f8;
        }


        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--background);
            color: var(--text);
            min-height: 100vh;
        }


        a {
            color: inherit;
            text-decoration: none;
        }


        button {
            font: inherit;
        }


        /* =========================================
           DASHBOARD
        ========================================= */

        .dashboard {
            display: flex;
            min-height: 100vh;
        }


        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {
            width: 270px;
            background: var(--sidebar);
            color: white;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 100;
            overflow-y: auto;
            transition: 0.3s;
        }


        /* BRAND */

        .sidebar-brand {
            height: 82px;
            padding: 0 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
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


        .brand-name strong,
        .brand-name span {
            display: block;
        }


        .brand-name strong {
            font-family: Georgia, serif;
            font-size: 16px;
            line-height: 1.2;
        }


        .brand-name span {
            color: #9eb1c0;
            font-size: 10px;
            letter-spacing: 0.4px;
            margin-top: 4px;
            line-height: 1.3;
        }


        /* SIDEBAR MENU */

        .sidebar-menu {
            padding: 14px 12px 28px;
        }


        /*
         * Judul kategori.
         * Jarak atas lebih besar agar setiap kelompok
         * terlihat terpisah tetapi tidak terlalu renggang.
         */
        .menu-title {
            color: #7590a3;
            font-size: 10px;
            letter-spacing: 0.7px;
            text-transform: uppercase;

            padding: 18px 12px 7px;

            line-height: 1.2;
        }


        /*
         * Menu dibuat compact.
         */
        .menu-item {
            display: flex;
            align-items: center;

            gap: 12px;

            min-height: 40px;

            padding: 9px 12px;

            border-radius: 7px;

            color: #dce6ed;

            font-size: 13px;

            margin-bottom: 1px;

            line-height: 1.3;

            transition:
                background 0.2s ease,
                color 0.2s ease;
        }


        .menu-item:hover,
        .menu-item.active {
            background: #1d405c;
            color: white;
        }


        .menu-item.active {
            font-weight: 600;
        }


        .menu-icon {
            width: 19px;
            min-width: 19px;

            text-align: center;

            flex-shrink: 0;

            font-size: 15px;

            line-height: 1;
        }


        /* =========================================
           MAIN
        ========================================= */

        .main {
            margin-left: 270px;
            width: calc(100% - 270px);
            min-height: 100vh;
        }


        /* =========================================
           TOPBAR
        ========================================= */

        .topbar {
            height: 82px;

            background: white;

            border-bottom: 1px solid var(--border);

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 30px;

            position: sticky;
            top: 0;

            z-index: 50;
        }


        .topbar-left,
        .user-area,
        .user-profile {
            display: flex;
            align-items: center;
        }


        .topbar-left {
            gap: 15px;
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


        .user-area {
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
        }


        .user-profile {
            gap: 10px;

            padding-left: 14px;

            border-left: 1px solid var(--border);
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


        .user-info strong,
        .user-info span {
            display: block;
        }


        .user-info strong {
            font-size: 13px;
        }


        .user-info span {
            color: var(--muted);
            font-size: 11px;
            margin-top: 2px;
        }


        /* =========================================
           MOBILE MENU
        ========================================= */

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


        /* =========================================
           CONTENT
        ========================================= */

        .content {
            padding: 30px;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .dashboard-footer {
            margin-top: 25px;

            text-align: center;

            color: #9aa3a9;

            font-size: 11px;

            padding: 10px;
        }


        /* =========================================
           SIDEBAR SCROLLBAR
        ========================================= */

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }


        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }


        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.14);
            border-radius: 10px;
        }


        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.22);
        }


        /* =========================================
           MOBILE
        ========================================= */

        @media (max-width: 768px) {

            .sidebar {
                transform: translateX(-100%);
            }


            .sidebar.open {
                transform: translateX(0);
            }


            .main {
                margin-left: 0;
                width: 100%;
            }


            .mobile-menu {
                display: block;
            }


            .topbar {
                height: 70px;
                padding: 0 18px;
            }


            .page-subtitle,
            .user-info,
            .notification {
                display: none;
            }


            .user-profile {
                padding-left: 0;
                border-left: 0;
            }


            .content {
                padding: 18px;
            }


            .sidebar-brand {
                padding: 0 20px;
            }


            .sidebar-menu {
                padding: 12px 10px 24px;
            }


            .menu-title {
                padding-top: 17px;
            }

        }

    </style>


    @stack('styles')

</head>


<body>


    <div class="dashboard">


        {{-- SIDEBAR --}}
        @include('Admin.Layout.Part.sidebar')


        {{-- SIDEBAR OVERLAY --}}
        <div
            class="sidebar-overlay"
            id="sidebarOverlay"
        ></div>


        <main class="main">


            {{-- HEADER --}}
            @include('Admin.Layout.Part.header')


            {{-- CONTENT --}}
            <div class="content">

                @yield('content')

            </div>


            {{-- FOOTER --}}
            @include('Admin.Layout.Part.footer')


        </main>

    </div>


    <script>

        const mobileMenu =
            document.getElementById('mobileMenu');

        const sidebar =
            document.getElementById('sidebar');

        const sidebarOverlay =
            document.getElementById('sidebarOverlay');


        mobileMenu?.addEventListener('click', () => {

            sidebar.classList.toggle('open');

            sidebarOverlay.classList.toggle('active');

        });


        sidebarOverlay?.addEventListener('click', () => {

            sidebar.classList.remove('open');

            sidebarOverlay.classList.remove('active');

        });

    </script>


    @stack('scripts')


</body>

</html>
```
