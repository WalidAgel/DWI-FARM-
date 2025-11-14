<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokAyam extends Model
{
    protected $table = 'stok_ayam';
    protected $primaryKey = 'id_stok';

    protected $fillable = [
        'id_kandang',
        'tanggal',
        'jumlah_ayam',
        'jenis_ayam',
        'umur_minggu',
        'status',
        'catatan'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'id_kandang');
    }

    public function scopeSehat($query)
    {
        return $query->where('status', 'sehat');
    }
}
