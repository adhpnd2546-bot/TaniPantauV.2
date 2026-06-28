<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\KunjunganLahan;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = KunjunganLahan::with('lahan.petani', 'petugas')
            ->orderBy('tanggal_kunjungan', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('manajer.kunjungan', compact('kunjungan'));
    }
}
