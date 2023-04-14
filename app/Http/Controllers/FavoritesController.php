<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class FavoritesController extends Controller
{
    public function index()
    {
        $products = Product::whereHas('favorites', function ($query) {
            $query->where('user_id', '=', auth()->id());
        })->get();

        $categories = Category::whereHas('products', function ($query) {
            $query->whereHas('favorites', function($query) {
                $query->where('user_id', '=', auth()->id());
            });
        })->get();

        return view('favorites.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(Product $product) 
    {

        $product->favorite(auth()->id());

        return back();
    }

    public function destroy(Product $product)
    {

        $product->removeFavorite();
        return back();
    }
    

}
