<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() ) {
            $cart = Cart::whereUserId($request->user()->id)->first();

            if ($cart) {
                return $next($request);
            }
        } elseif ($request->hasCookie('cart')) {

            return $next($request);
        }

        return redirect('/');
    }
}
