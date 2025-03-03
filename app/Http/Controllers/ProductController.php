<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Player;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(Product::all());

        return Inertia::render('products/Index')
            ->with(['products' => $products]);
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

    }

    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function buyProduct(Player $player, Product $product)
    {
        if ($product->charge($player)) {
            return response()->json(['message' => 'Услуга оплачена', 'balance' => $player->balance]);
        }
        return response()->json(['error' => 'Недостаточно средств'], 400);
    }
}
