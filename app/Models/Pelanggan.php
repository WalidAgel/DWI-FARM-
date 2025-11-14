<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama_pelanggan',
        'jenis_pembeli',
        'no_telepon',
        'alamat',
        'email',
        'status'
    ];

    public function penjualanTelur()
    {
        return $this->hasMany(PenjualanTelur::class, 'id_pelanggan');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
