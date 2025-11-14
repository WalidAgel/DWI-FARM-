<?php

namespace App\Http\Controllers;

use App\Services\ProfitabilitasService;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $profitabilitasService;

    public function __construct(ProfitabilitasService $profitabilitasService)
    {
        $this->profitabilitasService = $profitabilitasService;
    }

    public function laporanKeuanganLengkap(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        $this->profitabilitasService->hitungProfitabilitasBulanan($bulan, $tahun);

        $data = [
            'laba_rugi' => $this->profitabilitasService->getLaporanLabaRugi($bulan, $tahun),
        ];

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function downloadPDF(Request $request)
    {
        return response()->json(['success' => false, 'message' => 'Fitur download PDF dalam pengembangan']);
    }

    public function exportExcel(Request $request)
    {
        return response()->json(['success' => false, 'message' => 'Fitur export Excel dalam pengembangan']);
    }
}
