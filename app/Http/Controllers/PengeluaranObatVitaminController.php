<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranObatVitamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranObatVitaminController extends Controller
{
    public function index(Request $request)
    {
        $query = PengeluaranObatVitamin::with('supplier');

        if ($request->has('bulan') && $request->has('tahun')) {
            $query->whereMonth('tanggal_pembelian', $request->bulan)
                  ->whereYear('tanggal_pembelian', $request->tahun);
        }

        $data = $query->orderBy('tanggal_pembelian', 'desc')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_supplier' => 'nullable|exists:supplier,id_supplier',
            'tanggal_pembelian' => 'required|date',
            'nama_produk' => 'required|string|max:100',
            'jenis' => 'required|in:obat,vitamin,vaksin',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:20',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_kadaluarsa' => 'nullable|date',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $obat = PengeluaranObatVitamin::create($request->all());
        return response()->json(['success' => true, 'message' => 'Pengeluaran obat/vitamin berhasil ditambahkan', 'data' => $obat], 201);
    }

    public function show($id)
    {
        $obat = PengeluaranObatVitamin::with('supplier')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $obat]);
    }

    public function update(Request $request, $id)
    {
        $obat = PengeluaranObatVitamin::findOrFail($id);
        $obat->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $obat]);
    }

    public function destroy($id)
    {
        $obat = PengeluaranObatVitamin::findOrFail($id);
        $obat->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
