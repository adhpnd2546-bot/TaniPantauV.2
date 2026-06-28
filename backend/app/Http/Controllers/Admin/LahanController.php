<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lahan;
use App\Models\Petani;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;

class LahanController extends Controller
{
    public function index(Request $request)
    {
        $query = Lahan::with('petani', 'petugas');

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
            $query->where('petugas_id', $request->petugas);
        }

        $lahan = $query->orderBy('created_at', 'desc')->paginate(10);
        $petani = Petani::all();
        $kecamatan = Kecamatan::all();
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.lahan', compact('lahan', 'petani', 'kecamatan', 'petugas'));
    }

    public function create()
    {
        $petani = Petani::with(['desa', 'petugas'])->get();
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.lahan-form', ['lahan' => null, 'petani' => $petani, 'petugas' => $petugas, 'title' => 'Tambah Lahan']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'petani_id' => 'required|exists:petani,id',
            'petugas_id' => 'nullable|exists:users,id',
            'nama_lahan' => 'required|string|max:255',
            'komoditas' => 'required|in:padi,jagung,hortikultura',
            'luas_lahan' => 'required|numeric|min:0',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tanggal_tanam' => 'nullable|date',
            'status_fase' => 'required|in:persiapan,tanam,pemeliharaan,panen',
        ]);

        Lahan::create($validated);

        return redirect()->route('admin.lahan.index')->with('success', 'Data lahan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $lahan = Lahan::with(['petani.desa', 'petani.kecamatan', 'kunjungan.petugas'])->findOrFail($id);
        return view('admin.lahan-detail', compact('lahan'));
    }

    public function edit($id)
    {
        $lahan = Lahan::findOrFail($id);
        $petani = Petani::with(['desa', 'petugas'])->get();
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.lahan-form', ['lahan' => $lahan, 'petani' => $petani, 'petugas' => $petugas, 'title' => 'Edit Lahan']);
    }

    public function update(Request $request, $id)
    {
        $lahan = Lahan::findOrFail($id);

        $validated = $request->validate([
            'petani_id' => 'required|exists:petani,id',
            'petugas_id' => 'nullable|exists:users,id',
            'nama_lahan' => 'required|string|max:255',
            'komoditas' => 'required|in:padi,jagung,hortikultura',
            'luas_lahan' => 'required|numeric|min:0',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tanggal_tanam' => 'nullable|date',
            'status_fase' => 'required|in:persiapan,tanam,pemeliharaan,panen',
        ]);

        $lahan->update($validated);

        return redirect()->route('admin.lahan.index')->with('success', 'Data lahan berhasil diperbarui.');
    }

    public function map()
    {
        $lahan = Lahan::with('petani', 'petugas')->get();
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.lahan-map', compact('lahan', 'petugas'));
    }

    public function assignPetugas(Request $request)
    {
        $validated = $request->validate([
            'lahan_id' => 'required|exists:lahan,id',
            'petugas_id' => 'nullable|exists:users,id',
        ]);

        $lahan = Lahan::findOrFail($validated['lahan_id']);
        $lahan->update(['petugas_id' => $validated['petugas_id']]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Petugas berhasil ditugaskan.');
    }

    public function destroy($id)
    {
        $lahan = Lahan::findOrFail($id);
        $lahan->delete();

        return redirect()->route('admin.lahan.index')->with('success', 'Data lahan berhasil dihapus.');
    }
}
