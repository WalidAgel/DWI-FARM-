<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HppProduksi extends Model
{
    protected $table = 'hpp_produksi';
    protected $primaryKey = 'id_hpp';

    protected $fillable = [
        'periode_bulan',
        'periode_tahun',
        'hpp_telur_per_butir',
        'hpp_ayam_per_kg',
        'total_biaya_produksi',
        'total_unit_produksi',
        'catatan',
    ];
}
