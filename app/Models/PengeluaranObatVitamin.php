<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranObatVitamin extends Model
{
    protected $table = 'pengeluaran_obat_vitamin';
    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'id_supplier',
        'tanggal_pembelian',
        'nama_produk',
        'jenis',
        'jumlah',
        'satuan',
        'harga_satuan',
        'total_biaya',
        'tanggal_kadaluarsa',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'tanggal_kadaluarsa' => 'date',
        'harga_satuan' => 'decimal:2',
        'total_biaya' => 'decimal:2'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_biaya = $model->jumlah * $model->harga_satuan;
        });
    }
}
