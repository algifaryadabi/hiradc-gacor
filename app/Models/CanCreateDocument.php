<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanCreateDocument extends Model
{
    protected $table = 'can_create_documents';
    protected $primaryKey = 'id_create_documents';
    
    protected $fillable = [
        'pic',
        'deskripsi'
    ];
    
    /**
     * Relasi ke User
     */
    public function users()
    {
        return $this->hasMany(User::class, 'can_create_documents', 'id_create_documents');
    }
}
