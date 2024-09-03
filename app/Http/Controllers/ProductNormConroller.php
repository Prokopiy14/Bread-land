<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Product;
use App\Models\ProductNorm;
use Illuminate\Http\Request;

class ProductNormConroller extends Controller
{
    public function index()
    {
        $norms = ProductNorm::all();

        return view('product-norms.index', compact('norms'));

    }

    public function create()
    {
        $products = Product::orderBy('id','asc')->get();
        $equipments = Equipment::orderBy('id','asc')->get();

        return view('product-norms.create', compact('products', 'equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'norm' => ['required','integer','max:10000'],
            'product_id' => ['required','integer','exists:products,id'],
            'equipment_id' => ['required','integer','exists:equipment,id'],
        ]);

        $equipment = ProductNorm::query()->create([
            'product_id' => $request['product_id'],
            'equipment_id' => $request['equipment_id'],
            'norm' => $request['norm'],
        ]);

        $product = Product::whereId($request['product_id'])->first();

        alert('Норма для продукции '.$product->title.' добалена');
        return redirect('product-norms');

    }

    public function edit($id)
    {
        $norm = ProductNorm::whereId($id)->first();
        $product = Product::whereId($norm->product_id)->first();
        $equipment = Equipment::whereId($norm->equipment_id)->first();

        return view('product-norms.edit', compact('norm','product','equipment'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'norm' => ['required','integer','max:10000'],
            'product_id' => ['required','integer','exists:products,id'],
            'equipment_id' => ['required','integer','exists:equipment,id'],
        ]);

        $equipment = ProductNorm::find($id);
        $equipment->update($validated);

        $product = Product::whereId($request['product_id'])->first();

        alert('Норма продукции '.$product->title.' была обновлена');
        return redirect('product-norms');
    }

    public function destroy($id)
    {
        $norm = ProductNorm::find($id);
        if ($norm)
        {
            $norm->delete();
        }

        $product = Product::whereId($norm['product_id'])->first();

        alert('Норма продукции '.$product->title.' была удалена');
        return redirect()->back();
    }
}
