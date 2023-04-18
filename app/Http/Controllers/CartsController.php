<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    public function show(Cart $cart)
    {
        $this->authorize('view', $cart);

        return view('cart.show', [
            'cart' => $cart,
            'totalPrice' => $cart->totalPrice
        ]);
    }

    public function store(Cart $cart, Product $product)
    {

        $newProduct = $cart->products()->where('product_id', $product->id);

        $newProduct->exists()
            ? $this->updateProductCount($cart, $product->id, $this->productCountActions()['up']($newProduct->first()->pivot->count))
            : $cart->products()->attach($product);

        $this->updateCartTotalPrice($cart);
        return redirect('/cart/' . $cart->id);
    }

    public function update(Cart $cart, Product $product, $action)
    {
        $cartProductsCount = $cart->products()->findOrFail($product->id, ['product_id'])->pivot->count;
        
        $this->updateProductCount($cart, $product->id, $this->productCountActions()[$action]($cartProductsCount));
        $this->updateCartTotalPrice($cart);

            
        return redirect('/cart/' . $cart->id . '#' . $product->slug);
    }

    public function destroy(Cart $cart, Product $product)
    {
        $cart->products()->detach($product->id);
        $this->updateCartTotalPrice($cart);

        return back();
    }

    protected function updateProductCount($cart, $productId, $newCount)
    {
        $cart->products()->sync([$productId => [ 'count' => $newCount] ], false);
    }

    protected function getUpdatedCartPrice($cart)
    {
        return $cart->products()->count()
        ? array_reduce((array)$cart->products()->get()->all(), fn ($acc, $current) => $acc += ($current->price * $current->pivot->count), 0.00)
        : 0;
    }

    protected function updateCartTotalPrice($cart) 
    {
        $cart->totalPrice = $this->getUpdatedCartPrice($cart);
        $cart->save();
    }

    protected function productCountActions()
    {
        return [
            'up' => function($productCount) {
                return $productCount < 9 ? $productCount += 1 : $productCount;
            },
            'down' => function($productCount) {
                return $productCount == 1 ? $productCount : $productCount -= 1;
            }
        ];
    }

}
