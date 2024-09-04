<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['tittle' => 'Home']);
});

Route::get('/laporan', function () {
    return view('laporan', ['tittle' => 'Barang Hilang']);
});

Route::get('/buat-laporan', function () {
    return view('buat-laporan', ['tittle' => 'Buat Laporan Barang Hilang']);
});

Route::get('/contact', function () {
    return view('contact', ['tittle' => 'Hubungi Kami']);
});