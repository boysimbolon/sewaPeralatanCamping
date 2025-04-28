<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\PenyewaanController;

// ==== OPEN ROUTE ====
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ==== PROTECTED ROUTE ====
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/peralatans', [PeralatanController::class, 'index']);
    Route::post('/sewa', [PenyewaanController::class, 'store']);
    Route::get('/sewa/sedang', [PenyewaanController::class, 'sedangDisewa']);
    Route::get('/sewa/selesai', [PenyewaanController::class, 'sewaSelesai']);

    // ==== ADMIN ROUTE ====
    Route::middleware('admin')->group(function () {
        Route::put('/admin/penyewaan/{id}/status', [PenyewaanController::class, 'updateStatus']);
        Route::post('/admin/peralatans', [PeralatanController::class, 'store']);
        Route::put('/admin/peralatans/{peralatan}', [PeralatanController::class, 'update']);
        Route::delete('/admin/peralatans/{peralatan}', [PeralatanController::class, 'destroy']);
        Route::get('/admin/penyewaan', [PenyewaanController::class, 'index']);
        Route::get('/admin/history', [PenyewaanController::class, 'history']);
    });
});
