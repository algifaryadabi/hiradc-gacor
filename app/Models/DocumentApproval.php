<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentApproval extends Model
{
    protected $fillable = [
        'document_id',
        'level',
        'approver_id',
        'action',
        'catatan',
        'changes',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    // ==================== RELATIONSHIPS ====================

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id', 'id_user');
    }

    // ==================== HELPER METHODS ====================

    public function getActionLabelAttribute(): string
    {
        return match ($this->action) {
            'approved' => 'Disetujui',
            'revised' => 'Revisi',
            'edited' => 'Diedit',
            default => $this->action,
        };
    }

    public function getActionIconAttribute(): string
    {
        return match ($this->action) {
            'approved' => 'fa-check-circle',
            'revised' => 'fa-undo',
            'edited' => 'fa-edit',
            default => 'fa-circle',
        };
    }

    public function getActionColorAttribute(): string
    {
        return match ($this->action) {
            'approved' => 'bg-green',
            'revised' => 'bg-orange',
            'edited' => 'bg-blue',
            default => 'bg-gray',
        };
    }
}
