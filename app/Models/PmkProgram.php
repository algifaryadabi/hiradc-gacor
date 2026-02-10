<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmkProgram extends Model
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
        'approved_by_kepala_dept',
        'approved_by_direksi',
        'unit_approval_at',
        'dept_approval_at',
        'direksi_approval_at',
        'rejection_note',
        'revision_note',
        'revised_by',
        'revised_at',
        'resubmitted_at',
        'created_by',
    ];

    protected $casts = [
        'program_kerja' => 'array',
        'unit_approval_at' => 'datetime',
        'dept_approval_at' => 'datetime',
        'direksi_approval_at' => 'datetime',
        'revised_at' => 'datetime',
        'resubmitted_at' => 'datetime',
    ];

    public function documentDetail()
    {
        return $this->belongsTo(DocumentDetail::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedByUnit()
    {
        return $this->belongsTo(User::class, 'approved_by_kepala_unit');
    }

    public function approvedByDept()
    {
        return $this->belongsTo(User::class, 'approved_by_kepala_dept');
    }

    public function approvedByDireksi()
    {
        return $this->belongsTo(User::class, 'approved_by_direksi');
    }
}
