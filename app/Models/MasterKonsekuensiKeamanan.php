<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKonsekuensiKeamanan extends Model
{
    protected $table = 'master_konsekuensi_keamanan';

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
