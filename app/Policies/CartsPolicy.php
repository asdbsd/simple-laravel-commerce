<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartsPolicy
{

    public function view(User $user, Cart $cart): bool
    {
        return $user->id == $cart->user_id;
    }

    public function addProduct(User $user, Cart $cart, Product $product): bool
    {
        return $user->id == $cart->user_id && $product->user_id !== $user->id;
        // return true;
    }

    public function destroyProduct(User $user, Cart $cart, Product $product): bool
    {
        return $user->id === $cart->user_id;
    }

    public function updateProduct(User $user, Cart $cart, Product $product): bool
    {
        return $user->id === $cart->user_id;
    }

    public function canAccessPurchaseIndex(User $user, Cart $cart): bool
    {
        return $user->id === $cart->user_id;
    }
}
