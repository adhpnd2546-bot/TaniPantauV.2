<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lahan;
use App\Models\Petani;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        $petani = Petani::withCount('lahan')->with(['kecamatan', 'desa', 'petugas'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.petani', compact('petani'));
    }

    public function create()
    {
        $data = $this->getWilayahData();
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.petani-form', array_merge($data, [
            'petani' => null,
            'title' => 'Tambah Petani',
            'petugas' => $petugas,
        ]));
    }

    private function getWilayahData(): array
    {
        $provinsi = Provinsi::with('kota.kecamatan.desa')->get();
        $wilayahJson = $provinsi->map(fn($p) => [
            'id' => (string) $p->id,
            'nama' => $p->nama,
            'kota' => $p->kota->map(fn($kab) => [
                'id' => (string) $kab->id,
                'nama' => $kab->nama,
                'kecamatan' => $kab->kecamatan->map(fn($k) => [
                    'id' => (string) $k->id,
                    'nama' => $k->nama,
                    'desa' => $k->desa->map(fn($d) => [
                        'id' => (string) $d->id,
                        'nama' => $d->nama,
                    ]),
                ]),
            ]),
        ]);
        return compact('provinsi', 'wilayahJson');
    }

    public function store(Request $request)
    {
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
            Lahan::where('petani_id', $petani->id)->update(['petugas_id' => $validated['petugas_id']]);
        }

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petani = Petani::with(['kecamatan', 'desa', 'petugas'])->findOrFail($id);
        $data = $this->getWilayahData();
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.petani-form', array_merge($data, [
            'petani' => $petani,
            'title' => 'Edit Petani',
            'petugas' => $petugas,
        ]));
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

        Lahan::where('petani_id', $petani->id)->update(['petugas_id' => $validated['petugas_id'] ?? null]);

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petani = Petani::findOrFail($id);
        $petani->delete();

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil dihapus.');
    }
}
