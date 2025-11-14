<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranUtilitas extends Model
{
    protected $table = 'pengeluaran_utilitas';
    protected $primaryKey = 'id_utilitas';

    protected $fillable = [
        'tanggal',
        'jenis',
        'deskripsi',
        'biaya',
        'periode_bulan',
        'periode_tahun',
        'catatan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'biaya' => 'decimal:2'
    ];
}
