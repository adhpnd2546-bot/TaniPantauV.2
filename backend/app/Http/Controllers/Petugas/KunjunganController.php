<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\KunjunganLahan;
use App\Models\Lahan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = KunjunganLahan::with(['lahan.petani'])
            ->where('petugas_id', auth()->id())
            ->orderBy('tanggal_kunjungan', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('petugas.kunjungan-index', compact('kunjungan'));
    }

    public function create()
    {
        $lahan = Lahan::with('petani')->where('petugas_id', auth()->id())->get();
        return view('petugas.kunjungan-create', compact('lahan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lahan_id' => 'required|exists:lahan,id',
            'tanggal_kunjungan' => 'required|date',
            'kondisi_lahan' => 'required|in:baik,cukup,buruk',
            'catatan_lapangan' => 'nullable|string',
            'foto' => 'nullable|image|max:5120',
            'status_tindak_lanjut' => 'required|in:aman,perlu_pemantauan,perlu_tindakan',
            'status_fase' => 'required|in:persiapan,tanam,pemeliharaan,panen',
        ]);

        $lahan = Lahan::where('id', $request->lahan_id)
            ->where('petugas_id', auth()->id())
            ->first();
        if (!$lahan) {
            return redirect()->back()->withErrors(['lahan_id' => 'Lahan tidak valid atau bukan tugas Anda.'])->withInput();
        }

        $validated['petugas_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/kunjungan');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $file->move($path, $filename);
            $validated['foto'] = 'uploads/kunjungan/' . $filename;
        }

        $statusFase = $validated['status_fase'];
        unset($validated['status_fase']);

        $kunjungan = KunjunganLahan::create($validated);

        $lahan->status_fase = $statusFase;
        $lahan->save();

        return redirect(route('petugas.kunjungan.index'))->with('success', 'Kunjungan berhasil dicatat.');
    }

    public function edit($id)
    {
        $kunjungan = KunjunganLahan::where('id', $id)
            ->where('petugas_id', auth()->id())
            ->firstOrFail();

        $lahan = Lahan::with('petani')->where('petugas_id', auth()->id())->get();
        return view('petugas.kunjungan-edit', compact('kunjungan', 'lahan'));
    }

    public function update(Request $request, $id)
    {
        $kunjungan = KunjunganLahan::where('id', $id)
            ->where('petugas_id', auth()->id())
            ->firstOrFail();

        $validated = $request->validate([
            'lahan_id' => 'required|exists:lahan,id',
            'tanggal_kunjungan' => 'required|date',
            'kondisi_lahan' => 'required|in:baik,cukup,buruk',
            'catatan_lapangan' => 'nullable|string',
            'foto' => 'nullable|image|max:5120',
            'status_tindak_lanjut' => 'required|in:aman,perlu_pemantauan,perlu_tindakan',
            'status_fase' => 'required|in:persiapan,tanam,pemeliharaan,panen',
        ]);

        $lahan = Lahan::where('id', $request->lahan_id)
            ->where('petugas_id', auth()->id())
            ->first();
        if (!$lahan) {
            return redirect()->back()->withErrors(['lahan_id' => 'Lahan tidak valid atau bukan tugas Anda.'])->withInput();
        }

        if ($request->hasFile('foto')) {
            if ($kunjungan->foto && file_exists(public_path($kunjungan->foto))) {
                @unlink(public_path($kunjungan->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/kunjungan');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $file->move($path, $filename);
            $validated['foto'] = 'uploads/kunjungan/' . $filename;
        }

        $statusFase = $validated['status_fase'];
        unset($validated['status_fase']);

        $kunjungan->update($validated);

        $lahan->status_fase = $statusFase;
        $lahan->save();

        return redirect(route('petugas.kunjungan.index'))->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kunjungan = KunjunganLahan::where('id', $id)
            ->where('petugas_id', auth()->id())
            ->firstOrFail();

        if ($kunjungan->foto && file_exists(public_path($kunjungan->foto))) {
            @unlink(public_path($kunjungan->foto));
        }

        $lahanId = $kunjungan->lahan_id;
        $kunjungan->delete();

        $this->updateFaseLahan($lahanId);

        return redirect(route('petugas.kunjungan.index'))->with('success', 'Kunjungan berhasil dihapus.');
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
