<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';

    protected $fillable = [
        'nama_supplier',
        'jenis_produk',
        'no_telepon',
        'alamat',
        'email',
        'status'
    ];

    public function pengeluaranPakan()
    {
        return $this->hasMany(PengeluaranPakan::class, 'id_supplier');
    }

    public function pengeluaranObatVitamin()
    {
        return $this->hasMany(PengeluaranObatVitamin::class, 'id_supplier');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
