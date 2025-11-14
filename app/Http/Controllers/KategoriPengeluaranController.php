<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriPengeluaranController extends Controller
{
    public function index()
    {
        $data = KategoriPengeluaran::all();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $kategori = KategoriPengeluaran::create($request->all());
        return response()->json(['success' => true, 'message' => 'Kategori berhasil ditambahkan', 'data' => $kategori], 201);
    }

    public function show($id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);
        return response()->json(['success' => true, 'data' => $kategori]);
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);
        $kategori->update($request->all());
        return response()->json(['success' => true, 'message' => 'Kategori berhasil diupdate', 'data' => $kategori]);
    }

    public function destroy($id)
    {
        $kategori = KategoriPengeluaran::findOrFail($id);
        $kategori->delete();
        return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus']);
    }
}
