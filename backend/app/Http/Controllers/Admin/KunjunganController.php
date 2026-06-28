<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KunjunganLahan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = KunjunganLahan::with(['lahan.petani', 'petugas'])
            ->orderBy('tanggal_kunjungan', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.kunjungan', compact('kunjungan'));
    }
}
