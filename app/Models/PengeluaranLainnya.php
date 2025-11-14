<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranLainnya extends Model
{
    protected $table = 'pengeluaran_lainnya';
    protected $primaryKey = 'id_pengeluaran';

    protected $fillable = [
        'id_kategori',
        'tanggal',
        'deskripsi',
        'biaya',
        'catatan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'biaya' => 'decimal:2'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPengeluaran::class, 'id_kategori');
    }
}
