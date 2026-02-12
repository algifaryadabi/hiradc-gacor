<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentDetail extends Model
{
    protected $table = 'document_details';

    protected $fillable = [
        'document_id',
        'kategori',
        'kolom2_proses',
        'kolom2_kegiatan',
        'kolom3_lokasi',
        'kolom4_pihak',
        'kolom5_kondisi',
        'kolom6_bahaya',
        'bahaya_manual',
        'kolom7_aspek_lingkungan', // New
        'kolom7_dampak',
        'kolom8_ancaman', // New
        // Checking migration 2026_01_16_190935_create_document_details_table.php... 
        // It has 'bahaya_manual'. conditional migration added 'kolom7_aspek_lingkungan' and 'kolom8_ancaman'.
        // Does it add 'ancaman_manual'?
        // Controller line 483: 'manual' => $item['ancaman_manual'] ?? '', inside the JSON structure of kolom8_ancaman?
        // Ah, Controller line 481: 'kolom8_ancaman' => [ 'details' => ..., 'manual' => ... ]
        // So 'ancaman_manual' is part of the JSON, NOT a separate column.
        // Same for 'aspek_manual' -> part of 'kolom7_aspek_lingkungan' JSON.
        // 'bahaya_manual' IS a separate column (line 27 of create_document_details).
        // So I only need to add 'kolom7_aspek_lingkungan' and 'kolom8_ancaman' to fillable.

        'kolom9_risiko',
        'kolom9_risiko_k3ko',
        'kolom9_dampak_lingkungan',
        'kolom9_celah_keamanan',

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
        'kolom18_toleransi',
        'kolom19_program_type', // Re-added via migration
        'kolom19_pengendalian_lanjut', // New cols from controller
        'kolom20_kemungkinan_lanjut',
        'kolom21_konsekuensi_lanjut',
        'kolom22_tingkat_risiko_lanjut',
        'kolom22_level_lanjut',
        'residual_kemungkinan',
        'residual_konsekuensi',
        'residual_score',
        'residual_level',
    ];

    protected $casts = [
        'kolom6_bahaya' => 'array',
        'kolom7_aspek_lingkungan' => 'array',
        'kolom8_ancaman' => 'array',
        'kolom10_pengendalian' => 'array',
    ];

    // ==================== RELATIONSHIPS ====================

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function pukProgram()
    {
        return $this->hasOne(PukProgram::class, 'document_detail_id');
    }

    public function pmkProgram()
    {
        return $this->hasOne(PmkProgram::class, 'document_detail_id');
    }

    /**
     * Relationship for compatibility with views expecting multiple programs (hasMany)
     */
    public function pukPrograms()
    {
        return $this->hasMany(PukProgram::class, 'document_detail_id');
    }

    // ==================== HELPERS ====================

    public function getRiskLevelAttribute(): string
    {
        $score = $this->kolom14_score;
        if ($score >= 15)
            return 'Tinggi';
        if ($score >= 8)
            return 'Sedang';
        return 'Rendah';
    }

    // ==================== PROGRAM ACCESSORS ====================
    // Helper to get active program
    public function getActiveProgramAttribute()
    {
        if ($this->kolom19_program_type === 'PUK')
            return $this->pukProgram;
        if ($this->kolom19_program_type === 'PMK')
            return $this->pmkProgram;
        return $this->pukProgram ?? $this->pmkProgram;
    }

    public function getProgramTujuanAttribute()
    {
        return $this->active_program->tujuan ?? null;
    }

    public function getProgramSasaranAttribute()
    {
        return $this->active_program->sasaran ?? null;
    }

    public function getProgramPenanggungJawabAttribute()
    {
        return $this->active_program->penanggung_jawab ?? null;
    }

    public function getProgramUraianRevisiAttribute()
    {
        return $this->active_program->uraian_revisi ?? null;
    }

    public function getProgramKerjaAttribute()
    {
        return $this->active_program->program_kerja ?? [];
    }
}
