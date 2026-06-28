<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Lahan;
use App\Models\Petani;
use App\Models\KunjunganLahan;

class DashboardController extends Controller
{
    public function index()
    {
        $petani = Petani::with(['lahan', 'desa', 'kecamatan'])
            ->where('petugas_id', auth()->id())
            ->get();

        $lahan = Lahan::with('petani', 'kunjungan')
            ->where('petugas_id', auth()->id())
            ->get();

        $totalPetani = $petani->count();
        $totalLahan = $lahan->count();
        $totalKunjungan = KunjunganLahan::where('petugas_id', auth()->id())->count();
        $totalKunjungHariIni = KunjunganLahan::where('petugas_id', auth()->id())
            ->whereDate('tanggal_kunjungan', today())
            ->count();

        $lahanPerluTindakan = KunjunganLahan::where('petugas_id', auth()->id())
            ->where('status_tindak_lanjut', 'perlu_tindakan')
            ->distinct('lahan_id')->count('lahan_id');

        return view('petugas.dashboard', compact(
            'petani', 'lahan', 'totalPetani', 'totalLahan', 'totalKunjungan',
            'totalKunjungHariIni', 'lahanPerluTindakan'
        ));
    }
}
