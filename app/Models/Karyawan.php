<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nama_karyawan',
        'jabatan',
        'gaji_pokok',
        'tanggal_masuk',
        'status',
        'no_telepon',
        'alamat'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'gaji_pokok' => 'decimal:2'
    ];

    public function pengeluaranGaji()
    {
        return $this->hasMany(PengeluaranGaji::class, 'id_karyawan');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
