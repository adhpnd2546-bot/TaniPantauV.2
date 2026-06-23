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
        $query = Lahan::with('petani');

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

        $lahan = $query->orderBy('created_at', 'desc')->paginate(10);
        $petani = Petani::all();
        $kecamatan = Kecamatan::all();
        $petugas = User::whereIn('role', ['petugas', 'admin'])->get();
        return view('admin.lahan', compact('lahan', 'petani', 'kecamatan', 'petugas'));
    }

    public function create()
    {
        $petani = Petani::with('desa')->get();
        return view('admin.lahan-form', ['lahan' => null, 'petani' => $petani, 'title' => 'Tambah Lahan']);
    }

    public function store(Request $request)
    {
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
        $petani = Petani::with('desa')->get();
        return view('admin.lahan-form', ['lahan' => $lahan, 'petani' => $petani, 'title' => 'Edit Lahan']);
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

        return redirect()->route('admin.lahan.index')->with('success', 'Data lahan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lahan = Lahan::findOrFail($id);
        $lahan->delete();

        return redirect()->route('admin.lahan.index')->with('success', 'Data lahan berhasil dihapus.');
    }
}
