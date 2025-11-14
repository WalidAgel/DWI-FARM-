<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RasioKeuangan extends Model
{
    protected $table = 'rasio_keuangan';
    protected $primaryKey = 'id_rasio';

    protected $fillable = [
        'bulan',
        'tahun',
        'gross_profit_margin',
        'net_profit_margin',
        'return_on_assets',
        'return_on_equity',
        'current_ratio',
        'cash_ratio',
        'biaya_pakan_per_telur',
        'biaya_pakan_per_ayam',
        'produktivitas_per_kandang',
        'break_even_point',
    ];
}
