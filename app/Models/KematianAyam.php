<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KematianAyam extends Model
{
    protected $table = 'kematian_ayam';
    protected $primaryKey = 'id_kematian';

    protected $fillable = [
        'id_kandang',
        'tanggal',
        'jumlah',
        'penyebab',
        'catatan'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'id_kandang');
    }
}
