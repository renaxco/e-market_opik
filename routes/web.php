<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\SimulasiCucianController;

//login
Route::get('/login',[UserController::class,'index'])->name('login');
Route::post('/login/cek',[UserController::class,'cekLogin'])->name('cekLogin');
Route::get('/logout',[UserController::class,'logout'])->name('logout');


//route untuk yang sudah login
Route::get('/', [HomeController::class, 'index']);
Route::get('profile', [HomeController::class, 'profile']);
Route::get('contact', [HomeController::class, 'contact']);

Route::middleware(['auth', 'cekUserLogin:1'])->group(function(){
    Route::resource('produk', ProdukController::class);
    Route::get('download/produk', [ProdukController::class, 'exportData'])->name('export_produk');
});

// route untuk kasir
Route::middleware(['auth', 'cekUserLogin:1'])->group(function(){
  Route::resource('pembelian', PembelianController::class);
  // Route::resource('produk', ProdukController::class);
});


route::resource('guru', GuruController::class);
route::get('export-guru', [GuruController::class, 'export'])->name('export-guru');

// simulasi
route::get('simulasi', [SimulasiController::class, 'index'])->name('simulasi');

route::get('simulasi-cucian', [SimulasiCucianController::class, 'index'])->name('simulasi-cucian');
