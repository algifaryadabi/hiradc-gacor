<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserManagementController;
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

    // OTP Password Reset Routes
    Route::get('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'sendOtp'])->name('password.email');

    Route::get('/verify-otp', [App\Http\Controllers\ForgotPasswordController::class, 'showVerifyOtpForm'])->name('password.verify_otp');
    Route::post('/verify-otp', [App\Http\Controllers\ForgotPasswordController::class, 'verifyOtp'])->name('password.verify_otp.submit');

    Route::get('/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'reset'])->name('password.update');
});

// Protected Routes (Auth required)
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard (redirect based on role)
    Route::get('/dashboard', function () {
        return redirect()->route(Auth::user()->getDashboardRoute());
    })->name('dashboard');

    // Published Document Detail (Unified View)
    Route::get('/documents/{document}/published', [DocumentController::class, 'showPublished'])->name('documents.published');

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
        // Load published documents (General View)
        $rawDocuments = \App\Models\Document::published()
            ->with(['user', 'unit', 'approvals.approver'])
            ->orderBy('published_at', 'desc')
            ->get();

        $documents = $rawDocuments->map(function ($doc) {
            // Find Level 3 Approver (Kepala Departemen)
            $approverName = '-';
            $approvalNote = '-';
            $approvalDate = $doc->published_at ? $doc->published_at->format('d M Y') : '-';

            $lastApproval = $doc->approvals->sortByDesc('created_at')->first();
            if ($lastApproval) {
                $approverName = $lastApproval->approver->nama_user ?? 'Unknown';
                $approvalNote = $lastApproval->catatan ?? '-';
            }

            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'category' => $doc->kategori,
                'date' => $doc->published_at ? $doc->published_at->format('d M Y') : $doc->created_at->format('d M Y'),
                'time' => $doc->published_at ? $doc->published_at->format('H:i') . ' WIB' : $doc->created_at->format('H:i') . ' WIB',
                'author' => $doc->user->nama_user ?? 'Unknown',
                'approver' => $approverName,
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'status' => 'DISETUJUI',
                'risk_level' => $doc->risk_level ?? 'Normal',
                'approval_date' => $approvalDate,
                'approval_note' => $approvalNote
            ];
        });

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
    Route::get('/documents/export/pdf', [DocumentController::class, 'exportPdf'])->name('documents.export.pdf');
    Route::get('/documents/export/excel', [DocumentController::class, 'exportExcel'])->name('documents.export.excel');

    // Detail Export
    Route::get('/documents/{document}/export/pdf', [DocumentController::class, 'exportDetailPdf'])->name('documents.export.detail.pdf');
    Route::get('/documents/{document}/export/excel', [DocumentController::class, 'exportDetailExcel'])->name('documents.export.detail.excel');

    Route::get('/my-documents/summary', [DocumentController::class, 'summary'])->name('documents.summary');
    Route::get('/my-documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::post('/documents/{document}/submit', [DocumentController::class, 'submit'])->name('documents.submit');

    // ==================== APPROVER (KEPALA UNIT) ROUTES ====================
    Route::get('/approver/dashboard', [DocumentController::class, 'approverDashboard'])->name('approver.dashboard');
    Route::get('/approver/dashboard/data', [DocumentController::class, 'getApproverDashboardData'])->name('approver.dashboard.data');

    Route::get('/approver/check-documents', [DocumentController::class, 'pendingApproval'])->name('approver.check_documents');
    Route::get('/approver/documents/{document}/review', [DocumentController::class, 'review'])->name('approver.review');
    Route::post('/approver/documents/{document}/approve', [DocumentController::class, 'approve'])->name('approver.approve');
    Route::post('/approver/documents/{document}/revise', [DocumentController::class, 'revise'])->name('approver.revise');
    Route::post('/approver/update-pic', [DocumentController::class, 'updatePIC'])->name('approver.update_pic');
    Route::post('/approver/documents/update-detail/{id}', [DocumentController::class, 'updateDetail'])->name('approver.update_detail');
    Route::get('/approver/documents/get-item-html/{id}', [DocumentController::class, 'getEditItemHtml'])->name('approver.get_edit_item');
    Route::get('/approver/documents/{id}/status', [DocumentController::class, 'getStatus'])->name('approver.get_status');


    // ==================== UNIT PENGELOLA (SHE/KEAMANAN) ROUTES ====================
    // Kepala Unit Pengelola - Document Management
    Route::get('/unit-pengelola/documents', [DocumentController::class, 'unitPengelolaPending'])->name('unit_pengelola.check_documents');
    Route::get('/unit-pengelola/documents/{document}/review', [DocumentController::class, 'reviewUnit'])->name('unit_pengelola.review');

    // Staff Unit Pengelola - Inbox and Actions
    Route::get('/unit-pengelola/staff/inbox', [DocumentController::class, 'staffIndex'])->name('unit_pengelola.staff.index');
    Route::post('/unit-pengelola/documents/{document}/submit-review', [DocumentController::class, 'submitReviewUnit'])->name('unit_pengelola.submit_review');
    Route::post('/unit-pengelola/documents/{document}/verify', [DocumentController::class, 'verifyUnit'])->name('unit_pengelola.verify');

    // ==================== UNIT PENGELOLA DASHBOARD ====================
    Route::get('/unit-pengelola/dashboard', [DocumentController::class, 'unitPengelolaDashboard'])->name('unit_pengelola.dashboard');

    Route::get('/unit-pengelola/documents', [DocumentController::class, 'unitPengelolaPending'])->name('unit_pengelola.documents.index');
    Route::get('/unit-pengelola/check-documents', [DocumentController::class, 'unitPengelolaPending'])->name('unit_pengelola.check_documents');
    Route::get('/unit-pengelola/staff/documents', [DocumentController::class, 'staffIndex'])->name('unit_pengelola.staff.index');
    Route::get('/unit-pengelola/documents/{document}/review', [DocumentController::class, 'reviewUnit'])->name('unit_pengelola.review');
    Route::post('/unit-pengelola/documents/{document}/approve', [DocumentController::class, 'approve'])->name('unit_pengelola.approve');
    Route::post('/unit-pengelola/documents/{document}/revise', [DocumentController::class, 'revise'])->name('unit_pengelola.revise');
    Route::post('/unit-pengelola/documents/{document}/disposition', [DocumentController::class, 'disposition'])->name('unit_pengelola.disposition');
    Route::post('/unit-pengelola/documents/{document}/submit-review', [DocumentController::class, 'submitReviewUnit'])->name('unit_pengelola.submit_review');
    Route::post('/unit-pengelola/documents/{document}/verify', [DocumentController::class, 'verifyUnit'])->name('unit_pengelola.verify');

    // ==================== KEPALA DEPARTEMEN ROUTES ====================
    Route::get('/kepala-departemen/dashboard', function () {
        $user = Auth::user();
        $pendingDocuments = \App\Models\Document::where('current_level', 3)
            ->where('status', 'pending_level3')
            // Temporarily remove strict Department filtering if user data is incomplete for testing? 
            // Better to keep it but ensure user knows.
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

        // Transform for View (JSON)
        $pendingData = $pendingDocuments->map(function ($doc) {
            return [
                'id' => $doc->id,
                'title' => $doc->kolom2_kegiatan,
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'date' => $doc->created_at->format('d M Y'),
                'risk_level' => $doc->risk_level ?? 'High',
                'status' => 'Menunggu Approval'
            ];
        });

        $publishedData = $publishedDocuments->map(function ($doc) {
            $lastApproval = $doc->approvals()->latest()->first();
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? '-',
                'category' => $doc->kategori,
                'date' => $doc->published_at ? $doc->published_at->format('d M Y') : $doc->created_at->format('d M Y'),
                'author' => $doc->user->nama_user ?? 'Unknown',
                'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'seksi_id' => $doc->id_seksi,
                'risk_level' => $doc->risk_level ?? 'High',
                'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'approval_note' => $lastApproval ? $lastApproval->catatan : '-'
            ];
        });

        $direktorats = \App\Models\Direktorat::where('status_aktif', 1)->get();
        $departemens = \App\Models\Departemen::all();
        $units = \App\Models\Unit::all();
        $seksis = \App\Models\Seksi::all();

        return view('kepala_departemen.dashboard', compact('user', 'pendingCount', 'pendingDocuments', 'publishedDocuments', 'pendingData', 'publishedData', 'direktorats', 'departemens', 'units', 'seksis'));
    })->name('kepala_departemen.dashboard');

    Route::get('/kepala-departemen/check-documents', [DocumentController::class, 'kepalaDepartemenPending'])
        ->name('kepala_departemen.check_documents');

    Route::get('/kepala-departemen/documents/{document}/review', [DocumentController::class, 'review'])->name('kepala_departemen.review');
    Route::post('/kepala-departemen/documents/{document}/approve', [DocumentController::class, 'approve'])->name('kepala_departemen.approve');
    Route::post('/kepala-departemen/documents/{document}/revise', [DocumentController::class, 'revise'])->name('kepala_departemen.revise');
    Route::post('/kepala-departemen/documents/{document}/publish', [DocumentController::class, 'publish'])->name('kepala_departemen.publish');

    // ==================== ADMIN ROUTES ====================
    Route::get('/admin/dashboard', function () {
        $user = Auth::user();

        // Total Documents (exclude draft - only count submitted documents)
        $totalDocuments = \App\Models\Document::whereNotIn('status', ['draft'])->count();

        // Published Documents
        $publishedDocuments = \App\Models\Document::where('status', 'published')
            ->whereNotNull('published_at')
            ->count();

        // Pending Approval (all levels)
        $pendingDocuments = \App\Models\Document::whereIn('status', [
            'pending_level1',
            'pending_level2',
            'pending_level3'
        ])->count();

        // Revision Documents
        $revisionDocuments = \App\Models\Document::where('status', 'revision')->count();

        // Get published documents for table
        $documents = \App\Models\Document::where('status', 'published')
            ->whereNotNull('published_at')
            ->with(['user', 'unit'])
            ->orderBy('published_at', 'desc')
            ->limit(20)
            ->get();

        return view('admin.dashboard', compact(
            'user',
            'totalDocuments',
            'publishedDocuments',
            'pendingDocuments',
            'revisionDocuments',
            'documents'
        ));
    })->name('admin.dashboard');

    // User Management Routes
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users');
    Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');
    Route::put('/admin/users/{id}/pic', [UserManagementController::class, 'updatePIC'])->name('admin.users.updatePIC');
    Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

    // API Helper Routes for Cascade
    Route::get('/api/dept/{id_direktorat}', [UserManagementController::class, 'getDepartemen']);
    Route::get('/api/unit/{id_dept}', [UserManagementController::class, 'getUnit']);
    Route::get('/api/seksi/{id_unit}', [UserManagementController::class, 'getSeksi']);

    // Master Data Management Routes
    Route::get('/admin/master-data', [\App\Http\Controllers\MasterDataController::class, 'index'])->name('admin.master_data');

    // Direktorat
    Route::post('/admin/direktorat', [\App\Http\Controllers\MasterDataController::class, 'storeDirektorat'])->name('admin.direktorat.store');
    Route::put('/admin/direktorat/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateDirektorat'])->name('admin.direktorat.update');
    Route::delete('/admin/direktorat/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyDirektorat'])->name('admin.direktorat.destroy');

    // Departemen
    Route::post('/admin/departemen', [\App\Http\Controllers\MasterDataController::class, 'storeDepartemen'])->name('admin.departemen.store');
    Route::put('/admin/departemen/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateDepartemen'])->name('admin.departemen.update');
    Route::delete('/admin/departemen/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyDepartemen'])->name('admin.departemen.destroy');

    // Unit
    Route::post('/admin/unit', [\App\Http\Controllers\MasterDataController::class, 'storeUnit'])->name('admin.unit.store');
    Route::put('/admin/unit/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateUnit'])->name('admin.unit.update');
    Route::delete('/admin/unit/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyUnit'])->name('admin.unit.destroy');

    // Seksi
    Route::post('/admin/seksi', [\App\Http\Controllers\MasterDataController::class, 'storeSeksi'])->name('admin.seksi.store');
    Route::put('/admin/seksi/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateSeksi'])->name('admin.seksi.update');
    Route::delete('/admin/seksi/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroySeksi'])->name('admin.seksi.destroy');

    Route::get('/admin/master', function () {
        return view('admin.master');
    })->name('admin.master');
});
