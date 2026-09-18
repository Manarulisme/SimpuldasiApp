<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Website Resmi Kelurahan Binong</title>

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

        .logo img {
            width: 40px;
            height: auto;
            display: block;
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
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
            overflow: hidden;
            isolation: isolate;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
            z-index: -2;
        }

        /* FOTO 1 */

        .hero::before {
            background-image:
                linear-gradient(
                    rgba(0, 0, 0, 0.45),
                    rgba(0, 0, 0, 0.45)
                ),
                url('{{ asset('Assets/Image/foto_kelurahan1.jpg') }}');

            animation: heroSlide1 10s infinite;
        }

        /* FOTO 2 */

        .hero::after {
            background-image:
                linear-gradient(
                    rgba(0, 0, 0, 0.45),
                    rgba(0, 0, 0, 0.45)
                ),
                url('{{ asset('Assets/Image/foto_kelurahan2.jpg') }}');

            opacity: 0;

            animation: heroSlide2 10s infinite;
        }


        /* =========================
           HERO ANIMATION
        ========================= */

        @keyframes heroSlide1 {

            0%,
            45% {
                opacity: 1;
            }

            50%,
            95% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }

        }


        @keyframes heroSlide2 {

            0%,
            45% {
                opacity: 0;
            }

            50%,
            95% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }

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

        .btn-primary:hover {
            background: #095b31;
        }

        .btn-white {
            background: white;
            color: #222;
        }

        .btn-white:hover {
            background: #f1f1f1;
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
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
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

        .survey-button:hover {
            background: #095b31;
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
            color: #0b6b3a;
        }


        /* =========================
           PERSYARATAN PELAYANAN
        ========================= */

        .requirements-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 25px;
            max-width: 1100px;
            margin: auto;
        }

        .requirement-card {
            background: #fff;
            border: 1px solid #e8ecea;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s ease;
            cursor: pointer;
        }

        .requirement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        }

        .requirement-image {
            width: 100%;
            height: 500px;
            background: #f3f5f4;
            overflow: hidden;
            position: relative;
        }

        .requirement-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            transition: transform 0.3s ease;
        }

        .requirement-card:hover .requirement-image img {
            transform: scale(1.02);
        }

        .zoom-label {
            position: absolute;
            right: 15px;
            bottom: 15px;
            background: rgba(11, 107, 58, 0.9);
            color: #fff;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }


        /* =========================
           IMAGE VIEWER
        ========================= */

        .image-viewer {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.88);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 30px;
        }

        .image-viewer.show {
            display: flex;
        }

        .image-viewer-content {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image-viewer img {
            max-width: 90%;
            max-height: 85%;
            object-fit: contain;
            user-select: none;
            cursor: grab;
            transition: transform 0.2s ease;
        }

        .image-viewer img:active {
            cursor: grabbing;
        }

        .viewer-close {
            position: absolute;
            top: 15px;
            right: 20px;
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-size: 25px;
            cursor: pointer;
            z-index: 2;
        }

        .viewer-close:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .viewer-controls {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 0, 0, 0.55);
            padding: 8px;
            border-radius: 8px;
            z-index: 2;
        }

        .viewer-controls button {
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }

        .viewer-controls button:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .viewer-zoom-value {
            color: #fff;
            min-width: 55px;
            text-align: center;
            font-size: 12px;
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
                grid-template-columns: 1fr;
            }

            .requirement-image {
                height: 450px;
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

            .hero-content small {
                font-size: 12px;
            }

            .survey-box {
                flex-direction: column;
                text-align: center;
                padding: 30px 22px;
            }

            .requirements-grid {
                grid-template-columns: 1fr;
            }

            .requirement-image {
                height: 350px;
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

            .image-viewer {
                padding: 15px;
            }

            .image-viewer img {
                max-width: 95%;
                max-height: 80%;
            }

            .viewer-controls {
                bottom: 15px;
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

                <img
                    src="{{ asset('Assets/Image/logo_simpuldasi.png') }}"
                    alt="Logo Simpuldasi"
                >

                <div class="logo-text">

                    <strong>
                        Kelurahan Binong
                    </strong>

                    <span>
                        Website Resmi Kelurahan Binong
                    </span>

                </div>

            </a>


            <ul class="nav-menu">

                <li>
                    <a href="#">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="#">
                        Profil
                    </a>
                </li>

                <li>
                    <a href="#">
                        Pelayanan
                    </a>
                </li>

                <li>
                    <a href="#">
                        Persyaratan
                    </a>
                </li>

                <li>
                    <a href="#survey">
                        Survey
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
                    Kelurahan Binong
                </h1>

                <p>
                    Informasi dan pelayanan publik untuk masyarakat
                    secara mudah, cepat, transparan, dan terpercaya.
                </p>


                <div class="hero-buttons">

                    <a
                        href="#"
                        class="btn btn-primary"
                    >
                        Lihat Profil
                    </a>

                    <a
                        href="#"
                        class="btn btn-white"
                    >
                        Informasi Pelayanan
                    </a>

                </div>

            </div>

        </div>

    </section>



    <!-- =========================
         SURVEY
    ========================= -->

    <section
        class="section survey-section"
        id="survey"
    >

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
                        rel="noopener noreferrer"
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
                    Informasi persyaratan pelayanan administrasi
                    Kelurahan Binong dapat dilihat pada gambar berikut.
                </p>

            </div>



            <div class="requirements-grid">


                <!-- =========================
                     PERSYARATAN 1
                ========================= -->

                <div
                    class="requirement-card"
                    onclick="openImageViewer('{{ asset('Assets/Image/persyaratan_pelayanan1.png') }}')"
                >

                    <div class="requirement-image">

                        <img
                            src="{{ asset('Assets/Image/persyaratan_pelayanan1.png') }}"
                            alt="Persyaratan Pelayanan Kelurahan Binong"
                        >

                        <span class="zoom-label">
                            🔍 Klik untuk memperbesar
                        </span>

                    </div>

                </div>



                <!-- =========================
                     PERSYARATAN 2
                ========================= -->

                <div
                    class="requirement-card"
                    onclick="openImageViewer('{{ asset('Assets/Image/persyaratan_pelayanan2.png') }}')"
                >

                    <div class="requirement-image">

                        <img
                            src="{{ asset('Assets/Image/persyaratan_pelayanan2.png') }}"
                            alt="Persyaratan Pelayanan Kelurahan Binong"
                        >

                        <span class="zoom-label">
                            🔍 Klik untuk memperbesar
                        </span>

                    </div>

                </div>


            </div>

        </div>

    </section>



    <!-- =========================
         IMAGE VIEWER
    ========================= -->

    <div
        class="image-viewer"
        id="imageViewer"
        onclick="closeImageViewer(event)"
    >

        <div
            class="image-viewer-content"
            onclick="event.stopPropagation()"
        >


            <!-- CLOSE -->

            <button
                type="button"
                class="viewer-close"
                onclick="closeImageViewer()"
                title="Tutup"
            >
                ×
            </button>


            <!-- IMAGE -->

            <img
                id="viewerImage"
                src=""
                alt="Persyaratan Pelayanan"
            >


            <!-- CONTROLS -->

            <div class="viewer-controls">


                <button
                    type="button"
                    onclick="zoomOut()"
                    title="Zoom Out"
                >
                    −
                </button>


                <span
                    class="viewer-zoom-value"
                    id="zoomValue"
                >
                    100%
                </span>


                <button
                    type="button"
                    onclick="zoomIn()"
                    title="Zoom In"
                >
                    +
                </button>


                <button
                    type="button"
                    onclick="resetZoom()"
                    title="Reset Zoom"
                >
                    ↺
                </button>


            </div>

        </div>

    </div>



    <!-- =========================
         FOOTER
    ========================= -->

    <footer>

        <div class="footer-container">


            <div class="footer-column">

                <h3>
                    Kelurahan Binong
                </h3>

                <p>
                    Website resmi Kelurahan Binong sebagai media
                    informasi dan pelayanan publik bagi masyarakat.
                </p>

            </div>



            <div class="footer-column">

                <h3>
                    Menu
                </h3>

                <ul>

                    <li>
                        <a href="#">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Profil
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Pelayanan
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            Persyaratan
                        </a>
                    </li>

                </ul>

            </div>



            <div class="footer-column">

                <h3>
                    Kontak
                </h3>

                <ul>

                    <li>
                        Alamat Kelurahan
                    </li>

                    <li>
                        Telepon
                    </li>

                    <li>
                        Email
                    </li>

                    <li>
                        Jam Pelayanan
                    </li>

                </ul>

            </div>


        </div>



        <div class="copyright">

            © {{ date('Y') }} Kelurahan Binong. All Rights Reserved.

        </div>

    </footer>



    <!-- =========================
         JAVASCRIPT IMAGE VIEWER
    ========================= -->

    <script>

        let currentZoom = 1;

        const imageViewer =
            document.getElementById('imageViewer');

        const viewerImage =
            document.getElementById('viewerImage');

        const zoomValue =
            document.getElementById('zoomValue');


        /* =========================
           OPEN VIEWER
        ========================= */

        function openImageViewer(imageSrc) {

            viewerImage.src = imageSrc;

            currentZoom = 1;

            updateZoom();

            imageViewer.classList.add('show');

            document.body.style.overflow = 'hidden';

        }


        /* =========================
           CLOSE VIEWER
        ========================= */

        function closeImageViewer(event) {

            /*
             * Jika klik background,
             * tutup viewer.
             */

            if (event && event.target !== imageViewer) {
                return;
            }

            imageViewer.classList.remove('show');

            document.body.style.overflow = '';

            currentZoom = 1;

            updateZoom();

        }


        /* =========================
           ZOOM IN
        ========================= */

        function zoomIn() {

            if (currentZoom < 3) {

                currentZoom += 0.25;

                updateZoom();

            }

        }


        /* =========================
           ZOOM OUT
        ========================= */

        function zoomOut() {

            if (currentZoom > 0.5) {

                currentZoom -= 0.25;

                updateZoom();

            }

        }


        /* =========================
           RESET ZOOM
        ========================= */

        function resetZoom() {

            currentZoom = 1;

            updateZoom();

        }


        /* =========================
           UPDATE ZOOM
        ========================= */

        function updateZoom() {

            viewerImage.style.transform =
                `scale(${currentZoom})`;

            zoomValue.textContent =
                Math.round(currentZoom * 100) + '%';

        }


        /* =========================
           KEYBOARD
        ========================= */

        document.addEventListener(
            'keydown',
            function(event) {

                /* ESC = Close */

                if (event.key === 'Escape') {

                    imageViewer.classList.remove('show');

                    document.body.style.overflow = '';

                    currentZoom = 1;

                    updateZoom();

                }


                /* + = Zoom In */

                if (
                    event.key === '+' ||
                    event.key === '='
                ) {

                    zoomIn();

                }


                /* - = Zoom Out */

                if (event.key === '-') {

                    zoomOut();

                }

            }
        );

    </script>


</body>

</html>
