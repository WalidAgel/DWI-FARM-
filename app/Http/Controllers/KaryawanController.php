<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('nama_karyawan')->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_karyawan' => 'required|string|max:100',
            'jabatan' => 'nullable|string|max:50',
            'gaji_pokok' => 'required|numeric|min:0',
            'tanggal_masuk' => 'nullable|date',
            'status' => 'in:aktif,nonaktif',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $karyawan = Karyawan::create($request->all());
        return response()->json(['success' => true, 'message' => 'Karyawan berhasil ditambahkan', 'data' => $karyawan], 201);
    }

    public function show($id)
    {
        $karyawan = Karyawan::with('pengeluaranGaji')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $karyawan]);
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data karyawan berhasil diupdate', 'data' => $karyawan]);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return response()->json(['success' => true, 'message' => 'Karyawan berhasil dihapus']);
    }
}
