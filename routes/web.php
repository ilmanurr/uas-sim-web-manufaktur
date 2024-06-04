<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KetersediaanController;
use App\Http\Controllers\PemesananController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes untuk Bahan Baku
Route::get('/bahanbaku', [BahanBakuController::class, 'index'])->name('bahanbaku.index');
Route::get('/bahanbaku/create', [BahanBakuController::class, 'create'])->name('bahanbaku.create');
Route::post('/bahanbaku', [BahanBakuController::class, 'store'])->name('bahanbaku.store');
Route::get('/bahanbaku/{id}/edit', [BahanBakuController::class, 'edit'])->name('bahanbaku.edit');
Route::put('/bahanbaku/{id}', [BahanBakuController::class, 'update'])->name('bahanbaku.update');
Route::delete('/bahanbaku/{id}', [BahanBakuController::class, 'destroy'])->name('bahanbaku.destroy');

// Routes untuk Ketersediaan
Route::get('/ketersediaan', [KetersediaanController::class, 'index'])->name('ketersediaan.index');
Route::get('/ketersediaan/create', [KetersediaanController::class, 'create'])->name('ketersediaan.create');
Route::post('/ketersediaan', [KetersediaanController::class, 'store'])->name('ketersediaan.store');
Route::get('/ketersediaan/{id}/edit', [KetersediaanController::class, 'edit'])->name('ketersediaan.edit');
Route::put('/ketersediaan/{id}', [KetersediaanController::class, 'update'])->name('ketersediaan.update');
Route::delete('/ketersediaan/{id}', [KetersediaanController::class, 'destroy'])->name('ketersediaan.destroy');

// Routes untuk Pemesanan
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
Route::get('/pemesanan/{id}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
Route::put('/pemesanan/{id}', [PemesananController::class, 'update'])->name('pemesanan.update');
Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');