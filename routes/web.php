<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    // Simulasi Login Backend Sementara
    $credentials = $request->only('username', 'password');

    if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin') {
        // Login Sukses
        return redirect('/dashboard');
    }

    // Login Gagal
    return back()->with('error', 'maaf password dan usernmae anda salah');
})->name('login.submit');

Route::get('/dashboard', function () {
    return "<h1>Dashboard Coming Soon</h1>";
})->name('dashboard');

// Reset Password Routes
Route::get('/forgot-password', function () {
    return view('auth.reset-password');
})->name('password.request');

Route::post('/forgot-password', function (\Illuminate\Http\Request $request) {
    // Validasi sederhana (match password)
    $request->validate([
        'password' => 'required|confirmed',
    ]);

    // Simulasi Update Database...

    // Redirect ke Login dengan Pesan Sukses
    return redirect()->route('login')->with('success', 'password berhasil terupdate');
})->name('password.update');

// Dashboard & Logout
Route::get('/dashboard', function () {
    return view('dashboard.index'); // Updated to use the new Blade view
})->name('dashboard');

Route::get('/my-documents', function () {
    return view('documents.index');
})->name('documents.index');

Route::get('/document-detail', function () {
    return view('documents.show');
})->name('documents.show');

Route::get('/documents/create', function () {
    return view('documents.create');
})->name('documents.create');

Route::post('/logout', function () {
    // Simulasi Logout
    return redirect()->route('login');
})->name('logout');
