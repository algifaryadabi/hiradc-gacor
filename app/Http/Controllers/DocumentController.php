<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Direktorat;
use App\Models\Departemen;
use App\Models\Unit;
use App\Models\Seksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function __construct()
    {
        // Share badge counts with all views handled by this controller
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $revCount = Document::where('id_user', Auth::id())
                    ->where('status', 'revision')
                    ->count();
                view()->share('revisionCount', $revCount);
            }
            return $next($request);
        });
    }

    /**
     * List user's documents
     */
    public function index()
    {
        $user = Auth::user();

        $documents = Document::where('id_user', $user->id_user)
            ->with(['unit', 'approvals.approver'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Load counts for Status Tracker
        $myPending = $documents->whereIn('status', ['pending_level1', 'pending_level2', 'pending_level3'])
            ->sortByDesc('updated_at');

        $myRevision = $documents->where('status', 'revision')
            ->sortByDesc('updated_at');

        $myDraft = $documents->where('status', 'draft')
            ->sortByDesc('updated_at');

        return view('user.documents.index', compact('documents', 'myPending', 'myRevision', 'myDraft'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $user = Auth::user()->load(['roleJabatan', 'unit', 'departemen', 'direktorat']);
        $direktorats = Direktorat::where('status_aktif', 1)->get();
        $departemens = Departemen::all();
        $units = Unit::all();
        $seksis = Seksi::all();

        return view('user.documents.create', compact('user', 'direktorats', 'departemens', 'units', 'seksis'));
    }

    /**
     * Store new document
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:K3,KO,Lingkungan,Keamanan',
            'kolom2_proses' => 'required|string',
            'kolom2_kegiatan' => 'required|string',
            'kolom3_lokasi' => 'required|string',
        ]);

        $user = Auth::user();

        // 1. Construct Kolom 6 (Bahaya) JSON from various inputs
        $bahayaData = [
            'type' => $request->bahaya_type, // condition / action
            'kategori' => $request->bahaya_kategori, // fisika, kimia, dll
            'details' => $request->bahaya_detail ?? [], // Array of checked items
            'manual' => $request->bahaya_manual, // Manual input string
            'aspects' => $request->bahaya_aspect ?? [], // Lingkungan checkboxes
            'threats' => $request->bahaya_security ?? [], // Keamanan checkboxes
        ];

        // 2. Construct Kolom 10 (Pengendalian) JSON
        $controlsData = [
            'hierarchy' => $request->hirarki ?? [], // Checkboxes (Eliminasi, dll)
            'new_controls' => $request->new_controls ?? [], // Dynamic array from JS
        ];

        $document = Document::create([
            'id_user' => $user->id_user,
            'id_direktorat' => $user->id_direktorat,
            'id_dept' => $user->id_dept,
            'id_unit' => $user->id_unit,
            'id_seksi' => $user->id_seksi,
            'kategori' => $request->kategori,
            'status' => 'draft',
            'current_level' => 0,
            'kolom2_proses' => $request->kolom2_proses,
            'kolom2_kegiatan' => $request->kolom2_kegiatan,
            'kolom3_lokasi' => $request->kolom3_lokasi,
            'kolom5_kondisi' => $request->kolom5_kondisi,
            'kolom6_bahaya' => $bahayaData, // Casted to Array/JSON by Model
            'kolom7_dampak' => $request->kolom7_dampak,
            // 'kolom8_pihak' => $request->kolom8_pihak, // Removed
            'kolom9_risiko' => $request->kolom9_risiko,
            'kolom10_pengendalian' => $controlsData, // Casted to Array/JSON by Model
            'kolom11_existing' => $request->kolom11_existing,
            'kolom12_kemungkinan' => $request->kolom12_kemungkinan,
            'kolom13_konsekuensi' => $request->kolom13_konsekuensi,
            'kolom14_score' => $request->kolom12_kemungkinan * $request->kolom13_konsekuensi,
            'kolom15_regulasi' => $request->kolom15_regulasi,
            'kolom16_aspek' => $request->kolom16_penting,
            'kolom17_risiko' => $request->kolom17_risiko,
            'kolom17_peluang' => $request->kolom17_peluang,
            'kolom18_tindak_lanjut' => $request->kolom18_tindak_lanjut,
            // Residual
            'residual_kemungkinan' => $request->residual_kemungkinan,
            'residual_konsekuensi' => $request->residual_konsekuensi,
            'residual_score' => $request->residual_kemungkinan * $request->residual_konsekuensi,
        ]);

        // Submit for approval if requested
        if ($request->submit_for_approval) {
            $document->submitForApproval();
        }

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil disimpan dan dikirim untuk approval.')
            ->with('open_tab', 'tab_pending');
    }

    /**
     * Show document detail
     */
    public function show(Document $document)
    {
        return view('user.documents.show', compact('document'));
    }

    /**
     * Show edit form (Revision)
     */
    public function edit(Document $document)
    {
        if ($document->id_user != Auth::user()->id_user)
            abort(403);
        // Only allow edit if draft or revision
        if (!in_array($document->status, ['draft', 'revision']))
            return redirect()->route('documents.show', $document->id);

        return view('user.documents.edit', compact('document'));
    }

    /**
     * Update document (Revision submit)
     */
    public function update(Request $request, Document $document)
    {
        if ($document->id_user != Auth::user()->id_user)
            abort(403);

        $request->validate([
            'kolom2_proses' => 'required',
            'kolom2_kegiatan' => 'required',
            'kolom3_lokasi' => 'required',
        ]);

        // 1. Construct Bahaya Data (Merge existing type/category if not in request)
        $existingBahaya = $document->kolom6_bahaya;
        $bahayaData = [
            'type' => $request->bahaya_type ?? $existingBahaya['type'] ?? '',
            'kategori' => $request->kategori ?? $document->kategori,
            'details' => $request->bahaya_detail ?? $existingBahaya['details'] ?? [],
            'manual' => $request->bahaya_manual,
            'aspects' => $request->bahaya_aspect ?? [],
            'threats' => $request->bahaya_security ?? [],
        ];

        // 2. Controls
        $controlsData = [
            'hierarchy' => $request->hirarki ?? [],
            'new_controls' => $request->new_controls ?? [],
        ];

        $document->update([
            'kolom2_proses' => $request->kolom2_proses,
            'kolom2_kegiatan' => $request->kolom2_kegiatan,
            'kolom3_lokasi' => $request->kolom3_lokasi,
            'kolom5_kondisi' => $request->kolom5_kondisi,
            'kolom6_bahaya' => $bahayaData,
            'kolom7_dampak' => $request->kolom7_dampak,
            'kolom9_risiko' => $request->kolom9_risiko,
            'kolom10_pengendalian' => $controlsData,
            'kolom11_existing' => $request->kolom11_existing,
            'kolom12_kemungkinan' => $request->kolom12_kemungkinan,
            'kolom13_konsekuensi' => $request->kolom13_konsekuensi,
            'kolom14_score' => $request->kolom12_kemungkinan * $request->kolom13_konsekuensi,
            'kolom15_regulasi' => $request->kolom15_regulasi,
            // 'kolom16_aspek' => $request->kolom16_penting, // Optional
            // 'kolom17_risiko' => $request->kolom17_risiko, // Optional
            // 'kolom17_peluang' => $request->kolom17_peluang, // Optional
            'kolom18_tindak_lanjut' => $request->kolom18_tindak_lanjut,
            'residual_kemungkinan' => $request->residual_kemungkinan,
            'residual_konsekuensi' => $request->residual_konsekuensi,
            'residual_score' => $request->residual_kemungkinan * $request->residual_konsekuensi,

            // RESET STATUS TO PENDING
            'status' => 'pending_level1',
            'current_level' => 1
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Revisi berhasil disubmit ulang.')
            ->with('open_tab', 'tab_pending');
    }


    /**
     * Submit document for approval
     */
    public function submit(Document $document)
    {
        if ($document->id_user != Auth::user()->id_user) {
            abort(403);
        }

        $document->submitForApproval();

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil dikirim untuk approval.')
            ->with('open_tab', 'tab_pending');
    }

    // ==================== APPROVAL METHODS ====================

    /**
     * List documents pending approval (for approvers)
     */
    public function pendingApproval()
    {
        $user = Auth::user();

        // Use helper if available, or fallback to role_user column
        $role = method_exists($user, 'getRoleName') ? $user->getRoleName() : $user->role_user;

        // MATCHING RULES based on User's Screenshot of 'role_jabatan' table:
        // 3 = Senior Manager --> Acts as Approver Level 1 (Kepala Unit)
        // 2 = General Manager --> Acts as Approver Level 3 (Kepala Departemen) ?? (Assumption)

        $level = 0;

        // Level 1: Kepala Unit
        // - Role User 'approver' / 'kepala_unit'
        // - OR Role Jabatan 'Senior Manager' (id 3)
        if (in_array($role, ['approver', 'kepala_unit']) || $user->id_role_user == 3 || $user->id_role_jabatan == 3) {
            $level = 1;
        }
        // Level 2: Unit Pengelola (SHE / Security) - ONLY Kepala Unit
        // - Kepala Unit: role_jabatan = 3 (Senior Manager)
        // User Request: "Semua list nya yang ada, disetujui revisi maupun sdg diproses"
        // Show ALL documents for this Unit (excluding drafts potentially, unless asked)
        // assuming Monitor Unit Documents mode.

        $documents = Document::where('id_unit', $user->id_unit)
            ->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Transform for View
        $documentsData = $documents->map(function ($doc) use ($user) {
            $status = 'Disetujui'; // Default fallback (History/Done)

            // Logic Status
            if ($doc->canBeApprovedBy($user)) {
                $status = 'Menunggu';
            } elseif ($doc->status === 'revision') {
                $status = 'Revisi';
            } elseif ($doc->status === 'approved') {
                $status = 'Disetujui';
            } elseif ($doc->current_level > 1) {
                $status = 'Diproses'; // Lanjut ke level berikutnya
            }

            // Friendly Unit Name & Department
            $unitName = $doc->unit->nama_unit ?? '-';
            $deptName = $doc->user && $doc->user->departemen ? $doc->user->departemen->nama_dept : '-';
            $submitterName = $doc->user->nama_user ?? $doc->user->username ?? 'Unknown';

            return [
                'id' => $doc->id,
                'unit' => $unitName,
                'department' => $deptName,
                'submitter' => $submitterName,
                'title' => $doc->kolom2_kegiatan,
                'category' => $doc->kategori,
                'date_submit' => $doc->created_at->format('d M Y'),
                'time_submit' => $doc->created_at->format('H:i') . ' WIB',
                'status' => $status,
                'viewUrl' => route('approver.review', ['document' => $doc->id])
            ];
        });

        return view('approver.documents.index', compact('documentsData'));
    }

    /**
     * Show Approver Dashboard
     */
    public function approverDashboard()
    {
        $user = Auth::user();

        // Fetch pending documents for this level (Level 1)
        $pendingDocuments = Document::where('current_level', 1)
            ->where('status', 'pending_level1')
            ->where('id_unit', $user->id_unit)
            ->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingCount = $pendingDocuments->count();

        $publishedDocuments = Document::published()
            ->with(['user', 'unit'])
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();

        $direktorats = Direktorat::where('status_aktif', 1)->get();
        $departemens = Departemen::all();
        $units = Unit::all();
        $seksis = Seksi::all();

        return view('approver.dashboard', compact('user', 'pendingCount', 'pendingDocuments', 'publishedDocuments', 'direktorats', 'departemens', 'units', 'seksis'));
    }

    /**
     * Show Unit Pengelola Dashboard
     */
    public function unitPengelolaDashboard()
    {
        $user = Auth::user();

        // Verify user is Kepala Unit from SHE or Security
        if (!$user->isKepalaUnit() || !in_array($user->id_unit, [55, 56])) {
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

        // Fetch pending documents for this level (Level 2) with category filter
        $pendingDocuments = Document::where('current_level', 2)
            ->where('status', 'pending_level2')
            ->whereIn('kategori', $categoryFilter)
            ->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingCount = $pendingDocuments->count();

        $publishedDocuments = Document::published()
            ->with(['user', 'unit'])
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();

        // Transform Pending Documents for JS
        $pendingData = $pendingDocuments->map(function ($doc) {
            return [
                'id' => $doc->id, // Correct ID
                'title' => $doc->kolom2_kegiatan,
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'date' => $doc->created_at->format('d M Y'),
                'status' => 'Pending Review',
                'url' => route('unit_pengelola.review', $doc->id)
            ];
        });

        // Transform Published Documents for JS
        $publishedData = $publishedDocuments->map(function ($doc) {
            $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();
            return [
                'id' => $doc->id, // Correct ID
                'title' => $doc->kolom2_kegiatan,
                'category' => $doc->kategori,
                'date' => $doc->created_at->format('d M Y'),
                'author' => $doc->user->nama_user ?? '-',
                'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'status' => 'DISETUJUI',
                'risk_level' => $doc->risk_level ?? 'High', // Default value if null
                'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'approval_note' => $lastApproval ? $lastApproval->catatan : '-'
            ];
        });

        $direktorats = Direktorat::where('status_aktif', 1)->get();
        $departemens = Departemen::all();
        $units = Unit::all();

        return view('unit_pengelola.dashboard', compact('user', 'pendingCount', 'pendingDocuments', 'publishedDocuments', 'pendingData', 'publishedData', 'direktorats', 'departemens', 'units'));
    }

    /**
     * Show review page
     */
    public function review(Document $document)
    {
        $document->load(['user', 'approvals.approver', 'direktorat', 'departemen', 'unit', 'seksi']);

        return view(match (auth()->user()->getRoleName()) {
            'unit_pengelola' => 'unit_pengelola.documents.review',
            'kepala_departemen' => 'kepala_departemen.documents.review',
            default => 'approver.documents.review',
        }, compact('document'));
    }

    /**
     * Approve document
     */
    public function approve(Request $request, Document $document)
    {
        $request->validate([
            'catatan' => 'required|string|min:5',
        ], [
            'catatan.required' => 'Catatan wajib diisi untuk menyetujui dokumen.',
            'catatan.min' => 'Catatan minimal 5 karakter.',
        ]);

        $user = Auth::user();

        // Security Check
        if (!$document->canBeApprovedBy($user)) {
            abort(403, 'Anda tidak memiliki akses untuk menyetujui dokumen ini.');
        }

        // 1. Prepare Data Update (Form Fields)
        $dataToUpdate = $request->only([
            'kolom2_proses',
            'kolom2_kegiatan',
            'kolom3_lokasi',
            'kolom5_kondisi',
            'kolom7_dampak',
            'kolom9_risiko',
            'kolom11_existing',
            'kolom12_kemungkinan',
            'kolom13_konsekuensi',
            'kolom15_regulasi',
            'kolom16_penting',
            'kolom17_risiko',
            'kolom17_peluang',
            'kolom18_tindak_lanjut',
            'kolom18_toleransi',
            'residual_kemungkinan',
            'residual_konsekuensi',
        ]);

        // 2. Handle Complex Fields
        if ($request->has('bahaya_type')) {
            $dataToUpdate['kolom6_bahaya'] = [
                'type' => $request->bahaya_type,
                'kategori' => $request->kategori,
                'details' => $request->bahaya_detail ?? [],
                'manual' => $request->bahaya_manual,
                'aspects' => $request->bahaya_aspect ?? [],
                'threats' => $request->bahaya_security ?? [],
            ];
        }

        if ($request->has('hirarki') || $request->has('new_controls')) {
            $dataToUpdate['kolom10_pengendalian'] = [
                'hierarchy' => $request->hirarki ?? [],
                'new_controls' => $request->new_controls ?? [],
            ];
        }

        // 3. Recalculate Scores
        if (isset($dataToUpdate['kolom12_kemungkinan']) && isset($dataToUpdate['kolom13_konsekuensi'])) {
            $dataToUpdate['kolom14_score'] = $dataToUpdate['kolom12_kemungkinan'] * $dataToUpdate['kolom13_konsekuensi'];
        }
        if (isset($dataToUpdate['residual_kemungkinan']) && isset($dataToUpdate['residual_konsekuensi'])) {
            $dataToUpdate['residual_score'] = $dataToUpdate['residual_kemungkinan'] * $dataToUpdate['residual_konsekuensi'];
        }

        // 4. Save Compliance Checklist
        if ($request->has('compliance_checklist')) {
            $dataToUpdate['compliance_checklist'] = $request->compliance_checklist;
        }

        // 5. Update Database within Transaction
        \DB::transaction(function () use ($document, $dataToUpdate, $user, $request) {
            // A. Update Content
            $document->update($dataToUpdate);

            // B. Handle Approval Workflow
            if ($document->current_level == 2) {
                // Unit Pengelola (Level 2) -> Kepala Departemen (Level 3)
                $document->update([
                    'current_level' => 3,
                    'status' => 'pending_level3'
                ]);
            } elseif ($document->current_level == 3) {
                // Kepala Departemen (Level 3) -> PUBLISH
                $document->update([
                    'status' => 'approved', // or 'published'
                    'published_at' => now()
                ]);
            } else {
                // Standard Model Approval (Level 1 -> 2)
                $document->approve($user, $request->catatan);
            }

            // Create History Record if Manual Level 2 or 3 Update
            if ($document->wasChanged('current_level') || $document->wasChanged('status')) {
                $document->approvals()->create([
                    'approver_id' => $user->id_user,
                    'level' => $user->isKepalaDepartemen() ? 3 : ($user->isUnitPengelola() ? 2 : 1),
                    'action' => 'approved',
                    'catatan' => $request->catatan,
                    'ip_address' => $request->ip()
                ]);
            }
        });

        // 6. Redirect with Success Message
        if ($user->isKepalaDepartemen()) {
            return redirect()->route('kepala_departemen.check_documents')
                ->with('success', 'Dokumen berhasil dipublikasikan.');
        }
        if ($user->isUnitPengelola() || $document->approvals()->where('level', 2)->where('approver_id', $user->id_user)->exists()) {
            return redirect()->route('unit_pengelola.check_documents')
                ->with('success', 'Dokumen berhasil disetujui dan diteruskan ke Kepala Departemen.');
        }

        // Fallback Redirects
        if ($user->hasRole('admin'))
            return redirect()->route('admin.dashboard')->with('success', 'Dokumen Disetujui.');
        if ($document->current_level == 3 || $document->status == 'approved')
            return redirect()->route('kepala_departemen.check_documents')->with('success', 'Dokumen Disetujui.');

        return redirect()->route('approver.check_documents')->with('success', 'Dokumen Disetujui.');
    }

    /**
     * Send document for revision
     */
    /**
     * List documents pending approval for Unit Pengelola
     */
    public function unitPengelolaPending()
    {
        $user = Auth::user();

        // Verify user is Kepala Unit from SHE or Security
        if (!$user->isKepalaUnit() || !in_array($user->id_unit, [55, 56])) {
            abort(403, 'Akses ditolak. Hanya Kepala Unit SHE/Security yang dapat mengakses halaman ini.');
        }

        // Filter documents by category based on user's unit
        $categoryFilter = [];
        if ($user->id_unit == 56) { // SHE
            $categoryFilter = ['K3', 'KO', 'Lingkungan'];
        } elseif ($user->id_unit == 55) { // Security
            $categoryFilter = ['Keamanan'];
        }

        // Fetch All Documents (Pending & History) relevant to this Unit Pengelola
        // Requirement: "Semua list nya yang ada, disetujui revisi maupun sdg diproses"
        // But specifically for Check Documents we usually prioritize Pending.
        // Let's fetch ALL that pass the Category Filter + Level >= 2

        $documents = Document::whereIn('kategori', $categoryFilter)
            ->where('current_level', '>=', 2)
            ->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();

        $documentsData = $documents->map(function ($doc) use ($user) {
            $status = 'Disetujui'; // Default fallback

            // Logic Status
            if ($doc->canBeApprovedBy($user)) {
                $status = 'Menunggu';
            } elseif ($doc->status === 'revision') {
                $status = 'Revisi';
            } elseif ($doc->status === 'approved' || $doc->status === 'published' || $doc->current_level > 2) {
                // If it passed this level (Level 2), it's approved by THIS unit
                $status = 'Disetujui';
            }

            // Friendly Unit Name & Department
            $unitName = $doc->unit->nama_unit ?? '-';
            $submitterName = $doc->user->nama_user ?? $doc->user->username ?? 'Unknown';

            return [
                'id' => $doc->id,
                'unit' => $unitName,
                'department' => $doc->user && $doc->user->departemen ? $doc->user->departemen->nama_dept : '-',
                'submitter' => $submitterName,
                'title' => $doc->kolom2_kegiatan, // Added Title
                'category' => $doc->kategori,
                'date_submit' => $doc->created_at->format('d M Y'),
                'time_submit' => $doc->created_at->format('H:i') . ' WIB',
                'status' => $status,
                'viewUrl' => route('unit_pengelola.review', ['document' => $doc->id])
            ];
        });

        return view('unit_pengelola.documents.index', compact('documentsData'));
    }

    /**
     * List documents pending approval for Kepala Departemen (Level 3)
     */
    public function kepalaDepartemenPending()
    {
        $user = Auth::user();

        if (!$user->isKepalaDepartemen()) {
            abort(403, 'Akses ditolak. Hanya Kepala Departemen yang dapat mengakses halaman ini.');
        }

        // Fetch Pending (Level 3) & History (Published from this Dept) & Revisions
        $documents = Document::where('id_dept', $user->id_dept)
            ->where(function ($q) {
                $q->where('current_level', 3) // Pending this level
                    ->orWhere('status', 'approved') // Published
                    ->orWhere('status', 'published')
                    ->orWhere('status', 'revision'); // Revisions
            })
            ->with(['user', 'unit', 'approvals'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $documentsData = $documents->map(function ($doc) use ($user) {
            $status = 'Disetujui'; // Default fallback

            // Logic Status
            // Logic Status
            if ($doc->status === 'approved' || $doc->status === 'published') {
                $status = 'Disetujui';
            } elseif ($doc->status === 'revision') {
                $status = 'Revisi';
            } elseif ($doc->canBeApprovedBy($user)) {
                $status = 'Menunggu';
            }

            // Friendly Unit Name & Department
            $unitName = $doc->unit->nama_unit ?? '-';
            $submitterName = $doc->user->nama_user ?? $doc->user->username ?? 'Unknown';

            return [
                'id' => $doc->id,
                'unit' => $unitName,
                'department' => $doc->user && $doc->user->departemen ? $doc->user->departemen->nama_dept : '-',
                'submitter' => $submitterName,
                'title' => $doc->kolom2_kegiatan,
                'category' => $doc->kategori,
                'date_submit' => $doc->created_at->format('d M Y'),
                'time_submit' => $doc->created_at->format('H:i') . ' WIB',
                'status' => $status,
                'viewUrl' => route('kepala_departemen.review', ['document' => $doc->id])
            ];
        });

        return view('kepala_departemen.documents.index', compact('documentsData'));
    }
    public function reviewUnit(Document $document)
    {
        // Reuse the Approver Review View but we might need to point to different route for actions?
        // Actually actions (approve/revise) check canBeApprovedBy, so we can reuse routes 'approver.approve' IF we want.
        // But routes/web.php likely needs 'unit_pengelola.approve' to point to same method or we reuse.
        // Let's reuse 'approver.approve' route capability OR create specific if needed.
        // For simplicity, let's use the SAME view as Approver but ensure it points to valid routes.
        // The Approver View uses `route('approver.approve')`.
        // We can just define `unit-pengelola/documents/{document}/approve` -> DocumentController@approve
        // And `unit-pengelola/documents/{document}/revise` -> DocumentController@revise
        // And inside view, we dynamically set route OR just use one route name if we alias it?
        // Better: Use a dedicated view that extends or is a copy, to control the route URLs.

        return view('unit_pengelola.documents.review', compact('document'));
    }

    public function revise(Request $request, Document $document)
    {
        $request->validate([
            'catatan' => 'required|string|min:5', // Mandatory notes
        ], [
            'catatan.required' => 'Catatan wajib diisi untuk meminta revisi.',
            'catatan.min' => 'Catatan minimal 5 karakter.',
        ]);

        $user = Auth::user();

        if (!$document->canBeApprovedBy($user)) {
            abort(403);
        }

        // Custom Logic for Unit Pengelola (Level 2) Revision -> Back to Level 1 (Kepala Unit)
        // "kalau unit pengelola merevisi ... balik ke status kepala unit lagi"
        if ($document->current_level == 2) {
            $document->update([
                'status' => 'pending_level1',
                'current_level' => 1
            ]);
        } elseif ($document->current_level == 3) {
            // Kepala Departemen (Level 3) -> Back to Submitter (Level 0/1)
            // "jika revisi ... balik lagi ke submitter dan memulai langkah awal"
            $document->update([
                'status' => 'revision', // This usually means Submitter needs to edit
                'current_level' => 1 // Reset workflow to start
            ]);
        }

        // Record History (Refactored to handle both levels)
        if (in_array($document->getOriginal('current_level'), [2, 3])) {
            $document->approvals()->create([
                'approver_id' => $user->id_user,
                'level' => $user->isKepalaDepartemen() ? 3 : 2,
                'action' => 'revision',
                'catatan' => $request->catatan,
                'ip_address' => $request->ip()
            ]);

            $route = $user->isKepalaDepartemen() ? 'kepala_departemen.check_documents' : 'unit_pengelola.check_documents';
            $msg = $user->isKepalaDepartemen() ? 'Dokumen dikembalikan ke Submitter.' : 'Dokumen dikembalikan ke Kepala Unit.';

            return redirect()->route($route)->with('success', $msg);
        }

        $document->revise($user, $request->catatan);

        // Redirect based on role
        if ($user->isKepalaDepartemen())
            return redirect()->route('kepala_departemen.check_documents')->with('success', 'Revisi dikirim.');
        if ($user->isUnitPengelola()) {
            return redirect()->route('unit_pengelola.check_documents')
                ->with('success', 'Dokumen telah dikembalikan untuk revisi.');
        }

        return redirect()->route('approver.check_documents')
            ->with('success', 'Dokumen telah dikembalikan untuk revisi.');
    }


    // ==================== DASHBOARD DATA ====================

    /**
     * Get published documents for dashboard
     */
    public function published()
    {
        $documents = Document::published()
            ->with(['user', 'unit'])
            ->orderBy('published_at', 'desc')
            ->get();

        return $documents;
    }
}
