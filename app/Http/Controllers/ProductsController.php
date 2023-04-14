<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {

        $products = Product::with('category')->where('user_id', '!=', auth()->id())
            ->filter(request(['search', 'category', 'orderBy']))
            ->get();

        $categories = Category::whereHas('products', function ($query) {
            $query->where('user_id', '!=', auth()->id());
        })->get();


        return view('products.index', [
            'products' => $products,
            'categories' => $categories

        ]);
    }

    public function show(Product $product)
    {

        return view('products.show', ['product' => $product]);
    }
}
