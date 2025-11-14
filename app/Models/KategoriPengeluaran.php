<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPengeluaran extends Model
{
    protected $table = 'kategori_pengeluaran';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'status'
    ];

    public function pengeluaranLainnya()
    {
        return $this->hasMany(PengeluaranLainnya::class, 'id_kategori');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
