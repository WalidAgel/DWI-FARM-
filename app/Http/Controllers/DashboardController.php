<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use App\Services\ProfitabilitasService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;
    protected $profitabilitasService;

    public function __construct(
        DashboardService $dashboardService,
        ProfitabilitasService $profitabilitasService
    ) {
        $this->dashboardService = $dashboardService;
        $this->profitabilitasService = $profitabilitasService;
    }

    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $data = $this->dashboardService->getDashboardKeuangan($tahun);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function laporanLabaRugi(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        $laporan = $this->profitabilitasService->getLaporanLabaRugi($bulan, $tahun);

        return response()->json([
            'success' => true,
            'data' => $laporan
        ]);
    }
}
