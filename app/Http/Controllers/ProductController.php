<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Cart\CartService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(CartService $cartService)
    {
        $products = Product::query()->paginate(12);
        $productIdInCartList = $cartService->isInCartByProductIds($this->getProductIds($products->all()));

        return view('products.index',compact('products','productIdInCartList'));
    }

    public function create()
    {
        return view('products.create',);
    }

    public function store(Request $request)
    {
        $request->cookie('name');
        $request->validate([
            'title' => ['required','string'],
            'description' => ['required','string'],
            'price' => ['required','numeric'],
        ]);

        Product::query()->create([
            'title'=> $request['title'],
            'description'=> $request['description'],
            'price'=> $request['price'],
        ]);

        alert('Продукция '.$request->title.' добалена');
        return redirect('product-list');
    }

    public function show($product)
    {
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required','string'],
            'description' => ['required','string'],
            'price' => ['required','numeric'],
            ]);

        $product = Product::find($id);
        $product->update($validated);

        alert('Продукция '.$request->title.' была обновлена');
        return redirect('product-list');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product)
        {
            $product->delete();
        }

        alert('Продукция '.$product->title.' удалена');
        return redirect()->back();
    }

    public function product_list()
    {
        $products = Product::query()->paginate(12);

        return view('products.product-list',compact('products'));
    }

    private function getProductIds(array $products) : array
    {
        return array_map(fn(Product $product)=>$product->id,$products);
    }
}
