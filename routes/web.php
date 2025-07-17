<?php

use App\Http\Controllers\Mhscontroller;
use Illuminate\Support\Facades\Route;

route::get('/mhs-baru', [Mhscontroller::class, 'index'])->name('mhs-baru');
route::get('/mhs-insert', [Mhscontroller::class, 'create'])->name('mhs-insert');
Route::post('/mahasiswa', [Mhscontroller::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa', [Mhscontroller::class, 'index'])->name('mahasiswa.index');
Route::resource('mahasiswa', Mhscontroller::class);