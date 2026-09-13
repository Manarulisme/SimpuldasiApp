```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kepegawaian - Kelurahan XXXXX</title>

    <style>
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
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 270px;
            height: 100vh;
            background: var(--sidebar);
            color: white;
            z-index: 1000;
            overflow-y: auto;
        }

        .brand {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            text-align: center;
        }

        .logo {
            width: 58px;
            height: 58px;
            margin: 0 auto 12px;
            border-radius: 50%;
            background: white;
            color: var(--sidebar);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .brand h2 {
            font-size: 17px;
            margin-bottom: 5px;
        }

        .brand p {
            font-size: 10px;
            color: #b9c7d1;
            letter-spacing: 1px;
        }

        .menu {
            padding: 15px 10px 30px;
        }

        .menu-title {
            padding: 12px 15px 7px;
            font-size: 10px;
            text-transform: uppercase;
            color: #7f96a7;
            letter-spacing: 1px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 15px;
            margin-bottom: 3px;
            border-radius: 7px;
            text-decoration: none;
            color: #d9e2e8;
            font-size: 13px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: var(--sidebar-hover);
            color: white;
        }

        .menu a.active {
            background: var(--primary);
            color: white;
            font-weight: bold;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .submenu a {
            padding-left: 46px;
            font-size: 12px;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 270px;
            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            height: 82px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 500;
        }

        .page-heading h1 {
            font-family: Georgia, serif;
            font-size: 24px;
            color: var(--sidebar);
            margin-bottom: 4px;
        }

        .page-heading p {
            font-size: 12px;
            color: var(--muted);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .notification {
            width: 38px;
            height: 38px;
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            background: white;
            cursor: pointer;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
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

        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 30px;
            max-width: 1250px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 18px;
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h2 {
            font-family: Georgia, serif;
            font-size: 27px;
            color: var(--sidebar);
            margin-bottom: 7px;
        }

        .page-title p {
            font-size: 13px;
            color: var(--muted);
        }

        /* =========================
           FORM CARD
        ========================= */

        .form-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .form-header {
            padding: 22px 25px;
            border-bottom: 1px solid var(--border);
            background: #fbfcfc;
        }

        .form-header h3 {
            font-size: 17px;
            color: var(--sidebar);
            margin-bottom: 5px;
        }

        .form-header p {
            font-size: 12px;
            color: var(--muted);
        }

        .form-body {
            padding: 28px 25px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: var(--sidebar);
            font-weight: bold;
            padding-bottom: 12px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .section-number {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 12px;
            font-weight: bold;
            color: var(--text);
            margin-bottom: 8px;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            height: 43px;
            border: 1px solid #dce2e5;
            border-radius: 7px;
            padding: 0 13px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: var(--text);
            background: white;
            outline: none;
            transition: 0.2s;
        }

        textarea.form-control {
            height: 100px;
            padding: 12px 13px;
            resize: vertical;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(8,116,67,0.08);
        }

        .form-control::placeholder {
            color: #aab2b7;
        }

        select.form-control {
            cursor: pointer;
        }

        .form-help {
            font-size: 11px;
            color: var(--muted);
            margin-top: 6px;
        }

        /* =========================
           INFO BOX
        ========================= */

        .info-box {
            margin-top: 25px;
            padding: 14px 16px;
            background: var(--primary-light);
            border: 1px solid #d7ecdf;
            border-radius: 8px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .info-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .info-box p {
            font-size: 12px;
            line-height: 1.6;
            color: #416052;
        }

        /* =========================
           FORM FOOTER
        ========================= */

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-top: 1px solid var(--border);
            background: #fbfcfc;
        }

        .required-note {
            font-size: 11px;
            color: var(--muted);
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            height: 42px;
            padding: 0 20px;
            border-radius: 7px;
            border: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .btn-secondary {
            background: white;
            color: var(--text);
            border: 1px solid #dce2e5;
        }

        .btn-secondary:hover {
            background: #f2f4f5;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            padding: 25px 30px;
            margin-top: 15px;
            font-size: 11px;
            color: var(--muted);
            border-top: 1px solid var(--border);
        }

        /* =========================
           MOBILE
        ========================= */

        .mobile-menu {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            background: white;
            border-radius: 7px;
            font-size: 20px;
            cursor: pointer;
        }

        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 900;
        }

        @media (max-width: 1100px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: 0.3s;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .overlay.show {
                display: block;
            }

            .main {
                margin-left: 0;
            }

            .mobile-menu {
                display: block;
            }

            .topbar {
                padding: 0 18px;
            }

            .page-heading {
                display: none;
            }

            .content {
                padding: 20px 18px;
            }

            .topbar-right {
                margin-left: auto;
            }

            .user-info {
                display: none;
            }

            .form-body {
                padding: 22px 18px;
            }

            .form-header {
                padding: 20px 18px;
            }

            .form-footer {
                padding: 18px;
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .form-actions {
                width: 100%;
            }

            .form-actions .btn {
                flex: 1;
            }
        }

        @media (max-width: 480px) {
            .content {
                padding: 18px 14px;
            }

            .page-title h2 {
                font-size: 23px;
            }

            .topbar {
                height: 70px;
            }

            .notification {
                display: none;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- OVERLAY -->
    <div class="overlay" id="overlay"></div>

    <!-- =========================
         SIDEBAR
    ========================== -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <div class="logo">LOGO</div>
            <h2>Kelurahan XXXXX</h2>
            <p>SISTEM INFORMASI KELURAHAN</p>
        </div>

        <nav class="menu">

            <div class="menu-title">Menu Utama</div>

            <a href="dashboard.html">
                <span class="menu-icon">⌂</span>
                <span>Beranda</span>
            </a>

            <div class="menu-title">Kesekretariatan</div>

            <div class="submenu">
                <a href="duk.html" class="active">
                    <span class="menu-icon">👤</span>
                    <span>Data Umum Kepegawaian</span>
                </a>

                <a href="#">
                    <span class="menu-icon">▣</span>
                    <span>Data BMD</span>
                </a>
            </div>

            <div class="menu-title">Kesejahteraan Sosial</div>

            <div class="submenu">
                <a href="#">
                    <span class="menu-icon">♙</span>
                    <span>Posyandu & Posbindu</span>
                </a>

                <a href="#">
                    <span class="menu-icon">♥</span>
                    <span>Data Stunting</span>
                </a>

                <a href="#">
                    <span class="menu-icon">♧</span>
                    <span>KPM / Bantuan Sosial</span>
                </a>

                <a href="#">
                    <span class="menu-icon">🎓</span>
                    <span>Anak Putus Sekolah</span>
                </a>

                <a href="#">
                    <span class="menu-icon">▤</span>
                    <span>Data Sekolah</span>
                </a>
            </div>

            <div class="menu-title">Ekonomi & Pembangunan</div>

            <div class="submenu">
                <a href="#">
                    <span class="menu-icon">◉</span>
                    <span>Data UMKM</span>
                </a>

                <a href="#">
                    <span class="menu-icon">⌂</span>
                    <span>Data Rutillahu</span>
                </a>

                <a href="#">
                    <span class="menu-icon">♧</span>
                    <span>Data Buruan Sae</span>
                </a>

                <a href="#">
                    <span class="menu-icon">♣</span>
                    <span>Data Pohon</span>
                </a>

                <a href="#">
                    <span class="menu-icon">▦</span>
                    <span>Fasilitas Umum & Sosial</span>
                </a>
            </div>

            <div class="menu-title">Pemerintahan</div>

            <div class="submenu">
                <a href="#">
                    <span class="menu-icon">▤</span>
                    <span>Laporan Kependudukan</span>
                </a>

                <a href="#">
                    <span class="menu-icon">⚑</span>
                    <span>Linmas & Siskamling</span>
                </a>

                <a href="#">
                    <span class="menu-icon">♟</span>
                    <span>Data RT/RW & Periode</span>
                </a>

                <a href="#">
                    <span class="menu-icon">▣</span>
                    <span>Data PKL</span>
                </a>
            </div>

            <div class="menu-title">Sistem</div>

            <a href="#">
                <span class="menu-icon">⚙</span>
                <span>Pengaturan</span>
            </a>

            <a href="login.html">
                <span class="menu-icon">↪</span>
                <span>Keluar</span>
            </a>

        </nav>
    </aside>


    <!-- =========================
         MAIN
    ========================== -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <button class="mobile-menu" id="mobileMenu">☰</button>

            <div class="page-heading">
                <h1>Tambah Data Kepegawaian</h1>
                <p>Kesekretariatan · Data Umum Kepegawaian · Tambah Data</p>
            </div>

            <div class="topbar-right">

                <div class="notification">
                    ♧
                </div>

                <div class="user">
                    <div class="avatar">A</div>

                    <div class="user-info">
                        <strong>Administrator</strong>
                        <span>Admin Kelurahan</span>
                    </div>
                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <section class="content">

            <!-- BREADCRUMB -->
            <div class="breadcrumb">
                <a href="dashboard.html">Beranda</a>
                <span>›</span>
                <a href="duk.html">Data Kepegawaian</a>
                <span>›</span>
                <span>Tambah Data</span>
            </div>


            <!-- PAGE TITLE -->
            <div class="page-title">
                <h2>Tambah Data Umum Kepegawaian</h2>
                <p>Tambahkan data pegawai baru ke dalam Data Umum Kepegawaian Kelurahan XXXXX.</p>
            </div>


            <!-- FORM CARD -->
            <div class="form-card">

                <div class="form-header">
                    <h3>Form Data Pegawai</h3>
                    <p>Silakan lengkapi informasi pegawai pada kolom yang tersedia.</p>
                </div>


                <form id="pegawaiForm">

                    <div class="form-body">

                        <!-- DATA IDENTITAS -->
                        <div class="form-section">

                            <div class="section-title">
                                <span class="section-number">1</span>
                                Data Identitas Pegawai
                            </div>

                            <div class="form-grid">

                                <div class="form-group">
                                    <label for="jenis">
                                        Jenis Pegawai <span class="required">*</span>
                                    </label>

                                    <select id="jenis" name="jenis" class="form-control" required>
                                        <option value="">Pilih Jenis Pegawai</option>
                                        <option value="ASN">ASN</option>
                                        <option value="PPPK">PPPK</option>
                                        <option value="Non-ASN">Non-ASN</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="nomor">
                                        NIP / NRP / TT <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="nomor"
                                        name="nomor"
                                        class="form-control"
                                        placeholder="Masukkan NIP / NRP / TT"
                                        required
                                    >

                                    <span class="form-help">
                                        Sesuaikan dengan jenis dan status kepegawaian.
                                    </span>
                                </div>


                                <div class="form-group full">
                                    <label for="nama">
                                        Nama Lengkap <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="nama"
                                        name="nama"
                                        class="form-control"
                                        placeholder="Masukkan nama lengkap pegawai"
                                        required
                                    >
                                </div>

                            </div>

                        </div>


                        <!-- DATA KEPEGAWAIAN -->
                        <div class="form-section">

                            <div class="section-title">
                                <span class="section-number">2</span>
                                Data Kepegawaian
                            </div>

                            <div class="form-grid">

                                <div class="form-group">
                                    <label for="golongan">
                                        Golongan <span class="required">*</span>
                                    </label>

                                    <select id="golongan" name="golongan" class="form-control" required>
                                        <option value="">Pilih Golongan</option>
                                        <option value="I/a">I/a</option>
                                        <option value="I/b">I/b</option>
                                        <option value="I/c">I/c</option>
                                        <option value="I/d">I/d</option>
                                        <option value="II/a">II/a</option>
                                        <option value="II/b">II/b</option>
                                        <option value="II/c">II/c</option>
                                        <option value="II/d">II/d</option>
                                        <option value="III/a">III/a</option>
                                        <option value="III/b">III/b</option>
                                        <option value="III/c">III/c</option>
                                        <option value="III/d">III/d</option>
                                        <option value="IV/a">IV/a</option>
                                        <option value="IV/b">IV/b</option>
                                        <option value="IV/c">IV/c</option>
                                        <option value="IV/d">IV/d</option>
                                        <option value="IV/e">IV/e</option>
                                        <option value="IX">IX</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="pangkat">
                                        Pangkat <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="pangkat"
                                        name="pangkat"
                                        class="form-control"
                                        placeholder="Contoh: Penata"
                                        required
                                    >
                                </div>


                                <div class="form-group full">
                                    <label for="jabatan">
                                        Jabatan <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="jabatan"
                                        name="jabatan"
                                        class="form-control"
                                        placeholder="Contoh: Kasi Pemerintahan"
                                        required
                                    >
                                </div>

                            </div>

                        </div>


                        <!-- KETERANGAN -->
                        <div class="form-section">

                            <div class="section-title">
                                <span class="section-number">3</span>
                                Keterangan
                            </div>

                            <div class="form-grid">

                                <div class="form-group full">
                                    <label for="keterangan">
                                        Keterangan Tambahan
                                    </label>

                                    <textarea
                                        id="keterangan"
                                        name="keterangan"
                                        class="form-control"
                                        placeholder="Masukkan keterangan tambahan jika diperlukan..."
                                    ></textarea>

                                    <span class="form-help">
                                        Kolom ini bersifat opsional.
                                    </span>
                                </div>

                            </div>

                        </div>


                        <!-- INFO -->
                        <div class="info-box">

                            <div class="info-icon">i</div>

                            <p>
                                Pastikan data pegawai yang dimasukkan sudah benar sebelum
                                menyimpan. Data yang telah disimpan dapat diubah kembali
                                melalui halaman Data Umum Kepegawaian.
                            </p>

                        </div>

                    </div>


                    <!-- FORM FOOTER -->
                    <div class="form-footer">

                        <div class="required-note">
                            <span class="required">*</span> Wajib diisi
                        </div>

                        <div class="form-actions">

                            <a href="duk.html" class="btn btn-secondary">
                                Batal
                            </a>

                            <button type="submit" class="btn btn-primary">
                                ✓ Simpan Data
                            </button>

                        </div>

                    </div>

                </form>

            </div>


            <!-- FOOTER -->
            <footer class="footer">
                © 2026 Sistem Informasi Kelurahan XXXXX · Semua hak dilindungi.
            </footer>

        </section>

    </main>


    <script>

        /* =========================
           MOBILE SIDEBAR
        ========================== */

        const mobileMenu = document.getElementById('mobileMenu');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        mobileMenu.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });


        /* =========================
           FORM SUBMIT
        ========================== */

        const form = document.getElementById('pegawaiForm');

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            const nama = document.getElementById('nama').value;

            alert(
                'Data pegawai berhasil disimpan!\\n\\n' +
                'Nama: ' + nama
            );

            window.location.href = 'duk.html';

        });

    </script>

</body>
</html>
```
