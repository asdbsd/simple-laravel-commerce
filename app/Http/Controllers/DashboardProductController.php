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
            'name' => ['required', 'min:5', 'max:60'],
            'slug' => ['required', 'min:5', 'max:60', Rule::unique('products', 'slug')],
            'excerpt' => ['required', 'min:5', 'max:100'],
            'description' => ['required', 'min:5', 'max: 350'],
            'image' => ['required'],
            'user_id' => ['required', Rule::exists('users', 'id')]
        ]);

        Product::create($attributes);
    }

}
