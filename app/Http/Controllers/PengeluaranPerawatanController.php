<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranPerawatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranPerawatanController extends Controller
{
    public function index(Request $request)
    {
        $query = PengeluaranPerawatan::with('kandang');

        if ($request->has('bulan') && $request->has('tahun')) {
            $query->whereMonth('tanggal_perawatan', $request->bulan)
                  ->whereYear('tanggal_perawatan', $request->tahun);
        }

        $data = $query->orderBy('tanggal_perawatan', 'desc')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kandang' => 'nullable|exists:kandang,id_kandang',
            'tanggal_perawatan' => 'required|date',
            'jenis_perawatan' => 'required|in:perbaikan,pembersihan,renovasi,peralatan',
            'deskripsi' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'penanggung_jawab' => 'nullable|string|max:100',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $perawatan = PengeluaranPerawatan::create($request->all());
        return response()->json(['success' => true, 'message' => 'Pengeluaran perawatan berhasil ditambahkan', 'data' => $perawatan], 201);
    }

    public function show($id)
    {
        $perawatan = PengeluaranPerawatan::with('kandang')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $perawatan]);
    }

    public function update(Request $request, $id)
    {
        $perawatan = PengeluaranPerawatan::findOrFail($id);
        $perawatan->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $perawatan]);
    }

    public function destroy($id)
    {
        $perawatan = PengeluaranPerawatan::findOrFail($id);
        $perawatan->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
