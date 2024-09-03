<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ProductNormConroller;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['role:Admin'],'auth'], function () {
    Route::get('/roles',[RoleController::class,'index'])
        ->name('roles');

    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create');

    Route::post('/roles', [RoleController::class, 'store'])
        ->name('roles.store');

    Route::get('/roles/{role}/edit',[RoleController::class, 'edit'])
        ->name('roles.edit');

    Route::put('/roles/{role}',[RoleController::class, 'update'])
        ->name('roles.update');

    Route::delete('/roles/{role}',[RoleController::class, 'destroy'])
        ->name('roles.destroy');

    Route::get('/users',[UserController::class, 'index'])
        ->name('users');

    Route::get('/users/{user}/edit',[UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{user}',[UserController::class, 'update'])
        ->name('users.update');

    Route::get('/equipments',[EquipmentController::class,'index'])
        ->name('equipments');

    Route::get('/equipments/create', [EquipmentController::class, 'create'])
        ->name('equipments.create');

    Route::post('/equipments', [EquipmentController::class, 'store'])
        ->name('equipments.store');

    Route::get('/equipments/{equipment}/edit',[EquipmentController::class, 'edit'])
        ->name('equipments.edit');

    Route::put('/equipments/{equipment}',[EquipmentController::class, 'update'])
        ->name('equipments.update');

    Route::delete('/equipments/{equipment}',[EquipmentController::class, 'destroy'])
        ->name('equipments.destroy');

    Route::get('/product-norms',[ProductNormConroller::class,'index'])
        ->name('product-norms');

    Route::get('/product-norms/create', [ProductNormConroller::class, 'create'])
        ->name('product-norms.create');

    Route::post('/product-norms', [ProductNormConroller::class, 'store'])
        ->name('product-norms.store');

    Route::get('/product-norms/{norm}/edit',[ProductNormConroller::class, 'edit'])
        ->name('product-norms.edit');

    Route::put('/product-norms/{norm}',[ProductNormConroller::class, 'update'])
        ->name('product-norms.update');

    Route::delete('/product-norms/{norm}',[ProductNormConroller::class, 'destroy'])
        ->name('product-norms.destroy');
});

Route::group(['middleware' => ['permission:add products|edit products|destroy products']], function () {
    Route::get('/product-list',[ProductController::class, 'product_list'])
        ->name('products.list');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{product}/edit',[ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{product}',[ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{product}',[ProductController::class, 'destroy'])
        ->name('products.destroy');
});

Route::group(['middleware' => ['permission:show orders|edit orders|destroy orders']], function () {
    Route::get('/orders-list', [OrderController::class, 'order_list'])
        ->name('orders-list');

    Route::post('/change-status', [OrderController::class, 'change_status'])
        ->name('change-status');
});

Route::get('/products/{product}',[ProductController::class, 'show'])
    ->name('products.show');

