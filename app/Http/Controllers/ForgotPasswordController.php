<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\ResetPasswordOtp;

class ForgotPasswordController extends Controller
{
    // 1. Show Form Input Email
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // 2. Process Email & Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email_user',
        ], [
            'email.exists' => 'Email tidak terdaftar dalam sistem.',
        ]);

        $email = $request->email;

        // Generate 6 Digit OTP
        $otp = rand(100000, 999999);

        // Store in password_reset_tokens table
        // Delete existing token for this email first
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $otp, // We store OTP directly here (safe enough for this use case compared to hashed token, as it expires fast)
            'created_at' => Carbon::now()
        ]);

        // Send Email
        try {
            Mail::to($email)->send(new ResetPasswordOtp($otp));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi. ' . $e->getMessage());
        }

        // Store email in session for next step
        session(['reset_email' => $email]);

        return redirect()->route('password.verify_otp')->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    // 3. Show Form Input OTP
    public function showVerifyOtpForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-otp');
    }

    // 4. Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $email = session('reset_email');
        $otp = $request->otp;

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $otp)
            ->first();

        if (!$record) {
            return back()->with('error', 'Kode OTP salah atau telah kadaluarsa.');
        }

        // Check expiration (e.g., 15 minutes)
        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            return back()->with('error', 'Kode OTP telah kadaluarsa. Silakan minta ulang.');
        }

        // OTP Valid - Allow Password Reset
        // Store verification flag in session
        session(['otp_verified' => true]);

        return redirect()->route('password.reset');
    }

    // 5. Show Reset Password Form
    public function showResetForm()
    {
        if (!session('reset_email') || !session('otp_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    // 6. Process Reset Password
    public function reset(Request $request)
    {
        if (!session('reset_email') || !session('otp_verified')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => 'required|confirmed|min:6',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);

        $email = session('reset_email');

        $user = User::where('email_user', $email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        // Cleanup
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        $request->session()->forget(['reset_email', 'otp_verified']);

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
    }
}
