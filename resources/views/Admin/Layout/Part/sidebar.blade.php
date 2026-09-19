<aside class="sidebar" id="sidebar">

{{-- BRAND --}}

<div class="sidebar-brand">


<img
    src="{{ asset('Assets/Image/logo_simpuldasi.png') }}"
    alt="Logo SIMPULDASI"
    width="40"
    height="auto"
>

<div class="brand-name">
    <strong>Kelurahan Binong</strong>

    <span>
        Sistem Pengumpulan Data Terintegrasi (SIMPULDASI)
    </span>
</div>

{{-- TOMBOL HIDE MOBILE --}}
<button
    type="button"
    class="sidebar-close"
    id="sidebarClose"
    aria-label="Tutup menu"
>
    ×
</button>


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
    <span class="menu-icon">⌂</span>
    <span>Beranda</span>
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
    <span class="menu-icon">👤</span>
    <span>Data Umum Kepegawaian</span>
</a>

<a
    href="{{ url('/databmd') }}"
    class="menu-item {{ request()->is('databmd*') ? 'active' : '' }}"
>
    <span class="menu-icon">▣</span>
    <span>Data BMD</span>
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
    <span class="menu-icon">♡</span>
    <span>Posyandu &amp; Posbindu</span>
</a>

<a
    href="{{ url('/datastunting') }}"
    class="menu-item {{ request()->is('datastunting*') ? 'active' : '' }}"
>
    <span class="menu-icon">♧</span>
    <span>Data Stunting</span>
</a>

<a
    href="{{ url('/datakpm') }}"
    class="menu-item {{ request()->is('datakpm*') ? 'active' : '' }}"
>
    <span class="menu-icon">♢</span>
    <span>KPM / Bantuan Sosial</span>
</a>

<a
    href="{{ url('/dataputussekolah') }}"
    class="menu-item {{ request()->is('dataputussekolah*') ? 'active' : '' }}"
>
    <span class="menu-icon">◉</span>
    <span>Anak Putus Sekolah</span>
</a>

<a
    href="{{ url('/datasekolah') }}"
    class="menu-item {{ request()->is('datasekolah*') ? 'active' : '' }}"
>
    <span class="menu-icon">▤</span>
    <span>Data Sekolah</span>
</a>


{{-- ================================
     EKONOMI & PEMBANGUNAN
================================= --}}
<div class="menu-title">
    Ekonomi &amp; Pembangunan
</div>

<a
    href="{{ url('/dataumkm') }}"
    class="menu-item {{ request()->is('dataumkm*') ? 'active' : '' }}"
>
    <span class="menu-icon">♙</span>
    <span>Data UMKM</span>
</a>

<a
    href="{{ url('/datarutilahu') }}"
    class="menu-item {{ request()->is('datarutilahu*') ? 'active' : '' }}"
>
    <span class="menu-icon">◈</span>
    <span>Data Rutilahu</span>
</a>

<a
    href="{{ url('/databuruansae') }}"
    class="menu-item {{ request()->is('databuruansae*') ? 'active' : '' }}"
>
    <span class="menu-icon">🌱</span>
    <span>Data Buruan Sae</span>
</a>

<a
    href="{{ url('/datapohon') }}"
    class="menu-item {{ request()->is('datapohon*') ? 'active' : '' }}"
>
    <span class="menu-icon">♣</span>
    <span>Data Pohon</span>
</a>

<a
    href="{{ url('/datafasilitasumum') }}"
    class="menu-item {{ request()->is('datafasilitasumum*') ? 'active' : '' }}"
>
    <span class="menu-icon">▦</span>
    <span>Fasilitas Umum &amp; Sosial</span>
</a>


{{-- ================================
     PEMERINTAHAN
================================= --}}
<div class="menu-title">
    Pemerintahan
</div>

<a
    href="{{ url('/datalaporanpenduduk') }}"
    class="menu-item {{ request()->is('datalaporanpendudukan*') ? 'active' : '' }}"
>
    <span class="menu-icon">◫</span>
    <span>Laporan Kependudukan</span>
</a>

