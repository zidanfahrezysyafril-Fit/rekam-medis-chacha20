<!-- resources/views/emails/otp.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: #fff; max-width: 500px; margin: auto; padding: 30px; border-radius: 8px; }
        .otp-box { font-size: 36px; font-weight: bold; letter-spacing: 10px; color: #4F46E5;
                   text-align: center; padding: 20px; background: #f0f0ff; border-radius: 8px; margin: 20px 0; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo, {{ $userName }}!</h2>
        <p>Gunakan kode OTP berikut untuk verifikasi email kamu:</p>

        <div class="otp-box">{{ $otp }}</div>

        <p>Kode ini berlaku selama <strong>5 menit</strong>.</p>
        <p>Jika kamu tidak merasa mendaftar, abaikan email ini.</p>

        <div class="footer">
            &copy; {{ date('Y') }} RekamMedis. All rights reserved.
        </div>
    </div>
</body>
</html>