<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentHistory extends Model
{
    use HasFactory;

    protected $table = 'tr_document_histories';

    protected $fillable = [
        'document_id',
        'revision_number',
        'revision_reason',
        'archived_by',
        'snapshot_data',
        'archived_at',
    ];

    protected $casts = [
        'snapshot_data' => 'array',
        'archived_at' => 'datetime',
    ];

    // Relationships
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }

    public function archivedBy()
    {
        return $this->belongsTo(User::class, 'archived_by', 'id_user');
    }
}
