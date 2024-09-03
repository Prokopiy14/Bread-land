<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/cart',[CartController::class,'index'])
    ->name('cart');

Route::post('/cart/add',[CartController::class,'add'])
    ->name('cart.add');

Route::delete('/cart/destroy/{id}', [CartController::class,'destroy'])
    ->where('id', '[0-9]+')->name('cart.destroy');

Route::patch('cart/update', [CartController::class,'update'])
    ->name('cart.update');

Route::post('/cart/clear', [CartController::class,'clear'])
    ->name('cart.clear');

Route::post('/cart/increase', [CartController::class,'increase'])
    ->name('cart.increase');

Route::post('/cart/decrease', [CartController::class,'decrease'])
    ->name('cart.decrease');

Route::get('/checkout', [OrderController::class, 'checkout'])
    ->name('checkout')->middleware('checkout');








