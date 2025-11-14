<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranGajiController extends Controller
{
    public function index(Request $request)
    {
        $query = PengeluaranGaji::with('karyawan');

        if ($request->has('bulan') && $request->has('tahun')) {
            $query->where('periode_bulan', $request->bulan)
                  ->where('periode_tahun', $request->tahun);
        }

        if ($request->has('status_bayar')) {
            $query->where('status_bayar', $request->status_bayar);
        }

        $data = $query->orderBy('periode_tahun', 'desc')
                     ->orderBy('periode_bulan', 'desc')
                     ->get();
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'periode_bulan' => 'required|integer|min:1|max:12',
            'periode_tahun' => 'required|integer|min:2000',
            'gaji_pokok' => 'required|numeric|min:0',
            'lembur' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'tanggal_bayar' => 'nullable|date',
            'status_bayar' => 'in:pending,dibayar',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $gaji = PengeluaranGaji::create($request->all());
        return response()->json(['success' => true, 'message' => 'Pengeluaran gaji berhasil ditambahkan', 'data' => $gaji], 201);
    }

    public function show($id)
    {
        $gaji = PengeluaranGaji::with('karyawan')->findOrFail($id);
        return response()->json(['success' => true, 'data' => $gaji]);
    }

    public function update(Request $request, $id)
    {
        $gaji = PengeluaranGaji::findOrFail($id);
        $gaji->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate', 'data' => $gaji]);
    }

    public function destroy($id)
    {
        $gaji = PengeluaranGaji::findOrFail($id);
        $gaji->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function updateStatusBayar(Request $request, $id)
    {
        $gaji = PengeluaranGaji::findOrFail($id);
        $gaji->update([
            'status_bayar' => 'dibayar',
            'tanggal_bayar' => now()
        ]);
        return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diupdate', 'data' => $gaji]);
    }
}
