<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KunjunganLahan;
use App\Models\Lahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = KunjunganLahan::with(['lahan.petani', 'petugas'])->orderBy('tanggal_kunjungan', 'desc')->get()->map(function ($k) {
            return [
                'id' => $k->id,
                'lahan_id' => $k->lahan_id,
                'nama_lahan' => $k->lahan ? $k->lahan->nama_lahan : null,
                'petugas' => $k->petugas ? $k->petugas->name : null,
                'tanggal_kunjungan' => $k->tanggal_kunjungan,
                'kondisi_lahan' => $k->kondisi_lahan,
                'catatan_lapangan' => $k->catatan_lapangan,
                'foto' => $k->foto ? (str_starts_with($k->foto, 'uploads/') ? url($k->foto) : url('storage/' . $k->foto)) : null,
                'status_tindak_lanjut' => $k->status_tindak_lanjut,
            ];
        });

        return response()->json($kunjungan);
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $validated = $request->validate([
            'lahan_id' => 'required|exists:lahan,id',
            'tanggal_kunjungan' => 'required|date',
            'kondisi_lahan' => 'required|in:baik,cukup,buruk',
            'catatan_lapangan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'status_tindak_lanjut' => 'required|in:aman,perlu_pemantauan,perlu_tindakan',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kunjungan', 'public');
        }

        $validated['petugas_id'] = Auth::id();

        $kunjungan = KunjunganLahan::create($validated);

        // Auto-update fase lahan based on kunjungan
        $this->updateFaseLahan($kunjungan->lahan_id);

        return response()->json($kunjungan->load(['lahan', 'petugas']), 201);
    }

    private function updateFaseLahan($lahanId)
    {
        $lahan = Lahan::find($lahanId);
        if (!$lahan) return;

        $latest = KunjunganLahan::where('lahan_id', $lahanId)->latest()->first();
        if (!$latest) return;

        $faseOrder = ['persiapan' => 0, 'tanam' => 1, 'pemeliharaan' => 2, 'panen' => 3];
        $currentFaseIndex = $faseOrder[$lahan->status_fase] ?? 0;

        if ($latest->kondisi_lahan === 'baik' && $currentFaseIndex < 3) {
            $fases = array_keys($faseOrder);
            $lahan->status_fase = $fases[$currentFaseIndex + 1];
            $lahan->save();
        }
    }
}
