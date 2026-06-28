<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Petani;

class PetaniController extends Controller
{
    public function index()
    {
        $petani = Petani::withCount('lahan')->with('kecamatan', 'desa', 'petugas')->latest()->paginate(10);
        return view('manajer.petani', compact('petani'));
    }
}
