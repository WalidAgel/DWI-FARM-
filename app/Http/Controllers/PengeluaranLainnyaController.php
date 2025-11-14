<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranLainnya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranLainnyaController extends Controller
{
    public function index(Request $request)
    {
        $query = PengeluaranLainnya::with('kategori');

        if ($request->has('bulan') && $request->has('tahun')) {
            $query->whereMonth('tanggal', $request->bulan)
                  ->whereYear('tanggal', $request->tahun);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'nullable|exists:kategori_pengeluaran,id_kategori',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:200',
            'biaya' => 'required|numeric|min:0',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $pengeluaran = PengeluaranLainnya::create($request->all());
        return response()->json(['success' => true, 'message' => 'Pengeluaran lainnya berhasil ditambahkan', 'data' => $pengeluaran], 201);
    }

    public function show($id)
    {
        $pengeluaran = PengeluaranLainnya::with('kategori')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $pengeluaran]);
    }

    public function update(Request $request, $id)
    {
        $pengeluaran = PengeluaranLainnya::findOrFail($id);
        $pengeluaran->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $pengeluaran]);
    }

    public function destroy($id)
    {
        $pengeluaran = PengeluaranLainnya::findOrFail($id);
        $pengeluaran->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
