<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LahanController;
use App\Http\Controllers\Api\KunjunganController;
use App\Http\Controllers\Api\StatistikController;
use App\Http\Controllers\Api\PetaniController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WilayahController;

// Auth (no middleware)
Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:10,1');

// Public API (read-only, no auth required for frontend)
Route::get('/statistik', [StatistikController::class, 'index']);
Route::get('/kecamatan', [WilayahController::class, 'kecamatan']);
Route::get('/desa/{kecamatanId}', [WilayahController::class, 'desa']);
Route::get('/lahan', [LahanController::class, 'index']);
Route::get('/lahan/{id}', [LahanController::class, 'show']);
Route::get('/lahan/{id}/kunjungan', [LahanController::class, 'kunjungan']);
Route::get('/kunjungan', [KunjunganController::class, 'index']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Petani CRUD
    Route::get('/petani', [PetaniController::class, 'index']);
    Route::get('/petani/{id}', [PetaniController::class, 'show']);
    Route::post('/petani', [PetaniController::class, 'store']);
    Route::put('/petani/{id}', [PetaniController::class, 'update']);
    Route::delete('/petani/{id}', [PetaniController::class, 'destroy']);

    // Lahan
    Route::post('/lahan', [LahanController::class, 'store']);
    Route::put('/lahan/{id}', [LahanController::class, 'update']);
    Route::delete('/lahan/{id}', [LahanController::class, 'destroy']);

    // Kunjungan
    Route::post('/kunjungan-lahan', [KunjunganController::class, 'store']);

});
