<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowOrderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order = Order::whereId($request->route('order'))->first();
        if ($order) {
            if ((auth()->check() && $request->user()->id === $order->user_id) || $request->user()->hasRole('Admin')) {

                return $next($request);
            }
        }



        return redirect('/');
    }
}
