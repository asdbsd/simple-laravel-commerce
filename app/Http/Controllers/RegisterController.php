<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create() {
        return view('authRegister.create');
    }


    public function store(Request $request) {
        $attributes = request()
            ->validate([
                'firstName' => ['required', 'min:3', 'max:50'],
                'lastName' => ['required', 'min:3', 'max:50'],
                'username' => ['required', 'min:4', 'max:32', Rule::unique('users', 'username')],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:6', 'max:16']
            ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);
        Cart::create(['user_id' => $user->id]);

        auth()->login($user);

        return redirect(route('products.index'));
    }

}
