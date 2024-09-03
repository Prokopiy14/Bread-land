<?php

namespace App\Services\Cart;

use Illuminate\Http\RedirectResponse;

interface CartService
{
    public function add(int $productId, int $quantity);

    public function update(int $productId, int $quantity);

    public function destroy(int $productId);

    public function clear();

    public function increase(int $cartId);

    public function decrease(int $cartId);

    public function isInCart(int $productId) : bool;

    public function isInCartByProductIds(array $productsIds) : array;

    public function getCartItems() : array;

    public function getCartCost() : int;

    public function getTotalQuantity() : int;

}