<a
    href="{{ url('/datalinmas') }}"
    class="menu-item {{ request()->is('datalinmas*') ? 'active' : '' }}"
>
    <span class="menu-icon">⚑</span>
    <span>Linmas &amp; Siskamling</span>
</a>

<a
    href="{{ url('/datartrw') }}"
    class="menu-item {{ request()->is('datartrw*') ? 'active' : '' }}"
>
    <span class="menu-icon">▥</span>
    <span>Data RT/RW &amp; Periode</span>
</a>

<a
    href="{{ url('/datapkl') }}"
    class="menu-item {{ request()->is('datapkl*') ? 'active' : '' }}"
>
    <span class="menu-icon">◉</span>
    <span>Data PKL</span>
</a>


{{-- ================================
     SISTEM
================================= --}}
<div class="menu-title">
    Sistem
</div>

{{-- LAPORAN BULANAN --}}
<a
    href="{{ route('laporan.index') }}"
    class="menu-item {{ request()->is('laporan*') ? 'active' : '' }}"
>
    <span class="menu-icon">▤</span>
    <span>Laporan Bulanan</span>
</a>

<a
    href="{{ url('/pengaturan_user') }}"
    class="menu-item {{ request()->is('pengaturan_user*') ? 'active' : '' }}"
>
    <span class="menu-icon">⚙</span>
    <span>Pengaturan</span>
</a>


{{-- KELUAR --}}
<form
    action="{{ route('logout') }}"
    method="POST"
    style="margin: 0;"
>
    @csrf

    <button
        type="submit"
        class="menu-item"
        style="
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
            font: inherit;
            color: inherit;
            cursor: pointer;
        "
    >
        <span class="menu-icon">↪</span>
        <span>Keluar</span>
    </button>
</form>


</nav>

</aside>

{{-- OVERLAY MOBILE --}}

<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>

@push('styles')

<style>

    /* ==========================================
       TOMBOL HIDE SIDEBAR
    ========================================== */

    .sidebar-close {
        display: none;

        position: absolute;
        top: 18px;
        right: 15px;

        width: 36px;
        height: 36px;

        padding: 0;

        border: none;
        border-radius: 8px;

        background: transparent;
        color: #ffffff;

        font-size: 30px;
        font-weight: 400;
        line-height: 1;

        cursor: pointer;

        align-items: center;
        justify-content: center;
    }

    .sidebar-close:hover {
        background: rgba(255, 255, 255, 0.10);
    }


    /* ==========================================
       OVERLAY
    ========================================== */

    .sidebar-overlay {
        display: none;
    }


    /* ==========================================
       MOBILE
    ========================================== */

    @media (max-width: 768px) {

        .sidebar-close {
            display: flex;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;

            background: rgba(0, 0, 0, 0.45);

            z-index: 1090;
        }

        body.sidebar-open .sidebar-overlay {
            display: block;
        }

        .sidebar {
            z-index: 1100;
        }

    }

</style>

@endpush

@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (!sidebar) {
            return;
        }


        /* ==========================================
           FUNGSI TUTUP SIDEBAR
        ========================================== */

        function closeSidebar() {

            sidebar.classList.remove('show');

            document.body.classList.remove('sidebar-open');

        }


        /* ==========================================
           TOMBOL X
        ========================================== */

        if (sidebarClose) {

            sidebarClose.addEventListener('click', function (event) {

                event.preventDefault();

                closeSidebar();

            });

        }


        /* ==========================================
           OVERLAY
        ========================================== */

        if (sidebarOverlay) {

            sidebarOverlay.addEventListener('click', function () {

                closeSidebar();

            });

        }


        /* ==========================================
           MENU MOBILE
        ========================================== */

        const menuItems = sidebar.querySelectorAll('.menu-item');

        menuItems.forEach(function (item) {

            item.addEventListener('click', function () {

                if (window.innerWidth <= 768) {

                    closeSidebar();

                }

            });

        });


        /* ==========================================
           RESIZE
        ========================================== */

        window.addEventListener('resize', function () {

            if (window.innerWidth > 768) {

                document.body.classList.remove('sidebar-open');

            }

        });

    });

</script>

@endpush
