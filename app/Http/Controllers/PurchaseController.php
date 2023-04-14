<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Error;

class PurchaseController extends Controller
{
    public function index(Product $product) {
        return view('purchase.index', [
            'product' => $product
        ]);
    }

    public function create(Product $product)
    {
        $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        function calculateOrderAmount(Product $product): int {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // people from directly manipulating the amount on the client
            return $product->price;
        }
        
        header('Content-Type: application/json');
        
        try {
            // retrieve JSON from POST body
            // $jsonStr = file_get_contents('php://input');
            // $jsonObj = json_decode($jsonStr);
        
            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => calculateOrderAmount($product),
                'currency' => 'gbp',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
        
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

    }
}
