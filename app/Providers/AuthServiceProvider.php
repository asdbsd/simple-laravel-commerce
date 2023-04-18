<?php


namespace App\Providers;

use App\Models\Cart;
use App\Policies\CartsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Cart::class => CartsPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}