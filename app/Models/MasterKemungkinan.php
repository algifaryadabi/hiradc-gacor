<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKemungkinan extends Model
{
    protected $table = 'master_kemungkinan';

    protected $fillable = [
        'level',
        'nama',
        'penjelasan',
    ];
}
