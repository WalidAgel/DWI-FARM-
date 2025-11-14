<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetKeuangan extends Model
{
    protected $table = 'target_keuangan';
    protected $primaryKey = 'id_target';

    protected $fillable = [
        'bulan',
        'tahun',
        'target_pendapatan',
        'target_pengeluaran',
        'target_laba',
        'target_profitabilitas_persen',
        'catatan',
    ];
}
