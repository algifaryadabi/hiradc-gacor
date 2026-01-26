<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    protected $fillable = [
        'id_user',
        'id_direktorat',
        'id_dept',
        'id_unit',
        'id_seksi',
        'kategori', // Kept for legacy support (Header Category)
        'judul_dokumen',
        'status',
        'current_level',
        // 'kolom... fields' will be moved to DocumentDetail logic,
// but for now we keep them in fillable if we want to support legacy or partial migration?
// Actually, let's keep the fillable as is until we fully switch the Controller.
// I will just ADD the relationship below.
        'kolom2_proses',
        'kolom2_kegiatan',
        'kolom3_lokasi',
        'kolom5_kondisi',
        'kolom6_bahaya',
        'kolom7_dampak',
        'kolom9_risiko',
        'kolom10_pengendalian',
        'kolom11_existing',
        'kolom12_kemungkinan',
        'kolom13_konsekuensi',
        'kolom14_score',
        'kolom14_level',
        'kolom15_regulasi',
        'kolom16_aspek',
        'kolom17_risiko',
        'kolom17_peluang',
        'kolom18_tindak_lanjut',
        'residual_kemungkinan',
        'residual_konsekuensi',
        'residual_score',
        'residual_level',
        'published_at',
        'compliance_checklist',
        'level2_status',
        'level2_reviewer_id',
        'level2_approver_id',
        'level2_assignment_date',
        // Workflow Splitting Columns
        'status_she',
        'status_security',
        'she_current_approver_id',
        'she_reviewer_id',
        'she_verificator_id',
        'security_current_approver_id',
        'security_reviewer_id',
        'security_verificator_id',
        'she_approved_at',
        'security_approved_at',
    ];

    protected $casts = [
        'kolom6_bahaya' => 'array',
        'kolom10_pengendalian' => 'array',
        'published_at' => 'datetime',
        'compliance_checklist' => 'array',
    ];

    // ==================== RELATIONSHIPS ====================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function direktorat(): BelongsTo
    {
        return $this->belongsTo(Direktorat::class, 'id_direktorat', 'id_direktorat');
    }

    public function departemen(): BelongsTo
    {
        return $this->belongsTo(Departemen::class, 'id_dept', 'id_dept');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'id_unit', 'id_unit');
    }

    public function seksi(): BelongsTo
    {
        return $this->belongsTo(Seksi::class, 'id_seksi', 'id_seksi');
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(DocumentApproval::class, 'document_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(DocumentDetail::class, 'document_id');
    }

    public function level2Reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'level2_reviewer_id', 'id_user');
    }

    public function level2Approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'level2_approver_id', 'id_user');
    }

    // ==================== HELPER METHODS ====================

    /**
     * Submit document for approval
     */
    public function submitForApproval(): void
    {
        $this->status = 'pending_level1';
        $this->current_level = 1;
        $this->save();
    }

    /**
     * Approve document and move to next level
     */
    public function approve(User $approver, ?string $catatan = null): void
    {
        // Log approval
        $this->approvals()->create([
            'level' => $this->current_level,
            'approver_id' => $approver->id_user,
            'action' => 'approved',
            'catatan' => $catatan,
        ]);

        // Move to next level
        if ($this->current_level == 1) {
            $this->current_level = 2;
            $this->status = 'pending_level2';
        } elseif ($this->current_level == 2) {
            $this->current_level = 3;
            $this->status = 'pending_level3';
        } elseif ($this->current_level == 3) {
            $this->status = 'published';
            $this->published_at = now();
        }

        $this->save();
    }

    /**
     * Send document for revision
     */
    public function revise(User $approver, string $catatan): void
    {
        $this->approvals()->create([
            'level' => $this->current_level,
            'approver_id' => $approver->id_user,
            'action' => 'revised',
            'catatan' => $catatan,
        ]);

        $this->status = 'revision';
        // Reset level to 0 (Draft/Revision) so flow restarts from beginning when resubmitted
        $this->current_level = 0;
        $this->save();
    }

    /**
     * Check if document can be approved by user
     */
    public function canBeApprovedBy(User $user): bool
    {
        // Level 0: Kepala Seksi (Optional/Future use)
// If workflow ever starts at Level 0, this handles it
        if ($this->current_level == 0) {
            return $user->isKepalaSeksi() && $user->id_seksi == $this->id_seksi;
        }

        // Level 1: Kepala Unit (same unit as document)
        if ($this->current_level == 1) {
            // Must be Senior Manager (Role 3) AND same Unit
            return $user->isKepalaUnit() && $user->id_unit == $this->id_unit;
        }

        // Level 2: Unit Pengelola based on content
        // ONLY Kepala Unit (Senior Manager, role_jabatan=3) from SHE or Security can approve
        if ($this->current_level == 2) {
            // Must be Kepala Unit (Senior Manager)
            if (!$user->isKepalaUnit()) {
                return false;
            }

            // Get user's unit ID
            $userUnitId = $user->id_unit;

            // Check if user is from SHE (56) and document has SHE content
            if ($userUnitId == 56) {
                return $this->hasSheContent();
            }

            // Check if user is from Security (55) and document has Security content
            if ($userUnitId == 55) {
                return $this->hasSecurityContent();
            }

            return false;
        }

        // Level 3: Kepala Departemen
        if ($this->current_level == 3) {
            // Must be General Manager (Role 2) AND same Dept
            return $user->isKepalaDepartemen() && $user->id_dept == $this->id_dept;
        }

        return false;
    }

    /**
     * Get risk level label
     */
    public function getRiskLevelAttribute(): string
    {
        $score = $this->kolom14_score;
        if ($score >= 15)
            return 'Tinggi';
        if ($score >= 8)
            return 'Sedang';
        return 'Rendah';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'Draft',
            'pending_level1' => 'Menunggu Approval Kepala Unit',
            'pending_level2' => 'Menunggu Approval Unit Pengelola',
            'pending_level3' => 'Menunggu Approval Kepala Departemen',
            'approved' => 'Disetujui',
            'published' => 'Terpublikasi',
            'rejected' => 'Ditolak',
            'revision' => 'Perlu Revisi',
            default => $this->status,
        };
    }

    /**
     * Scope for published documents
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at');
    }

    /**
     * Scope for pending approval at specific level
     */
    public function scopePendingAt($query, int $level)
    {
        return $query->where('status', 'pending_level' . $level);
    }

    // ==================== WORKFLOW HELPERS ====================

    /**
     * Check if document has SHE content (K3, KO, Lingkungan)
     */
    public function hasSheContent(): bool
    {
        // Check if main category matches
        if (in_array($this->kategori, ['K3', 'KO', 'Lingkungan'])) {
            return true;
        }

        // Check details if mixed content is supported
// Note: Currently 'kategori' in header supports mixed?
// Based on user request "User uploads one complete document covering ALL categories".
// The 'details' table has 'kategori'.
        return $this->details()->whereIn('kategori', ['K3', 'KO', 'Lingkungan'])->exists();
    }

    /**
     * Check if document has Security content (Keamanan)
     */
    public function hasSecurityContent(): bool
    {
        if ($this->kategori === 'Keamanan') {
            return true;
        }
        return $this->details()->where('kategori', 'Keamanan')->exists();
    }

    public function isSheApproved(): bool
    {
        return $this->status_she === 'approved' || !$this->hasSheContent();
    }

    public function isSecurityApproved(): bool
    {
        return $this->status_security === 'approved' || !$this->hasSecurityContent();
    }
}