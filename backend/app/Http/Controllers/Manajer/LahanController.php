<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Lahan;
use App\Models\User;

class LahanController extends Controller
{
    public function index()
    {
        $lahan = Lahan::with('petani')->latest()->paginate(10);
        return view('manajer.lahan', compact('lahan'));
    }

    public function map()
    {
        $lahan = Lahan::with('petani', 'petugas')->get();
        $petugas = User::where('role', 'petugas')->get();
        return view('manajer.lahan-map', compact('lahan', 'petugas'));
    }
}
