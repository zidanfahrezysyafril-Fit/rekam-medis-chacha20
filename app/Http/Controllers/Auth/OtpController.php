<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $user = User::find(session('otp_user_id'));

        if (!$user) {
            return redirect()->route('register')
                ->withErrors(['otp' => 'Sesi tidak valid. Silakan daftar ulang.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan kirim ulang.']);
        }

        if ($user->otp_code !== $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid.']);
        }

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
        $user = User::find(session('otp_user_id'));

        if (!$user) {
            return redirect()->route('register')
                ->withErrors(['otp' => 'Sesi tidak valid. Silakan daftar ulang.']);
        }

        $otp = (string) random_int(100000, 999999);

        $user->update([
            'otp_code'       => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($user->email)->send(new OtpVerificationMail($otp, $user->name));

        return back()->with('success', 'Kode OTP baru telah dikirim ke email kamu.');
    }
}