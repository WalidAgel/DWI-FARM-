<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalisisProfitabilitas extends Model
{
    protected $table = 'analisis_profitabilitas';
    protected $primaryKey = 'id_analisis';

    protected $fillable = [
        'periode_mulai',
        'periode_selesai',
        'tipe_periode',
        'pendapatan_telur',
        'pendapatan_lainnya',
        'total_pendapatan',
        'biaya_pakan',
        'biaya_obat_vitamin',
        'biaya_perawatan',
        'biaya_gaji',
        'biaya_utilitas',
        'biaya_lainnya',
        'total_pengeluaran',
        'laba_kotor',
        'laba_bersih',
        'margin_laba_persen',
        'profitabilitas_persen',
        'roi_persen',
        'total_produksi_telur',
        'total_penjualan_telur',
        'jumlah_ayam_awal',
        'jumlah_ayam_akhir',
        'catatan'
    ];

    protected $casts = [
        'periode_mulai' => 'date',
        'periode_selesai' => 'date',
        'pendapatan_telur' => 'decimal:2',
        'pendapatan_lainnya' => 'decimal:2',
        'total_pendapatan' => 'decimal:2',
        'biaya_pakan' => 'decimal:2',
        'biaya_obat_vitamin' => 'decimal:2',
        'biaya_perawatan' => 'decimal:2',
        'biaya_gaji' => 'decimal:2',
        'biaya_utilitas' => 'decimal:2',
        'biaya_lainnya' => 'decimal:2',
        'total_pengeluaran' => 'decimal:2',
        'laba_kotor' => 'decimal:2',
        'laba_bersih' => 'decimal:2',
        'margin_laba_persen' => 'decimal:2',
        'profitabilitas_persen' => 'decimal:2',
        'roi_persen' => 'decimal:2'
    ];
}
