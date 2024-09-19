<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BarangHilangController;
use App\Models\BarangHilang;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [LoginController::class, 'index'], function () {
        return view('login');
    })->name('account.login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    Route::post('register', [RegisterController::class, 'index'])->name('account.register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('', function () {
        return view('home', ['title' => 'Home']);
    })->name('home');

    Route::get('laporan', function () {
        return view('laporan', ['title' => 'Barang Hilang']);
    });

    Route::get('buat-laporan', [BarangHilangController::class, 'index'])->name('buat.laporan');
    Route::post('buat-laporan', [BarangHilangController::class, 'fileUpload'])->name('upload.barang');

    Route::get('contact', function () {
        return view('contact', ['title' => 'Hubungi Kami']);
    });
});
