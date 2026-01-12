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
        // Level 2: Unit Pengelola (SHE / Security)
        // - Typically defined by role_user 'unit_pengelola'
        elseif ($role == 'unit_pengelola' || $user->id_role_user == 5) {
            $level = 2;
        }
        // Level 3: Kepala Departemen
        // - Role User 'kepala_departemen'
        // - OR Role Jabatan 'General Manager' (id 2) - Assuming GM is Dept Head typically
        elseif ($role == 'kepala_departemen' || $user->id_role_user == 4 || $user->id_role_jabatan == 2) {
            $level = 3;
        }

        $documents = Document::where('current_level', $level)
            ->where('status', 'pending_level' . $level)
            ->when($level == 1, function ($q) use ($user) {
                // Level 1: Same unit
                return $q->where('id_unit', $user->id_unit);
            })
            ->when($level == 3, function ($q) use ($user) {
                // Level 3: Same department
                return $q->where('id_dept', $user->id_dept);
            })
            ->with(['user', 'unit'])
            ->orderBy('created_at', 'desc')
            ->get();

        // History: Documents approved/revised by this user
        $historyDocuments = Document::whereHas('approvals', function ($q) use ($user) {
            $q->where('approver_id', $user->id_user);
        })->with(['user', 'unit'])->get();

        $documents = $documents->merge($historyDocuments)->unique('id_document');

        return view('approver.documents.index', compact('documents'));
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

        return view('approver.dashboard', compact('user', 'pendingCount', 'pendingDocuments', 'publishedDocuments', 'direktorats', 'departemens', 'units'));
    }

    /**
     * Show Unit Pengelola Dashboard
     */
    public function unitPengelolaDashboard()
    {
        $user = Auth::user();

        // Fetch pending documents for this level (Level 2)
        $pendingDocuments = Document::where('current_level', 2)
            ->where('status', 'pending_level2')
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

        return view('unit_pengelola.dashboard', compact('user', 'pendingCount', 'pendingDocuments', 'publishedDocuments', 'direktorats', 'departemens', 'units'));
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
        $user = Auth::user();

        if (!$document->canBeApprovedBy($user)) {
            abort(403, 'Anda tidak memiliki akses untuk menyetujui dokumen ini.');
        }

        // Update document fields (Always update with latest form data)
        // if ($request->has('edited_fields')) { // REMOVED CHECK
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
            'kolom16_aspek',
            'kolom17_risiko',
            'kolom17_peluang',
            'kolom18_tindak_lanjut'
        ]);

        // Handle JSON/Complex Fields specially
        if ($request->has('bahaya_type')) {
            $dataToUpdate['kolom6_bahaya'] = [
                'type' => $request->bahaya_type,
                'kategori' => $request->bahaya_kategori,
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

        // Recalculate Score if matrix changed
        if (isset($dataToUpdate['kolom12_kemungkinan']) && isset($dataToUpdate['kolom13_konsekuensi'])) {
            $dataToUpdate['kolom14_score'] = $dataToUpdate['kolom12_kemungkinan'] * $dataToUpdate['kolom13_konsekuensi'];
        }

        $document->update($dataToUpdate);
        // } // REMOVED CLOSING BRACE

        $document->approve($user, $request->catatan);

        return redirect()->route('approver.check_documents')
            ->with('success', 'Dokumen berhasil disetujui.');
    }

    /**
     * Send document for revision
     */
    public function revise(Request $request, Document $document)
    {
        $request->validate([
            'catatan' => 'required|string|min:10',
        ]);

        $user = Auth::user();

        if (!$document->canBeApprovedBy($user)) {
            abort(403);
        }

        $document->revise($user, $request->catatan);

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
