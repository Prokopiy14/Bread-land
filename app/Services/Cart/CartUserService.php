<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Services\Cart\Dto\CartItemDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartUserService implements CartService
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function add(int $productId, int $quantity) : Response
    {
        $cart =  $this->getCartItem($productId);

        if ($cart === null)
        {
            Cart::create([
                'product_id' =>  $productId,
                'user_id' =>  $this->getUserId(),
                'quantity' =>  $quantity,
            ]);
        }
        else {
            $cart->quantity += $quantity;
            $cart->update();
        }

        return response()->json(['success' => true]);
    }

    public function update(int $productId, int $quantity) : Response
    {
        $cart =  $this->getCartItem($productId);

        if ($cart) {
            if ($quantity < 1000 && $quantity >= 1)
            {
                $cart->quantity = $quantity;
                $cart->update();

                $cartCost = $this->getCartCost();
                $totalQuantity = $this->getTotalQuantity();

                return response()->json(['success' => true, 'cartCost' => $cartCost, 'totalQuantity' => $totalQuantity]);
            }
        }
        return response()->json(['success' => false]);
    }

    public function destroy(int $productId) : Response
    {
        $cart =  $this->getCartItem($productId);

        $cart?->delete();

        $cartCost = $this->getCartCost();
        $totalQuantity = $this->getTotalQuantity();

        return response()->json(['success' => true, 'cartCost' => $cartCost, 'totalQuantity' => $totalQuantity]);
    }

    public function clear() : Response
    {
        $cartItems = $this->getCartItems();

        if ($cartItems != null) {
            Cart::where('user_id', $this->getUserId())->delete();
        }

        return response()->json(['success' => true]);
    }

    public function increase(int $cartId) : Response
    {
        $cart = $this->getCartItem($cartId);

        if ($cart) {

            if ($cart->quantity < 1000)
            {
                $cart->quantity++;
                $cart->update();

                $quantity = $cart->quantity;
                $cartCost = $this->getCartCost();
                $totalQuantity = $this->getTotalQuantity();

                return response()->json(['success' => true, 'quantity' => $quantity, 'cartCost' => $cartCost, 'totalQuantity' => $totalQuantity]);
            }
        }

        return response()->json(['success' => false]);
    }

    public function decrease(int $cartId) : Response
    {
        $cart = $this->getCartItem($cartId);

        if ($cart) {
            if ($cart->quantity > 1)
            {
                $cart->quantity--;
                $cart->update();

                $cartCost = $this->getCartCost();
                $totalQuantity = $this->getTotalQuantity();
                $quantity = $cart->quantity;

                return response()->json(['success' => true, 'quantity' => $quantity, 'cartCost' => $cartCost, 'totalQuantity' => $totalQuantity]);
            } else {
                $cart->delete();
            }
        }
        return response()->json(['success' => false]);
    }

    public function isInCart(int $productId) : bool
    {
        $cart =  $this->getCartItem($productId);

        return $cart === null ? false : true;
    }

    public function isInCartByProductIds(array $productsIds) : array
    {
        $carts = Cart::whereIn('product_id', $productsIds)->where('user_id', $this->getUserId())->get();

        return $this->getProductIdsByCollection($carts);
    }

    private function getUserId() : int
    {
        return $this->request->user()->id;
    }

    private function getCartItem(int $productId) : ?Cart
    {
        return Cart::where('product_id', $productId)->where( 'user_id',  $this->getUserId())->first();
    }

    public function getCartItems() : array
    {
        $carts = Cart::with('product')->where( 'user_id',  $this->getUserId())->get();

        $cartItemDtoList = [];

        foreach ($carts as $cart)
        {
            $cartItemDtoList[] = new CartItemDto($cart->product, $cart->quantity);
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

    private function getProductIdsByCollection(Collection $carts)
    {
        return array_map(fn(Cart $cart)=>$cart->product_id,$carts->all());
    }
}
