<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'frontend.index')->name('frontend.home');
Route::view('/produk', 'frontend.produk')->name('frontend.produk');
Route::view('/cart', 'frontend.cart')->name('frontend.cart');
Route::view('/kontak', 'frontend.kontak')->name('frontend.kontak');
Route::view('/bantuan', 'frontend.bantuan')->name('frontend.bantuan');
Route::view('/tentang', 'frontend.tentang')->name('frontend.tentang');

// DETAIL PRODUK (NIKE STYLE)
Route::get('/produk/{id}', function ($id) {
    return view('frontend.product-detail');
});

// AUTH
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// DASHBOARD
Route::view('/dashboard', 'dashboard.index')->name('dashboard');
