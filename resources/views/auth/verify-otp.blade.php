<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #d32f2f;
            --primary-dark: #b71c1c;
            --bg-color: #f7fafc;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .auth-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .auth-icon {
            font-size: 50px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 10px;
            color: #333;
        }

        p {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .otp-input {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 24px;
            text-align: center;
            letter-spacing: 10px;
            font-weight: bold;
            box-sizing: border-box;
            transition: all 0.3s;
        }

        .otp-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
        }

        .alert-success {
            background-color: #f0fff4;
            color: #2f855a;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #68d391;
            font-size: 14px;
        }

        .alert-error {
            background-color: #fff5f5;
            color: #c53030;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <div class="auth-icon">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h2>Masukkan Kode OTP</h2>
        <p>Kode OTP telah dikirim ke: <strong>{{ session('reset_email') }}</strong></p>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('password.verify_otp.submit') }}" method="POST">
            @csrf

            <input type="text" name="otp" class="otp-input" placeholder="000000" maxlength="6" pattern="\d{6}" required
                autofocus autocomplete="off">

            <button type="submit" class="btn-submit">Verifikasi OTP</button>
        </form>

        <form action="{{ route('password.email') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <input type="hidden" name="email" value="{{ session('reset_email') }}">
            <button type="submit"
                style="background: none; border: none; color: #666; cursor: pointer; text-decoration: underline;">Kirim
                Ulang Kode</button>
        </form>
    </div>

</body>

</html>