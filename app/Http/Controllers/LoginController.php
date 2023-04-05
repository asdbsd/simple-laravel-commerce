<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create() {
        return view('authLogin.create');
    }


    public function store() {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'max:16']
        ]);

        if(! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Could not verify provided credentials'
            ]);
        }

        session()->regenerate();

        return redirect('/');
    }

    public function destroy() {
        auth()->logout();
        return redirect('/store');
    }

}
