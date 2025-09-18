<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => view('home'))->name('home');

Route::get('/about', fn() => view('about'))->name('about');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::middleware('auth')->group(function () {

    // Setting up new routes for fetching, incrementing, and decrementing 
    // the cart quantity
    Route::get('/cart/quantity', function () {
        return response()->json([
            'quantity' => CartItem::where('user_id', auth()->id())->sum('quantity')
        ]);
    })->name('fetchQuantity');

    Route::post('/cart/quantity', [CartController::class, 'getQuantity'])->name('cart.getQuantity');
    Route::post('/cart/increment-quantity', [CartController::class, 'incrementQuantity'])->name('cart.incrementQuantity');
    Route::post('/cart/decrement-quantity', [CartController::class, 'decrementQuantity'])->name('cart.decrementQuantity');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.add');
    // Route::post('/cart/{id}/increment-quantity', [CartController::class, 'incrementQuantity'])->name('cart.incrementQuantity');
    // Route::post('/cart/{id}/decrement-quantity', [CartController::class, 'decrementQuantity'])->name('cart.decrementQuantity');
    // Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
