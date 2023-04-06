<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardProductController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'products' => User::find(auth()->id())->products
        ]);
    }

    public function create()
    {
        return view('dashboard.create');
    }


    public function store()
    {
        $attributes = $this->validateProduct();

        Product::create($attributes);
        return redirect('/store/' . $attributes['slug']);
    }

    public function edit(Product $product)
    {
        return view('dashboard.edit', [
            'product' => $product
        ]);
    }

    public function update(Product $product)
    {
        $attributes = $this->validateProduct($product);

        if($attributes['image'] ?? false) {
            $attributes['image'] = request()->file('image')->store('images');
        }

        $product->update($attributes);
        return redirect('/store/' . $product->slug);
    }

    public function destroy(Product $product) {
        $product->delete();
        return back();
    }

    protected function validateProduct(?Product $product = null): array
    {
        $product ??= new Product();

        $attributes = request()->validate([
            'name' => ['required', 'min:5', 'max:60', Rule::unique('products', 'name')->ignore($product->id)],
            'description' => ['required', 'min:5', 'max: 500'],
            'image' => $product->exists ? ['image'] : ['required', 'image']
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
