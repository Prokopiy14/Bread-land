<?php

namespace App\Providers;

use App\Services\Cart\CartGuestService;
use App\Services\Cart\CartService;
use App\Services\Cart\CartUserService;
use App\Services\Favorites\FavoritesService;
use App\Services\Favorites\FavoritesUserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartService::class, function () {
            $request = app(Request::class);

            return  $request->user() === null
                ? app(CartGuestService::class,  [$request])
                : app(CartUserService::class, [$request]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
    }
}
