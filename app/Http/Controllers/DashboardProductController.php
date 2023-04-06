<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardProductController extends Controller
{
    public function create()
    {
        return view('dashboard.create');
    }


    public function store()
    {

        $attributes = request()->validate([
            'name' => ['required', 'min:5', 'max:60', Rule::unique('products', 'name')],
            'description' => ['required', 'min:5', 'max: 500'],
            'image' => ['required', 'image']
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['image'] = request()->file('image')->store('images');
        $attributes['slug'] = $this->setSlugFromProductName($attributes['name']);
        $attributes['excerpt'] = $this->setExcerptFromDescription($attributes['description']);

        Product::create($attributes);

        return redirect('/store/' . $attributes['slug']);
    }

    protected function setExcerptFromDescription(String $productDescription)
    {
        return substr($productDescription, 0, 95) . '...';
    }

    protected function setSlugFromProductName(String $productName) {
        return implode('-', explode(' ', strtolower($productName)));
    }

}
