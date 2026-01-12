<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departemen';
    protected $primaryKey = 'id_dept';

    protected $fillable = [
        'id_direktorat',
        'nama_dept',
    ];

    public function direktorat()
    {
        return $this->belongsTo(Direktorat::class, 'id_direktorat', 'id_direktorat');
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'id_dept', 'id_dept');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_dept', 'id_dept');
    }
}
