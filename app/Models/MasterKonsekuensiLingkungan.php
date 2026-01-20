<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKonsekuensiLingkungan extends Model
{
    protected $table = 'master_konsekuensi_lingkungan';

    protected $fillable = [
        'level',
        'cakupan_lokasi',
        'lama_pemulihan',
        'lama_penyimpangan',
        'financial',
        'objective',
        'legal',
        'product_image',
        'konsekuensi_manusia',
        'dampak_sosial',
        'biaya_perbaikan',
        'reputasi',
    ];
}
