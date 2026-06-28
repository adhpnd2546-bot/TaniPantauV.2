<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetaniController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $petani = Petani::with(['kecamatan', 'desa'])->paginate($perPage);

        $data = $petani->map(function ($p) {
            return [
                'id' => $p->id,
                'nama_petani' => $p->nama_petani,
                'nik' => $p->nik,
                'alamat' => $p->alamat,
                'kecamatan_id' => $p->kecamatan_id,
                'kecamatan' => $p->kecamatan ? $p->kecamatan->nama : null,
                'desa_id' => $p->desa_id,
                'desa' => $p->desa ? $p->desa->nama : null,
                'no_hp' => $p->no_hp,
                'petugas_id' => $p->petugas_id,
            ];
        });

        return response()->json([
            'data' => $data,
            'current_page' => $petani->currentPage(),
            'last_page' => $petani->lastPage(),
            'per_page' => $petani->perPage(),
            'total' => $petani->total(),
        ]);
    }

    public function show($id)
    {
        $p = Petani::with(['kecamatan', 'desa', 'lahan'])->find($id);

        if (!$p) {
            return response()->json(['message' => 'Petani tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $p->id,
            'nama_petani' => $p->nama_petani,
            'nik' => $p->nik,
            'alamat' => $p->alamat,
            'kecamatan_id' => $p->kecamatan_id,
            'kecamatan' => $p->kecamatan ? $p->kecamatan->nama : null,
            'desa_id' => $p->desa_id,
            'desa' => $p->desa ? $p->desa->nama : null,
            'no_hp' => $p->no_hp,
            'petugas_id' => $p->petugas_id,
            'total_lahan' => $p->lahan->count(),
        ]);
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $validated = $request->validate([
            'nama_petani' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:petani,nik',
            'alamat' => 'required|string',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
            'no_hp' => 'required|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/',
            'petugas_id' => 'nullable|exists:users,id',
        ]);

        $petani = Petani::create($validated);

        if ($validated['petugas_id'] ?? null) {
            \App\Models\Lahan::where('petani_id', $petani->id)->update(['petugas_id' => $validated['petugas_id']]);
        }

        return response()->json($petani->load(['kecamatan', 'desa']), 201);
    }

    public function update(Request $request, $id)
    {
        $petani = Petani::findOrFail($id);

        $validated = $request->validate([
            'nama_petani' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:petani,nik,' . $id,
            'alamat' => 'required|string',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
            'no_hp' => 'required|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/',
            'petugas_id' => 'nullable|exists:users,id',
        ]);

        $petani->update($validated);

        \App\Models\Lahan::where('petani_id', $petani->id)->update(['petugas_id' => $validated['petugas_id'] ?? null]);

        return response()->json($petani->load(['kecamatan', 'desa']));
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $petani = Petani::findOrFail($id);
        $petani->delete();

        return response()->json(['message' => 'Petani berhasil dihapus']);
    }
}
