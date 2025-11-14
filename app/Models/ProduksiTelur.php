<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduksiTelur extends Model
{
    protected $table = 'produksi_telur';
    protected $primaryKey = 'id_produksi';

    protected $fillable = [
        'id_kandang',
        'tanggal_produksi',
        'jumlah_telur',
        'jumlah_pecah',
        'jumlah_layak_jual',
        'berat_rata_rata',
        'catatan'
    ];

    protected $casts = [
        'tanggal_produksi' => 'date',
        'berat_rata_rata' => 'decimal:2'
    ];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'id_kandang');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->jumlah_layak_jual = $model->jumlah_telur - $model->jumlah_pecah;
        });
    }
}
