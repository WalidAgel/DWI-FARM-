<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranPakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranPakanController extends Controller
{
    public function index(Request $request)
    {
        $query = PengeluaranPakan::with('supplier');

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
            'jenis_pakan' => 'required|string|max:100',
            'jumlah_kg' => 'required|numeric|min:0',
            'harga_per_kg' => 'required|numeric|min:0',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $pakan = PengeluaranPakan::create($request->all());
        return response()->json(['success' => true, 'message' => 'Pengeluaran pakan berhasil ditambahkan', 'data' => $pakan], 201);
    }

    public function show($id)
    {
        $pakan = PengeluaranPakan::with('supplier')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $pakan]);
    }

    public function update(Request $request, $id)
    {
        $pakan = PengeluaranPakan::findOrFail($id);
        $pakan->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $pakan]);
    }

    public function destroy($id)
    {
        $pakan = PengeluaranPakan::findOrFail($id);
        $pakan->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}

