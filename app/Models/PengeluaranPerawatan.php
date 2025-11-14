<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranPerawatan extends Model
{
    protected $table = 'pengeluaran_perawatan';
    protected $primaryKey = 'id_perawatan';

    protected $fillable = [
        'id_kandang',
        'tanggal_perawatan',
        'jenis_perawatan',
        'deskripsi',
        'biaya',
        'penanggung_jawab',
        'catatan'
    ];

    protected $casts = [
        'tanggal_perawatan' => 'date',
        'biaya' => 'decimal:2'
    ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'id_kandang');
    }
}
