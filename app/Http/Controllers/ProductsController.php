<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $allProducts = Product::latest()
            ->where('user_id', '!=', auth()->id())->get();


        $filteredProducts = Product::latest()
            ->where('user_id', '!=', auth()->id())
                ->filter(request(['search', 'category', 'owner']))
                ->get();
        $products_ids = array_map(fn ($pr) => $pr->category_id, $allProducts->all());
        $categories = array_unique(array_map(fn ($pr) => in_array($pr->category_id, $products_ids) ? Category::find($pr->category_id) : null, $allProducts->all()));

        return view('products.index', [
            'products' => $filteredProducts,
            'categories' => $categories

        ]);
    }

    public function show(Product $product)
    {

        return view('products.show', ['product' => $product]);
    }
}
