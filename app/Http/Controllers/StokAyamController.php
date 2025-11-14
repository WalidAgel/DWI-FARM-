<?php

namespace App\Http\Controllers;

use App\Models\StokAyam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokAyamController extends Controller
{
    public function index(Request $request)
    {
        $query = StokAyam::with('kandang');

        if ($request->has('id_kandang')) {
            $query->where('id_kandang', $request->id_kandang);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kandang' => 'required|exists:kandang,id_kandang',
            'tanggal' => 'required|date',
            'jumlah_ayam' => 'required|integer|min:0',
            'jenis_ayam' => 'required|in:petelur,pedaging',
            'umur_minggu' => 'nullable|integer|min:0',
            'status' => 'in:sehat,sakit,mati',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $stok = StokAyam::create($request->all());
        return response()->json(['success' => true, 'message' => 'Stok ayam berhasil ditambahkan', 'data' => $stok], 201);
    }

    public function show($id)
    {
        $stok = StokAyam::with('kandang')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $stok]);
    }

    public function update(Request $request, $id)
    {
        $stok = StokAyam::findOrFail($id);
        $stok->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $stok]);
    }

    public function destroy($id)
    {
        $stok = StokAyam::findOrFail($id);
        $stok->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function getStokTerkini()
    {
        $data = StokAyam::with('kandang')
            ->whereIn('id_stok', function($query) {
                $query->selectRaw('MAX(id_stok)')
                      ->from('stok_ayam')
                      ->groupBy('id_kandang');
            })
            ->where('status', 'sehat')
            ->get();

        return response()->json(['success' => true, 'data' => $data]);
    }
}
