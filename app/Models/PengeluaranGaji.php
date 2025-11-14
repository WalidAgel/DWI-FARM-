<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranGaji extends Model
{
    protected $table = 'pengeluaran_gaji';
    protected $primaryKey = 'id_gaji';

    protected $fillable = [
        'id_karyawan',
        'periode_bulan',
        'periode_tahun',
        'gaji_pokok',
        'lembur',
        'bonus',
        'potongan',
        'total_gaji',
        'tanggal_bayar',
        'status_bayar',
        'catatan'
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
        'gaji_pokok' => 'decimal:2',
        'lembur' => 'decimal:2',
        'bonus' => 'decimal:2',
        'potongan' => 'decimal:2',
        'total_gaji' => 'decimal:2'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_gaji = $model->gaji_pokok + $model->lembur + $model->bonus - $model->potongan;
        });
    }

    public function scopePending($query)
    {
        return $query->where('status_bayar', 'pending');
    }

    public function scopeDibayar($query)
    {
        return $query->where('status_bayar', 'dibayar');
    }
}
