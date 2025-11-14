<?php

namespace App\Services;

class ProfitabilitasService
{
    public function hitungProfitabilitasBulanan($bulan, $tahun)
    {
        // logika perhitungan profit per bulan
        return [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'profit' => 1000000 // contoh
        ];
    }

    public function getLaporanLabaRugi($bulan, $tahun)
    {
        // logika laporan laba rugi
        return [
            'pendapatan' => 3000000,
            'pengeluaran' => 2000000,
            'laba_rugi' => 1000000
        ];
    }
}
