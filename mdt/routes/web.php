<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/laporan', function () {
    return view('laporan');
});

Route::get('/buat-laporan', function () {
    return view('buat-laporan');
});

Route::get('/contact', function () {
    return view('contact');
});