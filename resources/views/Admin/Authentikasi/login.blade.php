<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Pegawai - Kelurahan XXXXX</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f5;
            color: #222;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* =========================
           LOGIN WRAPPER
        ========================= */

        .login-wrapper {
            width: 100%;
            max-width: 1050px;
            min-height: 600px;

            display: grid;
            grid-template-columns: 1fr 1fr;

            background: #fff;
            border-radius: 16px;
            overflow: hidden;

            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);

            margin: 25px;
        }


        /* =========================
           LEFT SIDE
        ========================= */

        .login-left {

            background:
                linear-gradient(
                    rgba(0, 82, 43, 0.82),
                    rgba(0, 82, 43, 0.82)
                ),
                url({{ asset('Assets/Image/logo_simpuldasi.png') }})
                center center / cover no-repeat;

            color: white;

            display: flex;
            flex-direction: column;
            justify-content: center;

            padding: 60px;
        }


        .logo-area {
            display: flex;
            align-items: center;
            gap: 15px;

            margin-bottom: 45px;
        }


        .logo-icon {

            width: 55px;
            height: 55px;

            background: white;
            color: #075c36;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 12px;
            font-weight: bold;
        }


        .logo-text strong {
            display: block;
            font-size: 18px;
        }


        .logo-text span {
            display: block;
            font-size: 12px;
            opacity: 0.8;
            margin-top: 3px;
        }


        .login-left h1 {

            font-size: 42px;
            line-height: 1.15;

            margin-bottom: 20px;
        }


        .login-left p {

            font-size: 16px;
            line-height: 1.7;

            max-width: 430px;

            opacity: 0.9;
        }


        .left-footer {

            margin-top: 50px;

            font-size: 13px;
            opacity: 0.7;
        }


        /* =========================
           RIGHT SIDE
        ========================= */


        .login-right {

            padding: 60px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        .login-header {
            margin-bottom: 35px;
        }


        .login-header h2 {

            font-size: 30px;
            margin-bottom: 8px;
        }


        .login-header p {

            color: #777;
            font-size: 14px;
        }


        /* =========================
           FORM
        ========================= */

        .form-group {

            margin-bottom: 20px;
        }


        .form-group label {

            display: block;

            font-size: 14px;
            font-weight: 600;

            margin-bottom: 8px;
        }


        .form-control {

            width: 100%;

            padding: 14px 15px;

            border: 1px solid #ddd;

            border-radius: 7px;

            font-size: 14px;

            outline: none;

            transition: 0.3s;
        }


        .form-control:focus {

            border-color: #087443;

            box-shadow:
                0 0 0 3px rgba(8, 116, 67, 0.08);
        }


        .password-wrapper {

            position: relative;
        }


        .password-wrapper .form-control {

            padding-right: 50px;
        }


        .toggle-password {

            position: absolute;

            right: 15px;
            top: 50%;

            transform: translateY(-50%);

            border: none;
            background: transparent;

            cursor: pointer;

            color: #777;

            font-size: 13px;
        }


        /* =========================
           FORM OPTIONS
        ========================= */

        .form-options {

            display: flex;

            align-items: center;
            justify-content: space-between;

            margin-bottom: 25px;

            font-size: 13px;
        }


        .remember {

            display: flex;

            align-items: center;

            gap: 7px;

            color: #555;
        }


        .remember input {

            accent-color: #087443;
        }


        .forgot-password {

            color: #087443;
            font-weight: 600;
        }


        /* =========================
           LOGIN BUTTON
        ========================= */

        .login-button {

            width: 100%;

            padding: 14px;

            border: none;

            border-radius: 7px;

            background: #087443;

            color: white;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.3s;
        }


        .login-button:hover {

            background: #065c35;
        }


        /* =========================
           BACK HOME
        ========================= */

        .back-home {

            text-align: center;

            margin-top: 25px;

            font-size: 13px;
        }


        .back-home a {

            color: #087443;

            font-weight: 600;
        }


        /* =========================
           SECURITY NOTE
        ========================= */

        .security-note {

            margin-top: 35px;

            padding: 13px 15px;

            background: #f5f8f6;

            border-radius: 7px;

            font-size: 12px;

            color: #777;

            text-align: center;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {

            .login-wrapper {

                grid-template-columns: 1fr;

                max-width: 500px;
            }

            .login-left {

                min-height: 300px;

                padding: 40px;
            }

            .login-left h1 {

                font-size: 32px;
            }

            .left-footer {

                margin-top: 30px;
            }

            .login-right {

                padding: 40px;
            }
        }


        @media (max-width: 500px) {

            body {

                align-items: flex-start;
            }

            .login-wrapper {

                margin: 0;

                min-height: 100vh;

                border-radius: 0;

                box-shadow: none;
            }

            .login-left {

                padding: 35px 25px;

                min-height: 280px;
            }

            .login-right {

                padding: 35px 25px;
            }

            .login-left h1 {

                font-size: 28px;
            }

            .login-header h2 {

                font-size: 26px;
            }

            .form-options {

                flex-direction: column;

                align-items: flex-start;

                gap: 12px;
            }
        }

    </style>
</head>


<body>


    <div class="login-wrapper">


        <!-- =========================
             LEFT
        ========================= -->

        <div class="login-left">

            <div class="logo-area">

                <img src="{{ asset('Assets/Image/logo_simpuldasi.png') }}" alt="" width="40px" height="auto">
                {{-- <div class="logo-icon">
                </div> --}}

                <div class="logo-text">

                    <strong>
                        Kelurahan Binong
                    </strong>

                    <span>
                        Website Resmi Kelurahan
                    </span>

                </div>

            </div>


            <h1>
                Portal SIMPULDASI
            </h1>


            <p>
                Selamat datang di Sistem Pengumpulan Data Terintegrasi (SIMPULDASI).
                Silakan masuk menggunakan akun terverifikasi untuk
                mengakses sistem pelayanan dan administrasi.
            </p>


            <div class="left-footer">

                Sistem Pengumpulan Data Terintegrasi (SIMPULDASI)

            </div>

        </div>



        <!-- =========================
             RIGHT
        ========================= -->

        <div class="login-right">

@if(session('success'))

    <div style="
        background:#e8f7ee;
        color:#087443;
        padding:12px 15px;
        border-radius:7px;
        margin-bottom:20px;
        font-size:13px;
    ">
        {{ session('success') }}
    </div>

@endif


@if($errors->any())

    <div style="
        background:#fff1f1;
        color:#c62828;
        padding:12px 15px;
        border-radius:7px;
        margin-bottom:20px;
        font-size:13px;
    ">
        {{ $errors->first() }}
    </div>

@endif
            <div class="login-header">

                <h2>
                    Login Sistem
                </h2>

                <p>
                    Masukkan akun Anda untuk melanjutkan.
                </p>

            </div>



            <!-- =========================
                 LOGIN FORM
            ========================= -->

          <form action="{{ route('login.process') }}" method="POST">

    @csrf

    <div class="form-group">

        <label for="email">
            Email / Username
        </label>

        <input
            type="text"
            id="email"
            name="email"
            class="form-control"
            placeholder="Masukkan email atau username"
            autocomplete="username"
            value="{{ old('email') }}"
            required
        >

        @error('email')
            <small style="display:block; color:#dc3545; margin-top:6px;">
                {{ $message }}
            </small>
        @enderror

    </div>


    <div class="form-group">

        <label for="password">
            Password
        </label>

        <div class="password-wrapper">

            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
            >

            <button
                type="button"
                class="toggle-password"
                onclick="togglePassword()"
            >
                Lihat
            </button>

        </div>

        @error('password')
            <small style="display:block; color:#dc3545; margin-top:6px;">
                {{ $message }}
            </small>
        @enderror

    </div>


    <div class="form-options">

        <label class="remember">

            <input
                type="checkbox"
                name="remember"
                value="1"
                {{ old('remember') ? 'checked' : '' }}
            >

            Ingat saya

        </label>


        <a
            href="#"
            class="forgot-password"
        >
            Lupa password?
        </a>

    </div>


    <button
        type="submit"
        class="login-button"
    >
        Masuk ke Portal
    </button>

</form>



            <!-- =========================
                 BACK HOME
            ========================= -->

            <div class="back-home">

                <a href="index.html">
                    ← Kembali ke halaman utama
                </a>

            </div>



            <!-- =========================
                 SECURITY
            ========================= -->

            <div class="security-note">

                🔒 Akses ini khusus untuk akun yang ditunjuk oleh Pihak Kelurahan.

            </div>


        </div>

    </div>



    <!-- =========================
         JAVASCRIPT
    ========================= -->

    <script>

        function togglePassword() {

            const password =
                document.getElementById("password");

            const button =
                document.querySelector(".toggle-password");


            if (password.type === "password") {

                password.type = "text";

                button.textContent = "Sembunyikan";

            } else {

                password.type = "password";

                button.textContent = "Lihat";

            }

        }

    </script>


</body>

</html>
