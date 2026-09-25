<?php

// app/Http/Controllers/Auth/RegisteredUserController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpVerificationMail;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;


class RegisteredUserController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $hash = hash_hmac('sha256', $value, config('app.key'));
                    if (\App\Models\User::where('email_hash', $hash)->exists()) {
                        $fail('The email has already been taken.');
                    }
                }
            ],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'in:patient'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otp = (string) random_int(100000, 999999);

        $emailHash = hash_hmac('sha256', $request->email, config('app.key'));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_hash' => $emailHash,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        try {
            Mail::to($user->email)->send(new OtpVerificationMail($otp, $user->name));
        } catch (\Exception $e) {
            // Log mail failure without crashing registration
            \Illuminate\Support\Facades\Log::warning('OTP Mail delivery failed: ' . $e->getMessage());
        }

        session(['otp_user_id' => $user->id]);

        return redirect()->route('otp.verify')->with('info', 'Kode OTP telah dikirimkan ke email Anda.');
    }
}