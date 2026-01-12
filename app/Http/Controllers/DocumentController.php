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
    /**
     * List user's documents
     */
    public function index()
    {
        $documents = Document::where('id_user', Auth::user()->id_user)
            ->with(['unit', 'approvals.approver'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.documents.index', compact('documents'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $user = Auth::user();
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
            'kolom6_bahaya' => $request->kolom6_bahaya,
            'kolom7_dampak' => $request->kolom7_dampak,
            'kolom8_pihak' => $request->kolom8_pihak,
            'kolom9_risiko' => $request->kolom9_risiko,
            'kolom10_pengendalian' => $request->kolom10_pengendalian,
            'kolom11_existing' => $request->kolom11_existing,
            'kolom12_kemungkinan' => $request->kolom12_kemungkinan,
            'kolom13_konsekuensi' => $request->kolom13_konsekuensi,
            'kolom14_score' => $request->kolom12_kemungkinan * $request->kolom13_konsekuensi,
            'kolom15_regulasi' => $request->kolom15_regulasi,
            'kolom16_aspek' => $request->kolom16_aspek,
            'kolom17_risiko' => $request->kolom17_risiko,
            'kolom17_peluang' => $request->kolom17_peluang,
            'kolom18_tindak_lanjut' => $request->kolom18_tindak_lanjut,
        ]);

        // Submit for approval if requested
        if ($request->submit_for_approval) {
            $document->submitForApproval();
        }

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil disimpan.');
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
            ->with('success', 'Dokumen berhasil dikirim untuk approval.');
    }

    // ==================== APPROVAL METHODS ====================

    /**
     * List documents pending approval (for approvers)
     */
    public function pendingApproval()
    {
        $user = Auth::user();
        $level = match ($user->role_user) {
            'approver' => 1,
            'unit_pengelola' => 2,
            'kepala_departemen' => 3,
            default => 0,
        };

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
     * Show review page
     */
    public function review(Document $document)
    {
        $document->load(['user', 'approvals.approver', 'direktorat', 'departemen', 'unit', 'seksi']);

        return view('approver.documents.review', compact('document'));
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

        // Update document fields if edited
        if ($request->has('edited_fields')) {
            $document->update($request->only([
                'kolom2_proses',
                'kolom2_kegiatan',
                'kolom3_lokasi',
                'kolom5_kondisi',
                'kolom6_bahaya',
                'kolom7_dampak',
                'kolom9_risiko',
                'kolom11_existing',
                'kolom12_kemungkinan',
                'kolom13_konsekuensi',
                'kolom15_regulasi',
                'kolom16_aspek',
                'kolom17_risiko',
                'kolom17_peluang',
                'kolom18_tindak_lanjut',
            ]));
        }

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
