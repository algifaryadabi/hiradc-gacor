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
    public function index(Request $request)
    {
        $user = Auth::user();

        // PIC Authorization Check
        if ($user->can_create_documents != 1) {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan PIC dokumen.');
        }

        $query = Document::where('id_user', $user->id_user)
            ->with(['unit', 'approvals.approver']);

        // Filter: Month
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        // Filter: Year
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Filter: Status (Final/Publish)
        if ($request->filled('status_filter') && $request->status_filter == 'final') {
            $query->whereIn('status', ['approved', 'published']);
        }

        $documents = $query->orderBy('created_at', 'desc')->get();

        // Get Available Years for Filter
        $years = Document::where('id_user', $user->id_user)
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Load counts for Status Tracker (Calculate from ALL user docs, not just filtered ones, usually better UX, 
        // BUT filtering typically implies narrowing down list.
        // However, the "Stats Cards" usually show global stats. 
        // Let's keep them global or filtered? 
        // User request is just "filter existing list".
        // Let's recalculate counts based on Filtered result OR keep global.
        // Let's keep global for the top cards so they know their total stats always.
        // Making a separate query for global stats.

        $allDocs = Document::where('id_user', $user->id_user)->get();
        $myPending = $allDocs->whereIn('status', ['pending_level1', 'pending_level2', 'pending_level3']);
        $myRevision = $allDocs->where('status', 'revision');
        $myDraft = $allDocs->where('status', 'draft');

        return view('user.documents.index', compact('documents', 'myPending', 'myRevision', 'myDraft', 'years'));
    }

    /**
     * Show summary of all documents in one table
     */
    public function summary(Request $request)
    {
        $user = Auth::user();
        $user->load('unit.probis'); // Eager load probis

        $unitProbis = $user->unit && $user->unit->probis ? $user->unit->probis->nama_probis : 'Umum';

        $query = Document::where('id_user', $user->id_user)
            ->with(['unit', 'approvals.approver'])
            ->orderBy('created_at', 'desc');

        // Category Filter
        if ($request->has('kategori') && $request->kategori != 'all') {
            $query->where('kategori', $request->kategori);
        }

        // Status Filter
        if ($request->has('status') && $request->status != 'all') {
            if ($request->status == 'pending') {
                $query->whereIn('status', ['pending_level1', 'pending_level2', 'pending_level3']);
            } elseif ($request->status == 'approved') {
                $query->whereIn('status', ['approved', 'published']);
            } else {
                $query->where('status', $request->status);
            }
        }

        $documents = $query->get();

        return view('user.documents.summary', compact('documents', 'unitProbis'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $user = Auth::user();

        // RESTRICTION: Only Role 4, 5, 6 can submit (Temporary: All of them allowed)
        // Note: Column in users table is 'role_jabatan'
        $roleId = $user->role_jabatan;

        if (!in_array($roleId, [4, 5, 6])) {
            return redirect()->route('documents.index')
                ->with('error', 'Akses Ditolak: Level Jabatan Anda tidak diizinkan membuat dokumen.');
        }

        // PIC Authorization Check
        if ($user->can_create_documents != 1) {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak: Anda bukan PIC dokumen.');
        }

        $user->load(['roleJabatan', 'unit', 'departemen', 'direktorat']);
        $direktorats = Direktorat::where('status_aktif', 1)->get();
        $departemens = Departemen::all();
        $units = Unit::all();
        $seksis = Seksi::all();
        $probis = \App\Models\BusinessProcess::all(); // Fetch all Business Processes

        return view('user.documents.create', compact('user', 'direktorats', 'departemens', 'units', 'seksis', 'probis'));
    }

    /**
     * Store new document
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_dokumen' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.kategori' => 'required|in:K3,KO,Lingkungan,Keamanan',
            'items.*.kolom2_proses' => 'required|string',
            'items.*.kolom2_kegiatan' => 'required|string',
            'items.*.kolom3_lokasi' => 'required|string',
            'items.*.kolom5_kondisi' => 'required|string',
            'items.*.residual_score' => 'required|numeric|min:1',
            'items.*.residual_level' => 'required|string',
        ]);

        $user = Auth::user();

        // RESTRICTION: Only Role 4, 5, 6 can submit
        $roleId = $user->role_jabatan;

        if (!in_array($roleId, [4, 5, 6])) {
            abort(403, 'Akses Ditolak: Level Jabatan Anda tidak diizinkan membuat dokumen.');
        }

        // PIC Authorization Check
        if ($user->can_create_documents != 1) {
            abort(403, 'Akses Ditolak: Anda bukan PIC dokumen.');
        }

        \DB::transaction(function () use ($request, $user) {
            // 1. Create Header Document
            // For backward compatibility, we use the FIRST ITEM's data to populate the header columns.
            // This ensures index/summary views still show something meaningful.
            $firstItem = $request->items[0];

            // Reconstruct Arrays for Header (using First Item)
            $headerBahaya = [
                'type' => '', // Will be empty or need logic if we want to support legacy details in header
                'kategori' => $firstItem['kategori'],
                'details' => $firstItem['kolom6_bahaya'] ?? [],
                'manual' => $firstItem['bahaya_manual'] ?? '',
                'aspects' => [],
                'threats' => [],
            ];

            $headerControls = [
                'hierarchy' => $firstItem['kolom10_pengendalian'] ?? [],
                'new_controls' => [],
            ];

            // NOTE: We are filling the "Header" with the first item's data. 
            // Ideally, the "Header" should only contain Metadata, but we keep this for Legacy View Compatibility.
            $document = Document::create([
                'id_user' => $user->id_user,
                'id_direktorat' => $user->id_direktorat,
                'id_dept' => $user->id_dept,
                'id_unit' => $user->id_unit,
                'id_seksi' => $user->id_seksi,
                'kategori' => $firstItem['kategori'], // Main Header Category = First Item Category
                'judul_dokumen' => $request->judul_dokumen,
                'status' => 'draft',
                'current_level' => 0,

                // Legacy Columns (Populated from Item #1)
                'kolom2_proses' => $firstItem['kolom2_proses'],
                'kolom2_kegiatan' => $firstItem['kolom2_kegiatan'],
                'kolom3_lokasi' => $firstItem['kolom3_lokasi'],
                'kolom5_kondisi' => $firstItem['kolom5_kondisi'],
                'kolom6_bahaya' => $headerBahaya,
                'kolom7_dampak' => $firstItem['kolom7_dampak'],
                'kolom9_risiko' => $firstItem['kolom9_risiko'],
                'kolom10_pengendalian' => $headerControls,
                'kolom11_existing' => $firstItem['kolom11_existing'],
                'kolom12_kemungkinan' => $firstItem['kolom12_kemungkinan'],
                'kolom13_konsekuensi' => $firstItem['kolom13_konsekuensi'],
                'kolom14_score' => $firstItem['kolom14_score'] ?? ($firstItem['kolom12_kemungkinan'] * $firstItem['kolom13_konsekuensi']),
                'kolom15_regulasi' => $firstItem['kolom15_regulasi'] ?? null,
                'kolom16_aspek' => $firstItem['kolom16_aspek'] ?? null,
                'kolom17_risiko' => $firstItem['kolom17_risiko'] ?? null,
                'kolom17_peluang' => $firstItem['kolom17_peluang'] ?? null,
                'kolom18_tindak_lanjut' => $firstItem['kolom18_tindak_lanjut'],
                'residual_kemungkinan' => $firstItem['residual_kemungkinan'],
                'residual_konsekuensi' => $firstItem['residual_konsekuensi'],
                'residual_score' => $firstItem['residual_score'] ?? ($firstItem['residual_kemungkinan'] * $firstItem['residual_konsekuensi']),
            ]);

            // 2. Create Details
            foreach ($request->items as $item) {
                // Construct JSONs for specific item
                $bahayaData = [
                    'kategori' => $item['kategori'],
                    'details' => $item['kolom6_bahaya'] ?? [],
                    'manual' => $item['bahaya_manual'] ?? '',
                    // Note: 'type', 'aspects', 'threats' logic can be refined if needed per item type
                ];

                $controlsData = [
                    'hierarchy' => $item['kolom10_pengendalian'] ?? [],
                    'existing' => $item['kolom11_existing'],
                ];

                $document->details()->create([
                    'kategori' => $item['kategori'],
                    'kolom2_proses' => $item['kolom2_proses'],
                    'kolom2_kegiatan' => $item['kolom2_kegiatan'],
                    'kolom3_lokasi' => $item['kolom3_lokasi'],
                    'kolom4_pihak' => $item['kolom4_pihak'] ?? null,
                    'kolom5_kondisi' => $item['kolom5_kondisi'],
                    'kolom6_bahaya' => $bahayaData,
                    'kolom7_dampak' => $item['kolom7_dampak'],
                    'kolom9_risiko' => $item['kolom9_risiko'],
                    'kolom10_pengendalian' => $controlsData,
                    'kolom11_existing' => $item['kolom11_existing'],
                    'kolom12_kemungkinan' => $item['kolom12_kemungkinan'],
                    'kolom13_konsekuensi' => $item['kolom13_konsekuensi'],
                    'kolom14_score' => $item['kolom14_score'] ?? ($item['kolom12_kemungkinan'] * $item['kolom13_konsekuensi']),
                    'kolom14_level' => $item['kolom14_level'] ?? null,
                    'kolom15_regulasi' => $item['kolom15_regulasi'] ?? null,
                    'kolom16_aspek' => $item['kolom16_aspek'] ?? null,
                    'kolom17_risiko' => $item['kolom17_risiko'] ?? null,
                    'kolom17_peluang' => $item['kolom17_peluang'] ?? null,
                    'kolom18_tindak_lanjut' => $item['kolom18_tindak_lanjut'],
                    'kolom18_toleransi' => $item['kolom18_toleransi'] ?? 'Ya',
                    'residual_kemungkinan' => $item['residual_kemungkinan'],
                    'residual_konsekuensi' => $item['residual_konsekuensi'],
                    'residual_score' => $item['residual_score'] ?? ($item['residual_kemungkinan'] * $item['residual_konsekuensi']),
                    'residual_level' => $item['residual_level'] ?? null,
                ]);
            }

            // Submit for approval if requested
            if ($request->submit_for_approval) {
                $document->submitForApproval();
            }
        });

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
        $user = Auth::user();

        // ALLOW: Author OR Approver (Role 3 + Same Unit)
        $isAuthor = $document->id_user == $user->id_user;
        $isApprover = ($user->role_jabatan == 3 && $document->id_unit == $user->id_unit);

        if (!$isAuthor && !$isApprover) {
            abort(403);
        }

        // Only allow edit if draft or revision (For Author), but maybe Approver can edit in Pending?
        // Let's assume Approver can edit anytime they can view it in "Review" state (pending_level1).
        if ($isAuthor && !in_array($document->status, ['draft', 'revision'])) {
            return redirect()->route('documents.show', $document->id);
        }

        // If Approver, they usually edit while it matches their approval level (pending_level1)
        if ($isApprover && $document->status != 'pending_level1') {
            // Maybe allow restrictions? For now let's allow content correction.
        }

        return view('user.documents.edit', compact('document'));
    }

    /**
     * Update document (Revision submit)
     */
    public function update(Request $request, Document $document)
    {
        $user = Auth::user();
        $isAuthor = $document->id_user == $user->id_user;
        $isApprover = ($user->role_jabatan == 3 && $document->id_unit == $user->id_unit);

        if (!$isAuthor && !$isApprover) {
            abort(403);
        }

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.kategori' => 'required|in:K3,KO,Lingkungan,Keamanan',
            'items.*.kolom2_kegiatan' => 'required|string',
            // Add other validations as needed
        ]);

        \DB::transaction(function () use ($request, $document) {
            // 1. UPDATE HEADER (Legacy compatibility with Item #1)
            // Ideally header should only contain metadata, but we fill it for legacy views
            $firstItem = $request->items[0];

            $headerBahaya = [
                'type' => '',
                'kategori' => $firstItem['kategori'],
                'details' => $firstItem['kolom6_bahaya'] ?? [],
                'manual' => $firstItem['bahaya_manual'] ?? '',
                'aspects' => [],
                'threats' => [],
            ];

            $headerControls = [
                'hierarchy' => $firstItem['kolom10_pengendalian'] ?? [],
                'new_controls' => [],
            ];

            $document->update([
                'kategori' => $firstItem['kategori'],
                'kolom2_proses' => $firstItem['kolom2_proses'],
                'kolom2_kegiatan' => $firstItem['kolom2_kegiatan'],
                'kolom3_lokasi' => $firstItem['kolom3_lokasi'],
                'kolom5_kondisi' => $firstItem['kolom5_kondisi'],
                'kolom6_bahaya' => $headerBahaya,
                'kolom7_dampak' => $firstItem['kolom7_dampak'],
                'kolom9_risiko' => $firstItem['kolom9_risiko'],
                'kolom10_pengendalian' => $headerControls,
                'kolom11_existing' => $firstItem['kolom11_existing'],
                'kolom12_kemungkinan' => $firstItem['kolom12_kemungkinan'],
                'kolom13_konsekuensi' => $firstItem['kolom13_konsekuensi'],
                'kolom14_score' => $firstItem['kolom14_score'] ?? ($firstItem['kolom12_kemungkinan'] * $firstItem['kolom13_konsekuensi']),
                'kolom15_regulasi' => $firstItem['kolom15_regulasi'] ?? null,
                'kolom16_aspek' => $firstItem['kolom16_aspek'] ?? null,
                'kolom17_risiko' => $firstItem['kolom17_risiko'] ?? null,
                'kolom17_peluang' => $firstItem['kolom17_peluang'] ?? null,
                'kolom18_tindak_lanjut' => $firstItem['kolom18_tindak_lanjut'],
                'residual_kemungkinan' => $firstItem['residual_kemungkinan'],
                'residual_konsekuensi' => $firstItem['residual_konsekuensi'],
                'residual_score' => $firstItem['residual_score'] ?? ($firstItem['residual_kemungkinan'] * $firstItem['residual_konsekuensi']),

                // Reset Status
                'status' => 'pending_level1',
                'current_level' => 1
            ]);

            // 2. SYNC DETAILS
            $existingIds = $document->details()->pluck('id')->toArray();
            $processedIds = [];

            foreach ($request->items as $item) {
                // Prepare Data Array
                $bahayaData = [
                    'kategori' => $item['kategori'],
                    'details' => $item['kolom6_bahaya'] ?? [],
                    'manual' => $item['bahaya_manual'] ?? ''
                ];

                $controlsData = [
                    'hierarchy' => $item['kolom10_pengendalian'] ?? [],
                    'existing' => $item['kolom11_existing'],
                ];

                $detailData = [
                    'kategori' => $item['kategori'],
                    'kolom2_proses' => $item['kolom2_proses'],
                    'kolom2_kegiatan' => $item['kolom2_kegiatan'],
                    'kolom3_lokasi' => $item['kolom3_lokasi'],
                    'kolom4_pihak' => $item['kolom4_pihak'] ?? null,
                    'kolom5_kondisi' => $item['kolom5_kondisi'],
                    'kolom6_bahaya' => $bahayaData,
                    'kolom7_dampak' => $item['kolom7_dampak'],
                    'kolom9_risiko' => $item['kolom9_risiko'],
                    'kolom10_pengendalian' => $controlsData,
                    'kolom11_existing' => $item['kolom11_existing'],
                    'kolom12_kemungkinan' => $item['kolom12_kemungkinan'],
                    'kolom13_konsekuensi' => $item['kolom13_konsekuensi'],
                    'kolom14_score' => $item['kolom14_score'] ?? ($item['kolom12_kemungkinan'] * $item['kolom13_konsekuensi']),
                    'kolom14_level' => $item['kolom14_level'] ?? null,
                    'kolom15_regulasi' => $item['kolom15_regulasi'] ?? null,
                    'kolom16_aspek' => $item['kolom16_aspek'] ?? null,
                    'kolom17_risiko' => $item['kolom17_risiko'] ?? null,
                    'kolom17_peluang' => $item['kolom17_peluang'] ?? null,
                    'kolom18_tindak_lanjut' => $item['kolom18_tindak_lanjut'],
                    'kolom18_toleransi' => $item['kolom18_toleransi'] ?? 'Ya',
                    'residual_kemungkinan' => $item['residual_kemungkinan'],
                    'residual_konsekuensi' => $item['residual_konsekuensi'],
                    'residual_score' => $item['residual_score'] ?? ($item['residual_kemungkinan'] * $item['residual_konsekuensi']),
                    'residual_level' => $item['residual_level'] ?? null,
                ];

                if (isset($item['id']) && in_array($item['id'], $existingIds)) {
                    // Update existing
                    $document->details()->where('id', $item['id'])->update($detailData);
                    $processedIds[] = $item['id'];
                } else {
                    // Create new
                    $newDetail = $document->details()->create($detailData);
                    $processedIds[] = $newDetail->id;
                }
            }

            // 3. DELETE REMOVED
            $toDelete = array_diff($existingIds, $processedIds);
            if (!empty($toDelete)) {
                $document->details()->whereIn('id', $toDelete)->delete();
            }
        });



        // Redirect based on role
        if ($isApprover) {
            return redirect()->route('approver.check_documents')
                ->with('success', 'Dokumen berhasil diperbarui.');
        }

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
            ->with([
                'user',
                'unit',
                'approvals' => function ($q) {
                    $q->orderBy('created_at', 'desc');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        // Transform for View
        $documentsData = $documents->map(function ($doc) use ($user) {
            $status = 'Disetujui'; // Default fallback (History/Done)

            // Check if this is a revision
            if ($doc->status === 'revision') {
                // Get the last approval to determine who sent it back
                $lastApproval = $doc->approvals->first(); // Already ordered by desc

                // Only show as "Revisi" if it came from Unit Pengelola (Level 2)
                // Hide if it came from Kepala Unit Kerja themselves (Level 1)
                if ($lastApproval && $lastApproval->level == 2 && $lastApproval->action == 'revised') {
                    // This is a revision from Unit Pengelola - SHOW IT
                    $status = 'Revisi';
                } elseif ($lastApproval && $lastApproval->level == 1 && $lastApproval->action == 'revised') {
                    // This is a revision from Kepala Unit Kerja themselves - HIDE IT
                    return null;
                } else {
                    // Fallback for revisions without clear approval history
                    $status = 'Revisi';
                }
            } elseif ($doc->canBeApprovedBy($user)) {
                $status = 'Menunggu';
            } elseif ($doc->status === 'approved') {
                $status = 'Disetujui';
            } elseif ($doc->current_level > 1) {
                $status = 'Disetujui'; // Lanjut ke level berikutnya
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
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'category' => $doc->kategori,
                'date_submit' => $doc->created_at->format('d M Y'),
                'time_submit' => $doc->created_at->format('H:i') . ' WIB',
                'status' => $status,
                'viewUrl' => route('approver.review', ['document' => $doc->id])
            ];
        })->filter()->values(); // Remove null values and re-index

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

        // Fetch current PIC (staff dengan can_create_document = 1)
        $currentPIC = null;
        $staffList = collect([]);

        if ($user->role_jabatan == 3) { // Kepala Unit
            $currentPIC = \App\Models\User::where('id_unit', $user->id_unit)
                ->where('can_create_documents', 1)
                ->first();

            $staffList = \App\Models\User::where('id_unit', $user->id_unit)
                ->whereIn('role_jabatan', [4, 5, 6])
                ->orderBy('nama_user', 'asc')
                ->get(['id_user', 'nama_user', 'role_jabatan', 'can_create_documents']);
        }

        return view('approver.dashboard', compact('user', 'pendingCount', 'pendingDocuments', 'publishedDocuments', 'direktorats', 'departemens', 'units', 'seksis', 'currentPIC', 'staffList'));
    }

    /**
     * Show Unit Pengelola Dashboard
     */
    public function unitPengelolaDashboard()
    {
        $user = Auth::user();

        // Verify user is from SHE or Security (Head or Staff)
        // Checks ID Unit 55 or 56. Role check is handled by logic below.
        if (!in_array($user->id_unit, [55, 56])) {
            abort(403, 'Akses ditolak. Unit tidak valid.');
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

        // --- 1. HEAD OF UNIT VIEW (Process Lists) ---
        $pendingDocuments = collect([]);
        if ($user->isKepalaUnit()) {
            $pendingDocuments = Document::where('current_level', 2)
                ->where('status', 'pending_level2')
                ->whereIn('kategori', $categoryFilter)
                ->with(['user', 'unit'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // --- 2. STAFF VIEW (My Assignments) ---
        // A. Documents Assigned for REVIEW (Staff Reviewer) (Role 5, 6 etc)
        $myReviews = Document::where('level2_status', 'assigned_review')
            ->where('level2_reviewer_id', $user->id_user)
            ->with(['user', 'unit'])
            ->get();

        // B. Documents Assigned for VERIFICATION (Staff Approver) (Role 4)
        $myVerifications = Document::where('level2_status', 'assigned_approval')
            ->where('level2_approver_id', $user->id_user)
            ->with(['user', 'unit'])
            ->get();

        // C. History (Completed Reviews/Verifications)
        $historyReviews = Document::where('level2_reviewer_id', $user->id_user)
            ->where('level2_status', '!=', 'assigned_review')
            ->whereNotNull('level2_status') // Ensure it was part of this workflow
            ->with(['user', 'unit'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $historyVerifications = Document::where('level2_approver_id', $user->id_user)
            ->where('level2_status', '!=', 'assigned_approval')
            ->whereNotNull('level2_status')
            ->with(['user', 'unit'])
            ->orderBy('updated_at', 'desc')
            ->get();


        $publishedDocuments = Document::published()
            ->with(['user', 'unit'])
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();

        // Transform Pending Documents for JS (HEAD VIEW)
        $pendingData = $pendingDocuments->map(function ($doc) {
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
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
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'category' => $doc->kategori,
                'date' => $doc->created_at->format('d M Y'),
                'author' => $doc->user->nama_user ?? '-',
                'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'status' => 'DISETUJUI',
                'risk_level' => $doc->risk_level ?? 'High',
                'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'approval_note' => $lastApproval ? $lastApproval->catatan : '-'
            ];
        });

        // Fetch Staff for Disposition (Only for Head View)
        $staffReviewers = collect([]);
        $staffApprovers = collect([]);
        if ($user->isKepalaUnit()) {
            $staffReviewers = \App\Models\User::where('id_unit', $user->id_unit)
                ->whereIn('role_jabatan', [5, 6]) // Band IV, V
                ->get();

            $staffApprovers = \App\Models\User::where('id_unit', $user->id_unit)
                ->where('role_jabatan', 4) // Band III
                ->get();
        }

        $pendingCount = $pendingDocuments->count() + $myReviews->count() + $myVerifications->count();

        $direktorats = Direktorat::where('status_aktif', 1)->get();
        $departemens = Departemen::all();
        $units = Unit::all();

        return view('unit_pengelola.dashboard', compact(
            'user',
            'pendingCount',
            'pendingDocuments',
            'myReviews',
            'myVerifications',
            'publishedDocuments',
            'pendingData',
            'publishedData',
            'direktorats',
            'departemens',
            'units',
            'staffReviewers',
            'staffApprovers',
            'historyReviews',
            'historyVerifications'
        ));
    }

    /**
     * Show review page
     */
    public function review(Document $document)
    {
        $document->load(['user', 'approvals.approver', 'direktorat', 'departemen', 'unit', 'seksi']);

        $staffReviewers = [];
        $staffApprovers = [];

        if (auth()->user()->getRoleName() == 'unit_pengelola') {
            $staffReviewers = \App\Models\User::where('id_unit', auth()->user()->id_unit)
                ->whereIn('role_jabatan', [5, 6]) // Band IV, V
                ->get();

            $staffApprovers = \App\Models\User::where('id_unit', auth()->user()->id_unit)
                ->where('role_jabatan', 4) // Band III
                ->get();
        }

        return view(match (auth()->user()->getRoleName()) {
            'unit_pengelola' => 'unit_pengelola.documents.review',
            'kepala_departemen' => 'kepala_departemen.documents.review',
            default => 'approver.documents.review',
        }, compact('document', 'staffReviewers', 'staffApprovers'));
    }

    /**
     * Approve document
     */
    public function approve(Request $request, Document $document)
    {
        $request->validate([
            'catatan' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Security Check
        if (!$document->canBeApprovedBy($user)) {
            \Log::error('Approval Failed: Security Check', [
                'user_id' => $user->id_user,
                'doc_id' => $document->id,
                'current_level' => $document->current_level,
                'can_approve' => $document->canBeApprovedBy($user)
            ]);
            abort(403, 'Anda tidak memiliki akses untuk menyetujui dokumen ini.');
        } else {
            \Log::info('Approval Allowed', [
                'user_id' => $user->id_user,
                'doc_id' => $document->id,
                'current_level' => $document->current_level
            ]);
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
                // Unit Pengelola (Level 2)
                if (!$document->id_dept || $document->id_dept == 0) {
                    // No Dept -> Publish Directly
                    $document->update([
                        'status' => 'published',
                        'published_at' => now()
                    ]);
                } else {
                    // Has Dept -> Kepala Departemen (Level 3)
                    $document->update([
                        'current_level' => 3,
                        'status' => 'pending_level3'
                    ]);
                }
            } elseif ($document->current_level == 3) {
                // Kepala Departemen (Level 3) -> PUBLISH
                $document->update([
                    'status' => 'published',
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
        $message = 'Dokumen berhasil disetujui.';
        if ($document->fresh()->status == 'published') {
            $message .= ' Dokumen telah dipublikasikan.';
        } elseif ($document->fresh()->current_level == 3) {
            $message .= ' Dokumen diteruskan ke Kepala Departemen (Level 3).';
        }

        if ($user->isKepalaDepartemen()) {
            return redirect()->route('kepala_departemen.dashboard')
                ->with('success', 'Dokumen berhasil dipublikasikan.');
        }
        if ($user->isUnitPengelola() || $document->approvals()->where('level', 2)->where('approver_id', $user->id_user)->exists()) {
            return redirect()->route('unit_pengelola.dashboard')
                ->with('success', $message);
        }

        // Fallback Redirects
        if ($user->hasRole('admin'))
            return redirect()->route('admin.dashboard')->with('success', 'Dokumen Disetujui.');

        return redirect()->route('dashboard')->with('success', $message);
    }

    /**
     * Send document for revision
     */

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
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan, // Prioritize Document Title
                'risk_level' => $doc->risk_level ?? 'High', // Context for Card
                'date_submit' => $doc->created_at->format('d M Y'),
                'time_submit' => $doc->created_at->format('H:i') . ' WIB',
                'status' => $status,
                'viewUrl' => route('kepala_departemen.review', ['document' => $doc->id])
            ];
        });

        return view('kepala_departemen.documents.index', compact('documentsData'));
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

    /**
     * Publish document (Kepala Departemen Level 3)
     */
    public function publish(Request $request, Document $document)
    {
        $user = Auth::user();

        // Authorization: Must be Kepala Departemen (role 2) and same department
        if (!$user->isKepalaDepartemen() || $user->id_dept != $document->id_dept) {
            abort(403, 'Unauthorized to publish this document.');
        }

        // Verify document is at level 3 and pending
        if ($document->current_level != 3 || $document->status != 'pending_level3') {
            return back()->with('error', 'Dokumen tidak dalam status yang tepat untuk dipublikasi.');
        }

        // Log approval history
        $document->approvals()->create([
            'approver_id' => $user->id_user,
            'level' => 3,
            'action' => 'approved',
            'catatan' => $request->catatan ?? 'Dokumen dipublikasikan oleh Kepala Departemen',
            'ip_address' => $request->ip()
        ]);

        // Update document status to published
        $document->update([
            'status' => 'published',
            'published_at' => now()
        ]);

        return redirect()->route('kepala_departemen.dashboard')
            ->with('success', 'Dokumen berhasil dipublikasikan dan dapat dilihat oleh semua user.');
    }


    // ==================== DISPOSITION WORKFLOW ====================

    /**
     * Handle Disposition by Unit Pengelola Head
     */
    public function disposition(Request $request, Document $document)
    {
        $request->validate([
            'reviewer_id' => 'required|exists:users,id_user',
            'approver_id' => 'required|exists:users,id_user',
        ]);

        $user = Auth::user();

        // Ensure user is authorized (Head of Unit Pengelola)
        if (!$user->isUnitPengelola() || $document->current_level != 2) {
            abort(403, 'Unauthorized disposition.');
        }

        $document->update([
            'level2_status' => 'assigned_review',
            'level2_reviewer_id' => $request->reviewer_id,
            'level2_approver_id' => $request->approver_id,
            'level2_assignment_date' => now(),
        ]);

        // Log History for Disposition
        $document->approvals()->create([
            'approver_id' => $user->id_user,
            'level' => 2,
            'action' => 'disposition',
            'catatan' => 'Disposisi ke Reviewer & Approver',
            'ip_address' => $request->ip()
        ]);

        return back()->with('success', 'Dokumen berhasil didisposisikan kepada staff.');
    }

    /**
     * Submit Review by Staff (Band IV/V)
     */
    public function submitReviewUnit(Request $request, Document $document)
    {
        // Check: Is User the assigned Reviewer?
        if (Auth::id() != $document->level2_reviewer_id) {
            abort(403, 'Anda bukan reviewer yang ditunjuk untuk dokumen ini.');
        }

        // Also update any changes to the document (Risk Assessments, etc.)
        // Reusing the update logic might be good, but for now we trust they used the form which pointed here.
        // Or better: Use the same `approve` method logic for saving content but redirect differently?
        // Let's assume we just update status here. Content is updated via a separate update call or we replicate logic.
        // Actually, usually users edit form then click "Submit Review".
        // To catch edits, we should replicate the update logic or extract "update content" to a private method.
        // For simplicity now, I'll assume content is saved via JS auto-save or I should handle it.
        // Given existing pattern: `approve` handles update + transition.
        // I will copy the update content logic here lightly or assume a "save" happened.
        // Wait, the Review page usually submits a form to this Action.
        // So I should Handle Data Update here too.

        $this->updateDocumentContent($request, $document);

        // Log History
        $document->approvals()->create([
            'approver_id' => Auth::id(),
            'level' => 2,
            'action' => 'reviewed',
            'catatan' => $request->catatan ?? 'Review selesai oleh Staff Reviewer',
            'ip_address' => $request->ip()
        ]);

        $document->update([
            'level2_status' => 'assigned_approval', // Move to Approver (Band III)
        ]);

        return redirect()->route('unit_pengelola.check_documents')->with('success', 'Review selesai. Dokumen diteruskan ke Verifikator.');
    }

    /**
     * Verify/Approve by Staff (Band III)
     */
    public function verifyUnit(Request $request, Document $document)
    {
        // Check: Is User the assigned Approver?
        if (Auth::id() != $document->level2_approver_id) {
            abort(403, 'Anda bukan verifikator yang ditunjuk untuk dokumen ini.');
        }

        $this->updateDocumentContent($request, $document);

        // Log History
        $document->approvals()->create([
            'approver_id' => Auth::id(),
            'level' => 2,
            'action' => 'verified',
            'catatan' => $request->catatan ?? 'Verifikasi selesai oleh Staff Verifikator',
            'ip_address' => $request->ip()
        ]);

        $document->update([
            'level2_status' => 'staff_verified',
            'status' => 'staff_verified', // Update main status so it appears on Kepala Unit dashboard
        ]);

        return redirect()->route('unit_pengelola.check_documents')->with('success', 'Verifikasi selesai. Dokumen dikembalikan ke Kepala Unit.');
    }

    /**
     * Helper to update content similar to approve()
     */
    private function updateDocumentContent(Request $request, Document $document)
    {
        // Save Compliance Checklist if present
        if ($request->has('compliance_checklist')) {
            $document->update([
                'compliance_checklist' => $request->compliance_checklist
            ]);
        }

        // Check if 'items' is present (Multi-item submission)
        if ($request->has('items') && is_array($request->items)) {

            // 1. Update Header from First Item (Legacy Consistency)
            $firstItem = $request->items[0] ?? null;
            if ($firstItem) {
                $document->update([
                    'kolom2_proses' => $firstItem['kolom2_proses'] ?? $document->kolom2_proses,
                    'kolom2_kegiatan' => $firstItem['kolom2_kegiatan'] ?? $document->kolom2_kegiatan,
                    'kolom3_lokasi' => $firstItem['kolom3_lokasi'] ?? $document->kolom3_lokasi,
                    'kolom5_kondisi' => $firstItem['kolom5_kondisi'] ?? $document->kolom5_kondisi,
                    'kolom7_dampak' => $firstItem['kolom7_dampak'] ?? $document->kolom7_dampak,
                    'kolom9_risiko' => $firstItem['kolom9_risiko'] ?? $document->kolom9_risiko,
                    'kolom14_score' => ($firstItem['kolom12_kemungkinan'] ?? 0) * ($firstItem['kolom13_konsekuensi'] ?? 0),
                    'kolom12_kemungkinan' => $firstItem['kolom12_kemungkinan'] ?? $document->kolom12_kemungkinan,
                    'kolom13_konsekuensi' => $firstItem['kolom13_konsekuensi'] ?? $document->kolom13_konsekuensi,
                    'residual_score' => ($firstItem['residual_kemungkinan'] ?? 0) * ($firstItem['residual_konsekuensi'] ?? 0),
                    'residual_kemungkinan' => $firstItem['residual_kemungkinan'] ?? $document->residual_kemungkinan,
                    'residual_konsekuensi' => $firstItem['residual_konsekuensi'] ?? $document->residual_konsekuensi,
                    // Add others if needed
                ]);
            }

            // 2. Update Details
            foreach ($request->items as $itemData) {
                if (isset($itemData['id'])) {
                    $detail = $document->details()->find($itemData['id']);
                    if ($detail) {
                        // Prepare update data
                        $updateData = [
                            'kolom2_proses' => $itemData['kolom2_proses'] ?? $detail->kolom2_proses,
                            'kolom2_kegiatan' => $itemData['kolom2_kegiatan'] ?? $detail->kolom2_kegiatan,
                            'kolom3_lokasi' => $itemData['kolom3_lokasi'] ?? $detail->kolom3_lokasi,
                            'kolom5_kondisi' => $itemData['kolom5_kondisi'] ?? $detail->kolom5_kondisi,
                            'kolom7_dampak' => $itemData['kolom7_dampak'] ?? $detail->kolom7_dampak,
                            'kolom9_risiko' => $itemData['kolom9_risiko'] ?? $detail->kolom9_risiko,
                            'kolom11_existing' => $itemData['kolom11_existing'] ?? $detail->kolom11_existing,
                            'kolom12_kemungkinan' => $itemData['kolom12_kemungkinan'] ?? $detail->kolom12_kemungkinan,
                            'kolom13_konsekuensi' => $itemData['kolom13_konsekuensi'] ?? $detail->kolom13_kemungkinan,
                            'kolom15_regulasi' => $itemData['kolom15_regulasi'] ?? $detail->kolom15_regulasi,
                            'kolom16_aspek' => $itemData['kolom16_penting'] ?? $detail->kolom16_aspek, // Mapping check?
                            'kolom17_risiko' => $itemData['kolom17_risiko'] ?? $detail->kolom17_risiko,
                            'kolom17_peluang' => $itemData['kolom17_peluang'] ?? $detail->kolom17_peluang,
                            'kolom18_tindak_lanjut' => $itemData['kolom18_tindak_lanjut'] ?? $detail->kolom18_tindak_lanjut,
                            'kolom18_toleransi' => $itemData['kolom18_toleransi'] ?? $detail->kolom18_toleransi,
                            'residual_kemungkinan' => $itemData['residual_kemungkinan'] ?? $detail->residual_kemungkinan,
                            'residual_konsekuensi' => $itemData['residual_konsekuensi'] ?? $detail->residual_konsekuensi,
                        ];

                        // Calc Scores
                        if (isset($updateData['kolom12_kemungkinan']) && isset($updateData['kolom13_konsekuensi'])) {
                            $updateData['kolom14_score'] = $updateData['kolom12_kemungkinan'] * $updateData['kolom13_konsekuensi'];
                        }
                        if (isset($updateData['residual_kemungkinan']) && isset($updateData['residual_konsekuensi'])) {
                            $updateData['residual_score'] = $updateData['residual_kemungkinan'] * $updateData['residual_konsekuensi'];
                        }

                        // Hierarchy logic
                        if (isset($itemData['hirarki'])) {
                            $currentControl = $detail->kolom10_pengendalian ?? [];
                            $currentControl['hierarchy'] = $itemData['hirarki'];
                            $updateData['kolom10_pengendalian'] = $currentControl;
                        }

                        $detail->update($updateData);
                    }
                }
            }
        }
    }

    public function updatePIC(Request $request)
    {
        try {
            $request->validate([
                'staff_id' => 'required|exists:users,id_user'
            ]);

            $user = Auth::user();

            // Only Kepala Unit can update PIC
            if ($user->role_jabatan != 3) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            $staffId = $request->staff_id;

            // Verify staff is from same unit
            $staff = \App\Models\User::where('id_user', $staffId)
                ->where('id_unit', $user->id_unit)
                ->whereIn('role_jabatan', [4, 5, 6])
                ->first();

            if (!$staff) {
                return response()->json(['success' => false, 'message' => 'Staff not found'], 404);
            }

            // Update: Set all staff in unit to can_create_documents = 0
            \App\Models\User::where('id_unit', $user->id_unit)
                ->update(['can_create_documents' => 0]);

            // Set selected staff to can_create_documents = 1
            $staff->can_create_documents = 1;
            $staff->save();

            return response()->json([
                'success' => true,
                'message' => 'PIC berhasil diupdate',
                'staff_name' => $staff->nama_user
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating PIC: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update specific detail item (AJAX for Approver)
     */
    public function updateDetail(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $detail = \App\Models\DocumentDetail::findOrFail($id);
            $document = $detail->document;

            // Auth Check: Author OR Approver (Role 3 + Same Unit)
            $isAuthor = $document->id_user == $user->id_user;
            $isApprover = ($user->role_jabatan == 3 && $document->id_unit == $user->id_unit);

            if (!$isAuthor && !$isApprover) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            // Update Logic
            // We need to reconstruct JSON fields like kolom6_bahaya & kolom10_pengendalian

            // 1. Bahaya Data
            $currentBahaya = $detail->kolom6_bahaya ?? [];
            if ($request->has('kategori'))
                $currentBahaya['kategori'] = $request->kategori; // sync category
            // Note: For full edit, we might need more inputs. 
            // Assuming the modal sends 'kolom2_kegiatan', 'kolom3_lokasi', etc.

            $updateData = $request->only([
                'kolom2_kegiatan',
                'kolom3_lokasi',
                'kolom5_kondisi',
                'kolom11_existing',
                'kolom12_kemungkinan',
                'kolom13_konsekuensi',
                'kolom16_aspek',
                'kolom18_tindak_lanjut',
                'residual_kemungkinan',
                'residual_konsekuensi'
            ]);

            // Calc Scores
            if (isset($updateData['kolom12_kemungkinan']) && isset($updateData['kolom13_konsekuensi'])) {
                $updateData['kolom14_score'] = $updateData['kolom12_kemungkinan'] * $updateData['kolom13_konsekuensi'];
                // Update Level logic can be added here or via Accessor/Observer
            }
            if (isset($updateData['residual_kemungkinan']) && isset($updateData['residual_konsekuensi'])) {
                $updateData['residual_score'] = $updateData['residual_kemungkinan'] * $updateData['residual_konsekuensi'];
            }

            $detail->update($updateData);

            // Optionally update risk levels (simple logic)
            // ...

            return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get HTML Form for specific detail item (AJAX for Approver)
     */
    public function getEditItemHtml($id)
    {
        try {
            $user = Auth::user();
            $detail = \App\Models\DocumentDetail::findOrFail($id);
            $document = $detail->document;

            // Auth Check
            if ($document->id_user != $user->id_user && !($user->role_jabatan == 3 && $document->id_unit == $user->id_unit)) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            // Render view component
            $html = view('components.hiradc-item-form', [
                'item' => $detail,
                'index' => $detail->id, // Use ID as index to be unique
                'prefix' => 'edit_item' // Flat logic: inputs will be named edit_item[ID][field]
            ])->render();

            return response()->json(['success' => true, 'html' => $html]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }



    /**
     * Show published document detail (Read-only)
     */
    public function showPublished(Document $document)
    {
        $document->load(['user', 'details', 'approvals.approver', 'direktorat', 'departemen', 'unit', 'seksi']);
        return view('documents.published_detail', compact('document'));
    }

    /**
     * Show review page for Unit Pengelola
     */
    public function reviewUnit($id)
    {
        $document = Document::with(['user.unit', 'details', 'approvals'])->findOrFail($id);

        $user = Auth::user();

        // Fetch Staff for Disposition Forms
        $staffReviewers = \App\Models\User::where('id_unit', $user->id_unit)
            ->whereIn('role_jabatan', [5, 6]) // Band IV, V
            ->get();

        $staffApprovers = \App\Models\User::where('id_unit', $user->id_unit)
            ->where('role_jabatan', 4) // Band III
            ->get();

        return view('unit_pengelola.documents.review', compact('document', 'staffReviewers', 'staffApprovers'));
    }

    /**
     * Show documents approved by Kepala Unit Kerja (Level 1)
     * Filtered by category based on Unit Pengelola type:
     * - Unit of SHE (id 55): K3, KO, Lingkungan
     * - Unit Security (id 56): Keamanan
     */
    public function unitPengelolaPending()
    {
        $user = Auth::user();
        if (!in_array($user->id_unit, [55, 56]))
            abort(403);

        // Check if user is Staff (role_jabatan 4, 5, or 6)
        // If yes, redirect to staff inbox
        if (in_array($user->role_jabatan, [4, 5, 6])) {
            return redirect()->route('unit_pengelola.staff.index');
        }

        // If Kepala Unit Pengelola, show disposition page
        // Determine allowed categories based on unit
        $allowedCategories = [];
        if ($user->id_unit == 55) {
            // Unit Security receives Keamanan
            $allowedCategories = ['Keamanan'];
        } elseif ($user->id_unit == 56) {
            // Unit of SHE receives K3, KO, Lingkungan
            $allowedCategories = ['K3', 'KO', 'Lingkungan'];
        }

        // Load documents that have been approved by Level 1 (Kepala Unit Kerja)
        // and are now pending for Level 2 (Unit Pengelola) review
        // Include both: pending disposition AND staff verified (ready for Kepala approval)
        $documents = Document::where('current_level', 2)
            ->whereIn('status', ['pending_level2', 'staff_verified'])
            ->whereIn('kategori', $allowedCategories)
            ->with(['user', 'unit', 'approvals.approver'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('unit_pengelola.documents.index', compact('documents'));
    }

    public function staffIndex()
    {
        $user = Auth::user();

        // Check if user is Staff (role_jabatan 4, 5, or 6)
        if (!in_array($user->role_jabatan, [4, 5, 6])) {
            abort(403, 'Unauthorized. Only Unit Pengelola staff can access this page.');
        }

        // Check if user is from Unit Pengelola (id_unit 55 or 56)
        if (!in_array($user->id_unit, [55, 56])) {
            abort(403, 'Unauthorized. Only Unit Pengelola staff can access this page.');
        }

        // Load documents assigned to this staff (either as reviewer or approver)
        $query = Document::where(function ($q) use ($user) {
            $q->where('level2_reviewer_id', $user->id_user)
                ->orWhere('level2_approver_id', $user->id_user);
        });

        // Filter by role: Verifikator (role_jabatan 4) only sees documents for verification
        // Reviewer (role_jabatan 5, 6) sees all assigned documents
        if ($user->role_jabatan == 4) {
            // Verifikator only sees: assigned_approval (documents that need verification)
            $query->whereIn('level2_status', ['assigned_approval']);
        } else {
            // Reviewer only sees: assigned_review (documents that need review)
            // Documents that have been processed (assigned_approval, approved, etc) are hidden
            $query->whereIn('level2_status', ['assigned_review']);
        }

        $documents = $query->with(['user', 'unit', 'approvals.approver'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('unit_pengelola.documents.staff_index', compact('documents'));
    }


}
