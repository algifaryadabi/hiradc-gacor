<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    protected $table = 'seksi';
    protected $primaryKey = 'id_seksi';

    protected $fillable = [
        'id_unit',
        'nama_seksi',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit', 'id_unit');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_seksi', 'id_seksi');
    }

    public function probis()
    {
        return $this->belongsTo(BusinessProcess::class, 'id_probis');
    }
}
