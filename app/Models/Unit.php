<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $primaryKey = 'id_unit';

    protected $fillable = [
        'id_dept',
        'nama_unit',
        'kode_unit',
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_dept', 'id_dept');
    }

    public function seksis()
    {
        return $this->hasMany(Seksi::class, 'id_unit', 'id_unit');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_unit', 'id_unit');
    }
}
