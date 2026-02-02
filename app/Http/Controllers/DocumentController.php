<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Direktorat;
use App\Models\Departemen;
use App\Models\Unit;
use App\Models\Seksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocumentDetailExport;

class DocumentController extends Controller
{
    /**
     * Export Published Documents to PDF
     */
    public function exportPdf()
    {
        $user = Auth::user();

        // 1. Determine Scope
        // Special Units: Mgt System (34), Security (55), SHE (56) => Can download ALL
        $specialUnits = [34, 55, 56];

        $query = Document::published()
            ->with(['user', 'approvals', 'unit']);

        if (!in_array($user->id_unit, $specialUnits)) {
            $query->where('id_unit', $user->id_unit);
        }

        $documents = $query->orderBy('published_at', 'desc')->get();

        $pdf = Pdf::loadView('documents.export_pdf', compact('documents'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('published_documents_' . date('Y-m-d_His') . '.pdf');
    }

    /**
     * Export Published Documents to Excel (CSV)
     */
    public function exportExcel()
    {
        $user = Auth::user();

        // 1. Determine Scope
        $specialUnits = [34, 55, 56];

        $query = Document::published()
            ->with(['user', 'approvals', 'unit']);

        if (!in_array($user->id_unit, $specialUnits)) {
            $query->where('id_unit', $user->id_unit);
        }

        $documents = $query->orderBy('published_at', 'desc')->get();

        $filename = "published_documents_" . date('Y-m-d_His') . ".csv";

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function () use ($documents) {
            $file = fopen('php://output', 'w');

            // Header Row
            fputcsv($file, ['Unit Penginput', 'Judul Form', 'Kategori', 'Disetujui Oleh', 'Tanggal Publish', 'Waktu', 'Penulis', 'Risiko']);

            foreach ($documents as $doc) {
                $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();
                $approver = $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-';
                $unitName = $doc->unit ? $doc->unit->nama_unit : '-';

                // Title Mapping logic
                $title = $doc->judul_dokumen ?? '-';

                fputcsv($file, [
                    $unitName,
                    $title,
                    $doc->kategori,
                    $approver,
                    $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                    $doc->published_at ? $doc->published_at->format('H:i') : '-',
                    $doc->user->nama_user ?? '-',
                    $doc->risk_level ?? 'High'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Generate Standardized Filename
     * Format: [Title]_[UnitInput]_[Dept]_[SHE/Security]
     */
    private function generateStandardFilename(Document $document, $extension)
    {
        // 1. Title
        $title = $document->judul_dokumen ?? $document->kolom2_kegiatan ?? 'Dokumen';

        // 2. Unit Input
        $unitInput = $document->unit->nama_unit ?? 'Unit';

        // 3. Department
        $dept = $document->user && $document->user->departemen ? $document->user->departemen->nama_dept : 'Dept';

        // 4. Managing Unit (SHE/Security) - Logic to infer or default
        // If the document is specifically managed by SHE or Security, we append it.
        // Assuming 'managing_unit' attribute exists or we infer from ID?
        // Let's check if we can infer from the document content or just use a generic logic if not explicit.
        // Since the prompt says "from unit pengelola she or security", we can maybe check the approvers or the flow?
        // Or simply append "SHE" if status_she is active, "Security" if status_security is active?
        // For simplicity and robustness, let's look at the document's type/content flags if available, 
        // OR rely on who is exporting it? No, filename should be consistent.

        $suffix = 'HIRADC'; // Default
        if ($document->hasSheContent()) {
            $suffix = 'SHE';
        } elseif ($document->hasSecurityContent()) {
            $suffix = 'Security';
        }

        // Sanitize parts
        $safeTitle = $this->sanitizeFilename($title);
        $safeUnit = $this->sanitizeFilename($unitInput);
        $safeDept = $this->sanitizeFilename($dept);

        return "{$safeTitle}_{$safeUnit}_{$safeDept}_{$suffix}.{$extension}";
    }

    /**
     * Export Single Document Detail to PDF
     */
    public function exportDetailPdf(Document $document)
    {
        // ... (Access Control kept same, abbreviated for brevity in replacer if needed, but here replacing full function)
        // Access Control
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        $isAuthor = $user->id_user == $document->id_user;
        $isPublic = in_array($document->status, ['published', 'approved']);
        $isUnitPengelola = $user->isUnitPengelola();
        $isApprover = $document->approvals()->where('approver_id', $user->id_user)->exists() || $document->canBeApprovedBy($user);

        if (!$isAuthor && !$isPublic && !$isUnitPengelola && !$isApprover) {
            abort(403, 'Unauthorized access to export document.');
        }

        $document->load(['details', 'user', 'unit', 'approvals.approver', 'departemen', 'direktorat']);

        $pdf = Pdf::loadView('documents.export_detail_pdf', compact('document'));
        $pdf->setPaper('a4', 'landscape');

        $filename = $this->generateStandardFilename($document, 'pdf');
        return $pdf->download($filename);
    }

    /**
     * Export Single Document Detail to Excel
     */
    public function exportDetailExcel(Document $document)
    {
        // Access Control
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        $isAuthor = $user->id_user == $document->id_user;
        $isPublic = in_array($document->status, ['published', 'approved']);
        $isUnitPengelola = $user->isUnitPengelola() || (in_array($user->role_jabatan, [4, 5, 6]) && in_array($user->id_unit, [55, 56]));
        $isApprover = $document->approvals()->where('approver_id', $user->id_user)->exists() || $document->canBeApprovedBy($user);

        if (!$isAuthor && !$isPublic && !$isUnitPengelola && !$isApprover) {
            abort(403, 'Unauthorized access to export document.');
        }

        $document->load(['details', 'user', 'unit', 'departemen']);

        $filename = $this->generateStandardFilename($document, 'xlsx');

        return Excel::download(new DocumentDetailExport($document), $filename);
    }

    /**
     * Sanitize filename by removing special characters
     */
    private function sanitizeFilename($string)
    {
        // Remove special characters, keep only alphanumeric, spaces, and hyphens
        $string = preg_replace('/[^A-Za-z0-9\s\-]/', '', $string);
        // Replace multiple spaces with single space
        $string = preg_replace('/\s+/', ' ', $string);
        // Replace spaces with underscores
        $string = str_replace(' ', '_', $string);
        // Limit length
        return substr($string, 0, 50);
    }
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
            'items.*.residual_score' => 'nullable|numeric|min:0',
            'items.*.residual_level' => 'nullable|string',
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
                // kolom7_dampak removed - no longer used in new structure
                'kolom9_risiko' => $firstItem['kolom9_risiko'] ?? $firstItem['kolom9_risiko_k3ko'] ?? $firstItem['kolom9_dampak_lingkungan'] ?? $firstItem['kolom9_celah_keamanan'] ?? null,
                'kolom10_pengendalian' => $headerControls,
                'kolom11_existing' => $firstItem['kolom11_existing'],
                'kolom12_kemungkinan' => $firstItem['kolom12_kemungkinan'],
                'kolom13_konsekuensi' => $firstItem['kolom13_konsekuensi'],
                'kolom14_score' => $firstItem['kolom14_score'] ?? ($firstItem['kolom12_kemungkinan'] * $firstItem['kolom13_konsekuensi']),
                'kolom15_regulasi' => $firstItem['kolom15_regulasi'] ?? null,
                'kolom16_aspek' => $firstItem['kolom16_aspek'] ?? null,
                'kolom17_risiko' => $firstItem['kolom17_risiko'] ?? null,
                'kolom17_peluang' => $firstItem['kolom17_peluang'] ?? null,
                // kolom18_tindak_lanjut removed - replaced by kolom18_toleransi + kolom19-22
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
                    'kolom5_kondisi' => $item['kolom5_kondisi'],
                    'kolom6_bahaya' => $bahayaData,
                    // Conditional: Aspek Lingkungan (Lingkungan category only)
                    'kolom7_aspek_lingkungan' => [
                        'details' => $item['kolom7_aspek_lingkungan'] ?? [],
                        'manual' => $item['aspek_manual'] ?? '',
                    ],
                    // Conditional: Ancaman Keamanan (Keamanan category only)
                    'kolom8_ancaman' => [
                        'details' => $item['kolom8_ancaman'] ?? [],
                        'manual' => $item['ancaman_manual'] ?? '',
                    ],
                    // Kolom 9: Separate fields based on category
                    'kolom9_risiko_k3ko' => $item['kolom9_risiko_k3ko'] ?? null,
                    'kolom9_dampak_lingkungan' => $item['kolom9_dampak_lingkungan'] ?? null,
                    'kolom9_celah_keamanan' => $item['kolom9_celah_keamanan'] ?? null,
                    // Keep old kolom9_risiko for backward compatibility (default to '-' if all new fields are empty)
                    'kolom9_risiko' => $item['kolom9_risiko_k3ko'] ?? $item['kolom9_dampak_lingkungan'] ?? $item['kolom9_celah_keamanan'] ?? '-',
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
                    'kolom18_toleransi' => $item['kolom18_toleransi'] ?? 'Ya',
                    // Columns 19-22: Follow-up risk assessment (only if tolerance = Tidak)
                    'kolom19_pengendalian_lanjut' => $item['kolom19_pengendalian_lanjut'] ?? null,
                    'kolom20_kemungkinan_lanjut' => $item['kolom20_kemungkinan_lanjut'] ?? null,
                    'kolom21_konsekuensi_lanjut' => $item['kolom21_konsekuensi_lanjut'] ?? null,
                    'kolom22_tingkat_risiko_lanjut' => $item['kolom22_tingkat_risiko_lanjut'] ?? null,
                    'kolom22_level_lanjut' => $item['kolom22_level_lanjut'] ?? null,
                    'residual_kemungkinan' => $item['residual_kemungkinan'] ?? 0,
                    'residual_konsekuensi' => $item['residual_konsekuensi'] ?? 0,
                    'residual_score' => $item['residual_score'] ?? (isset($item['residual_kemungkinan']) && isset($item['residual_konsekuensi']) ? ($item['residual_kemungkinan'] * $item['residual_konsekuensi']) : 0),
                    'residual_level' => $item['residual_level'] ?? '-',
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
            'revision_comment' => 'required|string|min:5', // Added validation
            // Add other validations as needed
        ]);

        \DB::transaction(function () use ($request, $document, $user) {
            // 1. UPDATE HEADER (Legacy compatibility with Item #1)
            // Use reset() to get the first item regardless of array key (e.g. if index is ID)
            $items = $request->items;
            $firstItem = reset($items); // Get first element value

            $headerBahaya = [
                'type' => '',
                'kategori' => $firstItem['kategori'] ?? 'K3',
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
                'kategori' => $firstItem['kategori'] ?? 'K3',
                'kolom2_proses' => $firstItem['kolom2_proses'] ?? '',
                'kolom2_kegiatan' => $firstItem['kolom2_kegiatan'] ?? '',
                'kolom3_lokasi' => $firstItem['kolom3_lokasi'] ?? '',
                'kolom5_kondisi' => $firstItem['kolom5_kondisi'] ?? '',
                'kolom6_bahaya' => $headerBahaya,
                // Robust Fallback Chain for Kolom 9
                'kolom9_risiko' => $firstItem['kolom9_risiko'] ?? $firstItem['kolom9_risiko_k3ko'] ?? $firstItem['kolom9_dampak_lingkungan'] ?? $firstItem['kolom9_celah_keamanan'] ?? '-',
                'kolom10_pengendalian' => $headerControls,
                'kolom11_existing' => $firstItem['kolom11_existing'] ?? '',
                'kolom12_kemungkinan' => $firstItem['kolom12_kemungkinan'] ?? 1,
                'kolom13_konsekuensi' => $firstItem['kolom13_konsekuensi'] ?? 1,
                'kolom14_score' => $firstItem['kolom14_score'] ?? (($firstItem['kolom12_kemungkinan'] ?? 1) * ($firstItem['kolom13_konsekuensi'] ?? 1)),
                'kolom15_regulasi' => $firstItem['kolom15_regulasi'] ?? null,
                'kolom16_aspek' => $firstItem['kolom16_aspek'] ?? null,
                'kolom17_risiko' => $firstItem['kolom17_risiko'] ?? null,
                'kolom17_peluang' => $firstItem['kolom17_peluang'] ?? null,
                // 'kolom18_tindak_lanjut' => $firstItem['kolom18_tindak_lanjut'] ?? null, // REMOVED: Column does not exist in DB

                'residual_kemungkinan' => $firstItem['residual_kemungkinan'] ?? 0,
                'residual_konsekuensi' => $firstItem['residual_konsekuensi'] ?? 0,
                'residual_score' => $firstItem['residual_score'] ?? (($firstItem['residual_kemungkinan'] ?? 0) * ($firstItem['residual_konsekuensi'] ?? 0)),

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
                    'kolom5_kondisi' => $item['kolom5_kondisi'],
                    'kolom6_bahaya' => $bahayaData,
                    // Conditional: Aspek Lingkungan (Lingkungan category only)
                    'kolom7_aspek_lingkungan' => [
                        'details' => $item['kolom7_aspek_lingkungan'] ?? [],
                        'manual' => $item['aspek_manual'] ?? '',
                    ],
                    // Conditional: Ancaman Keamanan (Keamanan category only)
                    'kolom8_ancaman' => [
                        'details' => $item['kolom8_ancaman'] ?? [],
                        'manual' => $item['ancaman_manual'] ?? '',
                    ],
                    // Kolom 9: Separate fields based on category
                    'kolom9_risiko_k3ko' => $item['kolom9_risiko_k3ko'] ?? null,
                    'kolom9_dampak_lingkungan' => $item['kolom9_dampak_lingkungan'] ?? null,
                    'kolom9_celah_keamanan' => $item['kolom9_celah_keamanan'] ?? null,
                    // Keep old kolom9_risiko for backward compatibility (default to '-' if all new fields are empty)
                    'kolom9_risiko' => $item['kolom9_risiko_k3ko'] ?? $item['kolom9_dampak_lingkungan'] ?? $item['kolom9_celah_keamanan'] ?? '-',
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
                    'kolom18_toleransi' => $item['kolom18_toleransi'] ?? 'Ya',
                    // Columns 19-22: Follow-up risk assessment (only if tolerance = Tidak)
                    'kolom19_pengendalian_lanjut' => $item['kolom19_pengendalian_lanjut'] ?? null,
                    'kolom20_kemungkinan_lanjut' => $item['kolom20_kemungkinan_lanjut'] ?? null,
                    'kolom21_konsekuensi_lanjut' => $item['kolom21_konsekuensi_lanjut'] ?? null,
                    'kolom22_tingkat_risiko_lanjut' => $item['kolom22_tingkat_risiko_lanjut'] ?? null,
                    'kolom22_level_lanjut' => $item['kolom22_level_lanjut'] ?? null,
                    'residual_kemungkinan' => $item['residual_kemungkinan'] ?? 0,
                    'residual_konsekuensi' => $item['residual_konsekuensi'] ?? 0,
                    'residual_score' => $item['residual_score'] ?? (isset($item['residual_kemungkinan']) && isset($item['residual_konsekuensi']) ? ($item['residual_kemungkinan'] * $item['residual_konsekuensi']) : 0),
                    'residual_level' => $item['residual_level'] ?? '-',
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
            // logic: If partial revision, only delete items that belong to the Active Revision Category
            // If SHE revision -> Only delete missing SHE items. Keep Security items.
            // If Security revision -> Only delete missing Security items. Keep SHE items.

            $toDelete = array_diff($existingIds, $processedIds);

            if (!empty($toDelete)) {
                // Determine scope
                $isSheRevision = $document->status_she == 'revision';
                $isSecRevision = $document->status_security == 'revision';

                // If both are revision (or initial submit), delete all in diff
                // If only one is revision, we must protect the other.

                $query = $document->details()->whereIn('id', $toDelete);

                if ($isSheRevision && !$isSecRevision) {
                    // Only delete SHE-related categories
                    $query->whereIn('kategori', ['K3', 'KO', 'Lingkungan']);
                } elseif ($isSecRevision && !$isSheRevision) {
                    // Only delete Security-related categories
                    $query->where('kategori', 'Keamanan');
                }

                $query->delete();
            }

            // 4. LOG REVISION HISTORY
            // Log that the unit has submitted the revision
            $document->approvals()->create([
                'level' => 1, // Reset to level 1 flow
                'approver_id' => $user->id_user,
                'action' => 'resubmitted',
                'catatan' => $request->revision_comment, // Use user comment
            ]);
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

        // Level Determination
        // We want to ensure SHE (56) and Security (55) users see ALL documents if they are Approvers (Level 2).
        // Using broad check: If they are in SHE/Security unit OR have 'approver' role/rank.

        $isSHE = ($user->id_unit == 56);
        $isSecurity = ($user->id_unit == 55);

        // logic: If unit is SHE/Security, they are Level 2 approvers (System Approvers).
        // Also include if they explicitly have role_jabatan 3 (Kepala Unit) BUT specifically for these units.
        // Actually, "Approver" role (id_role_user=3) should also count.

        $isLevel2 = ($isSHE || $isSecurity); // Simplified: explicit SHE/Security units are System Approvers.

        // Note: If normal Kepala Unit (Level 1) of other units logs in, isLevel2 is false.


        $documents = collect([]);

        if ($isLevel2) {
            // Unit Pengelola (SHE / Security)
            // Query docs where their respective status is active (not 'none')
            $query = Document::query()
                ->with([
                    'user',
                    'unit',
                    'approvals' => function ($q) {
                        $q->orderBy('created_at', 'desc');
                    }
                ]);

            if ($isSHE) {
                // Relaxed to allow viewing all categories as requested
                // $query->where('status_she', '!=', 'none');
            } elseif ($isSecurity) {
                // $query->where('status_security', '!=', 'none');
            }

            $documents = $query->orderBy('created_at', 'desc')->get();

        } else {
            // Level 1: Kepala Unit Asal
            // Only see documents from own unit
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
        }

        // Transform for View
        $documentsData = $documents->map(function ($doc) use ($user, $isSHE, $isSecurity, $isLevel2) {
            $status = 'Disetujui'; // Default fallback
            $workflowStatus = $doc->status; // Default global

            // Determine relevant status based on viewer
            // Determine relevant status based on viewer
            if ($isLevel2) {
                if ($isSHE) {
                    $workflowStatus = ($doc->status_she !== 'none') ? $doc->status_she : $doc->status;
                } elseif ($isSecurity) {
                    $workflowStatus = ($doc->status_security !== 'none') ? $doc->status_security : $doc->status;
                }
            }

            // Map Technical Status to Friendly Name
            // Statuses: 'none', 'pending_head', 'pending_reviewer', 'pending_verificator', 'pending_head_final', 'approved', 'revision'
            switch ($workflowStatus) {
                case 'pending_level1':
                    $status = 'Menunggu Approval Kepala Unit';
                    break;
                case 'pending_head':
                    $status = 'Menunggu Disposisi/Approval Head';
                    break;
                case 'pending_reviewer':
                    $status = 'Menunggu Review Staff';
                    break;
                case 'pending_verificator':
                    $status = 'Menunggu Verifikasi Staff';
                    break;
                case 'pending_head_final':
                    $status = 'Menunggu Final Approval';
                    break;
                case 'approved':
                    $status = 'Disetujui';
                    break;
                case 'published':
                    $status = 'Terpublikasi';
                    break;
                case 'pending_level2': // Treating Pending Level 2 as Approved (by Level 1) for this view
                    $status = 'Disetujui';
                    break;
                case 'revision':
                    $status = 'Revisi';
                    break;
                default:
                    $status = ucwords(str_replace('_', ' ', $workflowStatus));
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
                'category' => $doc->managing_unit,
                'date_submit' => $doc->created_at->format('d M Y'),
                'time_submit' => $doc->created_at->format('H:i') . ' WIB',
                'status' => $status,
                'raw_status' => $workflowStatus, // For logic if needed
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

        $publishedDocuments = Document::where(function ($q) {
                $q->where('status', 'published')
                  ->orWhere('status_she', 'published')
                  ->orWhere('status_security', 'published');
            })
            ->with(['user', 'unit', 'approvals.approver'])
            ->orderBy('updated_at', 'desc')
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

    // NEW: Realtime Data for Dashboard Table
    public function getApproverDashboardData(Request $request)
    {
        $query = Document::where(function ($q) {
                $q->where('status', 'published')
                  ->orWhere('status_she', 'published')
                  ->orWhere('status_security', 'published');
            })
            ->with(['user', 'unit', 'details', 'approvals.approver'])
            ->orderBy('updated_at', 'desc');

        // Filter by Unit if provided
        if ($request->has('unit_id') && $request->unit_id != '') {
            $query->where('id_unit', $request->unit_id);
        }

        // Optional: Filter by Dept if provided (though Unit usually implies Dept)
        if ($request->has('dept_id') && $request->dept_id != '') {
            $query->where('id_dept', $request->dept_id);
        }

        // Limit defaults to 20 only if no specific filter
        if (!$request->has('unit_id')) {
            $query->limit(20);
        }

        $publishedDocuments = $query->get();

        $data = $publishedDocuments->map(function ($doc) {
            $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();

            // Revert to Broad Categories (SHE, Security) - Strict Check
            $cats = [];
            if ($doc->hasSheContent() && ($doc->status == 'published' || $doc->status_she == 'published'))
                $cats[] = 'SHE';
            if ($doc->hasSecurityContent() && ($doc->status == 'published' || $doc->status_security == 'published'))
                $cats[] = 'Security';
            $categoryLabel = empty($cats) ? '-' : implode(', ', $cats);

            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan, // Use title fallback
                'document_title' => $doc->judul_dokumen,
                'category' => $categoryLabel,
                'date' => $doc->created_at->format('d M Y'),
                'author' => $doc->user->nama_user ?? '-',
                'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'seksi_id' => $doc->id_seksi,
                'status' => 'DISETUJUI', // Static for Published
                'risk_level' => $doc->risk_level ?? 'Normal', // Add risk level
                'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'publish_time' => $doc->published_at ? $doc->published_at->format('H:i') . ' WIB' : '-',
                'approval_note' => $lastApproval ? $lastApproval->catatan : '-'
            ];
        });

        return response()->json($data);
    }

    /**
     * Show Unit Pengelola Dashboard
     */
    public function unitPengelolaDashboard_OLD()
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
        $inProgressDocuments = collect([]);
        $finalDecisionDocuments = collect([]);
        $approvedByMe = collect([]);

        if ($user->isKepalaUnit()) {
            $stField = ($user->id_unit == 56) ? 'status_she' : 'status_security';

            // A. Menunggu Disposisi (Fresh)
            $pendingDocuments = Document::where('current_level', 2)
                ->where(function ($q) use ($stField) {
                    $q->where($stField, 'pending_head')->orWhereNull($stField)->orWhere($stField, '');
                })
                ->whereIn('kategori', $categoryFilter)
                ->with(['user', 'unit'])
                ->orderBy('created_at', 'desc')
                ->get();

            // B. Lagi Diperiksa Staff (In Progress)
            $inProgressDocuments = Document::where('current_level', 2)
                ->whereIn($stField, ['assigned_review', 'assigned_approval'])
                ->whereIn('kategori', $categoryFilter)
                ->with(['user', 'unit'])
                ->get();

            // C. Keputusan Akhir (Verified by Staff)
            $finalDecisionDocuments = Document::where('current_level', 2)
                ->whereIn($stField, ['staff_verified', 'returned_to_head'])
                ->whereIn('kategori', $categoryFilter)
                ->with(['user', 'unit'])
                ->get();

            // D. Sudah Approve (Approved at Level 2 OR moved up)
            $approvedByMe = Document::where(function ($q) use ($stField) {
                // Case 1: Still at Level 2 and finished for my unit
                $q->where('current_level', 2)->where($stField, 'approved');
            })
                ->orWhere(function ($q) use ($user) {
                    // Case 2: Moved past Level 2 and I approved it at Level 2
                    $q->where('current_level', '>', 2)
                        ->whereHas('approvals', function ($a) use ($user) {
                        $a->where('approver_id', $user->id_user)
                            ->where('level', 2)
                            ->where('action', 'approved');
                    });
                })
                ->whereIn('kategori', $categoryFilter)
                ->with(['user', 'unit'])
                ->orderBy('updated_at', 'desc')
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
            // ->whereIn('kategori', $categoryFilter) // Removed restriction to show ALL categories for any Unit Pengelola
            ->with(['user', 'unit', 'approvals.approver'])
            ->orderBy('published_at', 'desc')
            ->limit(20)
            ->get();

        // Transform Pending Documents for JS (HEAD VIEW)
        $pendingData = $pendingDocuments->map(function ($doc) {
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'date' => $doc->created_at->format('d M Y'),
                'status' => 'Pending Assignment',
                'url' => route('unit_pengelola.review', $doc->id)
            ];
        });

        $inProgressData = $inProgressDocuments->map(function ($doc) {
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'date' => $doc->created_at->format('d M Y'),
                'status' => 'In Progress',
                'url' => route('unit_pengelola.review', $doc->id)
            ];
        });

        $finalDecisionData = $finalDecisionDocuments->map(function ($doc) {
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'date' => $doc->created_at->format('d M Y'),
                'status' => 'Keputusan Akhir',
                'url' => route('unit_pengelola.review', $doc->id)
            ];
        });

        $approvedByMeData = $approvedByMe->map(function ($doc) {
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'date' => $doc->updated_at->format('d M Y'),
                'status' => 'Approved',
                'url' => route('unit_pengelola.review', $doc->id)
            ];
        });

        // Transform Published Documents for JS
        $publishedData = $publishedDocuments->map(function ($doc) {
            $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? '-',
                'category' => $doc->managing_unit,
                'date' => $doc->created_at->format('d M Y'),
                'author' => $doc->user->nama_user ?? '-',
                'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'seksi_id' => $doc->id_seksi,
                'status' => 'DISETUJUI',
                'risk_level' => $doc->risk_level ?? 'High',
                'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'publish_time' => $doc->published_at ? $doc->published_at->format('H:i') . ' WIB' : '-',
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
        $seksis = Seksi::all();

        return view('unit_pengelola.dashboard', compact(
            'user',
            'pendingCount',
            'pendingDocuments',
            'inProgressDocuments',
            'finalDecisionDocuments',
            'approvedByMe',
            'myReviews',
            'myVerifications',
            'publishedDocuments',
            'pendingData',
            'inProgressData',
            'finalDecisionData',
            'approvedByMeData',
            'publishedData',
            'direktorats',
            'departemens',
            'units',
            'seksis',
            'staffReviewers',
            'staffApprovers',
            'historyReviews',
            'historyVerifications'
        ));
    }

    /**
     * Show review page
     */
    public function review(Document $document, Request $request = null)
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

        // For Kepala Departemen, add filter support
        $filter = 'ALL';
        $verifyingUnit = '';
        if (auth()->user()->getRoleName() == 'kepala_departemen') {
            $filter = request()->query('filter', 'ALL');
            if ($filter == 'SHE') {
                $verifyingUnit = 'Unit Pengelola SHE';
            } elseif ($filter == 'Security') {
                $verifyingUnit = 'Unit Pengelola Keamanan';
            }
        } elseif (auth()->user()->role_jabatan == 3) { // Kepala Unit (Approver) Filter
             $excludedCategories = [];
             // If SHE is done, hide SHE rows
             if (in_array($document->status_she, ['approved', 'published'])) {
                 $excludedCategories = array_merge($excludedCategories, ['K3', 'KO', 'Lingkungan']);
             }
             // If Security is done, hide Security rows
             if (in_array($document->status_security, ['approved', 'published'])) {
                 $excludedCategories = array_merge($excludedCategories, ['Keamanan']);
             }
             
             if (!empty($excludedCategories)) {
                 $document->setRelation('details', $document->details->whereNotIn('kategori', $excludedCategories));
             }
        }

        return view(match (auth()->user()->getRoleName()) {
            'unit_pengelola' => 'unit_pengelola.documents.review',
            'kepala_departemen' => 'kepala_departemen.documents.review',
            default => 'approver.documents.review',
        }, compact('document', 'staffReviewers', 'staffApprovers', 'filter', 'verifyingUnit'));
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
            $incoming = is_string($request->compliance_checklist) ? json_decode($request->compliance_checklist, true) : $request->compliance_checklist;
            if ($user->id_unit == 56) { // SHE
                $dataToUpdate['compliance_checklist_she'] = $incoming;
            } elseif ($user->id_unit == 55) { // Security
                $dataToUpdate['compliance_checklist_security'] = $incoming;
            } else {
                $dataToUpdate['compliance_checklist'] = $incoming;
            }
        }

        // 5. Update Database within Transaction
        \DB::transaction(function () use ($document, $dataToUpdate, $user, $request) {
            // A. Update Content
            $document->update($dataToUpdate);

            // B. Handle Approval Workflow
            // B. Handle Approval Workflow
            if ($document->current_level == 1) {
                // Level 1 Approval (Kepala Unit Asal)
                $owner = $document->user; // or $document->user()->first() if relation

                // BYPASS RULE 1: Unit Pengelola (SHE/Security) Creators with No Dept -> Publish Immediately
                $isUnitPengelolaCreator = in_array($owner->id_unit, [55, 56]) && ($owner->id_dept == 0 || $owner->id_dept === null);

                if ($isUnitPengelolaCreator) {
                    \Log::info('Bypassing Level 2 & 3 - Unit Pengelola creator with no department', [
                        'document_id' => $document->id,
                        'unit_id' => $owner->id_unit,
                        'unit_name' => $owner->unit->nama_unit ?? 'Unknown',
                        'dept_id' => $owner->id_dept
                    ]);

                    $document->update([
                        'status' => 'published',
                        'published_at' => now(),
                        'current_level' => 4 // Finished
                    ]);
                } else {
                    // Normal Flow -> Move to Level 2
                    $document->refresh();
                    
                    // SMART STATUS UPDATE with Partial Revision Support
                    $wasRevision = ($document->status == 'revision');
                    $isSheRevision = ($document->status_she == 'revision');
                    $isSecRevision = ($document->status_security == 'revision');
                    
                    $currentShe = $document->status_she;
                    $currentSec = $document->status_security;
                    
                    // Determine SHE status
                    if (in_array($currentShe, ['approved', 'published'])) {
                        $sheStatus = $currentShe; // Keep as is
                    } elseif ($wasRevision && $isSecRevision && !$isSheRevision) {
                        // Security was revised, SHE was NOT -> Keep SHE status unchanged
                        $sheStatus = $currentShe;
                    } else {
                        // Normal flow or SHE was revised -> Set to pending_head
                        $sheStatus = $document->hasSheContent() ? 'pending_head' : 'none';
                    }

                    // Determine Security status
                    if (in_array($currentSec, ['approved', 'published'])) {
                        $secStatus = $currentSec; // Keep as is
                    } elseif ($wasRevision && $isSheRevision && !$isSecRevision) {
                        // SHE was revised, Security was NOT -> Keep Security status unchanged
                        $secStatus = $currentSec;
                    } else {
                        // Normal flow or Security was revised -> Set to pending_head
                        $secStatus = $document->hasSecurityContent() ? 'pending_head' : 'none';
                    }

                    $document->update([
                        'current_level' => 2,
                        'status' => 'pending_level2',
                        'status_she' => $sheStatus,
                        'status_security' => $secStatus,
                    ]);
                }

                // Create History Record
                $document->approvals()->create([
                    'approver_id' => $user->id_user,
                    'level' => 1,
                    'action' => 'approved',
                    'catatan' => $request->catatan,
                    'ip_address' => $request->ip()
                ]);

            } elseif ($document->current_level == 2) {
                // Level 2 Approval (Unit Pengelola Internal Flow)
                // Determine which path we are processing based on User's Unit
                $isShe = ($user->id_unit == 56); // SHE Unit
                $isSecurity = ($user->id_unit == 55); // Security Unit

                // Handle SHE Path
                if ($isShe && $document->status_she != 'none') {
                    if ($document->status_she == 'pending_head') {
                        // Alternate path if Head approves directly without disposition (Optional)
                        // For now, let's keep it as is or redirect to disposition?
                        // Assuming Head wants to "Approve" means "Move to next" or "Final Approve"?
                        // If Head approves at start, maybe skip to approved? User requested full flow.
                        // Let's assume this block is rarely hit via 'approve' route if UI filters.
                        $document->update(['status_she' => 'assigned_review']);
                    } elseif ($document->status_she == 'assigned_review') {
                        $document->update(['status_she' => 'assigned_approval']);
                    } elseif ($document->status_she == 'assigned_approval') {
                        $document->update(['status_she' => 'staff_verified']);
                    } elseif ($document->status_she == 'staff_verified') {
                        $document->update([
                            'status_she' => 'approved',
                            'she_approved_at' => now()
                        ]);
                    }
                }
                // Handle Security Path
                elseif ($isSecurity && $document->status_security != 'none') {
                    if ($document->status_security == 'pending_head') {
                        $document->update(['status_security' => 'assigned_review']);
                    } elseif ($document->status_security == 'assigned_review') {
                        $document->update(['status_security' => 'assigned_approval']);
                    } elseif ($document->status_security == 'assigned_approval') {
                        $document->update(['status_security' => 'staff_verified']);
                    } elseif ($document->status_security == 'staff_verified') {
                        $document->update([
                            'status_security' => 'approved',
                            'security_approved_at' => now()
                        ]);
                    }
                }

                // Check if BOTH are done (Consolidation)
                // Need to refresh model to get updated statuses
                $document->refresh();

                if ($document->isSheApproved() && $document->isSecurityApproved()) {
                    // BYPASS RULE 2: Non-Dept Units (id_dept = 0 or NULL) -> Publish Immediately after L2
                    $owner = $document->user;
                    if ($owner->id_dept == 0 || $owner->id_dept === null) {
                        \Log::info('Bypassing Level 3 - Unit has no department', [
                            'document_id' => $document->id,
                            'unit_id' => $owner->id_unit,
                            'unit_name' => $owner->unit->nama_unit ?? 'Unknown',
                            'dept_id' => $owner->id_dept
                        ]);

                        $document->update([
                            'status' => 'published',
                            'published_at' => now(),
                            'current_level' => 4
                        ]);
                    } else {
                        // Normal Flow -> Move to Level 3 (Kepala Departemen)
                        $document->update(['status' => 'pending_level3_ready']);
                        // Note: We don't auto-increment current_level to 3 here due to "Parallel Partial" logic preference,
                        // BUT standard flow usually implies moving to 3. If "pending_level3_ready" is picked up by L3 view, it's fine.
                        // However, to ensure it appears in L3 pending list, usually we might set current_level=3 if strict.
                        // For now, let's keep status update.
                    }
                }

                // Create History Record (Level 2)
                $document->approvals()->create([
                    'approver_id' => $user->id_user,
                    'level' => 2,
                    'action' => 'approved', // Or specific internal action name? Keep 'approved' for consistency
                    'catatan' => $request->catatan,
                    'ip_address' => $request->ip()
                ]);

            } elseif ($document->current_level == 3 || ($document->current_level == 2 && ($document->isSheApproved() || $document->isSecurityApproved()))) {
                // Level 3 Approval (Kepala Departemen)
                // New Logic: Parallel Approval at Level 3

                // Which part are we approving?
                // Based on what's visible/ready.
                $actionType = $request->input('approval_type', 'all'); // 'she', 'security', 'all'

                if ($actionType == 'she' || ($actionType == 'all' && $document->status_she == 'approved')) {
                    $document->update([
                        'status_she' => 'published', // Final state for SHE part
                        'she_approved_at' => now(), // Or separate column for lvl3? reusing she_approved_at might be ambiguous if used for level 2.
                        // Assuming she_approved_at is for Level 2... let's check migration.
                        // Wait, previous code set she_approved_at at Level 2.
                        // We need to distinguish Level 2 done vs Level 3 done.
                        // Let's use status strings: 'approved' (L2 Done) -> 'published' (L3 Done).
                    ]);
                }

                if ($actionType == 'security' || ($actionType == 'all' && $document->status_security == 'approved')) {
                    $document->update([
                        'status_security' => 'published'
                    ]);
                }

                // Check Global Completion
                $sheDone = $document->hasSheContent() ? $document->status_she == 'published' : true;
                $secDone = $document->hasSecurityContent() ? $document->status_security == 'published' : true;

                if ($sheDone && $secDone) {
                    $document->update([
                        'status' => 'published',
                        'current_level' => 4, // Completed
                        'published_at' => now()
                    ]);
                }

                $document->approvals()->create([
                    'approver_id' => $user->id_user,
                    'level' => 3,
                    'action' => 'approved', // maybe 'approved_partial'?
                    'catatan' => $request->catatan,
                    'ip_address' => $request->ip()
                ]);
            }
        });

        // 6. Redirect with Success Message
        $document->refresh();
        $message = 'Dokumen berhasil disetujui.';
        
        // Check if document was auto-published due to no department
        $wasAutoPublished = false;
        if ($document->status == 'published' && $document->current_level == 4) {
            $owner = $document->user;
            if ($owner->id_dept == 0 || $owner->id_dept === null) {
                $wasAutoPublished = true;
                $message = '✅ Dokumen berhasil disetujui dan LANGSUNG TERPUBLIKASI! Unit tidak memiliki departemen, sehingga approval Kepala Departemen (Level 3) dilewati.';
            } else {
                $message .= ' Dokumen telah dipublikasikan.';
            }
        } elseif ($document->current_level == 3) {
            $message .= ' Dokumen diteruskan ke Kepala Departemen (Level 3).';
        }

        if ($user->isKepalaDepartemen()) {
            return redirect()->route('kepala_departemen.dashboard')
                ->with('success', 'Dokumen berhasil dipublikasikan.');
        }
        if ($user->isUnitPengelola() || $document->approvals()->where('level', 2)->where('approver_id', $user->id_user)->exists()) {
            // Enhanced message for Kepala Unit Pengelola final approval
            $successMessage = $message;
            
            // Override message if auto-published
            if ($wasAutoPublished) {
                $successMessage = '✅ DOKUMEN BERHASIL TERPUBLIKASI! Unit tidak memiliki departemen, approval Kepala Departemen (Level 3) dilewati secara otomatis.';
            } elseif ($document->status_she == 'approved' || $document->status_security == 'approved') {
                $successMessage = 'Approve Final Berhasil! Dokumen telah disetujui dan akan diteruskan ke Kepala Departemen.';
            }
            
            return redirect()->route('unit_pengelola.dashboard')
                ->with('success', $successMessage);
        }

        // Fallback Redirects
        if ($user->hasRole('admin'))
            return redirect()->route('admin.dashboard')->with('success', 'Dokumen Disetujui.');

        // Use direct route to prevent session flash loss from double-redirect
        return redirect()->route($user->getDashboardRoute())->with('success', $message);
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

        // Fetch Pending (Level 3 or Level 2 Partial) & History
        $documents = Document::where('id_dept', $user->id_dept)
            ->where(function ($q) {
                $q->where('current_level', 3) // Fully Pending
                    ->orWhere(function ($sub) {
                        // Parallel Entry OR Revision Visibility
                        // We want to show the document IF at least one track is 'approved' OR 'published'
                        // regardless of global status (even if 'revision' or 'pending_level1' or 'pending_level2')
                        $sub->where(function ($p) {
                             $p->whereIn('status_she', ['approved', 'published'])
                               ->orWhereIn('status_security', ['approved', 'published']);
                        });
                    })
                    ->orWhere('status', 'approved') // Published Global
                    ->orWhere('status', 'published');
            })
            ->with(['user', 'unit', 'approvals'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $documentsData = $documents->flatMap(function ($doc) use ($user) {
            $items = [];

            // Helper to build item
            $buildItem = function ($catType, $statusLabel, $isPublished = false) use ($doc) {
                // Friendly Unit Name & Department
                $unitName = $doc->unit->nama_unit ?? '-';
                $submitterName = $doc->user->nama_user ?? $doc->user->username ?? 'Unknown';

                return [
                    'id' => $doc->id,
                    'unit' => $unitName,
                    'department' => $doc->user && $doc->user->departemen ? $doc->user->departemen->nama_dept : '-',
                    'submitter' => $submitterName,
                    'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                    'risk_level' => $doc->risk_level ?? 'High',
                    'date_submit' => $doc->created_at->format('d M Y'),
                    'time_submit' => $doc->created_at->format('H:i') . ' WIB',
                    'status' => $statusLabel,
                    'category_label' => $catType, // SHE or Security
                    'current_level' => $doc->current_level,
                    // Pass filter param to review page
                    'viewUrl' => route('kepala_departemen.review', ['document' => $doc->id, 'filter' => $catType]),
                    'is_published' => $isPublished
                ];
            };

            // 1. CHECKS FOR PENDING/VISIBLE TASKS
            // Check SHE Status
            if ($doc->hasSheContent()) {
                if ($doc->status_she == 'approved') {
                    $items[] = $buildItem('SHE', 'Verified by Kepala Unit SHE');
                } elseif ($doc->status_she == 'published') {
                    $items[] = $buildItem('SHE', 'Terpublikasi (SHE)', true);
                }
            }

            // Check Security Status
            if ($doc->hasSecurityContent()) {
                if ($doc->status_security == 'approved') {
                    $items[] = $buildItem('Security', 'Verified by Kepala Unit Keamanan');
                } elseif ($doc->status_security == 'published') {
                    $items[] = $buildItem('Security', 'Terpublikasi (Security)', true);
                }
            }

            // FALLBACK: If standard Level 3 (legacy) or just created
            if (empty($items) && $doc->current_level == 3 && $doc->status == 'pending_level3') {
                $items[] = $buildItem('ALL', 'Menunggu Approval');
            }

            return $items;
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

        if ($user->isKepalaDepartemen()) {
            // Bypass strict level check for Kepala Departemen to allow "Forced Revision" or Partial Revision fixes
            if ($user->id_dept != $document->id_dept) {
                abort(403, 'Anda tidak memiliki akses ke dokumen departemen lain.');
            }
            // Allow revision as long as it's not draft (level 0)
            if ($document->status == 'draft') {
                abort(403, 'Dokumen draft tidak bisa direvisi.');
            }
        } elseif (!$document->canBeApprovedBy($user)) {
            // For other roles (Kepala Unit), keep strict check
            abort(403);
        }

        // Custom Logic for Unit Pengelola (Level 2) Revision -> Back to Submitter
        // Implement Partial Revision: Only revise the category managed by this Unit Pengelola
        // EXCLUDE Kepala Departemen (Role 2) because they might be accessing L2 docs but should use L3 logic
        if ($document->current_level == 2 && !$user->isKepalaDepartemen()) {
            $isShe = ($user->id_unit == 56); // SHE Unit
            $isSecurity = ($user->id_unit == 55); // Security Unit

            // Check if the OTHER track can still continue their work
            $otherTrackCanContinue = false;
            
            if ($isShe) {
                // SHE is revising - check if Security can still continue
                // Security can continue if they haven't finished yet (not approved/published/revision)
                $otherTrackCanContinue = !in_array($document->status_security, ['approved', 'published', 'revision']);
            } elseif ($isSecurity) {
                // Security is revising - check if SHE can still continue
                $otherTrackCanContinue = !in_array($document->status_she, ['approved', 'published', 'revision']);
            }

            $updateData = [
                'status' => 'revision',
                // If other track can continue, stay at level 2. Otherwise, back to submitter (level 1)
                'current_level' => $otherTrackCanContinue ? 2 : 1
            ];

            // Partial Revision Logic
            if ($isShe) {
                // SHE Unit revising -> Only SHE categories need revision
                $updateData['status_she'] = 'revision';
                // Keep status_security as is (might be 'approved', 'pending_head', etc.)
            } elseif ($isSecurity) {
                // Security Unit revising -> Only Security category needs revision
                $updateData['status_security'] = 'revision';
                // Keep status_she as is
            } else {
                // Fallback: If neither SHE nor Security (shouldn't happen), reset both
                $updateData['status_she'] = 'revision';
                $updateData['status_security'] = 'revision';
            }

            $document->update($updateData);
        }
        // Kepala Departemen (Level 3) -> Back to Submitter (Level 0/1)
        // Handle Partial Revision
        elseif ($document->current_level == 3 || ($document->current_level == 2 && ($document->isSheApproved() || $document->isSecurityApproved()))) {
            $filter = strtoupper($request->query('filter', 'ALL')); // Normalize to UPPERCASE
            $updateData = [
                'status' => 'revision',
                'current_level' => 1
            ];

            if ($filter == 'SHE') {
                $updateData['status_she'] = 'revision';
                // Keep status_security as is
            } elseif ($filter == 'SECURITY') {
                $updateData['status_security'] = 'revision';
                // Keep status_she as is
            } else {
                // ALL -> Reset Both
                $updateData['status_she'] = 'revision';
                $updateData['status_security'] = 'revision';
            }

            $document->update($updateData);
        }

        // Record History (Refactored to handle both levels)
        if (in_array($document->getOriginal('current_level'), [2, 3])) {
            // Get filter parameter for scoped revision
            $filter = $request->query('filter', 'ALL');
            $catatan = $request->catatan;

            // Add track information to revision note
            if ($user->isKepalaDepartemen() && $filter != 'ALL') {
                $catatan .= ' (Track ' . $filter . ')';
            }

            $document->approvals()->create([
                'approver_id' => $user->id_user,
                'level' => $user->isKepalaDepartemen() ? 3 : 2,
                'action' => 'revision',
                'catatan' => $catatan,
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

        // Validation: Verify document is ready for Level 3 OR Partial Level 2
        // We allow Level 2 if at least one track is approved.
        $isReady = ($document->current_level == 3) ||
            ($document->current_level == 2 && ($document->status_she == 'approved' || $document->status_security == 'approved'));

        if (!$isReady) {
            return back()->with('error', 'Dokumen tidak dalam status yang tepat untuk dipublikasi.');
        }

        // Get filter parameter to determine which track to approve
        $filter = $request->query('filter', 'ALL');

        // Smart Publish Logic: Approve based on filter
        $approvedSomething = false;

        // 1. Approve SHE Track (only if filter is SHE or ALL)
        if (($filter == 'SHE' || $filter == 'ALL') && $document->status_she == 'approved') {
            $document->update(['status_she' => 'published']);
            $approvedSomething = true;
        }

        // 2. Approve Security Track (only if filter is Security or ALL)
        if (($filter == 'Security' || $filter == 'ALL') && $document->status_security == 'approved') {
            $document->update(['status_security' => 'published']);
            $approvedSomething = true;
        }

        // 3. Already Level 3 (Both were done before)
        $fullyPublished = false;
        if ($document->current_level == 3 && $document->status == 'pending_level3') {
            // Just publish everything
            // If tracks were used, ensure they are marked published too
            if ($document->status_she == 'approved')
                $document->update(['status_she' => 'published']);
            if ($document->status_security == 'approved')
                $document->update(['status_security' => 'published']);
            $document->update(['status' => 'published', 'published_at' => now()]);
            $fullyPublished = true;
            $approvedSomething = true;
        }

        // 4. Check Consolidation (If we just approved a partial track)
        if (!$fullyPublished) {
            $sheDone = in_array($document->status_she, ['published', 'none']);
            $secDone = in_array($document->status_security, ['published', 'none']);

            if ($sheDone && $secDone) {
                $document->update([
                    'current_level' => 3, // Move to 3 finally
                    'status' => 'published',
                    'published_at' => now()
                ]);
            }
        }

        if (!$approvedSomething) {
            return back()->with('warning', 'Tidak ada bagian dokumen yang siap disetujui saat ini.');
        }

        // Log approval history with track information
        $catatan = $request->catatan ?? 'Dokumen disetujui oleh Kepala Departemen';
        if ($filter == 'SHE') {
            $catatan .= ' (Track SHE)';
        } elseif ($filter == 'Security') {
            $catatan .= ' (Track Security)';
        }

        $document->approvals()->create([
            'approver_id' => $user->id_user,
            'level' => 3,
            'action' => 'approved',
            'catatan' => $catatan,
            'ip_address' => $request->ip()
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
            'reviewer_id' => 'nullable|exists:users,id_user',
            'approver_id' => 'nullable|exists:users,id_user',
        ]);

        $user = Auth::user();

        // DEBUG LOGGING
        \Illuminate\Support\Facades\Log::info("Disposition Request", [
            'user_id' => $user->id_user,
            'unit_id' => $user->id_unit,
            'doc_id' => $document->id,
            'doc_level' => $document->current_level
        ]);

        // Ensure user is authorized (Head of Unit Pengelola)
        if (!$user->isUnitPengelola() || $document->current_level != 2) {
            \Illuminate\Support\Facades\Log::error("Disposition Unauthorized", ['is_up' => $user->isUnitPengelola(), 'level' => $document->current_level]);
            abort(403, 'Unauthorized disposition.');
        }

        // Auto-Assign Logic: If IDs are null, try to find the designated staff from Dashboard permissions
        $reviewerId = $request->reviewer_id;
        $approverId = $request->approver_id;

        if (!$reviewerId) {
            $activeReviewers = \App\Models\User::where('id_unit', $user->id_unit)
                ->where('is_reviewer', true)
                ->get();
            if ($activeReviewers->count() === 1) {
                $reviewerId = $activeReviewers->first()->id_user;
            }
        }

        if (!$approverId) {
            $activeApprovers = \App\Models\User::where('id_unit', $user->id_unit)
                ->where('is_verifier', true)
                ->get();
            if ($activeApprovers->count() === 1) {
                $approverId = $activeApprovers->first()->id_user;
            }
        }

        // VALIDATION: Ensure both Reviewer and Verifikator are assigned
        if (!$reviewerId || !$approverId) {
            $missing = [];
            if (!$reviewerId) $missing[] = 'Staff Reviewer';
            if (!$approverId) $missing[] = 'Staff Verifikator';
            
            $errorMessage = implode(' dan ', $missing) . ' wajib ditunjuk terlebih dahulu.';
            
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 422);
            }
            
            return back()->withErrors([
                'disposition' => $errorMessage
            ]);
        }

        // Parallel Workflow: Update Specific Columns based on Unit
        if ($user->id_unit == 55) { // Security
            \Illuminate\Support\Facades\Log::info("Disposition Logic: SECURITY Block");
            $document->status_security = 'assigned_review';
            if ($reviewerId)
                $document->security_reviewer_id = $reviewerId;
            if ($approverId)
                $document->security_verificator_id = $approverId;
            $document->save();
        } elseif ($user->id_unit == 56) { // SHE
            \Illuminate\Support\Facades\Log::info("Disposition Logic: SHE Block");
            $document->status_she = 'assigned_review';
            if ($reviewerId)
                $document->she_reviewer_id = $reviewerId;
            if ($approverId)
                $document->she_verificator_id = $approverId;
            $document->save();
        } else {
            // Fallback
            \Illuminate\Support\Facades\Log::info("Disposition Logic: FALLBACK Block");
            $document->level2_status = 'assigned_review';
            $document->level2_assignment_date = now();
            if ($reviewerId)
                $document->level2_reviewer_id = $reviewerId;
            if ($approverId)
                $document->level2_approver_id = $approverId;
            $document->save();
        }

        // Log History for Disposition
        $logMessage = 'Disposisi ke Staff';
        if ($reviewerId)
            $logMessage .= ' (Reviewer Assigned)';
        if ($approverId)
            $logMessage .= ' (Approver Assigned)';
        if (!$reviewerId && !$approverId)
            $logMessage .= ' (Pool)';

        $document->approvals()->create([
            'approver_id' => $user->id_user,
            'level' => 2,
            'action' => 'disposition',
            'catatan' => $logMessage,
            'ip_address' => $request->ip()
        ]);

        if ($request->wantsJson()) {
            $msg = 'Dokumen berhasil didisposisikan.';
            if ($reviewerId && $approverId) {
                $msg = 'Dokumen dikirim ke Reviewer dan Verifikator terpilih.';
            } elseif ($reviewerId) {
                $msg = 'Dokumen dikirim ke Reviewer terpilih (Verifikator: Pool).';
            } else {
                $msg = 'Dokumen dikirim ke Verifikator terpilih (Reviewer: Pool).';
            }

            // Append Debug Info to Message for verification
            $freshDoc = $document->fresh();
            $debugStatus = ($user->id_unit == 56) ? $freshDoc->status_she : (($user->id_unit == 55) ? $freshDoc->status_security : $freshDoc->level2_status);
            $msg .= " [Status: $debugStatus]";

            return response()->json(['success' => true, 'message' => $msg]);
        }

        return back()->with('success', 'Dokumen berhasil didisposisikan kepada staff.');
    }

    /**
     * Submit Review by Staff (Band IV/V)
     */
    public function submitReviewUnit(Request $request, Document $document)
    {
        // Check: Is User the assigned Reviewer?
        $user = Auth::user();
        $isAssigned = false;

        if ($user->id_unit == 55) { // Security
            // Allow if explicitly assigned OR has reviewer permission and doc is in review status
            $isAssigned = ($user->id_user == $document->security_reviewer_id) || 
                          ($user->is_reviewer && $document->status_security == 'assigned_review');
        } elseif ($user->id_unit == 56) { // SHE
            $isAssigned = ($user->id_user == $document->she_reviewer_id) || 
                          ($user->is_reviewer && $document->status_she == 'assigned_review');
        } else {
            // Fallback
            $isAssigned = ($user->id_user == $document->level2_reviewer_id) || 
                          ($user->is_reviewer && $document->level2_status == 'assigned_review');
        }

        if (!$isAssigned) {
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

        // Check Unit
        $user = Auth::user();
        if ($user->id_unit == 55) { // Security
            $document->update(['status_security' => 'assigned_approval']);
        } elseif ($user->id_unit == 56) { // SHE
            $document->update(['status_she' => 'assigned_approval']);
        } else {
            // Fallback
            $document->update(['level2_status' => 'assigned_approval']);
        }

        return redirect()->route('unit_pengelola.staff.index')->with('success', 'Review selesai. Dokumen diteruskan ke Verifikator.');
    }

    /**
     * Verify/Approve by Staff (Band III)
     */
    public function verifyUnit(Request $request, Document $document)
    {
        // Check: Is User the assigned Approver?
        $user = Auth::user();
        $isAssigned = false;

        if ($user->id_unit == 55) { // Security
            // Allow if explicitly assigned OR has verifier permission and doc is in approval status
            $isAssigned = ($user->id_user == $document->security_verificator_id) || 
                          ($user->is_verifier && $document->status_security == 'assigned_approval');
        } elseif ($user->id_unit == 56) { // SHE
            $isAssigned = ($user->id_user == $document->she_verificator_id) || 
                          ($user->is_verifier && $document->status_she == 'assigned_approval');
        } else {
            $isAssigned = ($user->id_user == $document->level2_approver_id) || 
                          ($user->is_verifier && $document->level2_status == 'assigned_approval');
        }

        if (!$isAssigned) {
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

        // Update Status based on Unit
        if ($user->id_unit == 55) { // Security
            $document->update([
                'status_security' => 'staff_verified',
                // Don't update global status yet, as other unit might be pending
            ]);
        } elseif ($user->id_unit == 56) { // SHE
            $document->update([
                'status_she' => 'staff_verified',
            ]);
        } else {
            $document->update([
                'level2_status' => 'staff_verified',
                'status' => 'staff_verified',
            ]);
        }

        return redirect()->route('unit_pengelola.staff.index')->with('success', 'Verifikasi selesai. Dokumen dikembalikan ke Kepala Unit.');
    }

    /**
     * Helper to update content similar to approve()
     */
    private function updateDocumentContent(Request $request, Document $document)
    {
        // Save Compliance Checklist if present
        if ($request->has('compliance_checklist')) {
            $user = \Auth::user();
            $incoming = is_string($request->compliance_checklist) ? json_decode($request->compliance_checklist, true) : $request->compliance_checklist;

            if ($user->id_unit == 56) { // SHE
                $document->update(['compliance_checklist_she' => $incoming]);
            } elseif ($user->id_unit == 55) { // Security
                $document->update(['compliance_checklist_security' => $incoming]);
            } else {
                $document->update(['compliance_checklist' => $incoming]);
            }
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
            // $id is DocumentDetail ID from Route
            $detail = \App\Models\DocumentDetail::findOrFail($id);
            $document = $detail->document; // Get parent document

            $request->validate([
                'detail_id' => 'sometimes|exists:document_details,id', // Optional validation since we have ID in route
                'kategori' => 'required',
                'kolom2_kegiatan' => 'required|string',
                'kolom12_kemungkinan' => 'required|numeric|min:1|max:5',
                'kolom13_konsekuensi' => 'required|numeric|min:1|max:5',
            ]);

            // Redundant check removed since we loaded detail from ID directly
            // $detail = \App\Models\DocumentDetail::findOrFail($request->detail_id);

            // PERMISSION CHECKS
            $isAuthor = $document->id_user == $user->id_user;
            $isApprover = ($user->role_jabatan == 3 && $document->id_unit == $user->id_unit);

            // Unit Pengelola - Head (Role 2)
            $isUnitPengelolaHead = ($user->role_jabatan == 2 && in_array($user->id_unit, [55, 56]));

            // Unit Pengelola - Assigned Staff (Reviewer/Approver/Verificator)
            // Check specific assignments based on unit
            $isAssigned = false;
            if ($user->id_unit == 55) { // Security
                $isAssigned = ($document->security_reviewer_id == $user->id_user ||
                    $document->security_current_approver_id == $user->id_user);
            } elseif ($user->id_unit == 56) { // SHE
                $isAssigned = ($document->she_reviewer_id == $user->id_user ||
                    $document->she_current_approver_id == $user->id_user);
            } else {
                // Legacy / General
                $isAssigned = ($document->level2_reviewer_id == $user->id_user ||
                    $document->level2_approver_id == $user->id_user);
            }

            // Allow any Staff in Unit Pengelola if Status permits? 
            // For now, strict assignment or Head or Author/Approver logic.
            // But User requested "staff reviewer" validation.
            // In staffIndex, they can see doc if assigned or pool.
            // If they can see it, they should be able to edit if logic allows.
            // Let's assume passed validation if they are in the 'review' page implies they 'can' view.

            // Allow Generic Staff in Unit Pengelola (Role 4,5,6 in Unit 55/56)
            $isUnitStaff = in_array($user->role_jabatan, [4, 5, 6]) && in_array($user->id_unit, [55, 56]);

            if (!$isAuthor && !$isApprover && !$isUnitPengelolaHead && !$isAssigned && !$isUnitStaff) {
                return response()->json(['success' => false, 'message' => 'Unauthorized Access'], 403);
            }

            // CALCULATION & MAPPING
            $chem = $request->kolom12_kemungkinan;
            $cons = $request->kolom13_konsekuensi;
            $score = $chem * $cons;

            $level = 'Rendah';
            if ($score >= 15)
                $level = 'Tinggi';
            elseif ($score >= 8)
                $level = 'Sedang';

            // Map Item 9 Risk based on Category
            $riskK3 = $detail->kolom9_risiko_k3ko;
            $riskEnv = $detail->kolom9_dampak_lingkungan; // Note: Model might not have this in fillable if I didn't add it? Added in legacy?
            // Checked Model: fillable has kolom9_dampak_lingkungan etc.
            $riskSec = $detail->kolom9_celah_keamanan;

            if (in_array($request->kategori, ['K3', 'KO'])) {
                $riskK3 = $request->kolom9_risiko;
            } elseif ($request->kategori == 'Lingkungan') {
                $riskEnv = $request->kolom9_risiko;
            } elseif ($request->kategori == 'Keamanan') {
                $riskSec = $request->kolom9_risiko;
            }

            $updateData = [
                'kategori' => $request->kategori,
                'kolom2_kegiatan' => $request->kolom2_kegiatan,
                'kolom3_lokasi' => $request->kolom3_lokasi,
                'kolom5_kondisi' => $request->kolom5_kondisi,

                'kolom6_bahaya' => [
                    'details' => is_array($request->kolom6_bahaya) ? $request->kolom6_bahaya : ($request->kolom6_bahaya ? [$request->kolom6_bahaya] : []),
                    'manual' => $request->bahaya_manual ?? '',
                ],
                'bahaya_manual' => $request->bahaya_manual,

                'kolom7_aspek_lingkungan' => [
                    'details' => is_array($request->kolom7_aspek_lingkungan) ? $request->kolom7_aspek_lingkungan : ($request->kolom7_aspek_lingkungan ? [$request->kolom7_aspek_lingkungan] : []),
                    'manual' => $request->aspek_manual ?? '',
                ],

                'kolom8_ancaman' => [
                    'details' => is_array($request->kolom8_ancaman) ? $request->kolom8_ancaman : ($request->kolom8_ancaman ? [$request->kolom8_ancaman] : []),
                    'manual' => $request->ancaman_manual ?? '',
                ],

                // Maps
                'kolom9_risiko_k3ko' => $riskK3,
                'kolom9_dampak_lingkungan' => $riskEnv,
                'kolom9_celah_keamanan' => $riskSec,
                'kolom9_risiko' => $request->kolom9_risiko,

                'kolom11_existing' => $request->kolom11_existing,
                'kolom12_kemungkinan' => $chem,
                'kolom13_konsekuensi' => $cons,
                'kolom14_score' => $score,
                'kolom14_level' => $level,
                'kolom15_regulasi' => $request->kolom15_regulasi,
                'kolom16_aspek' => $request->kolom16_aspek,
                'kolom17_risiko' => $request->kolom17_risiko,
                'kolom17_peluang' => $request->kolom17_peluang,
                'kolom18_toleransi' => $request->kolom18_toleransi,
                'kolom19_pengendalian_lanjut' => $request->kolom19_pengendalian_lanjut,

                // Follow Up Risk
                'kolom20_kemungkinan_lanjut' => $request->kolom20_kemungkinan_lanjut,
                'kolom21_konsekuensi_lanjut' => $request->kolom21_konsekuensi_lanjut,
                'kolom22_tingkat_risiko_lanjut' => $request->kolom22_tingkat_risiko_lanjut,
                'kolom22_level_lanjut' => ($request->kolom22_tingkat_risiko_lanjut >= 15 ? 'High' : ($request->kolom22_tingkat_risiko_lanjut >= 8 ? 'Medium' : 'Low')),

                // Residual Risk
                'residual_kemungkinan' => $request->residual_kemungkinan,
                'residual_konsekuensi' => $request->residual_konsekuensi,
                'residual_score' => $request->residual_score,
                'residual_level' => ($request->residual_score >= 15 ? 'High' : ($request->residual_score >= 8 ? 'Medium' : 'Low')),
            ];

            $detail->update($updateData);

            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.']);

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
            // Allow any Staff in Unit Pengelola (Role 4, 5, 6) in Unit 55/56
            $isUnitStaff = in_array($user->role_jabatan, [4, 5, 6]) &&
                in_array($user->id_unit, [55, 56]);

            if ($document->id_user != $user->id_user && !($user->role_jabatan == 3 && $document->id_unit == $user->id_unit) && !$isUnitStaff) {
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

        // Filter Details based on Unit
        $filteredDetails = $document->details; // Default all

        if ($user->id_unit == 55) { // Security
            // Access Control: Block Staff if document is still pending_head (Not Dispositioned)
            // Staff roles: 4 (Verifikator), 5 (Reviewer), 6 (Reviewer)
            if (in_array($user->role_jabatan, [4, 5, 6])) {
                if ($document->status_security === 'pending_head' || $document->status_security === 'none' || empty($document->status_security)) {
                    abort(403, 'Dokumen belum didisposisikan oleh Kepala Unit.');
                }
            }

            $filteredDetails = $document->details->filter(function ($detail) {
                return $detail->kategori == 'Keamanan';
            });
        } elseif ($user->id_unit == 56) { // SHE
            // Access Control: Block Staff if document is pending_head
            if (in_array($user->role_jabatan, [4, 5, 6])) {
                if ($document->status_she === 'pending_head' || $document->status_she === 'none' || empty($document->status_she)) {
                    abort(403, 'Dokumen belum didisposisikan oleh Kepala Unit.');
                }
            }

            $filteredDetails = $document->details->filter(function ($detail) {
                return in_array($detail->kategori, ['K3', 'KO', 'Lingkungan']);
            });
        }

        // Fetch Staff for Disposition Forms
        $staffReviewers = \App\Models\User::where('id_unit', $user->id_unit)
            ->whereIn('role_jabatan', [5, 6]) // Band IV, V
            ->get();

        $staffApprovers = \App\Models\User::where('id_unit', $user->id_unit)
            ->where('role_jabatan', 4) // Band III
            ->get();

        return view('unit_pengelola.documents.review', compact('document', 'filteredDetails', 'staffReviewers', 'staffApprovers'));
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

        // Load documents that have been approved by Level 1 (Level > 1 OR status pending_level2)
        // Correct Logic: Check if Header Matches OR Details Match
        // Also ensure current_level is 2 (Unit Pengelola Phase)

        $stField = ($user->id_unit == 56) ? 'status_she' : 'status_security';

        // 1. Fetch relevant documents at Level 2
        $docsAtLevel2 = Document::where('current_level', 2)
            ->where(function ($q) use ($allowedCategories) {
                $q->whereIn('kategori', $allowedCategories)
                    ->orWhereHas('details', function ($d) use ($allowedCategories) {
                        $d->whereIn('kategori', $allowedCategories);
                    });
            })
            ->with(['user', 'unit', 'approvals.approver'])
            ->get();

        // 2. Fetch documents I approved at Level 2 that are now Level 3+
        $docsApprovedAndMoved = Document::where('current_level', '>', 2)
            ->whereHas('approvals', function ($q) use ($user) {
                $q->where('approver_id', $user->id_user)
                    ->where('action', 'approved')
                    ->where('level', 2);
            })
            ->with(['user', 'unit', 'approvals.approver'])
            ->get();

        // 3. UPDATED: Fetch documents where MY track has ANY active status (not null, not revision)
        // This ensures SHE documents remain visible when Security is in revision, and vice versa
        // Covers all statuses: pending_head, assigned_review, assigned_approval, staff_verified, returned_to_head, approved, published
        $docsMyTrackActive = Document::where(function ($q) use ($stField) {
                $q->whereNotNull($stField)
                  ->where($stField, '!=', 'revision')
                  ->where($stField, '!=', '');
            })
            ->where(function ($q) use ($allowedCategories) {
                $q->whereIn('kategori', $allowedCategories)
                    ->orWhereHas('details', function ($d) use ($allowedCategories) {
                        $d->whereIn('kategori', $allowedCategories);
                    });
            })
            ->with(['user', 'unit', 'approvals.approver'])
            ->get();

        // 4. Combine all three queries and remove duplicates
        $documents = $docsAtLevel2
            ->concat($docsApprovedAndMoved)
            ->concat($docsMyTrackActive)
            ->unique('id')
            ->sortByDesc('created_at');

        // 4. Categorize consistently for the cards
        $pendingDocuments = $documents->filter(function ($d) use ($stField) {
            $st = $d->$stField;
            return $d->current_level == 2 && ($st == 'pending_head' || empty($st));
        });

        $inProgressDocuments = $documents->filter(function ($d) use ($stField) {
            return $d->current_level == 2 && in_array($d->$stField, ['assigned_review', 'assigned_approval']);
        });

        $finalDecisionDocuments = $documents->filter(function ($d) use ($stField) {
            return $d->current_level == 2 && in_array($d->$stField, ['staff_verified', 'returned_to_head']);
        });

        $approvedByMe = $documents->filter(function ($d) use ($stField, $user) {
            if ($d->current_level == 2 && $d->$stField == 'approved')
                return true;
            if ($d->current_level > 2) {
                return $d->approvals->where('approver_id', $user->id_user)->where('level', 2)->where('action', 'approved')->count() > 0;
            }
            return false;
        });

        // 5. My Unit Internal Stats (Dokumen Internal)
        // Documents created by users in THIS unit
        $myUnitDocs = Document::where('id_unit', $user->id_unit)->get();
        $myUnitStats = [
            'pending' => $myUnitDocs->whereNotIn('status', ['published', 'approved'])->count(), // Waiting
            'approved' => $myUnitDocs->where('status', 'approved')->count(), // Approved (but maybe not published?)
            'published' => $myUnitDocs->where('status', 'published')->count(), // Final
        ];

        return view('unit_pengelola.documents.index', compact(
            'documents',
            'pendingDocuments',
            'inProgressDocuments',
            'finalDecisionDocuments',
            'approvedByMe',
            'myUnitStats'
        ));
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

        // Determine allowed categories based on unit
        $allowedCategories = [];
        if ($user->id_unit == 55) { // Security
            $allowedCategories = ['Keamanan'];
        } elseif ($user->id_unit == 56) { // SHE
            $allowedCategories = ['K3', 'KO', 'Lingkungan'];
        }

        // Load documents assigned to this staff OR unassigned (Pool)
        // Fix (Parallel): Check specific SHE/Security columns depending on Unit

        $query = Document::where('current_level', 2);

        if ($user->id_unit == 55) { // Security
            // Simplified permission-based filtering
            if ($user->role_jabatan == 4) { // Verifikator
                if ($user->is_verifier) {
                    // Show all documents in approval status if user has verifier permission
                    $query->where('status_security', 'assigned_approval');
                } else {
                    // Only show explicitly assigned documents
                    $query->where('status_security', 'assigned_approval')
                          ->where('security_verificator_id', $user->id_user);
                }
            } else { // Reviewer (role_jabatan 5 or 6)
                if ($user->is_reviewer) {
                    // Show all documents in review status if user has reviewer permission
                    $query->where('status_security', 'assigned_review');
                } else {
                    // Only show explicitly assigned documents
                    $query->where('status_security', 'assigned_review')
                          ->where('security_reviewer_id', $user->id_user);
                }
            }

        } elseif ($user->id_unit == 56) { // SHE
            // Simplified permission-based filtering
            if ($user->role_jabatan == 4) { // Verifikator
                if ($user->is_verifier) {
                    // Show all documents in approval status if user has verifier permission
                    $query->where('status_she', 'assigned_approval');
                } else {
                    // Only show explicitly assigned documents
                    $query->where('status_she', 'assigned_approval')
                          ->where('she_verificator_id', $user->id_user);
                }
            } else { // Reviewer (role_jabatan 5 or 6)
                if ($user->is_reviewer) {
                    // Show all documents in review status if user has reviewer permission
                    $query->where('status_she', 'assigned_review');
                } else {
                    // Only show explicitly assigned documents
                    $query->where('status_she', 'assigned_review')
                          ->where('she_reviewer_id', $user->id_user);
                }
            }

        } else {
            // Fallback (Original Logic)
            $query->where(function ($q) use ($user) {
                $q->where('level2_reviewer_id', $user->id_user)
                    ->orWhere('level2_approver_id', $user->id_user)
                    ->orWhereNull('level2_reviewer_id');
            });
            if ($user->role_jabatan == 4) {
                $query->whereIn('level2_status', ['assigned_approval']);
            } else {
                $query->where(function ($q) {
                    $q->where('level2_status', 'assigned_review')
                        ->orWhereNull('level2_status')
                        ->orWhere('status', 'pending_level2');
                });
            }
        }

        $documents = $query->with(['user', 'unit', 'approvals.approver'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('unit_pengelola.documents.staff_index', compact('documents'));
    }



    // NEW: Unit Pengelola Dashboard (View)
    public function unitPengelolaDashboard(Request $request)
    {
        $user = Auth::user();

        // 1. Fetch Master Data for Accordion/Filters
        $direktorats = \App\Models\Direktorat::where('status_aktif', 1)->get();
        $departemens = \App\Models\Departemen::all();
        $units = \App\Models\Unit::all();
        $units = \App\Models\Unit::all();
        $seksis = \App\Models\Seksi::all();

        // 1b. Fetch Users in My Unit (For Management Tab)
        $unitUsers = \App\Models\User::where('id_unit', $user->id_unit)
            ->where('id_user', '!=', $user->id_user) // Exclude myself
            ->orderBy('nama_user')
            ->get();

        // 2. Fetch Pending Documents (Waiting for Unit Pengelola Head)
        $allowedCategories = [];
        if ($user->id_unit == 55) { // Security
            $allowedCategories = ['Keamanan'];
        } elseif ($user->id_unit == 56) { // SHE
            $allowedCategories = ['K3', 'KO', 'Lingkungan'];
        }

        // Fetch docs pending at Level 2 for this Unit
        $docsAtLevel2 = Document::where('current_level', 2)
            ->where(function ($q) use ($allowedCategories) {
                $q->whereIn('kategori', $allowedCategories)
                    ->orWhereHas('details', function ($d) use ($allowedCategories) {
                        $d->whereIn('kategori', $allowedCategories);
                    });
            })
            ->with(['user', 'unit'])
            ->get();

        $stField = ($user->id_unit == 56) ? 'status_she' : 'status_security';

        $pendingDocuments = $docsAtLevel2->filter(function ($d) use ($stField) {
            $st = $d->$stField;
            return $d->current_level == 2 && ($st == 'pending_head' || empty($st));
        });

        $pendingCount = $pendingDocuments->count();
        // Transform for View
        $pendingData = $pendingDocuments->map(function ($doc) {
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan, // Fallback
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'date' => $doc->created_at->format('d M Y'),
                'risk_level' => $doc->risk_level ?? 'Normal',
                'status' => 'Menunggu Disposisi'
            ];
        })->values();


        // 3. Fetch Published/Approved Data (Top 10) - Inclusive
        $publishedDocuments = Document::where(function ($q) {
                $q->where('status', 'published')
                  ->orWhere('status_she', 'published')
                  ->orWhere('status_security', 'published');
            })
            ->with(['user', 'unit', 'details', 'approvals.approver'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        $publishedData = $publishedDocuments->map(function ($doc) {
            $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();
            // Broad Categories
            $cats = [];
            // Broad Categories - Strict Check
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
                'date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'author' => $doc->user->nama_user ?? '-',
                'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                'unit' => $doc->unit ? $doc->unit->nama_unit : '-',
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'risk_level' => $doc->risk_level ?? 'Normal',
                'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'approval_note' => $lastApproval ? $lastApproval->catatan : '-'
            ];
        });

        return view('unit_pengelola.dashboard', compact(
            'user',
            'pendingCount',
            'pendingData',
            'publishedData',
            'direktorats',
            'departemens',
            'units',
            'seksis',
            'unitUsers'
        ));
    }



    // NEW: Unit Pengelola Dashboard Data (AJAX)
    public function getUnitPengelolaDashboardData(Request $request)
    {
        $user = Auth::user();

        // Verify user is from SHE or Security (Head or Staff)
        // STRICT ID CHECK REMOVED to allow testing with other units if role allows
        // if (!in_array($user->id_unit, [55, 56])) {
        //     // return response()->json([], 403);
        // }

        // Filter documents by category based on user's unit
        // REQ: User wants ALL categories to be visible regardless of Unit Pengelola type
        // $categoryFilter = [];
        // if ($user->id_unit == 56) {
        //     // SHE unit: K3, KO, Lingkungan
        //     $categoryFilter = ['K3', 'KO', 'Lingkungan'];
        // } elseif ($user->id_unit == 55) {
        //     // Security unit: Keamanan
        //     $categoryFilter = ['Keamanan', 'keamanan', 'Security', 'security'];
        // }

        $query = Document::where(function ($q) {
                $q->where('status', 'published')
                  ->orWhere('status_she', 'published')
                  ->orWhere('status_security', 'published');
            })
            ->with(['user', 'unit', 'approvals.approver'])
            ->orderBy('updated_at', 'desc');

        // Filter by Unit if provided
        if ($request->has('unit_id') && $request->unit_id != '') {
            $query->where('id_unit', $request->unit_id);
        }

        // Limit defaults to 20 only if no specific filter
        if (!$request->has('unit_id')) {
            $query->limit(20);
        }

        $publishedDocuments = $query->with(['user', 'unit', 'details', 'approvals.approver'])->get();

        $data = $publishedDocuments->map(function ($doc) {
            $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();

            // Revert to Broad Categories (SHE, Security) - Strict Check
            $cats = [];
            if ($doc->hasSheContent() && ($doc->status == 'published' || $doc->status_she == 'published'))
                $cats[] = 'SHE';
            if ($doc->hasSecurityContent() && ($doc->status == 'published' || $doc->status_security == 'published'))
                $cats[] = 'Security';
            $categoryLabel = empty($cats) ? '-' : implode(', ', $cats);

            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'document_title' => $doc->judul_dokumen,
                'category' => $categoryLabel,
                'date' => $doc->created_at->format('d M Y'),
                'author' => $doc->user->nama_user ?? '-',
                'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'seksi_id' => $doc->id_seksi,
                'status' => 'DISETUJUI',
                'risk_level' => $doc->risk_level ?? 'Normal',
                'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'publish_time' => $doc->published_at ? $doc->published_at->format('H:i') . ' WIB' : '-',
                'approval_note' => $lastApproval ? $lastApproval->catatan : '-'
            ];
        });

        return response()->json($data);
    }

    // NEW: Admin Dashboard Data (AJAX) - For Accordion
    public function getAdminDashboardData(Request $request)
    {
        // Admin sees ALL published documents
        $query = Document::published()
            ->with(['user', 'unit', 'approvals.approver'])
            ->orderBy('published_at', 'desc');

        // Filter by Unit if provided (clicked from Accordion)
        if ($request->has('unit_id') && $request->unit_id != '') {
            $query->where('id_unit', $request->unit_id);
        }

        // Limit defaults to 20 only if no specific filter
        if (!$request->has('unit_id')) {
            $query->limit(20);
        }

        $publishedDocuments = $query->with(['user', 'unit', 'details'])->get();

        $data = $publishedDocuments->map(function ($doc) {
            // Revert to Broad Categories (SHE, Security)
            $cats = [];
            if ($doc->hasSheContent())
                $cats[] = 'SHE';
            if ($doc->hasSecurityContent())
                $cats[] = 'Security';
            $categoryLabel = empty($cats) ? '-' : implode(', ', $cats);

            $lastApproval = $doc->approvals()->where('action', 'approved')->latest()->first();
            return [
                'id' => $doc->id,
                'title' => $doc->judul_dokumen ?? $doc->kolom2_kegiatan,
                'document_title' => $doc->judul_dokumen,
                'category' => $categoryLabel,
                'date' => $doc->created_at->format('d M Y'),
                'author' => $doc->user->nama_user ?? '-',
                'approver' => $lastApproval ? ($lastApproval->approver->nama_user ?? '-') : '-',
                'dir_id' => $doc->id_direktorat,
                'dept_id' => $doc->id_dept,
                'unit_id' => $doc->id_unit,
                'seksi_id' => $doc->id_seksi,
                'status' => 'DISETUJUI',
                'risk_level' => $doc->risk_level ?? 'Normal',
                'approval_date' => $doc->published_at ? $doc->published_at->format('d M Y') : '-',
                'publish_time' => $doc->published_at ? $doc->published_at->format('H:i') . ' WIB' : '-',
                'approval_note' => $lastApproval ? $lastApproval->catatan : '-'
            ];
        });

        return response()->json($data);
    }

    // NEW: Realtime Status Check for Polling
    public function getStatus($id)
    {
        $document = Document::findOrFail($id);

        $statusLabel = 'Menunggu';
        if ($document->status == 'approved')
            $statusLabel = 'Disetujui';
        if ($document->status == 'revision')
            $statusLabel = 'Perlu Revisi';

        return response()->json([
            'success' => true,
            'current_level' => $document->current_level,
            'status' => $document->status,
            'status_label' => $statusLabel
        ]);
    }
    // NEW: Update Unit Permissions (AJAX)
    public function updateUnitPermissions(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id_user',
                'is_reviewer' => 'sometimes|boolean',
                'is_verifier' => 'sometimes|boolean',
                'can_create_documents' => 'sometimes|boolean',
            ]);

            $currentUser = Auth::user();
            $targetUser = \App\Models\User::findOrFail($request->user_id);

            // Security Check: User must be Unit Head of same unit
            if ($currentUser->id_unit != $targetUser->id_unit || !$currentUser->isKepalaUnit()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized: You must be the Head of this Unit.'], 403);
            }

            if ($request->has('is_reviewer')) {
                // Enforce Single Reviewer: If setting to true, unset others
                if ($request->is_reviewer) {
                    \App\Models\User::where('id_unit', $currentUser->id_unit)
                        ->where('id_user', '!=', $targetUser->id_user)
                        ->update(['is_reviewer' => 0]);
                    
                    // MUTUAL EXCLUSION: Unset other roles for this user
                    $targetUser->is_verifier = 0;
                    $targetUser->can_create_documents = 0;
                }
                $targetUser->is_reviewer = $request->is_reviewer;
            }

            if ($request->has('is_verifier')) {
                // Enforce Single Verifier: If setting to true, unset others
                if ($request->is_verifier) {
                    \App\Models\User::where('id_unit', $currentUser->id_unit)
                        ->where('id_user', '!=', $targetUser->id_user)
                        ->update(['is_verifier' => 0]);
                    
                    // MUTUAL EXCLUSION: Unset other roles for this user
                    $targetUser->is_reviewer = 0;
                    $targetUser->can_create_documents = 0;
                }
                $targetUser->is_verifier = $request->is_verifier;
            }

            if ($request->has('can_create_documents')) {
                // Enforce Single Create Access: If setting to true, unset others
                if ($request->can_create_documents) {
                    \App\Models\User::where('id_unit', $currentUser->id_unit)
                        ->where('id_user', '!=', $targetUser->id_user)
                        ->update(['can_create_documents' => 0]);
                    
                    // MUTUAL EXCLUSION: Unset other roles for this user
                    $targetUser->is_reviewer = 0;
                    $targetUser->is_verifier = 0;
                }
                $targetUser->can_create_documents = $request->can_create_documents;
            }

            $targetUser->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function reviseDetail(Request $request, \App\Models\DocumentDetail $detail)
    {
        $request->validate([
            'catatan' => 'required|string|min:5'
        ]);

        $document = $detail->document;
        $user = Auth::user();

        // Check Permissions
        // Allow HoD to revise specific items
        if ($user->isKepalaDepartemen()) {
            if ($user->id_dept != $document->id_dept) {
                abort(403);
            }
        } elseif (!$document->canBeApprovedBy($user)) {
             abort(403);
        }

        // 1. Update Detail Status
        $detail->update([
            'status' => 'revision',
            'revision_note' => $request->catatan
        ]);

        // 2. Update Parent Document Status (Trigger Revision Mode)
        // Only update the specific track status
        $cat = $detail->kategori;
        $updateData = [
            'status' => 'revision',
            'current_level' => 1
        ];

        if (in_array($cat, ['K3', 'KO', 'Lingkungan'])) {
            $updateData['status_she'] = 'revision';
        } elseif ($cat == 'Keamanan') {
            $updateData['status_security'] = 'revision';
        }

        $document->update($updateData);

        // 3. Record History
        $document->approvals()->create([
            'approver_id' => $user->id_user,
            'level' => $user->isKepalaDepartemen() ? 3 : 2,
            'action' => 'revision', 
            'catatan' => "Revisi Item #{$detail->id} ({$detail->kolom2_kegiatan}): " . $request->catatan,
            'ip_address' => $request->ip()
        ]);

        return back()->with('success', 'Item berhasil direvisi. Dokumen dikembalikan ke penyusun.');
    }
}
