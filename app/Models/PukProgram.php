<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PukProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_detail_id',
        'judul',
        'tujuan',
        'sasaran',
        'penanggung_jawab',
        'uraian_revisi',
        'program_kerja',
        'status',
        'approved_by_kepala_unit',
        'approved_at',
        'rejection_note',
        'created_by',
    ];

    protected $casts = [
        'program_kerja' => 'array',
        'approved_at' => 'datetime',
    ];

    public function documentDetail()
    {
        return $this->belongsTo(DocumentDetail::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_kepala_unit');
    }
}
