<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.submit');

    Route::get('/forgot-password', function () {
        return view('auth.reset-password');
    })->name('password.request');

    Route::post('/forgot-password', function (\Illuminate\Http\Request $request) {
        $request->validate(['password' => 'required|confirmed']);
        return redirect()->route('login')->with('success', 'Password berhasil diupdate');
    })->name('password.update');
});

// Protected Routes (Auth required)
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard (redirect based on role)
    Route::get('/dashboard', function () {
        return redirect()->route(Auth::user()->getDashboardRoute());
    })->name('dashboard');

    // ==================== USER / PEKERJA ROUTES ====================
    Route::get('/user/dashboard', function () {
        $user = Auth::user();

        // Count revisions for sidebar badge
        $revisionCount = \App\Models\Document::where('id_user', $user->id_user)
            ->where('status', 'revision')
            ->count();
        view()->share('revisionCount', $revisionCount);

        // Load dropdown data from database
        $direktorats = \App\Models\Direktorat::where('status_aktif', 1)->get();
        $departemens = \App\Models\Departemen::all();
        $units = \App\Models\Unit::all();
        $seksis = \App\Models\Seksi::all();

        // Load published documents (General View)
        $documents = \App\Models\Document::published()
            ->with(['user', 'unit'])
            ->orderBy('published_at', 'desc')
            ->get();

        // Load MY pending/revision/draft documents
        $myPending = \App\Models\Document::where('id_user', $user->id_user)
            ->whereIn('status', ['pending_level1', 'pending_level2', 'pending_level3'])
            ->with([
                'approvals' => function ($q) {
                    $q->latest();
                }
            ])
            ->orderBy('updated_at', 'desc')
            ->get();

        $myRevision = \App\Models\Document::where('id_user', $user->id_user)
            ->where('status', 'revision')
            ->with([
                'approvals' => function ($q) {
                    $q->latest();
                }
            ])
            ->orderBy('updated_at', 'desc')
            ->get();

        $myDraft = \App\Models\Document::where('id_user', $user->id_user)
            ->where('status', 'draft')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('user.dashboard', compact('documents', 'myPending', 'myRevision', 'myDraft', 'user', 'direktorats', 'departemens', 'units', 'seksis'));
    })->name('user.dashboard');

    // Document CRUD for users
    Route::get('/my-documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::post('/documents/{document}/submit', [DocumentController::class, 'submit'])->name('documents.submit');

    // ==================== APPROVER (KEPALA UNIT) ROUTES ====================
    Route::get('/approver/dashboard', [DocumentController::class, 'approverDashboard'])->name('approver.dashboard');

    Route::get('/approver/check-documents', [DocumentController::class, 'pendingApproval'])->name('approver.check_documents');
    Route::get('/approver/documents/{document}/review', [DocumentController::class, 'review'])->name('approver.review');
    Route::post('/approver/documents/{document}/approve', [DocumentController::class, 'approve'])->name('approver.approve');
    Route::post('/approver/documents/{document}/revise', [DocumentController::class, 'revise'])->name('approver.revise');

    // ==================== UNIT PENGELOLA (SHE/KEAMANAN) ROUTES ====================

    Route::get('/unit-pengelola/dashboard', [DocumentController::class, 'unitPengelolaDashboard'])->name('unit_pengelola.dashboard');

    Route::get('/unit-pengelola/check-documents', function () {
        $user = Auth::user();

        // Verify user is Kepala Unit from SHE or Security
        if ($user->id_role_jabatan != 3 || !in_array($user->id_unit, [55, 56])) {
            abort(403, 'Akses ditolak. Hanya Kepala Unit SHE/Security yang dapat mengakses halaman ini.');
        }

        // Filter documents by category based on user's unit
        $categoryFilter = [];
        if ($user->id_unit == 56) {
            // SHE unit: K3, KO, Lingkungan
            $categoryFilter = ['K3', 'KO', 'Lingkungan'];
        } elseif ($user->id_unit == 55) {
            // Security unit: Keamanan
            $categoryFilter = ['Keamanan'];
        }

        $documents = \App\Models\Document::where('current_level', 2)
            ->where('status', 'pending_level2')
            ->whereIn('kategori', $categoryFilter)
            ->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('unit_pengelola.documents.index', compact('documents'));
    })->name('unit_pengelola.check_documents');

    Route::get('/unit-pengelola/documents/{document}/review', [DocumentController::class, 'review'])->name('unit_pengelola.review');
    Route::post('/unit-pengelola/documents/{document}/approve', [DocumentController::class, 'approve'])->name('unit_pengelola.approve');
    Route::post('/unit-pengelola/documents/{document}/revise', [DocumentController::class, 'revise'])->name('unit_pengelola.revise');

    // ==================== KEPALA DEPARTEMEN ROUTES ====================
    Route::get('/kepala-departemen/dashboard', function () {
        $user = Auth::user();
        $pendingDocuments = \App\Models\Document::where('current_level', 3)
            ->where('status', 'pending_level3')
            ->where('id_dept', $user->id_dept)
            ->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingCount = $pendingDocuments->count();

        $publishedDocuments = \App\Models\Document::published()
            ->with(['user', 'unit'])
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();

        $direktorats = \App\Models\Direktorat::where('status_aktif', 1)->get();
        $departemens = \App\Models\Departemen::all();
        $units = \App\Models\Unit::all();

        return view('kepala_departemen.dashboard', compact('user', 'pendingCount', 'pendingDocuments', 'publishedDocuments', 'direktorats', 'departemens', 'units'));
    })->name('kepala_departemen.dashboard');

    Route::get('/kepala-departemen/check-documents', function () {
        $user = Auth::user();
        $documents = \App\Models\Document::where('current_level', 3)
            ->where('status', 'pending_level3')
            ->where('id_dept', $user->id_dept)
            ->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('kepala_departemen.review', compact('documents'));
    })->name('kepala_departemen.check_documents');

    Route::get('/kepala-departemen/documents/{document}/review', [DocumentController::class, 'review'])->name('kepala_departemen.review');
    Route::post('/kepala-departemen/documents/{document}/approve', [DocumentController::class, 'approve'])->name('kepala_departemen.approve');
    Route::post('/kepala-departemen/documents/{document}/revise', [DocumentController::class, 'revise'])->name('kepala_departemen.revise');

    // ==================== ADMIN ROUTES ====================
    Route::get('/admin/dashboard', function () {
        $user = Auth::user();
        $totalDocuments = \App\Models\Document::count();
        $publishedDocuments = \App\Models\Document::published()->count();
        $pendingDocuments = \App\Models\Document::whereIn('status', ['pending_level1', 'pending_level2', 'pending_level3'])->count();

        $documents = \App\Models\Document::published()
            ->with(['user', 'unit'])
            ->orderBy('published_at', 'desc')
            ->limit(20)
            ->get();

        return view('admin.dashboard', compact('user', 'totalDocuments', 'publishedDocuments', 'pendingDocuments', 'documents'));
    })->name('admin.dashboard');

    Route::get('/admin/users', function () {
        $users = \App\Models\User::all();
        return view('admin.users.index', compact('users'));
    })->name('admin.users');

    Route::get('/admin/master', function () {
        return view('admin.master');
    })->name('admin.master');
});
