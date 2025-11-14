<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingkasanBulanan extends Model
{
    protected $table = 'ringkasan_bulanan';
    protected $primaryKey = 'id_ringkasan';

    protected $fillable = [
        'bulan',
        'tahun',
        'total_pengeluaran',
        'total_pendapatan',
        'pendapatan_bersih',
        'profitabilitas_persen',
        'total_produksi_telur',
        'total_penjualan_telur',
        'jumlah_ayam_aktif'
    ];

    protected $casts = [
        'total_pengeluaran' => 'decimal:2',
        'total_pendapatan' => 'decimal:2',
        'pendapatan_bersih' => 'decimal:2',
        'profitabilitas_persen' => 'decimal:2'
    ];
}
