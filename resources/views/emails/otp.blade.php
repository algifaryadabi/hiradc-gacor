<!DOCTYPE html>
<html>

<head>
    <title>Reset Password OTP</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #d32f2f;">Reset Password Request</h2>
        <p>Halo,</p>
        <p>Kami menerima permintaan untuk mereset password akun Anda di HIRADC PT Semen Padang.</p>
        <p>Gunakan kode OTP berikut untuk melanjutkan proses reset password:</p>

        <div style="background-color: #f4f4f4; padding: 15px; text-align: center; border-radius: 5px; margin: 20px 0;">
            <span style="font-size: 24px; font-weight: bold; letter-spacing: 5px; color: #333;">{{ $otp }}</span>
        </div>

        <p>Kode ini akan kadaluarsa dalam 15 menit.</p>
        <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>

        <br>
        <p>Terima kasih,<br>Tim HIRADC</p>
    </div>
</body>

</html>