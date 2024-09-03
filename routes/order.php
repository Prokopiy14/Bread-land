<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::post('/orders',[OrderController::class,'store'])
    ->name('orders.store');

Route::get('/applyOrder',[OrderController::class,'applyOrder'])
    ->name('orders.applyOrder')->middleware('applyOrder');









