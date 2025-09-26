<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;

// Routes everyone can see
Route::get('/', fn() => view('home'))->name('home');

Route::get('/about', fn() => view('about'))->name('about');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Routes only authenticated or logged in users can see
Route::middleware('auth')->group(function () {
    Route::get('/cart', fn() => view('cart'))->name('cart');
    Route::get('/cart/total-quantity', [CartController::class, 'getInitialCartTotalQuantity']);
    Route::get('/cart/update', [CartController::class, 'updateCart']);

    Route::post('/cart', [CartController::class, 'store']);

    Route::patch('/cart/{id}/increment-quantity', [CartController::class, 'incrementQuantity']);
    Route::patch('/cart/{id}/decrement-quantity', [CartController::class, 'decrementQuantity']);

    Route::delete('/cart/{id}', [CartController::class, 'destroy']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
