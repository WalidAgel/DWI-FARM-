<?php

namespace App\Http\Controllers;

use App\Models\KematianAyam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KematianAyamController extends Controller
{
    public function index(Request $request)
    {
        $query = KematianAyam::with('kandang');

        if ($request->has('bulan') && $request->has('tahun')) {
            $query->whereMonth('tanggal', $request->bulan)
                  ->whereYear('tanggal', $request->tahun);
        }

        if ($request->has('id_kandang')) {
            $query->where('id_kandang', $request->id_kandang);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kandang' => 'required|exists:kandang,id_kandang',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'penyebab' => 'nullable|string|max:200',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $kematian = KematianAyam::create($request->all());
        return response()->json(['success' => true, 'message' => 'Data kematian ayam berhasil ditambahkan', 'data' => $kematian], 201);
    }

    public function show($id)
    {
        $kematian = KematianAyam::with('kandang')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $kematian]);
    }

    public function update(Request $request, $id)
    {
        $kematian = KematianAyam::findOrFail($id);
        $kematian->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $kematian]);
    }

    public function destroy($id)
    {
        $kematian = KematianAyam::findOrFail($id);
        $kematian->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function laporanKematian(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        $data = KematianAyam::with('kandang')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->selectRaw('
                id_kandang,
                COUNT(*) as total_kejadian,
                SUM(jumlah) as total_kematian,
                GROUP_CONCAT(DISTINCT penyebab) as penyebab_umum
            ')
            ->groupBy('id_kandang')
            ->get();

        return response()->json(['success' => true, 'data' => $data]);
    }
}
