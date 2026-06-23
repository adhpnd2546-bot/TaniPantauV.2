<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LahanController extends Controller
{
    public function index(Request $request)
    {
        $query = Lahan::with('petani.kecamatan', 'petani.desa');

        if ($request->komoditas) {
            $query->where('komoditas', $request->komoditas);
        }
        if ($request->status_fase) {
            $query->where('status_fase', $request->status_fase);
        }
        if ($request->kecamatan) {
            $query->whereHas('petani', function ($q) use ($request) {
                $q->where('kecamatan_id', $request->kecamatan);
            });
        }
        if ($request->petugas) {
            $query->whereHas('kunjungan', function ($q) use ($request) {
                $q->where('petugas_id', $request->petugas);
            });
        }

        $perPage = $request->input('per_page', 50);
        $lahan = $query->paginate($perPage);

        $data = $lahan->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_lahan' => $item->nama_lahan,
                'komoditas' => $item->komoditas,
                'luas_lahan' => $item->luas_lahan,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'tanggal_tanam' => $item->tanggal_tanam,
                'status_fase' => $item->status_fase,
                'belum_dikunjungi' => $item->kunjungan()->count() === 0,
                'petani' => $item->petani ? [
                    'id' => $item->petani->id,
                    'nama' => $item->petani->nama_petani,
                    'kecamatan' => $item->petani->kecamatan->nama ?? null,
                ] : null,
                'petani_id' => $item->petani_id,
            ];
        });

        return response()->json([
            'data' => $data,
            'current_page' => $lahan->currentPage(),
            'last_page' => $lahan->lastPage(),
            'per_page' => $lahan->perPage(),
            'total' => $lahan->total(),
        ]);
    }

    public function show($id)
    {
        $lahan = Lahan::with(['petani.kecamatan', 'petani.desa', 'kunjungan.petugas'])->find($id);

        if (!$lahan) {
            return response()->json(['message' => 'Lahan tidak ditemukan'], 404);
        }

        $data = [
            'id' => $lahan->id,
            'nama_lahan' => $lahan->nama_lahan,
            'komoditas' => $lahan->komoditas,
            'luas_lahan' => $lahan->luas_lahan,
            'latitude' => $lahan->latitude,
            'longitude' => $lahan->longitude,
            'tanggal_tanam' => $lahan->tanggal_tanam,
            'status_fase' => $lahan->status_fase,
            'petani' => $lahan->petani ? [
                'id' => $lahan->petani->id,
                'nama' => $lahan->petani->nama_petani,
                'kecamatan' => $lahan->petani->kecamatan->nama ?? null,
            ] : null,
            'petani_id' => $lahan->petani_id,
            'belum_dikunjungi' => $lahan->kunjungan()->count() === 0,
            'google_maps_link' => $lahan->latitude && $lahan->longitude
                ? "https://www.google.com/maps?q={$lahan->latitude},{$lahan->longitude}"
                : null,
            'kunjungan_lahans' => $lahan->kunjungan->map(function ($k) {
                return [
                    'id' => $k->id,
                    'tanggal_kunjungan' => $k->tanggal_kunjungan,
                    'kondisi_lahan' => $k->kondisi_lahan,
                    'catatan_lapangan' => $k->catatan_lapangan,
                    'foto' => $k->foto ? url('storage/' . $k->foto) : null,
                    'status_tindak_lanjut' => $k->status_tindak_lanjut,
                    'petugas' => $k->petugas ? $k->petugas->name : null,
                ];
            }),
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $validated = $request->validate([
            'petani_id' => 'required|exists:petani,id',
            'nama_lahan' => 'required|string|max:255',
            'komoditas' => 'required|in:padi,jagung,hortikultura',
            'luas_lahan' => 'required|numeric|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'tanggal_tanam' => 'nullable|date',
            'status_fase' => 'required|in:persiapan,tanam,pemeliharaan,panen',
        ]);

        $lahan = Lahan::create($validated);

        return response()->json($lahan->load('petani'), 201);
    }

    public function update(Request $request, $id)
    {
        $lahan = Lahan::findOrFail($id);

        $validated = $request->validate([
            'petani_id' => 'required|exists:petani,id',
            'nama_lahan' => 'required|string|max:255',
            'komoditas' => 'required|in:padi,jagung,hortikultura',
            'luas_lahan' => 'required|numeric|min:0',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'tanggal_tanam' => 'nullable|date',
            'status_fase' => 'required|in:persiapan,tanam,pemeliharaan,panen',
        ]);

        $lahan->update($validated);

        return response()->json($lahan->load('petani'));
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $lahan = Lahan::findOrFail($id);
        $lahan->delete();

        return response()->json(['message' => 'Lahan berhasil dihapus']);
    }

    public function kunjungan($id)
    {
        $lahan = Lahan::find($id);

        if (!$lahan) {
            return response()->json(['message' => 'Lahan tidak ditemukan'], 404);
        }

        $kunjungan = $lahan->kunjungan()->with('petugas')->orderBy('tanggal_kunjungan', 'desc')->get()->map(function ($k) {
            return [
                'id' => $k->id,
                'tanggal_kunjungan' => $k->tanggal_kunjungan,
                'kondisi_lahan' => $k->kondisi_lahan,
                'catatan_lapangan' => $k->catatan_lapangan,
                'foto' => $k->foto ? url('storage/' . $k->foto) : null,
                'status_tindak_lanjut' => $k->status_tindak_lanjut,
                'petugas' => $k->petugas ? $k->petugas->name : null,
            ];
        });

        return response()->json($kunjungan);
    }
}
