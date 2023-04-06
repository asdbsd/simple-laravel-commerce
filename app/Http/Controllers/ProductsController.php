<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() 
    {
        return view('products.index', [
            'products' => Product::where('user_id', '!=', auth()->id())->get()
        ]);
    }

    public function show(Product $product) 
    {

        return view('products.show', [ 'product' => $product ]);
    }

}
