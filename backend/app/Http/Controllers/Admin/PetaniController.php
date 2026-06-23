<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        $petani = Petani::withCount('lahan')->with(['kecamatan', 'desa'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.petani', compact('petani'));
    }

    public function create()
    {
        $data = $this->getWilayahData();
        return view('admin.petani-form', array_merge($data, [
            'petani' => null,
            'title' => 'Tambah Petani',
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
        ]);

        Petani::create($validated);

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petani = Petani::with(['kecamatan', 'desa'])->findOrFail($id);
        $data = $this->getWilayahData();
        return view('admin.petani-form', array_merge($data, [
            'petani' => $petani,
            'title' => 'Edit Petani',
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
        ]);

        $petani->update($validated);

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petani = Petani::findOrFail($id);
        $petani->delete();

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil dihapus.');
    }
}
