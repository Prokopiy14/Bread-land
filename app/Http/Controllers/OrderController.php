<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderCompositions;
use App\Models\Organization;
use App\Services\Cart\CartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(CartService $cartService, Request $request)
    {
        $cartItemDtoList = $cartService->getCartItems();
        $cartCost = $cartService->getCartCost();
        $totalQuantity = $cartService->getTotalQuantity();
        $address = null;
        $organization = null;

        if ($request->user()) {
            $address = Address::where('user_id', $request->user()->id)->first();
            if ($address) {
                $organization = Organization::where('address_id', $address->id)->first();
            }
        }

        return view('orders.checkout',compact('cartItemDtoList','cartCost', 'totalQuantity', 'address', 'organization'));
    }

    public function applyOrder()
    {
        return view('orders.applyOrder');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartService $cartService)
    {
        $cartItemDtoList = $cartService->getCartItems();
        $address = null;
        $organization = null;

        if ($request->user()) {
            $address = Address::where('user_id', $request->user()->id)->first();
            if ($address) {
                $organization = Organization::where('address_id', $address->id)->first();
            }
        }

        $request->validateWithBag('createOrder', [
            'title' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:18'],
            'address' => ['required'],
            'date' => ['required', 'date'],
            'organization' => ['string'],
        ]);

        $order = Order::create([
            'organization' => $request->organization,
            'customer' => $request->title,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'status' => 'Создан',
            'total' => $cartService->getCartCost(),
            'user_id' => $request->user() ? $request->user()->id : null,
            'address_id' => $address ? $address->id : null,
            'organization_id' => $organization ? $organization->id : null,
            'delivered_at' => $request->date,
        ]);

        foreach ($cartItemDtoList as $productItem)
        {
            OrderCompositions::create([
                'order_id' => $order->id,
                'product_id' => $productItem->getProduct('product')->id,
                'quantity' => $productItem->getQuantity(),
            ]);
        }
        $cartService->clear();
        $request->session()->put('success', true);
        $orderId = $order->id;
        return redirect()->route('orders.applyOrder', ['success' => 'true', 'orderId' => $orderId]);
    }


    public function show($id)
    {
        $order = Order::where('id', $id)->first();
        $address = Address::whereId($order->address_id)->first();
        $organization = Organization::whereId($order->prganization_id)->first();
        $orderCompositions = OrderCompositions::where('order_id', $id)->get();

        return view('orders.show',
            compact(
                'order',
                'orderCompositions',
                'address',
                'organization'
            )
        )->with($id);
    }

    public function order_list()
    {
        $orders = Order::all();

        return view('orders.order-list', compact('orders'));
    }

    public function change_status(Request $request)
    {
        $orderId = $request->orderId;

        $order = Order::whereId($orderId)->first();

        $order->update([
            'status' => 'Доставлен'
        ]);

        return response()->json(['success' => true, 'status' => $order->status]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
