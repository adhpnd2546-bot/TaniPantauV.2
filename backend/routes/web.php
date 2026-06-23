<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PetaniController;
use App\Http\Controllers\Admin\LahanController;
use App\Http\Controllers\Admin\KunjunganController;
use App\Http\Controllers\Admin\PetugasController;

/*
|--------------------------------------------------------------------------
| Public Routes (guest only)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $role = auth()->user()?->role;

    if ($role === 'manajer') {
        return redirect(config('app.frontend_url', 'http://127.0.0.1:8000/frontend') . '/index.php');
    }

    return redirect(match($role) {
        'admin' => route('admin.dashboard'),
        'petugas' => route('petugas.kunjungan.create'),
        default => route('home'),
    });
})->middleware('auth')->name('dashboard');

Route::get('/public/lahan', function () {
    return view('public.lahan');
})->name('public.lahan');

Route::get('/public/artikel', function () {
    return view('public.artikel');
})->name('public.artikel');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', function () {
            $totalPetani = \App\Models\Petani::count();
            $totalLahan = \App\Models\Lahan::count();
            $totalKunjungan = \App\Models\KunjunganLahan::count();
            $lahanPerluTindakan = \App\Models\KunjunganLahan::where('status_tindak_lanjut', 'perlu_tindakan')
                ->distinct('lahan_id')->count('lahan_id');
            $lahanTerbaru = \App\Models\Lahan::with('petani')->latest()->take(5)->get();
            $totalPetugas = \App\Models\User::where('role', 'petugas')->count();

            return view('admin.dashboard', compact(
                'totalPetani', 'totalLahan', 'totalKunjungan',
                'lahanPerluTindakan', 'lahanTerbaru', 'totalPetugas'
            ));
        })->name('dashboard');

        Route::resource('petani', PetaniController::class)->except(['show']);

        Route::resource('lahan', LahanController::class);

        Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan');
        Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');

        Route::resource('petugas', PetugasController::class);
    });

/*
|--------------------------------------------------------------------------
| Petugas Lapangan Routes
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')
    ->name('petugas.')
    ->middleware(['auth', 'role:petugas'])
    ->group(function () {

        Route::prefix('kunjungan')->group(function () {
            Route::get('/', [KunjunganController::class, 'riwayatPetugas'])->name('kunjungan.index');
            Route::get('/create', [KunjunganController::class, 'create'])->name('kunjungan.create');
            Route::post('/store', [KunjunganController::class, 'store'])->name('kunjungan.store');
        });
    });

/*
|--------------------------------------------------------------------------
| Profile Routes (shared across all roles)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Breeze Auth Routes (login, register, logout, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
