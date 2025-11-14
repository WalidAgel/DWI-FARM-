<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranPakan extends Model
{
    protected $table = 'pengeluaran_pakan';
    protected $primaryKey = 'id_pakan';

    protected $fillable = [
        'id_supplier',
        'tanggal_pembelian',
        'jenis_pakan',
        'jumlah_kg',
        'harga_per_kg',
        'total_biaya',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'jumlah_kg' => 'decimal:2',
        'harga_per_kg' => 'decimal:2',
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
            $model->total_biaya = $model->jumlah_kg * $model->harga_per_kg;
        });
    }
}
