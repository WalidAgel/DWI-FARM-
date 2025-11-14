<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranUtilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranUtilitasController extends Controller
{
    public function index(Request $request)
    {
        $query = PengeluaranUtilitas::query();

        if ($request->has('bulan') && $request->has('tahun')) {
            $query->where('periode_bulan', $request->bulan)
                  ->where('periode_tahun', $request->tahun);
        }

        if ($request->has('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'jenis' => 'required|in:listrik,air,transportasi,lainnya',
            'deskripsi' => 'nullable|string|max:200',
            'biaya' => 'required|numeric|min:0',
            'periode_bulan' => 'nullable|integer|min:1|max:12',
            'periode_tahun' => 'nullable|integer|min:2000',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $utilitas = PengeluaranUtilitas::create($request->all());
        return response()->json(['success' => true, 'message' => 'Pengeluaran utilitas berhasil ditambahkan', 'data' => $utilitas], 201);
    }

    public function show($id)
    {
        $utilitas = PengeluaranUtilitas::findOrFail($id);
        return response()->json(['success' => true, 'data' => $utilitas]);
    }

    public function update(Request $request, $id)
    {
        $utilitas = PengeluaranUtilitas::findOrFail($id);
        $utilitas->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $utilitas]);
    }

    public function destroy($id)
    {
        $utilitas = PengeluaranUtilitas::findOrFail($id);
        $utilitas->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
