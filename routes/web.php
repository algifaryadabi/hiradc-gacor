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

Route::get('/debug-log', function () {
    $content = file_get_contents(storage_path('logs/laravel.log'));
    $lines = explode("\n", $content);
    $filtered = array_filter($lines, function ($line) {
        return str_contains($line, 'Disposition');
    });
    return implode("\n", array_slice($filtered, -20)); // Return last 20 matches
});

Route::get('/check-units', function () {
    return \App\Models\Unit::all();
});

Route::get('/debug-user', function () {
    return \Illuminate\Support\Facades\Auth::user();
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
        // Load published documents (General View)
        // Load published documents (General View) - Inclusive of partial tracks
        $rawDocuments = \App\Models\Document::where(function ($q) {
            $q->where('status', 'published')
                ->orWhere('status_she', 'published')
                ->orWhere('status_security', 'published');
        })
            ->with(['user', 'unit', 'approvals.approver', 'details'])
            ->orderBy('updated_at', 'desc')
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

            // Revert to Broad Categories (SHE, Security), but only if published
            $cats = [];
            if ($doc->hasSheContent() && ($doc->status == 'published' || $doc->status_she == 'published'))
                $cats[] = 'SHE';
            if ($doc->hasSecurityContent() && ($doc->status == 'published' || $doc->status_security == 'published'))
                $cats[] = 'Security';
            $categoryLabel = empty($cats) ? '-' : implode(', ', $cats);

            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'category' => $categoryLabel,
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
                'approval_note' => $approvalNote,
                'details' => $doc->details->map(fn($d) => ['kategori' => $d->kategori])->toArray()
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

    // Document Routes
    Route::resource('documents', \App\Http\Controllers\DocumentController::class);
    Route::put('documents/{id}/update-detail', [\App\Http\Controllers\DocumentController::class, 'updateDetail'])
        ->name('documents.update_detail');
    Route::get('documents/{document}/export-detail-pdf', [\App\Http\Controllers\DocumentController::class, 'exportDetailPdf'])
        ->name('documents.export.detail.pdf');
    Route::get('/documents/{document}/export/excel', [DocumentController::class, 'exportDetailExcel'])->name('documents.export.detail.excel');

    // PUK/PMK Export Routes
    Route::get('/documents/{document}/export/puk/pdf', [DocumentController::class, 'exportPukPdf'])->name('documents.export.puk.pdf');
    Route::get('/documents/{document}/export/puk/excel', [DocumentController::class, 'exportPukExcel'])->name('documents.export.puk.excel');
    Route::get('/documents/{document}/export/pmk/pdf', [DocumentController::class, 'exportPmkPdf'])->name('documents.export.pmk.pdf');
    Route::get('/documents/{document}/export/pmk/excel', [DocumentController::class, 'exportPmkExcel'])->name('documents.export.pmk.excel');


    Route::get('/my-documents/summary', function () {
        return redirect()->route('documents.index');
    })->name('documents.summary');
    Route::get('/my-documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::post('/documents/{document}/submit', [DocumentController::class, 'submit'])->name('documents.submit');
    Route::post('/documents/{document}/autosave', [DocumentController::class, 'autosaveDraft'])->name('documents.autosave');
    Route::post('/documents/{document}/submit-revision', [DocumentController::class, 'submitRevision'])->name('documents.submit_revision');


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
    // Update Program Kerja PUK/PMK (Approver)
    Route::put('/approver/puk/{id}/update-program-kerja', [DocumentController::class, 'updatePukProgramKerja'])->name('approver.puk.update_program');
    Route::put('/approver/pmk/{id}/update-program-kerja', [DocumentController::class, 'updatePmkProgramKerja'])->name('approver.pmk.update_program');

    // ==================== NEW APPROVAL WORKFLOW ROUTES ====================
    Route::post('/approval/hiradc/{id}', [\App\Http\Controllers\ApprovalController::class, 'approveHiradc'])->name('approval.hiradc');
    Route::post('/approval/puk/{id}', [\App\Http\Controllers\ApprovalController::class, 'approvePuk'])->name('approval.puk');
    Route::post('/approval/pmk/{id}', [\App\Http\Controllers\ApprovalController::class, 'approvePmk'])->name('approval.pmk');

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
    Route::get('/unit-pengelola/dashboard/data', [DocumentController::class, 'getUnitPengelolaDashboardData'])->name('unit_pengelola.dashboard.data');

    Route::get('/unit-pengelola/documents', [DocumentController::class, 'unitPengelolaPending'])->name('unit_pengelola.documents.index');
    Route::get('/unit-pengelola/check-documents', [DocumentController::class, 'unitPengelolaPending'])->name('unit_pengelola.check_documents');
    Route::get('/unit-pengelola/staff/documents', [DocumentController::class, 'staffIndex'])->name('unit_pengelola.staff.index');
    Route::get('/unit-pengelola/documents/{document}/review', [DocumentController::class, 'reviewUnit'])->name('unit_pengelola.review');
    Route::post('/unit-pengelola/documents/{document}/approve', [DocumentController::class, 'approve'])->name('unit_pengelola.approve');
    Route::post('/unit-pengelola/documents/{document}/revise', [DocumentController::class, 'revise'])->name('unit_pengelola.revise');
    Route::post('/unit-pengelola/documents/{document}/disposition', [DocumentController::class, 'disposition'])->name('unit_pengelola.disposition');
    Route::post('/unit-pengelola/documents/{document}/submit-review', [DocumentController::class, 'submitReviewUnit'])->name('unit_pengelola.submit_review');
    Route::post('/unit-pengelola/documents/{document}/verify', [DocumentController::class, 'verifyUnit'])->name('unit_pengelola.verify');
    Route::post('/unit-pengelola/documents/update-detail/{id}', [DocumentController::class, 'updateDetail'])->name('unit_pengelola.update_detail');
    Route::post('/unit-pengelola/update-permissions', [DocumentController::class, 'updateUnitPermissions'])->name('unit_pengelola.update_permissions');
    Route::get('/unit-pengelola/documents/get-item-html/{id}', [DocumentController::class, 'getEditItemHtml'])->name('unit_pengelola.get_edit_item');
    // Update Program Kerja PUK/PMK (Unit Pengelola)
    Route::put('/unit-pengelola/puk/{id}/update-program-kerja', [DocumentController::class, 'updatePukProgramKerja'])->name('unit_pengelola.puk.update_program');
    Route::put('/unit-pengelola/pmk/{id}/update-program-kerja', [DocumentController::class, 'updatePmkProgramKerja'])->name('unit_pengelola.pmk.update_program');

    // ==================== KEPALA DEPARTEMEN ROUTES ====================
    Route::get('/kepala-departemen/dashboard', function () {
        $user = Auth::user();

        // 1. Fetch Pending Documents (Flexible Query for Parallel Workflow)
        $pendingDocuments = \App\Models\Document::where('id_dept', $user->id_dept)
            ->where(function ($q) {
                $q->where('current_level', 3) // Standard Level 3
                    ->orWhere(function ($sub) {
                        // Parallel Persistence: Show if ANY track is approved/published
                        // This covers:
                        // - Revision (Level 1)
                        // - Resubmitted (Pending Level 1)
                        // - Processing (Pending Level 2)
                        $sub->where(function ($p) {
                            $p->whereIn('status_she', ['approved', 'published'])
                                ->orWhereIn('status_security', ['approved', 'published']);
                        });
                    })
                    ->orWhere('status', 'approved') // Published Global
                    ->orWhere('status', 'published');
            })
            ->with(['user', 'unit'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $pendingCount = $pendingDocuments->count();

        $publishedDocuments = \App\Models\Document::where('id_dept', $user->id_dept)
            ->where(function ($q) {
                $q->where('status', 'published')
                    ->orWhere('status_she', 'published')
                    ->orWhere('status_security', 'published');
            })
            ->with(['user', 'unit', 'details'])
            ->orderBy('updated_at', 'desc') // Use updated_at since published_at might differ per track
            ->limit(10)
            ->get();

        // Transform for View (JSON) - Support Split Cards
        $pendingData = $pendingDocuments->flatMap(function ($doc) {
            $items = [];

            // Helper
            $buildItem = function ($filter, $label, $isPublished = false) use ($doc) {
                return [
                    'id' => $doc->id,
                    'title' => $doc->kolom2_kegiatan,
                    'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                    'date' => $doc->created_at->format('d M Y'),
                    'risk_level' => $doc->risk_level ?? 'High',
                    'status' => $label,
                    'filter' => $filter, // Passed to specific review link
                    'is_published' => $isPublished
                ];
            };

            // Check SHE
            if ($doc->hasSheContent()) {
                if ($doc->status_she == 'approved') {
                    $items[] = $buildItem('SHE', 'Menunggu Approval (K3/KO/Lingkungan)', false);
                } elseif ($doc->status_she == 'published') {
                    $items[] = $buildItem('SHE', 'Terpublikasi (K3/KO/Lingkungan)', true);
                }
            }
            // Check Security
            if ($doc->hasSecurityContent()) {
                if ($doc->status_security == 'approved') {
                    $items[] = $buildItem('Security', 'Menunggu Approval (Keamanan)', false);
                } elseif ($doc->status_security == 'published') {
                    $items[] = $buildItem('Security', 'Terpublikasi (Keamanan)', true);
                }
            }

            // Fallback for Legacy/Standard
            if (empty($items)) {
                // If it was fetched but matches neither specific approved condition
                // e.g. strictly pending_level3 with no sub-status used yet
                if ($doc->current_level == 3) {
                    $items[] = $buildItem('ALL', 'Menunggu Approval', false);
                }
                // Also show if global revision but visible? No, logic above handles status check from query.
            }

            return $items;
        });

        $publishedData = $publishedDocuments->map(function ($doc) {
            $lastApproval = $doc->approvals()->latest()->first();

            // Revert to Broad Categories (SHE, Security) as requested, but ONLY if they are published
            $cats = [];
            if ($doc->hasSheContent() && ($doc->status == 'published' || $doc->status_she == 'published'))
                $cats[] = 'SHE';
            if ($doc->hasSecurityContent() && ($doc->status == 'published' || $doc->status_security == 'published'))
                $cats[] = 'Security';
            $categoryLabel = empty($cats) ? '-' : implode(', ', $cats);

            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? '-',
                'category' => $categoryLabel,
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


    // ==================== DIREKSI (LEVEL 4) ROUTES ====================
    Route::get('/direksi/dashboard', [DocumentController::class, 'direksiDashboard'])->name('direksi.dashboard');
    Route::get('/direksi/dashboard/data', [DocumentController::class, 'getDireksiDashboardData'])->name('direksi.dashboard.data');

    Route::get('/direksi/documents/check', [DocumentController::class, 'direksiPending'])->name('direksi.check_documents');

    Route::get('/direksi/documents/{document}/review', [DocumentController::class, 'review'])->name('direksi.review');
    Route::post('/direksi/documents/{document}/approve', [DocumentController::class, 'approve'])->name('direksi.approve');
    Route::post('/direksi/documents/{document}/revise', [DocumentController::class, 'revise'])->name('direksi.revise');

    // ==================== PMK/PUK REVISION ROUTES ====================
    // PMK Revision (Direksi)
    Route::post('/pmk/{pmk}/request-revision', [DocumentController::class, 'requestPmkRevision'])->name('pmk.request_revision');
    Route::post('/pmk/{pmk}/resubmit', [DocumentController::class, 'resubmitPmk'])->name('pmk.resubmit');

    // Edit Programs Page
    Route::get('/documents/{document}/edit-programs', [DocumentController::class, 'editPrograms'])->name('documents.edit_programs');

    // Update PUK/PMK Program Data
    Route::post('/puk/{puk}/update-program', [DocumentController::class, 'updatePukProgram'])->name('puk.update.program');
    Route::post('/pmk/{pmk}/update-program', [DocumentController::class, 'updatePmkProgram'])->name('pmk.update.program');

    // PUK Revision (Kepala Unit)
    Route::post('/puk/{puk}/request-revision', [DocumentController::class, 'requestPukRevision'])->name('puk.request_revision');
    Route::post('/puk/{puk}/resubmit', [DocumentController::class, 'resubmitPuk'])->name('puk.resubmit');


    // ==================== ADMIN ROUTES ====================
    Route::get('/admin/dashboard', function () {
        $user = Auth::user();

        // Total Documents (exclude draft - only count submitted documents)
        $totalDocuments = \App\Models\Document::whereNotIn('status', ['draft'])->count();

        // Published Documents
        // Published Documents - Inclusive
        $publishedDocuments = \App\Models\Document::where(function ($q) {
            $q->where('status', 'published')
                ->orWhere('status_she', 'published')
                ->orWhere('status_security', 'published');
        })
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
        // Get published documents for table - Inclusive
        $rawDocuments = \App\Models\Document::where(function ($q) {
            $q->where('status', 'published')
                ->orWhere('status_she', 'published')
                ->orWhere('status_security', 'published');
        })
            ->with(['user', 'unit', 'details'])
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        $documents = $rawDocuments->map(function ($doc) {
            // Revert to Broad Categories (SHE, Security), but only if published
            $cats = [];
            if ($doc->hasSheContent() && ($doc->status == 'published' || $doc->status_she == 'published'))
                $cats[] = 'SHE';
            if ($doc->hasSecurityContent() && ($doc->status == 'published' || $doc->status_security == 'published'))
                $cats[] = 'Security';
            $categoryLabel = empty($cats) ? '-' : implode(', ', $cats);

            // Use Accessors or Direct attributes since we are mapping manually now
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'category' => $categoryLabel,
                'date' => $doc->published_at ? $doc->published_at->format('d M Y') : $doc->created_at->format('d M Y'),
                'author' => $doc->user->nama_user ?? 'Unknown',
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'unit_id' => $doc->id_unit, // Required for filtering on dashboard
                'status' => 'DISETUJUI', // Admin view of published
                'status_label' => 'Terpublikasi',
                'risk_level' => $doc->risk_level ?? 'High'
            ];
        });

        // Master Data for Filters
        $direktorats = \App\Models\Direktorat::where('status_aktif', 1)->get();
        $departemens = \App\Models\Departemen::all();
        $units = \App\Models\Unit::all();
        $seksis = \App\Models\Seksi::all();

        return view('admin.dashboard', compact(
            'user',
            'totalDocuments',
            'publishedDocuments',
            'pendingDocuments',
            'revisionDocuments',
            'documents',
            'direktorats',
            'departemens',
            'units',
            'seksis'
        ));
    })->name('admin.dashboard');

    Route::get('/admin/dashboard/data', [DocumentController::class, 'getAdminDashboardData'])->name('admin.dashboard.data');

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

    // Probis (Business Process)
    Route::post('/admin/probis', [\App\Http\Controllers\MasterDataController::class, 'storeProbis'])->name('admin.probis.store');
    Route::put('/admin/probis/{id}', [\App\Http\Controllers\MasterDataController::class, 'updateProbis'])->name('admin.probis.update');
    Route::delete('/admin/probis/{id}', [\App\Http\Controllers\MasterDataController::class, 'destroyProbis'])->name('admin.probis.destroy');

    Route::get('/admin/master', function () {
        return view('admin.master');
    })->name('admin.master');

    // Document Revision Routes
    Route::post('/documents/{document}/initiate-revision', [\App\Http\Controllers\DocumentController::class, 'initiateRevision'])->name('documents.initiate_revision');
    Route::get('/documents/{document}/revision-history', [\App\Http\Controllers\DocumentController::class, 'getRevisionHistory'])->name('documents.revision_history');
});

