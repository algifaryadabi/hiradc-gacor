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
        'kolom18_toleransi',
        'residual_kemungkinan',
        'residual_konsekuensi',
        'residual_score',
        'residual_level',
    ];

    protected $casts = [
        'kolom6_bahaya' => 'array',
        'kolom10_pengendalian' => 'array',
    ];

    // ==================== RELATIONSHIPS ====================

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'document_id');
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
}
