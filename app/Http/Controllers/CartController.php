<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;

class CartController extends Controller
{
    public function index(CartService $cartService)
    {
        $cartItemDtoList = $cartService->getCartItems();
        $cartCost = $cartService->getCartCost();
        $totalQuantity = $cartService->getTotalQuantity();

        return view('cart.index',compact('cartItemDtoList','cartCost', 'totalQuantity'));
    }

    public function add(Request $request, CartService $cartService)
    {
        $productId = $request->productId;

        return $cartService->add($productId, 1);
    }

    public function update(Request $request, CartService $cartService)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cartService->update($productId, $quantity);
    }

    public function destroy(CartService $cartService, int $productId)
    {
        return $cartService->destroy($productId);
    }

    public function clear(CartService $cartService)
    {
        return $cartService->clear();
    }

    public function increase(Request $request, CartService $cartService)
    {
        $cartId = $request->cartId;

        return $cartService->increase($cartId);
    }

    public function decrease(Request $request, CartService $cartService)
    {
        $cartId = $request->cartId;

        return $cartService->decrease($cartId);
    }
}

