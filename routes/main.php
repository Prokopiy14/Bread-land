<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrganizationContoller;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::view('/','index')->name('home');

Route::get('/promotions',[\App\Http\Controllers\PromotionController::class,'index'])
    ->name('promotions');

Route::get('/favorites',[\App\Http\Controllers\FavoriteController::class,'index'])
    ->name('favorites');

Route::get('/contacts', function () {
    return view('contacts.index');
})->name('contacts');

Route::get('/enterprise', function () {
    return view('enterprise.index');
})->name('enterprise');

Route::get('/products',[\App\Http\Controllers\ProductController::class, 'index'])
    ->name('products');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    Route::post('/address', [AddressController::class, 'store'])
        ->name('address.store');

    Route::patch('/address', [AddressController::class, 'update'])
        ->name('address.update');


    Route::get('organization',[OrganizationContoller::class, 'index'])
        ->name('organization');

    Route::post('/organization', [OrganizationContoller::class, 'store'])
        ->name('organization.store');

    Route::patch('/organization', [OrganizationContoller::class, 'update'])
        ->name('organization.update');


    Route::get('/orders/{order}',[OrderController::class, 'show'])
        ->name('orders.show')->middleware('showOrder');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
require __DIR__.'/cart.php';
require __DIR__.'/order.php';




