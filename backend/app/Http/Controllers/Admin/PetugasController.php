<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.petugas', compact('petugas'));
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
        $petugas->delete();

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
