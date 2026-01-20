<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKonsekuensiK3 extends Model
{
    protected $table = 'master_konsekuensi_k3';

    protected $fillable = [
        'level',
        'konsekuensi_manusia',
        'financial',
        'objective',
        'legal',
        'biaya_program_mitigasi',
        'reputasi',
    ];
}
