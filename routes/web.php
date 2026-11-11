<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriFormatController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\TindakanRestorasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('koleksi', KoleksiController::class);
Route::resource('kategori', KategoriFormatController::class)
    ->parameters(['kategori' => 'kategoriFormat'])
    ->except('show');
Route::resource('tindakan', TindakanRestorasiController::class)
    ->parameters(['tindakan' => 'tindakanRestorasi'])
    ->except('show');
