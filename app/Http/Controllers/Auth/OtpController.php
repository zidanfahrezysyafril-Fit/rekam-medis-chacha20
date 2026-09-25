<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class OtpController extends Controller
{
    public function show()
    {
        if (!session('otp_user_id')) {
            return redirect()->route('register');
        }

        return view('auth.otp-verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $userId = session('otp_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('register')
                ->withErrors(['otp' => 'Sesi tidak valid. Silakan daftar ulang.']);
        }

        // Brute force protection on OTP verification
        $throttleKey = 'otp-verify:' . $user->id . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors(['otp' => "Terlalu banyak percobaan verifikasi OTP. Silakan coba lagi dalam {$seconds} detik."]);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa (berlaku 5 menit). Silakan klik Kirim Ulang.']);
        }

        if ($user->otp_code !== $request->otp) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withErrors(['otp' => 'Kode OTP tidak valid.']);
        }

        RateLimiter::clear($throttleKey);

        $user->update([
            'email_verified_at' => now(),
            'otp_code'          => null,
            'otp_expires_at'    => null,
        ]);

        session()->forget('otp_user_id');

        return redirect()->route('login')
            ->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }

    public function resend()
    {
        $userId = session('otp_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('register')
                ->withErrors(['otp' => 'Sesi tidak valid. Silakan daftar ulang.']);
        }

        // Rate limit OTP resend requests (max 3 times per minute)
        $resendKey = 'otp-resend:' . $user->id . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($resendKey, 3)) {
            $seconds = RateLimiter::availableIn($resendKey);
            return back()->withErrors(['otp' => "Terlalu banyak permintaan kirim ulang. Silakan tunggu {$seconds} detik."]);
        }

        RateLimiter::hit($resendKey, 60);

        $otp = (string) random_int(100000, 999999);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        try {
            Mail::to($user->email)->send(new OtpVerificationMail($otp, $user->name));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('OTP Resend Mail failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Kode OTP baru (berlaku 5 menit) telah dikirim ke email Anda.');
    }
}