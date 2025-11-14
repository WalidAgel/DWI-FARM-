<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    protected $table = 'kandang';
    protected $primaryKey = 'id_kandang';

    protected $fillable = [
        'nama_kandang',
        'kapasitas',
        'jenis_ayam',
        'status',
        'tanggal_dibangun'
    ];

    protected $casts = [
        'tanggal_dibangun' => 'date'
    ];

    public function stokAyam()
    {
        return $this->hasMany(StokAyam::class, 'id_kandang');
    }

    public function produksiTelur()
    {
        return $this->hasMany(ProduksiTelur::class, 'id_kandang');
    }

    public function kematianAyam()
    {
        return $this->hasMany(KematianAyam::class, 'id_kandang');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
