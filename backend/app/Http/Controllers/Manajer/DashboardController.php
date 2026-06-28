<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Models\Lahan;
use App\Models\KunjunganLahan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPetani = Petani::count();
        $totalLahan = Lahan::count();
        $totalKunjungan = KunjunganLahan::count();
        $lahanPerluTindakan = KunjunganLahan::where('status_tindak_lanjut', 'perlu_tindakan')
            ->distinct('lahan_id')->count('lahan_id');
        $lahanTerbaru = Lahan::with('petani')->latest()->take(5)->get();
        $totalPetugas = User::where('role', 'petugas')->count();

        $lahanPerPetugas = User::where('role', 'petugas')
            ->withCount(['lahan', 'petani'])
            ->get()
            ->map(fn($u) => ['name' => $u->name, 'total_lahan' => $u->lahan_count, 'total_petani' => $u->petani_count])
            ->toArray();

        return view('manajer.dashboard', compact(
            'totalPetani', 'totalLahan', 'totalKunjungan',
            'lahanPerluTindakan', 'lahanTerbaru', 'totalPetugas',
            'lahanPerPetugas'
        ));
    }
}
