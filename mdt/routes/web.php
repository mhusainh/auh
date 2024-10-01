<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BarangHilangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [LoginController::class, 'index'])->name('account.login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    Route::post('register', [RegisterController::class, 'index'])->name('account.register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('', function () {
        return view('home', ['title' => 'Home']);
    })->name('home');

    Route::get('laporan', [BarangHilangController::class, 'showlaporan'])->name('lapor.barang');
    Route::get('buat-laporan', [BarangHilangController::class, 'index'])->name('buat.laporan');
    Route::post('buat-laporan', [BarangHilangController::class, 'fileUpload'])->name('upload.barang');
    Route::get('contact', function () {
        return view('contact', ['title' => 'Hubungi Kami']);
    });

    Route::get('profile', function () {
        return view('profile', ['title' => 'Profile']);
    });

    Route::get('edit-laporan', [BarangHilangController::class, 'showprofile'])->name('edit-laporan');
    Route::get('edit-profile/{encryptedId}', [ProfileController::class, 'index'])->name('edit.profile');

    Route::post('/update-phone/{id}', [ProfileController::class, 'updatePhone'])->name('edit.phone');
    Route::post('/update-email/{id}', [ProfileController::class, 'updateEmail'])->name('edit.email');
    Route::post('/update-profile/{id}', [ProfileController::class, 'updatePicture'])->name('edit.profilePicture');
});
