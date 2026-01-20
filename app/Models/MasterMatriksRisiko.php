<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterMatriksRisiko extends Model
{
    protected $table = 'master_matriks_risiko';

    protected $fillable = [
        'kemungkinan',
        'konsekuensi',
        'score',
        'level',
        'warna',
        'program_mitigasi',
    ];

    /**
     * Get risk level based on likelihood and consequence
     */
    public static function getRiskLevel($kemungkinan, $konsekuensi)
    {
        return self::where('kemungkinan', $kemungkinan)
                   ->where('konsekuensi', $konsekuensi)
                   ->first();
    }
}
