<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::latest()
            ->where('user_id', '!=', auth()->id())
            ->filter(request(['search', 'category', 'owner']))
            ->get();
        $products_ids = array_map(fn ($pr) => $pr->category_id, $products->all());
        $categories = array_unique(array_map(fn ($pr) => in_array($pr->category_id, $products_ids) ? Category::find($pr->category_id) : null, $products->all()));

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
