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

    public function canManageCart(User $user, Cart $cart, Product $product): bool
    {
        return $user->id == $cart->user_id && $product->user_id !== $user->id;

    }

    public function canAccessPurchase(User $user, Cart $cart): bool
    {
        return auth()->id() === $cart->user_id;
    }
}
