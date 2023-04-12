<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {


        $allUserProducts = Product::where('user_id', '!=', auth()->id())->get()->all();

        $products_ids = array_map(fn ($pr) => $pr->category_id, $allUserProducts);
        $categories = array_unique(array_map(fn ($pr) => in_array($pr->category_id, $products_ids) ? Category::find($pr->category_id) : null, $allUserProducts));

        // dd($categories);

        return view('products.index', [
            'products' => Product::where('user_id', '!=', auth()->id())
                ->filter(request(['search', 'category', 'orderBy']))
                ->get(),
            'categories' => $categories

        ]);
    }

    public function show(Product $product)
    {

        return view('products.show', ['product' => $product]);
    }
}
