<?php

namespace App\Http\Controllers;

use App\Models\ProduksiTelur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProduksiTelurController extends Controller
{
    public function index(Request $request)
    {
        $query = ProduksiTelur::with('kandang');

        if ($request->has('bulan') && $request->has('tahun')) {
            $query->whereMonth('tanggal_produksi', $request->bulan)
                  ->whereYear('tanggal_produksi', $request->tahun);
        }

        if ($request->has('id_kandang')) {
            $query->where('id_kandang', $request->id_kandang);
        }

        $data = $query->orderBy('tanggal_produksi', 'desc')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kandang' => 'required|exists:kandang,id_kandang',
            'tanggal_produksi' => 'required|date',
            'jumlah_telur' => 'required|integer|min:0',
            'jumlah_pecah' => 'nullable|integer|min:0',
            'berat_rata_rata' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $produksi = ProduksiTelur::create($request->all());
        return response()->json(['success' => true, 'message' => 'Produksi telur berhasil ditambahkan', 'data' => $produksi], 201);
    }

    public function show($id)
    {
        $produksi = ProduksiTelur::with('kandang')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $produksi]);
    }

    public function update(Request $request, $id)
    {
        $produksi = ProduksiTelur::findOrFail($id);
        $produksi->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $produksi]);
    }

    public function destroy($id)
    {
        $produksi = ProduksiTelur::findOrFail($id);
        $produksi->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function laporanProduksi(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        $data = ProduksiTelur::with('kandang')
            ->whereMonth('tanggal_produksi', $bulan)
            ->whereYear('tanggal_produksi', $tahun)
            ->selectRaw('
                id_kandang,
                COUNT(*) as total_hari_produksi,
                SUM(jumlah_telur) as total_telur,
                SUM(jumlah_pecah) as total_pecah,
                SUM(jumlah_layak_jual) as total_layak_jual,
                AVG(berat_rata_rata) as rata_berat,
                MAX(jumlah_telur) as produksi_tertinggi,
                MIN(jumlah_telur) as produksi_terendah
            ')
            ->groupBy('id_kandang')
            ->get();

        $total = [
            'total_produksi' => $data->sum('total_telur'),
            'total_pecah' => $data->sum('total_pecah'),
            'total_layak_jual' => $data->sum('total_layak_jual'),
            'persentase_pecah' => $data->sum('total_telur') > 0
                ? ($data->sum('total_pecah') / $data->sum('total_telur')) * 100
                : 0
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'summary' => $total
        ]);
    }
}
