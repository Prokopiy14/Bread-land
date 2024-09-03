<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});








//
//
//Route::prefix('user')->as('user.')->group(function (){
//
//    Route::middleware(['auth','active'])->group(function (){
//        Route::middleware('verified')->group(function (){
//            Route::get('/profile',[\App\Http\Controllers\Auth\user\ProfileController::class,'index'])->name('profile');
//            Route::post('/profile',[\App\Http\Controllers\Auth\user\ProfileController::class,'store'])->name('profile.store');
//            Route::get('/profile/edit',[\App\Http\Controllers\Auth\user\ProfileController::class,'edit'])->name('profile.edit');
//            Route::get('/personal-area',[\App\Http\Controllers\Auth\user\PersonalAreaController::class,'index'])->name('personal-area');
//        });
//        Route::get('/logout', [\App\Http\Controllers\Auth\user\LogoutController::class, 'logout'])->name('logout');
//    });
//    Route::get('/favorites',['App\Http\Controllers\Auth\user\FavoriteController','index'])->name('favorites');
//
//    Route::middleware('guest')->group(function () {
//        Route::get('/login', [\App\Http\Controllers\Auth\user\LoginController::class, 'index'])->name('login');
//        Route::post('/login', [\App\Http\Controllers\Auth\user\LoginController::class, 'store'])->name('login.store');
//        Route::get('/registration', [\App\Http\Controllers\Auth\user\RegisterController::class, 'index'])->name('registration');
//        Route::post('/registration', [\App\Http\Controllers\Auth\user\RegisterController::class, 'store'])->name('registration.store');
//    });
//});
