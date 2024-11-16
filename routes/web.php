<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('welcome');
Route::post('pesan', [BerandaController::class, 'pesanProduk'])->name('pesan-produk');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('produk', [AdminController::class, 'produkIndex'])->name('data.produk');
    Route::post('produk', [AdminController::class, 'simpanProduk'])->name('produk.simpan');
    Route::delete('produk/{nama_produk}', [AdminController::class, 'produkHapus'])->name('produk.hapus');
    Route::put('produk/{id}/update', [AdminController::class, 'updateProduk'])->name('produk.update');
    Route::get('pemesanan', [AdminController::class, 'pemesananIndex'])->name('data.pemesanan');
    Route::post('pemesanan', [AdminController::class, 'simpanPemesanan'])->name('simpan.pemesanan');
    Route::delete('pemesanan/{no_pesanan}', [AdminController::class, 'hapusPemesanan'])->name('hapus.pemesanan');
    Route::put('pemesanan/{id}/update', [AdminController::class, 'updatePemesanan'])->name('update.pemesanan');
    Route::get('customer', [AdminController::class, 'customerIndex'])->name('data.customer');
    route::delete('customer/delete/{id}', [AdminController::class, 'customerHapus'])->name('customer.hapus');
    Route::put('customer/{id}/update', [AdminController::class, 'updateCustomer'])->name('customer.update');
    Route::post('customer', [AdminController::class, 'tambahCustomer'])->name('customer.simpan');
});

require __DIR__ . '/auth.php';
