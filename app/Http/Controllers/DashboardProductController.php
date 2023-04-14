<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;

class DashboardProductController extends Controller
{
    public function index()
    {

        $products = Product::with('category')->where('user_id', '=', auth()->id())
            ->filter(request(['search', 'category', 'orderBy']))
            ->get();

        $categories = Category::whereHas('products', function ($query) {
            $query->where('user_id', '=', auth()->id());
        })->get();

        return view('dashboard.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('dashboard.create', [
            'categories' => Category::all()
        ]);
    }


    public function store()
    {
        // dd(request('price'));
        $this->authorize('create', Product::class);

        $attributes = $this->validateProduct();

        $attributes['image'] = request()->file('image')->store('images');

        Product::create($attributes);
        return redirect('/store/' . $attributes['slug']);
    }

    public function edit(Product $product)
    {

        $this->authorize('update', $product);

        return view('dashboard.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function update(Product $product)
    {
        $this->authorize('update', $product);

        $attributes = $this->validateProduct($product);

        if ($attributes['image'] ?? false) {
            $attributes['image'] = request()->file('image')->store('images');
        }

        $product->update($attributes);
        return redirect('/store/' . $product->slug);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();
        return back();
    }

    protected function validateProduct(?Product $product = null): array
    {
        $product ??= new Product();

        $attributes = request()->validate([
            'name' => ['required', 'min:5', 'max:60', Rule::unique('products', 'name')->ignore($product->id)],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'min:5', 'max: 500'],
            'image' => $product->exists ? ['image'] : ['required', 'image'],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['slug'] = $this->setSlugFromProductName($attributes['name']);
        $attributes['excerpt'] = $this->setExcerptFromDescription($attributes['description']);

        return $attributes;
    }

    protected function setExcerptFromDescription(String $productDescription)
    {
        return substr($productDescription, 0, 95) . '...';
    }

    protected function setSlugFromProductName(String $productName)
    {
        return implode('-', explode(' ', strtolower($productName)));
    }
}
