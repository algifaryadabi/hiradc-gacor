<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleJabatan extends Model
{
    protected $table = 'role_jabatan';
    protected $primaryKey = 'id_role_jabatan';

    protected $fillable = [
        'nama_role_jabatan',
        'deskripsi',
        'level_jabatan',
        'status_aktif',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_jabatan', 'id_role_jabatan');
    }
}
