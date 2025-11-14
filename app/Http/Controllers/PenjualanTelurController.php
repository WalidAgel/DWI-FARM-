<?php

namespace App\Http\Controllers;

use App\Models\PenjualanTelur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanTelurController extends Controller
{
    public function index(Request $request)
    {
        $query = PenjualanTelur::with('pelanggan');

        if ($request->has('bulan') && $request->has('tahun')) {
            $query->whereMonth('tanggal_penjualan', $request->bulan)
                  ->whereYear('tanggal_penjualan', $request->tahun);
        }

        if ($request->has('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        $data = $query->orderBy('tanggal_penjualan', 'desc')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pelanggan' => 'nullable|exists:pelanggan,id_pelanggan',
            'tanggal_penjualan' => 'required|date',
            'jumlah_telur' => 'required|integer|min:1',
            'harga_per_butir' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer,tempo',
            'status_pembayaran' => 'required|in:lunas,belum_lunas',
            'tanggal_jatuh_tempo' => 'nullable|date',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $penjualan = PenjualanTelur::create($request->all());
        return response()->json(['success' => true, 'message' => 'Penjualan telur berhasil ditambahkan', 'data' => $penjualan], 201);
    }

    public function show($id)
    {
        $penjualan = PenjualanTelur::with('pelanggan')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $penjualan]);
    }

    public function update(Request $request, $id)
    {
        $penjualan = PenjualanTelur::findOrFail($id);
        $penjualan->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $penjualan]);
    }

    public function destroy($id)
    {
        $penjualan = PenjualanTelur::findOrFail($id);
        $penjualan->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function updateStatusPembayaran(Request $request, $id)
    {
        $penjualan = PenjualanTelur::findOrFail($id);

        $penjualan->update([
            'status_pembayaran' => 'lunas'
        ]);

        return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diupdate', 'data' => $penjualan]);
    }

    public function laporanPenjualan(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        $data = PenjualanTelur::whereMonth('tanggal_penjualan', $bulan)
            ->whereYear('tanggal_penjualan', $tahun)
            ->selectRaw('
                COUNT(*) as total_transaksi,
                SUM(jumlah_telur) as total_telur_terjual,
                SUM(total_harga) as total_pendapatan,
                AVG(harga_per_butir) as rata_harga_per_butir,
                SUM(CASE WHEN status_pembayaran = "lunas" THEN total_harga ELSE 0 END) as pendapatan_lunas,
                SUM(CASE WHEN status_pembayaran = "belum_lunas" THEN total_harga ELSE 0 END) as piutang
            ')
            ->first();

        return response()->json(['success' => true, 'data' => $data]);
    }
}
