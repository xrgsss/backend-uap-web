<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| FRONTEND (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::view('/', 'frontend.index')->name('frontend.home');

Route::view('/produk', 'frontend.produk')
    ->name('frontend.produk');

Route::get('/produk/{id}', function ($id) {
    return view('frontend.product-detail', [
        'id' => $id
    ]);
})->name('frontend.produk.detail');

Route::view('/cart', 'frontend.cart')
    ->name('frontend.cart');

Route::view('/kontak', 'frontend.kontak')
    ->name('frontend.kontak');

Route::view('/bantuan', 'frontend.bantuan')
    ->name('frontend.bantuan');

Route::view('/tentang', 'frontend.tentang')
    ->name('frontend.tentang');


/*
|--------------------------------------------------------------------------
| CHECKOUT FLOW
|--------------------------------------------------------------------------
*/
Route::view('/checkout', 'frontend.checkout')
    ->name('checkout');

Route::view('/checkout-success', 'frontend.checkout-success')
    ->name('checkout.success');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');


/*
|--------------------------------------------------------------------------
| DASHBOARD / USER
|--------------------------------------------------------------------------
*/
Route::view('/dashboard', 'dashboard.index')
    ->name('dashboard');

Route::view('/orders', 'frontend.orders')
    ->name('orders');
