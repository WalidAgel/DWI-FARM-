<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $data = Supplier::aktif()->orderBy('nama_supplier')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required|string|max:100',
            'jenis_produk' => 'nullable|string|max:100',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:100',
            'status' => 'in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $supplier = Supplier::create($request->all());
        return response()->json(['success' => true, 'message' => 'Supplier berhasil ditambahkan', 'data' => $supplier], 201);
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json(['success' => true, 'data' => $supplier]);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data supplier berhasil diupdate', 'data' => $supplier]);
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json(['success' => true, 'message' => 'Supplier berhasil dihapus']);
    }
}
