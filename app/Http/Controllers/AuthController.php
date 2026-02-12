<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function login()
    {
        // If already logged in, redirect to dashboard
        if (Auth::check()) {
            return redirect()->route(Auth::user()->getDashboardRoute());
        }

        return view('auth.login');
    }

    /**
     * Handle login attempt
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->has('remember');

        // Find user by email (case-insensitive)
        // We use whereRaw to ensure it works even if DB has Uppercase and input is Lowercase
        $user = User::whereRaw('LOWER(email_user) = ?', [strtolower($email)])->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Check if user is active
        if (!$user->isActive()) {
            return back()->with('error', 'Akun Anda dinonaktifkan. Silakan hubungi administrator.');
        }

        // Verify password - check both hashed and plain text (for legacy data)
        $passwordValid = false;

        // Try hashed password first
        if (password_verify($password, $user->password)) {
            $passwordValid = true;
        }
        // Fallback: check plain text password (for legacy data)
        elseif ($password === $user->password) {
            $passwordValid = true;
        }

        if (!$passwordValid) {
            return back()->with('error', 'Password salah.');
        }

        // Login the user
        Auth::login($user, $remember);
        $request->session()->regenerate();

        // Redirect based on user role
        return redirect()->intended(
            route($user->getDashboardRoute())
        );
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
