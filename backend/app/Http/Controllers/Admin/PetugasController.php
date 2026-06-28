<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lahan;
use App\Models\Petani;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')
            ->withCount(['lahan', 'petani'])
            ->get();
        $totalLahan = Lahan::count();
        $totalPetani = Petani::count();
        return view('admin.petugas', compact('petugas', 'totalLahan', 'totalPetani'));
    }

    public function reassign(Request $request)
    {
        $validated = $request->validate([
            'from_id' => 'required|exists:users,id',
            'to_id' => 'nullable|exists:users,id',
            'type' => 'required|in:lahan,petani',
        ]);

        $from = User::findOrFail($validated['from_id']);
        $toId = $validated['to_id'];

        if ($validated['type'] === 'petani') {
            $petaniIds = Petani::where('petugas_id', $from->id)->pluck('id');
            $countPetani = $petaniIds->count();
            $countLahan = Lahan::whereIn('petani_id', $petaniIds)->count();

            Petani::where('petugas_id', $from->id)->update(['petugas_id' => $toId]);
            Lahan::whereIn('petani_id', $petaniIds)->update(['petugas_id' => $toId]);

            return redirect()->route('admin.petugas.index')
                ->with('success', "$countPetani petani ($countLahan lahan) dari {$from->name} berhasil dialihkan.");
        }

        $count = Lahan::where('petugas_id', $from->id)->count();

        if ($toId) {
            Lahan::where('petugas_id', $from->id)
                ->update(['petugas_id' => $toId]);
        } else {
            Lahan::where('petugas_id', $from->id)
                ->update(['petugas_id' => null]);
        }

        return redirect()->route('admin.petugas.index')
            ->with('success', "$count lahan dari {$from->name} berhasil dialihkan.");
    }

    public function create()
    {
        return view('admin.petugas-form', ['petugas' => null, 'title' => 'Tambah Petugas']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'petugas';

        User::create($validated);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petugas = User::findOrFail($id);
        return view('admin.petugas-form', ['petugas' => $petugas, 'title' => 'Edit Petugas']);
    }

    public function update(Request $request, $id)
    {
        $petugas = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $petugas->name = $validated['name'];
        $petugas->email = $validated['email'];
        if (!empty($validated['password'])) {
            $petugas->password = Hash::make($validated['password']);
        }
        $petugas->save();

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petugas = User::findOrFail($id);
        
        // Putuskan relasi petugas agar data lama tidak error/orphan
        Lahan::where('petugas_id', $petugas->id)->update(['petugas_id' => null]);
        Petani::where('petugas_id', $petugas->id)->update(['petugas_id' => null]);
        \App\Models\KunjunganLahan::where('petugas_id', $petugas->id)->update(['petugas_id' => null]);
        
        $petugas->delete();

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
