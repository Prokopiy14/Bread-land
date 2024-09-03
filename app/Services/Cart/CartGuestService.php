<?php

namespace App\Services\Cart;

use App\Models\Product;
use App\Services\Cart\Dto\FavoritesItemDto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CartGuestService implements CartService
{
    private const COOKIE_NAME = 'cart';
    private const COOKIE_LIFE_TIME = 60 * 60 * 24 * 30;
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function add(int $productId, int $quantity) : Response
    {
        $cart = $this->getCart();

        if (isset($cart[$productId]))
        {
            $cart[$productId] += $quantity;
        }
        else {
            $cart[$productId] = $quantity;
        }

        return $this->setCookie($cart);
    }

    public function update(int $productId, int $quantity) : Response
    {
        return response()->json(['success' => false]);
    }

    public function destroy(int $productId) : Response
    {
        $cart = $this->getCart();

        if (isset($cart[$productId]))
        {
            unset($cart[$productId]);
        }

        return $this->setCookie($cart);
    }

    public function clear() : Response
    {
        return response()->json(['status' => 'success'])->withCookie(Cookie::forget(self::COOKIE_NAME));
    }

    public function increase(int $cartId) : Response
    {
        $cart = $this->getCart();
        if ($cart[$cartId] < 1000)
        {
            $cart[$cartId]++;

            $quantity = $cart[$cartId];
            $cartCost = $this->getCartCost();
            $totalQuantity = $this->getTotalQuantity();

            return response()->json(['success' => true, 'quantity' => $quantity, 'cartCost' => $cartCost, 'totalQuantity' => $totalQuantity])->withCookie(Cookie::make(self::COOKIE_NAME, json_encode($cart), self::COOKIE_LIFE_TIME));

        }
        return response()->json(['success' => false]);
    }

    public function decrease(int $cartId) : Response
    {
        $cart = $this->getCart();
        if ($cart[$cartId] > 1)
        {
            $cart[$cartId]--;

            $quantity = $cart[$cartId];
            $cartCost = $this->getCartCost();
            $totalQuantity = $this->getTotalQuantity();

            return response()->json(['success' => true, 'quantity' => $quantity, 'cartCost' => $cartCost, 'totalQuantity' => $totalQuantity])->withCookie(Cookie::make(self::COOKIE_NAME, json_encode($cart), self::COOKIE_LIFE_TIME));
        } else {
            unset($cart[$cartId]);
        }
        return response()->json(['success' => false]);
    }

    public function isInCart(int $productId) : bool
    {
        $cart =  $this->getCart();

        return isset($cart[$productId]);
    }

    public function isInCartByProductIds(array $productsIds) : array
    {
        $productIdsInCartList = [];

       foreach ($productsIds as $productsId)
       {
           if ($this->isInCart($productsId))
           {
               $productIdsInCartList[] = $productsId;
           }
       }
       return $productIdsInCartList;
    }

    private function getCart() : array
    {
        return json_decode($this->request->cookie(self::COOKIE_NAME) ?? '[]',true);
    }

    private function setCookie(array $cart) : Response
    {
        return response()->withCookie(Cookie::make(self::COOKIE_NAME, json_encode($cart), self::COOKIE_LIFE_TIME));
    }

    public function getCartItems() : array
    {
        $carts = $this->getCart();

        $productsIds = $this->getProductIdsByData($carts);

        $products = Product::whereIn('id', $productsIds)->get();

        $cartItemDtoList = [];

        foreach ($products as $product)
        {
            $cartItemDtoList[] = new FavoritesItemDto($product, $carts[$product->id]);
        }

        return $cartItemDtoList;
    }

    public function getCartCost() : int
    {
        $cartItemDtoList = $this->getCartItems();

        $basketCost = 0;

        foreach ($cartItemDtoList as $productItem)
        {
            $basketCost += $productItem->getProduct('product')->price * $productItem->getQuantity();
        }

        return $basketCost;
    }

    public function getTotalQuantity() : int
    {
        $cartItemDtoList = $this->getCartItems();

        $totalQuantity = 0;

        foreach ($cartItemDtoList as $productItem)
        {
            $totalQuantity += $productItem->getQuantity();
        }

        return $totalQuantity;
    }

    private function getProductIdsByData(array $carts) : array
    {
        return array_keys($carts);
    }
}
