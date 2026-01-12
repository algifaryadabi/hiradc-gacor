<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direktorat extends Model
{
    protected $table = 'direktorat';
    protected $primaryKey = 'id_direktorat';

    protected $fillable = [
        'nama_direktorat',
        'deskripsi',
        'status_aktif',
    ];

    public function departemen()
    {
        return $this->hasMany(Departemen::class, 'id_direktorat', 'id_direktorat');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_direktorat', 'id_direktorat');
    }
}
