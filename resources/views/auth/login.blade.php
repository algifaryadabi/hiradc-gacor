<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #d32f2f;
            /* Semen Padang Red */
            --primary-dark: #b71c1c;
            --secondary-color: #1a202c;
            --accent-color: #ffc107;
            --text-color: #333;
            --bg-color: #f7fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            height: 100vh;
            overflow: hidden;
            background-color: var(--bg-color);
        }

        .login-container {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        /* Left Side - Branding */
        .login-left {
            flex: 1.2;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            overflow: hidden;
            color: white;
            text-align: center;
        }

        /* Abstract shapes for premium feel */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }

        .shape-1 {
            width: 500px;
            height: 500px;
            top: -150px;
            left: -150px;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            bottom: -50px;
            right: -50px;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            top: 20%;
            right: 20%;
            opacity: 0.2;
        }

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .brand-logo-container {
            width: 150px;
            height: 150px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            font-size: 60px;
            font-weight: bold;
            color: var(--primary-color);
            position: relative;
            overflow: hidden;
        }

        /* Placeholder for Logo if image fails */
        .brand-logo-img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }

        .brand-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .brand-subtitle {
            font-size: 18px;
            opacity: 0.9;
            max-width: 600px;
            line-height: 1.6;
            font-weight: 300;
        }

        /* Right Side - Form */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            padding: 40px;
            position: relative;
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            padding: 40px;
            /* Glassy effect on white background? neat but subtle here */
        }

        .form-header {
            margin-bottom: 40px;
            text-align: left;
        }

        .form-header h2 {
            font-size: 36px;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .form-header p {
            color: #718096;
            font-size: 16px;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            /* Larger text inputs */
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 4px rgba(211, 47, 47, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 20px;
            transition: color 0.3s;
        }

        .input-icon-right {
            left: auto;
            right: 18px;
            cursor: pointer;
        }

        .form-control:focus+.input-icon,
        .form-control:focus~.input-icon {
            color: var(--primary-color);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(to right, #d32f2f, #b71c1c);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 5px 15px rgba(211, 47, 47, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(211, 47, 47, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .extra-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .forgot-pass {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-pass:hover {
            text-decoration: underline;
        }

        /* Error Message Styling */
        .error-message {
            background-color: #fff5f5;
            color: #c53030;
            padding: 15px;
            border-radius: 10px;
            border-left: 5px solid #fc8181;
            margin-bottom: 25px;
            display: none;
            /* Hidden by default */
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 500;
            animation: shake 0.5s cubic-bezier(.36, .07, .19, .97) both;
        }

        @keyframes shake {

            10%,
            90% {
                transform: translate3d(-1px, 0, 0);
            }

            20%,
            80% {
                transform: translate3d(2px, 0, 0);
            }

            30%,
            50%,
            70% {
                transform: translate3d(-4px, 0, 0);
            }

            40%,
            60% {
                transform: translate3d(4px, 0, 0);
            }
        }

        /* Responsive */
        @media (max-width: 900px) {
            .login-left {
                display: none;
            }

            .login-right {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Bagian Kiri: Branding PT Semen Padang -->
        <div class="login-left">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>

            <div class="brand-content">
                <div class="brand-logo-container">
                    <!-- Placeholder untuk Logo. Ganti src dengan path logo asli jika ada -->
                    <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP" class="brand-logo-img"
                        onerror="this.style.display='none'; this.parentElement.innerText='SP'">
                </div>
                <h1 class="brand-title">PT Semen Padang</h1>
                <p class="brand-subtitle">Sistem Manajemen Identifikasi Bahaya, Penilaian Risiko, dan Penetapan
                    Pengendalian (HIRADC)</p>
            </div>
        </div>

        <!-- Bagian Kanan: Login Form -->
        <div class="login-right">
            <div class="login-card">
                <div class="form-header">
                    <h2>Selamat Datang!</h2>
                    <p>Silakan login untuk mengakses dashboard.</p>
                </div>

                <!-- Pesan Error Custom -->
                <div id="custom-error" class="error-message">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert" style="background-color: #f0fff4; color: #2f855a; border: 1px solid #68d391;">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <!-- Kita gunakan onsubmit untuk handling interaktif di frontend -->
                <form id="loginForm" action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Masukkan username" required autofocus>
                            <span class="input-icon">👤</span>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password" required style="padding-right: 50px;">
                            <span class="input-icon input-icon-right" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="extra-links" style="justify-content: flex-end;">
                        <a href="{{ route('password.request') }}" class="forgot-pass">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn-submit">Masuk Aplikasi</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function (e) {
            // Optional: Add custom validation logic here if needed
            // e.preventDefault(); 
        });

        // Cek jika ada error dari Laravel Session (Backend Real)
        @if(session('error') || $errors->any())
            const errorElement = document.getElementById('custom-error');
            errorElement.style.display = 'flex';
        @endif
    </script>
</body>

</html>