<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PetaniController;
use App\Http\Controllers\Admin\LahanController;
use App\Http\Controllers\Admin\KunjunganController;
use App\Http\Controllers\Admin\PetugasController;

/*
|--------------------------------------------------------------------------
| Authenticated Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $role = auth()->user()?->role;

    return redirect(match($role) {
        'admin' => route('admin.dashboard'),
        'manajer' => route('manajer.dashboard'),
        'petugas' => route('petugas.dashboard'),
        default => route('login'),
    });
})->middleware('auth')->name('dashboard');

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

            $lahanPerPetugas = \App\Models\User::where('role', 'petugas')
                ->withCount(['lahan', 'petani'])
                ->get()
                ->map(fn($u) => ['name' => $u->name, 'total' => $u->lahan_count, 'total_petani' => $u->petani_count])
                ->toArray();

            return view('admin.dashboard', compact(
                'totalPetani', 'totalLahan', 'totalKunjungan',
                'lahanPerluTindakan', 'lahanTerbaru', 'totalPetugas',
                'lahanPerPetugas'
            ));
        })->name('dashboard');

        Route::resource('petani', PetaniController::class)->except(['show']);

        Route::get('/lahan/map', [LahanController::class, 'map'])->name('lahan.map');
        Route::post('/lahan/assign', [LahanController::class, 'assignPetugas'])->name('lahan.assign');
        Route::resource('lahan', LahanController::class);

        Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan');

        Route::post('/petugas/reassign', [PetugasController::class, 'reassign'])->name('petugas.reassign');
        Route::resource('petugas', PetugasController::class);

        // Route Sementara untuk Jalankan Migrasi di InfinityFree (Hapus setelah digunakan)
        Route::get('/run-migrations', function() {
            try {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                return "Migrasi database berhasil dijalankan!";
            } catch (\Exception $e) {
                return "Gagal migrasi: " . $e->getMessage();
            }
        })->name('run-migrations');

        // Route Diagnostik Struktur Folder & Path (Hapus setelah digunakan)
        Route::get('/debug-paths', function() {
            $paths = [
                'base_path' => base_path(),
                'public_path' => public_path(),
                'public_path_exists' => is_dir(public_path()) ? 'Yes' : 'No',
                'uploads_kunjungan_exists' => is_dir(public_path('uploads/kunjungan')) ? 'Yes' : 'No',
                'uploads_kunjungan_writable' => is_writable(public_path('uploads/kunjungan')) ? 'Yes' : 'No',
                'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'Not set',
            ];
            
            $kunjunganFiles = [];
            $kunjunganDir = public_path('uploads/kunjungan');
            if (is_dir($kunjunganDir)) {
                $files = scandir($kunjunganDir);
                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..') {
                        $filePath = $kunjunganDir . '/' . $file;
                        $kunjunganFiles[] = [
                            'name' => $file,
                            'size' => @filesize($filePath) . ' bytes',
                            'readable' => is_readable($filePath) ? 'Yes' : 'No',
                        ];
                    }
                }
            }
            
            return response()->json([
                'paths' => $paths,
                'kunjungan_dir_files' => $kunjunganFiles,
            ]);
        })->name('debug-paths');
    });

/*
|--------------------------------------------------------------------------
| Manajer/Koordinator Routes (read-only)
|--------------------------------------------------------------------------
*/
Route::prefix('manajer')
    ->name('manajer.')
    ->middleware(['auth', 'role:manajer'])
    ->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\Manajer\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/lahan', [App\Http\Controllers\Manajer\LahanController::class, 'index'])
            ->name('lahan');
        Route::get('/lahan/map', [App\Http\Controllers\Manajer\LahanController::class, 'map'])
            ->name('lahan.map');

        Route::get('/petani', [App\Http\Controllers\Manajer\PetaniController::class, 'index'])
            ->name('petani');

        Route::get('/kunjungan', [App\Http\Controllers\Manajer\KunjunganController::class, 'index'])
            ->name('kunjungan');
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

        Route::get('/dashboard', [App\Http\Controllers\Petugas\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('kunjungan', App\Http\Controllers\Petugas\KunjunganController::class)->except(['show']);
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

