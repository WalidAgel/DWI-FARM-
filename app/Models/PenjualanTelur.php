<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanTelur extends Model
{
    protected $table = 'penjualan_telur';
    protected $primaryKey = 'id_penjualan_telur';

    protected $fillable = [
        'id_pelanggan',
        'tanggal_penjualan',
        'jumlah_telur',
        'harga_per_butir',
        'total_harga',
        'metode_pembayaran',
        'status_pembayaran',
        'tanggal_jatuh_tempo',
        'catatan'
    ];

    protected $casts = [
        'tanggal_penjualan' => 'date',
        'tanggal_jatuh_tempo' => 'date',
        'harga_per_butir' => 'decimal:2',
        'total_harga' => 'decimal:2'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_harga = $model->jumlah_telur * $model->harga_per_butir;
        });
    }

    public function scopeLunas($query)
    {
        return $query->where('status_pembayaran', 'lunas');
    }

    public function scopeBelumLunas($query)
    {
        return $query->where('status_pembayaran', 'belum_lunas');
    }
}
