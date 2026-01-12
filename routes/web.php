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
        // Login Sukses Admin
        return redirect('/dashboard');
    } elseif ($credentials['username'] === 'pekerja' && $credentials['password'] === 'pekerja') {
        // Login Sukses Pekerja
        // Simulate Auth login for blade checks (Optional, mostly frontend simulation)
        // In real app: Auth::login(...)
        return redirect()->route('user.dashboard');
    }

    // Login Gagal
    return back()->with('error', 'maaf password dan usernmae anda salah');
})->name('login.submit');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

// User / Pekerja Routes
Route::get('/user/dashboard', function () {
    // Mock Data for Worker Dashboard
    $documents = collect([
        (object) [
            'id' => 101,
            'title' => 'Identifikasi Bahaya Area Produksi A',
            'type' => (object) ['name' => 'K3', 'code' => 'K3'],
            'published_at' => now()->subDays(2),
            'risk_level' => 'Tinggi',
            'hazard' => 'Kebisingan Mesin',
            'control' => 'Penggunaan Earplug dan Rotasi Shift'
        ],
        (object) [
            'id' => 102,
            'title' => 'Prosedur Keselamatan Gudang B3',
            'type' => (object) ['name' => 'Lingkungan', 'code' => 'Lingkungan'],
            'published_at' => now()->subDays(5),
            'risk_level' => 'Sedang',
            'hazard' => 'Tumpahan Bahan Kimia',
            'control' => 'Penyediaan Spill Kit dan SOP Penanganan'
        ],
        (object) [
            'id' => 103,
            'title' => 'Evaluasi Keamanan Pos Utama',
            'type' => (object) ['name' => 'Keamanan', 'code' => 'Keamanan'],
            'published_at' => now()->subWeeks(1),
            'risk_level' => 'Rendah',
            'hazard' => 'Akses Ilegal',
            'control' => 'Pemasangan CCTV dan Patroli Rutin'
        ]
    ]);

    return view('user.dashboard', compact('documents'));
})->name('user.dashboard');

Route::get('/user/documents/{id}', function ($id) {
    // Mock Detail View (reusing show or simple return for now)
    return view('user.documents.show', ['id' => $id]);
})->name('user.documents.show');

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
    return view('user.documents.index');
})->name('documents.index');

Route::get('/document-detail', function () {
    return view('user.documents.show');
})->name('documents.show');

Route::get('/documents/create', function () {
    return view('user.documents.create');
})->name('documents.create');

Route::post('/logout', function () {
    // Simulasi Logout
    return redirect()->route('login');
})->name('logout');

// Approver Routes
Route::get('/approver/dashboard', function () {
    return view('approver.dashboard');
})->name('approver.dashboard');

Route::get('/approver/check-documents', function () {
    return view('approver.documents.index');
})->name('approver.check_documents');

Route::get('/approver/documents/review', function () {
    return view('approver.documents.review');
})->name('approver.review');

// Unit Pengelola Routes
Route::get('/unit-pengelola/dashboard', function () {
    return view('unit_pengelola.dashboard');
})->name('unit_pengelola.dashboard');

Route::get('/unit-pengelola/check-documents', function () {
    return view('unit_pengelola.documents.index');
})->name('unit_pengelola.check_documents');

Route::get('/unit-pengelola/documents/review', function () {
    return view('unit_pengelola.documents.review');
})->name('unit_pengelola.review');

// Kepala Departemen Routes
Route::get('/kepala-departemen/dashboard', function () {
    return view('kepala_departemen.dashboard');
})->name('kepala_departemen.dashboard');

Route::get('/kepala-departemen/check-documents', function () {
    return view('kepala_departemen.documents.index');
})->name('kepala_departemen.check_documents');

Route::get('/kepala-departemen/documents/review', function () {
    return view('kepala_departemen.documents.review'); // Create this view if not exists, or re-use logic
    // Wait, I haven't created kepala_departemen/documents/review.blade.php yet? I did create dashboard and index in Step 656 summary.
    // I need to ensure the view exists later. For now, route is fine.
})->name('kepala_departemen.review');

// Alias specifically for 'documents' if user used that link
Route::get('/documents', function () {
    return view('user.documents.index');
});
