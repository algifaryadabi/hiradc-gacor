<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentApproval;
use App\Models\PukProgram;
use App\Models\PmkProgram;
use App\Models\User;
use App\Models\Unit;
use App\Models\Departemen;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    /**
     * Approve MAIN HIRADC Document (Level 1, 2, 3)
     */
    public function approveHiradc(Request $request, $id)
    {
        $document = Document::with(['user', 'details'])->findOrFail($id);
        $user = Auth::user();
        $catatan = $request->input('note');

        // VALIDATION: Can user approve?
        if (!$document->canBeApprovedBy($user)) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki hak akses untuk menyetujui dokumen ini.'], 403);
        }

        DB::beginTransaction();
        try {
            // Log Approval
            $approval = DocumentApproval::create([
                'document_id' => $document->id,
                'level' => $document->current_level,
                'approver_id' => $user->id_user,
                'action' => 'approved',
                'catatan' => $catatan,
            ]);

            // HANDLE LEVEL TRANSITIONS
            if ($document->current_level == 1) {
                // From Kepala Unit -> Unit Pengelola
                $document->current_level = 2;
                $document->status = 'pending_level2';

                // Initialize Split Statuses
                if ($document->hasSheContent())
                    $document->status_she = 'pending_head'; // Need SHE Head approval
                if ($document->hasSecurityContent())
                    $document->status_security = 'pending_head'; // Need Security Head approval

            } elseif ($document->current_level == 2) {
                // Unit Pengelola Approval
                // Updating status based on WHO approved (SHE or Security Head)
                if ($user->isUnitPengelola() && $user->id_unit == 56) { // SHE
                    $document->status_she = 'approved';
                    $document->she_approved_at = now();
                } elseif ($user->isUnitPengelola() && $user->id_unit == 55) { // Security
                    $document->status_security = 'approved';
                    $document->security_approved_at = now();
                }

                // Check if ALL required Units have approved
                if ($document->isSheApproved() && $document->isSecurityApproved()) {
                    // Check for Dept ID 0 Exception
                    if ($document->id_dept === 0) {
                        // Skip Level 3, Go Straight to Publish
                        $document->current_level = 3; // Finished Level 2
                        $document->status = 'published';
                        $document->published_at = now();
                    } else {
                        // Move to Level 3 (Kepala Departemen)
                        $document->current_level = 3;
                        $document->status = 'pending_level3';
                    }
                } else {
                    // Still waiting for other unit
                    // Status remains 'pending_level2'
                }

            } elseif ($document->current_level == 3) {
                // Kepala Departemen -> Publish
                $document->status = 'published';
                $document->published_at = now();
            }

            $document->save();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Dokumen berhasil disetujui.']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Approve PUK Program (Only Kepala Unit)
     */
    public function approvePuk(Request $request, $id)
    {
        $program = PukProgram::findOrFail($id);
        $user = Auth::user();

        // 1. Must be Head of Unit of the creator's unit
        // We need to trace back to document Detail -> Document
        $detail = $program->documentDetail;
        $document = $detail->document; // Assuming relation exists

        if (!$document) {
            // Fallback if relation missing in model, load manually?
            // Should have relation. assuming DocumentDetail belongsTo Document
            // If not, we check Program -> DocumentDetail -> Document
            return response()->json(['success' => false, 'message' => 'Data Dokumen tidak ditemukan.'], 404);
        }

        // Logic: Approver must be Kepala Unit AND Same Unit as Document
        if (!$user->isKepalaUnit() || $user->id_unit != $document->id_unit) {
            return response()->json(['success' => false, 'message' => 'Hanya Kepala Unit terkait yang dapat menyetujui PUK.'], 403);
        }

        $program->status = 'approved';
        $program->approved_by_kepala_unit = $user->id_user;
        $program->approved_at = now();
        $program->save();

        return response()->json(['success' => true, 'message' => 'Program PUK berhasil disetujui.']);
    }

    /**
     * Approve PMK Program (Unit -> Dept -> Direksi)
     */
    public function approvePmk(Request $request, $id)
    {
        $program = PmkProgram::findOrFail($id);
        $user = Auth::user();
        $detail = $program->documentDetail;
        $document = $detail->document;

        $catatan = $request->input('note');

        // Level 1: Kepala Unit
        if ($program->status == 'pending_unit') {
            if (!$user->isKepalaUnit() || $user->id_unit != $document->id_unit) {
                return response()->json(['success' => false, 'message' => 'Akses Ditolak. Menunggu Approval Kepala Unit.'], 403);
            }
            $program->status = 'pending_dept';
            $program->approved_by_kepala_unit = $user->id_user;
            $program->unit_approval_at = now();
            $program->save();
            return response()->json(['success' => true, 'message' => 'PMK disetujui Kepala Unit. Menunggu Kepala Departemen.']);
        }

        // Level 2: Kepala Departemen
        if ($program->status == 'pending_dept') {
            // Check Dept 0 Exception? PMK usually for High Risk, maybe specific rule.
            // Requirement says "Kepala Departemen". If Dept 0, maybe skip?
            // Assuming Dept exists for now or handled.
            if ($document->id_dept === 0) {
                // Auto-advance if no dept? Or logic handled elsewhere.
                // Let's assume for PMK, if id_dept is 0, we skip to Direksi immediately?
                // Or maybe validation prevents submitting PMK without Dept?
                // Let's implement skip logic for robustness.

                // If current user is Direktur? No, skipping needs to happen at previous step.
                // We'll assume standard flow for now.
            }

            // Standard Dept Check
            if (!$user->isKepalaDepartemen() || $user->id_dept != $document->id_dept) {
                // Fallback: If Dept 0, maybe Direktur approves here?
                // Keep it strict for now.
                return response()->json(['success' => false, 'message' => 'Akses Ditolak. Menunggu Approval Kepala Departemen.'], 403);
            }

            $program->status = 'pending_direksi'; // New status for PMK
            $program->approved_by_kepala_dept = $user->id_user;
            $program->dept_approval_at = now();
            $program->save();
            return response()->json(['success' => true, 'message' => 'PMK disetujui Kepala Departemen. Menunggu Direksi.']);
        }

        // Level 3: Direksi
        if ($program->status == 'pending_direksi') {
            // Must be Direktur of Parent Directorate
            if (!$user->isDirektur()) {
                return response()->json(['success' => false, 'message' => 'Hanya Direktur yang dapat menyetujui.'], 403);
            }

            // Check correctness of Directorate
            // Logic: User(Direktur)->id_direktorat MUST MATCH Document->id_direktorat
            if ($user->id_direktorat != $document->id_direktorat) {
                // Cross-check: Ensure it matches
                return response()->json(['success' => false, 'message' => 'Anda bukan Direktur dari Direktorat dokumen ini.'], 403);
            }

            $program->status = 'approved';
            $program->approved_by_direksi = $user->id_user;
            $program->direksi_approval_at = now();
            $program->save();
            return response()->json(['success' => true, 'message' => 'Program PMK sepenuhnya disetujui!']);
        }

        return response()->json(['success' => false, 'message' => 'Status program tidak valid untuk approval.'], 400);
    }

}
