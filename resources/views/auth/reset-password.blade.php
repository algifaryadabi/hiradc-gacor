<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #d32f2f;
            /* Semen Padang Red */
            --primary-dark: #b71c1c;
            --secondary-color: #1a202c;
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

        /* Left Side - Branding (Same as Login) */
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
            overflow: hidden;
        }

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
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            padding: 40px;
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

        .form-control {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
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

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #718096;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: var(--primary-color);
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
        <!-- Bagian Kiri -->
        <div class="login-left">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="brand-content">
                <div class="brand-logo-container">
                    <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP" class="brand-logo-img"
                        onerror="this.style.display='none'; this.parentElement.innerText='SP'">
                </div>
                <h1 class="brand-title">PT Semen Padang</h1>
                <p class="brand-subtitle">Sistem Manajemen Identifikasi Bahaya, Penilaian Risiko, dan Penetapan
                    Pengendalian (HIRADC)</p>
            </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="login-right">
            <div class="login-card">
                <div class="form-header">
                    <h2>Reset Password</h2>
                    <p>Masukkan password baru Anda.</p>
                </div>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <label for="password">Password Baru</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password baru" required autofocus>
                            <span class="input-icon">🔒</span>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <div class="input-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Konfirmasi password baru" required>
                            <span class="input-icon">🔐</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Simpan Password</button>

                    <a href="{{ route('login') }}" class="back-link">Kembali ke Login</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>