<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Error;

class PurchaseController extends Controller
{
    public function index(Cart $cart) {

        return view('purchase.index', [
            'cart' => $cart
        ]);
    }

    public function show(Cart $cart) {

        $intentSecret = request('payment_intent_client_secret');
        $status = request('redirect_status');
        $products = $cart->products()->get();
        $cartTotal = $cart->totalPrice;

        foreach($cart->products as $product){
            $cart->products()->detach($product);
        }
        $cart->totalPrice = 0.00;
        $cart->save();

        return view('purchase.show', [
            'products' => $products,
            'cartTotal' => $cartTotal
        ]);
    }

    public function create()
    {
        
        // $products = Product::where('slug', '=', request()['items']);
        
        $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        function calculateOrderAmount($products): int {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // people from directly manipulating the amount on the client

            return $products[0];
        }
        
        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => calculateOrderAmount($jsonObj->items),
                'currency' => 'gbp',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
        
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            return response()->json($output);

            // echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

    }
}
