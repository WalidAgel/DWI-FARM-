<?php

namespace App\Services;

class DashboardService
{
    public function getDashboardKeuangan($tahun)
    {
        // logika dashboard keuangan
        return [
            'tahun' => $tahun,
            'total_pendapatan' => 35000000,
            'total_pengeluaran' => 25000000,
            'laba_bersih' => 10000000
        ];
    }
}
