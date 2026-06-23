<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KunjunganLahan;
use App\Models\Lahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = KunjunganLahan::with(['lahan.petani', 'petugas'])->orderBy('tanggal_kunjungan', 'desc')->paginate(10);
        return view('admin.kunjungan', compact('kunjungan'));
    }

    public function riwayatPetugas()
    {
        $kunjungan = KunjunganLahan::with(['lahan.petani'])
            ->where('petugas_id', auth()->id())
            ->orderBy('tanggal_kunjungan', 'desc')
            ->paginate(10);
        return view('petugas.kunjungan-index', compact('kunjungan'));
    }

    public function create()
    {
        $lahan = Lahan::with('petani')->get();
        return view('petugas.kunjungan-create', compact('lahan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lahan_id' => 'required|exists:lahan,id',
            'tanggal_kunjungan' => 'required|date',
            'kondisi_lahan' => 'required|in:baik,cukup,buruk',
            'catatan_lapangan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'status_tindak_lanjut' => 'required|in:aman,perlu_pemantauan,perlu_tindakan',
        ]);

        $validated['petugas_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kunjungan', 'public');
        }

        $kunjungan = KunjunganLahan::create($validated);

        $this->updateFaseLahan($kunjungan->lahan_id);

        $redirect = auth()->user()->role === 'petugas' ? route('petugas.kunjungan.create') : route('admin.kunjungan');

        return redirect($redirect)->with('success', 'Kunjungan berhasil dicatat.');
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
