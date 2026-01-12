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
        'kategori',
        'status',
        'current_level',
        'kolom2_proses',
        'kolom2_kegiatan',
        'kolom3_lokasi',
        'kolom5_kondisi',
        'kolom6_bahaya',
        'kolom7_dampak',
        'kolom8_pihak',
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
    ];

    protected $casts = [
        'kolom6_bahaya' => 'array',
        'kolom8_pihak' => 'array', // Will be removed in DB but keep for now or remove
        'kolom10_pengendalian' => 'array',
        'published_at' => 'datetime',
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
            $this->status = 'approved';
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
        $this->save();
    }

    /**
     * Check if document can be approved by user
     */
    public function canBeApprovedBy(User $user): bool
    {
        // Level 1: Kepala Unit (same unit as document)
        if ($this->current_level == 1) {
            $isApprover = $user->getRoleName() === 'approver' ||
                $user->id_role_user == 3 ||
                $user->id_role_jabatan == 3; // Senior Manager

            return $isApprover && $user->id_unit == $this->id_unit;
        }


        // Level 2: Unit Pengelola based on category
        if ($this->current_level == 2) {
            $userRole = $user->getRoleName();

            // User must be 'unit_pengelola' OR 'approver'(Kepala Unit) of the managing unit
            if ($userRole !== 'unit_pengelola' && $userRole !== 'approver') {
                return false;
            }

            // Get user's unit name for checking
            // We can also check IDs based on DB dump (55=Security, 56=SHE)
            $userUnitId = $user->id_unit;
            $userUnitName = strtoupper($user->unit->nama_unit ?? '');

            if (in_array($this->kategori, ['K3', 'KO', 'Lingkungan'])) {
                // SHE unit approves
                return $userUnitId == 56 ||
                    str_contains($userUnitName, 'SHE') ||
                    str_contains($userUnitName, 'SAFETY') ||
                    str_contains($userUnitName, 'LINGKUNGAN');
            } else if ($this->kategori === 'Keamanan') {
                // Security unit approves
                return $userUnitId == 55 ||
                    str_contains($userUnitName, 'KEAMANAN') ||
                    str_contains($userUnitName, 'SECURITY');
            }

            return false;
        }

        // Level 3: Kepala Departemen
        if ($this->current_level == 3) {
            $isDeptHead = $user->getRoleName() === 'kepala_departemen' ||
                $user->id_role_user == 4 ||
                $user->id_role_jabatan == 2; // General Manager

            return $isDeptHead && $user->id_dept == $this->id_dept;
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
        return $query->where('status', 'approved')->whereNotNull('published_at');
    }

    /**
     * Scope for pending approval at specific level
     */
    public function scopePendingAt($query, int $level)
    {
        return $query->where('status', 'pending_level' . $level);
    }
}
