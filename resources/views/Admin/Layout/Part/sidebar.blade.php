<aside class="sidebar" id="sidebar">

    {{-- BRAND --}}
    <div class="sidebar-brand">

        <img
            src="{{ asset('Assets/Image/logo_simpuldasi.png') }}"
            alt="Logo Simpuldasi"
            width="40"
            height="auto"
        >

        <div class="brand-name">

            <strong>
                Kelurahan Binong
            </strong>

            <span>
                SISTEM INFORMASI KELURAHAN
            </span>

        </div>

    </div>


    {{-- MENU --}}
    <nav class="sidebar-menu">


        {{-- ================================
             BERANDA
        ================================= --}}

        <a
            href="{{ url('/dashboard') }}"
            class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ⌂
            </span>

            <span>
                Beranda
            </span>

        </a>


        {{-- ================================
             KESEKRETARIATAN
        ================================= --}}

        <div class="menu-title">
            Kesekretariatan
        </div>


        <a
            href="{{ url('/dataumumpegawai') }}"
            class="menu-item {{ request()->is('dataumumpegawai*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                👤
            </span>

            <span>
                Data Umum Kepegawaian
            </span>

        </a>


        <a
            href="{{ url('/databmd') }}"
            class="menu-item {{ request()->is('databmd*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ▣
            </span>

            <span>
                Data BMD
            </span>

        </a>


        {{-- ================================
             KESEJAHTERAAN SOSIAL
        ================================= --}}

        <div class="menu-title">
            Kesejahteraan Sosial
        </div>


        <a
            href="{{ url('/dataposyandu') }}"
            class="menu-item {{ request()->is('dataposyandu*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ♡
            </span>

            <span>
                Posyandu &amp; Posbindu
            </span>

        </a>


        <a
            href="{{ url('/datastunting') }}"
            class="menu-item {{ request()->is('datastunting*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ♧
            </span>

            <span>
                Data Stunting
            </span>

        </a>


        <a
            href="{{ url('/datakpm') }}"
            class="menu-item {{ request()->is('datakpm*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ♢
            </span>

            <span>
                KPM / Bantuan Sosial
            </span>

        </a>


        <a
            href="{{ url('/dataputussekolah') }}"
            class="menu-item {{ request()->is('dataputussekolah*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ◉
            </span>

            <span>
                Anak Putus Sekolah
            </span>

        </a>


        <a
            href="{{ url('/datasekolah') }}"
            class="menu-item {{ request()->is('datasekolah*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ▤
            </span>

            <span>
                Data Sekolah
            </span>

        </a>


        {{-- ================================
             EKONOMI & PEMBANGUNAN
        ================================= --}}

        <div class="menu-title">
            Ekonomi &amp; Pembangunan
        </div>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                ♙
            </span>

            <span>
                Data UMKM
            </span>

        </a>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                ◈
            </span>

            <span>
                Data Rutillahu
            </span>

        </a>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                🌱
            </span>

            <span>
                Data Buruan Sae
            </span>

        </a>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                ♣
            </span>

            <span>
                Data Pohon
            </span>

        </a>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                ▦
            </span>

            <span>
                Fasilitas Umum &amp; Sosial
            </span>

        </a>


        {{-- ================================
             PEMERINTAHAN
        ================================= --}}

        <div class="menu-title">
            Pemerintahan
        </div>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                ◫
            </span>

            <span>
                Laporan Kependudukan
            </span>

        </a>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                ⚑
            </span>

            <span>
                Linmas &amp; Siskamling
            </span>

        </a>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                ▥
            </span>

            <span>
                Data RT/RW &amp; Periode
            </span>

        </a>


        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                ◉
            </span>

            <span>
                Data PKL
            </span>

        </a>


        {{-- ================================
             SISTEM
        ================================= --}}

        <div class="menu-title">
            Sistem
        </div>


        <a
            href="{{ url('/pengaturan') }}"
            class="menu-item {{ request()->is('pengaturan*') ? 'active' : '' }}"
        >

            <span class="menu-icon">
                ⚙
            </span>

            <span>
                Pengaturan
            </span>

        </a>


        <a
            href="{{ url('/login') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                ↪
            </span>

            <span>
                Keluar
            </span>

        </a>


    </nav>

</aside>
```
