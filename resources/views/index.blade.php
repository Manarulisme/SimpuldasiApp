<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Website Resmi Kelurahan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #222;
            background: #fff;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            width: 100%;
            background: #fff;
            border-bottom: 1px solid #eee;
            position: relative;
            z-index: 10;
        }

        .nav-container {
            max-width: 1200px;
            margin: auto;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: #0b6b3a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .logo-text strong {
            display: block;
            font-size: 17px;
        }

        .logo-text span {
            font-size: 12px;
            color: #777;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 28px;
            list-style: none;
        }

        .nav-menu a {
            font-size: 14px;
            color: #444;
            transition: 0.3s;
        }

        .nav-menu a:hover {
            color: #0b6b3a;
        }

        .login-button {
            background: #0b6b3a;
            color: #fff !important;
            padding: 10px 18px;
            border-radius: 6px;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            min-height: 600px;
            background:
                linear-gradient(
                    rgba(0, 0, 0, 0.45),
                    rgba(0, 0, 0, 0.45)
                ),
                url("assets/hero.jpg") center center / cover no-repeat;

            display: flex;
            align-items: center;
        }

        .hero-container {
            max-width: 1200px;
            width: 100%;
            margin: auto;
            padding: 80px 24px;
        }

        .hero-content {
            max-width: 650px;
            color: white;
        }

        .hero-content small {
            font-size: 15px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero-content h1 {
            font-size: 48px;
            line-height: 1.15;
            margin: 15px 0 20px;
        }

        .hero-content p {
            font-size: 17px;
            max-width: 600px;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 13px 22px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-primary {
            background: #0b6b3a;
            color: white;
        }

        .btn-white {
            background: white;
            color: #222;
        }

        /* =========================
           GENERAL SECTION
        ========================= */

        .section {
            padding: 80px 24px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .section-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 45px;
        }

        .section-header small {
            color: #0b6b3a;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-header h2 {
            font-size: 34px;
            margin: 10px 0 15px;
        }

        .section-header p {
            color: #666;
        }

        /* =========================
           SURVEY
        ========================= */

        .survey-section {
            background: #f5f8f6;
        }

        .survey-box {
            max-width: 1000px;
            margin: auto;
            background: white;
            border-radius: 12px;
            padding: 45px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        }

        .survey-content {
            flex: 1;
        }

        .survey-content h3 {
            font-size: 27px;
            margin-bottom: 12px;
        }

        .survey-content p {
            color: #666;
            margin-bottom: 20px;
        }

        .survey-button {
            display: inline-block;
            background: #0b6b3a;
            color: white;
            padding: 13px 22px;
            border-radius: 6px;
            font-weight: 600;
        }

        .survey-icon {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: #e7f3ec;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
        }

        /* =========================
           PERSYARATAN
        ========================= */

        .requirements-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .requirement-card {
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            background: white;
            transition: 0.3s;
        }

        .requirement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .requirement-image {
            height: 220px;
            background: #eee;
            overflow: hidden;
        }

        .requirement-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .requirement-content {
            padding: 22px;
        }

        .requirement-content h3 {
            font-size: 19px;
            margin-bottom: 8px;
        }

        .requirement-content p {
            font-size: 14px;
            color: #666;
        }

        .requirement-link {
            display: inline-block;
            margin-top: 15px;
            color: #0b6b3a;
            font-size: 14px;
            font-weight: bold;
        }

        /* =========================
           LOGIN PEGAWAI
        ========================= */

        .employee-section {
            background: #0b6b3a;
            color: white;
            text-align: center;
        }

        .employee-section h2 {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .employee-section p {
            max-width: 600px;
            margin: 0 auto 25px;
            opacity: 0.9;
        }

        .employee-button {
            display: inline-block;
            background: white;
            color: #0b6b3a;
            padding: 13px 25px;
            border-radius: 6px;
            font-weight: bold;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #1c1c1c;
            color: white;
            padding: 45px 24px 25px;
        }

        .footer-container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
        }

        .footer-column h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .footer-column p,
        .footer-column li {
            font-size: 14px;
            color: #bbb;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column li {
            margin-bottom: 8px;
        }

        .copyright {
            max-width: 1200px;
            margin: 35px auto 0;
            padding-top: 20px;
            border-top: 1px solid #333;
            color: #888;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .nav-menu {
                gap: 15px;
            }

            .hero-content h1 {
                font-size: 40px;
            }

            .requirements-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 650px) {

            .nav-menu {
                display: none;
            }

            .hero {
                min-height: 550px;
            }

            .hero-content h1 {
                font-size: 34px;
            }

            .hero-content p {
                font-size: 15px;
            }

            .survey-box {
                flex-direction: column;
                text-align: center;
                padding: 30px 22px;
            }

            .requirements-grid {
                grid-template-columns: 1fr;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 60px 20px;
            }

            .section-header h2 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         NAVBAR
    ========================= -->

    <header class="navbar">

        <div class="nav-container">

            <a href="#" class="logo">

                <div class="logo-icon">
                    LOGO
                </div>

                <div class="logo-text">
                    <strong>Kelurahan XXXXX</strong>
                    <span>Website Resmi Kelurahan</span>
                </div>

            </a>

            <ul class="nav-menu">

                <li>
                    <a href="#">Beranda</a>
                </li>

                <li>
                    <a href="#">Profil</a>
                </li>

                <li>
                    <a href="#">Pelayanan</a>
                </li>

                <li>
                    <a href="#">Persyaratan</a>
                </li>

                <li>
                    <a href="#survey">Survey</a>
                </li>

                <li>
                    <a href="#login" class="login-button">
                        Login Pegawai
                    </a>
                </li>

            </ul>

        </div>

    </header>


    <!-- =========================
         HERO
    ========================= -->

    <section class="hero">

        <div class="hero-container">

            <div class="hero-content">

                <small>
                    Website Resmi Kelurahan
                </small>

                <h1>
                    Selamat Datang di
                    Kelurahan XXXXX
                </h1>

                <p>
                    Informasi dan pelayanan publik untuk masyarakat
                    secara mudah, cepat, transparan, dan terpercaya.
                </p>

                <div class="hero-buttons">

                    <a href="#" class="btn btn-primary">
                        Lihat Profil
                    </a>

                    <a href="#" class="btn btn-white">
                        Informasi Pelayanan
                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================
         SURVEY
    ========================= -->

    <section class="section survey-section" id="survey">

        <div class="container">

            <div class="section-header">

                <small>
                    Survey Kepuasan Masyarakat
                </small>

                <h2>
                    Suara Anda Membantu Kami
                    Meningkatkan Pelayanan
                </h2>

                <p>
                    Kami terus berupaya memberikan pelayanan terbaik
                    kepada masyarakat. Sampaikan penilaian dan masukan
                    Anda melalui Survey Kepuasan Masyarakat.
                </p>

            </div>


            <div class="survey-box">

                <div class="survey-content">

                    <h3>
                        Berikan Penilaian Anda
                    </h3>

                    <p>
                        Luangkan waktu sejenak untuk mengisi Survey
                        Kepuasan Masyarakat. Setiap masukan Anda sangat
                        berarti bagi peningkatan kualitas pelayanan kami.
                    </p>

                    <a
                        href="https://forms.gle/A4DD1UZrSNxzgQa28"
                        target="_blank"
                        class="survey-button"
                    >
                        Isi Survey Sekarang
                    </a>

                </div>

                <div class="survey-icon">
                    ✓
                </div>

            </div>

        </div>

    </section>


    <!-- =========================
         PERSYARATAN PELAYANAN
    ========================= -->

    <section class="section">

        <div class="container">

            <div class="section-header">

                <small>
                    Pelayanan Publik
                </small>

                <h2>
                    Persyaratan Pelayanan
                </h2>

                <p>
                    Ketahui dokumen dan persyaratan yang diperlukan
                    sebelum mengajukan pelayanan administrasi.
                </p>

            </div>


            <div class="requirements-grid">


                <!-- CARD 1 -->

                <div class="requirement-card">

                    <div class="requirement-image">

                        <img
                            src="assets/persyaratan-1.jpg"
                            alt="Persyaratan Pelayanan"
                        >

                    </div>

                    <div class="requirement-content">

                        <h3>
                            Pelayanan Administrasi
                        </h3>

                        <p>
                            Informasi mengenai persyaratan
                            administrasi pelayanan masyarakat.
                        </p>

                        <a href="#" class="requirement-link">
                            Lihat Persyaratan →
                        </a>

                    </div>

                </div>


                <!-- CARD 2 -->

                <div class="requirement-card">

                    <div class="requirement-image">

                        <img
                            src="assets/persyaratan-2.jpg"
                            alt="Persyaratan Pelayanan"
                        >

                    </div>

                    <div class="requirement-content">

                        <h3>
                            Surat Keterangan
                        </h3>

                        <p>
                            Informasi persyaratan untuk pengurusan
                            surat keterangan.
                        </p>

                        <a href="#" class="requirement-link">
                            Lihat Persyaratan →
                        </a>

                    </div>

                </div>


                <!-- CARD 3 -->

                <div class="requirement-card">

                    <div class="requirement-image">

                        <img
                            src="assets/persyaratan-3.jpg"
                            alt="Persyaratan Pelayanan"
                        >

                    </div>

                    <div class="requirement-content">

                        <h3>
                            Pelayanan Kependudukan
                        </h3>

                        <p>
                            Informasi mengenai dokumen dan persyaratan
                            pelayanan kependudukan.
                        </p>

                        <a href="#" class="requirement-link">
                            Lihat Persyaratan →
                        </a>

                    </div>

                </div>


            </div>

        </div>

    </section>


    <!-- =========================
         LOGIN PEGAWAI
    ========================= -->

    <section class="section employee-section" id="login">

        <div class="container">

            <h2>
                Portal Pegawai
            </h2>

            <p>
                Akses sistem internal untuk mendukung pengelolaan
                pelayanan dan administrasi Kelurahan.
            </p>

            <a href="login.html" class="employee-button">
                🔐 Login Pegawai
            </a>

        </div>

    </section>


    <!-- =========================
         FOOTER
    ========================= -->

    <footer>

        <div class="footer-container">

            <div class="footer-column">

                <h3>
                    Kelurahan XXXXX
                </h3>

                <p>
                    Website resmi Kelurahan XXXXX sebagai media
                    informasi dan pelayanan publik bagi masyarakat.
                </p>

            </div>


            <div class="footer-column">

                <h3>
                    Menu
                </h3>

                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Profil</a></li>
                    <li><a href="#">Pelayanan</a></li>
                    <li><a href="#">Persyaratan</a></li>
                </ul>

            </div>


            <div class="footer-column">

                <h3>
                    Kontak
                </h3>

                <ul>
                    <li>Alamat Kelurahan</li>
                    <li>Telepon</li>
                    <li>Email</li>
                    <li>Jam Pelayanan</li>
                </ul>

            </div>

        </div>


        <div class="copyright">

            © 2026 Kelurahan XXXXX. All Rights Reserved.

        </div>

    </footer>

</body>
</html>
