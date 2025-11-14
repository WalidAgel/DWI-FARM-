<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Kandang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KandangController extends Controller
{
    public function index()
    {
        $data = Kandang::with(['stokAyam' => function($q) {
            $q->latest()->first();
        }])->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kandang' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
            'jenis_ayam' => 'required|in:petelur,pedaging,campuran',
            'status' => 'in:aktif,perbaikan,nonaktif',
            'tanggal_dibangun' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $kandang = Kandang::create($request->all());
        return response()->json(['success' => true, 'message' => 'Kandang berhasil ditambahkan', 'data' => $kandang], 201);
    }

    public function show($id)
    {
        $kandang = Kandang::with(['stokAyam', 'produksiTelur', 'kematianAyam'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $kandang]);
    }

    public function update(Request $request, $id)
    {
        $kandang = Kandang::findOrFail($id);
        $kandang->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data kandang berhasil diupdate', 'data' => $kandang]);
    }

    public function destroy($id)
    {
        $kandang = Kandang::findOrFail($id);
        $kandang->delete();
        return response()->json(['success' => true, 'message' => 'Kandang berhasil dihapus']);
    }
}
