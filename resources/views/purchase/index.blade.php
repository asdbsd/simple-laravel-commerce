@push('head')
    @vite(['resources/css/checkout.css', 'resources/js/stripe.js'])
@endpush
<x-layout title="Checkout Page">
    <x-header.navigation />

    <div class="row">
        <div class="col-6">
            @foreach ($cart->products()->get() as $product)
                <div class="row">
                    <div class="col-4">
                        <img class="col-12 rounded-2 m-0 p-0" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->slug . '-image' }}" />
                    </div>

                    <div class="col-8">
                        <h2>{{ $product->name }}</h2>
                        <p><span>Price: </span><strong>£{{ $product->price }}</strong></p>
                        <p></p><span>Qty: </span><strong>{{ $product->pivot->count }}</strong></p>
                    </div>

                </div>
                <hr>
            @endforeach
        </div>

        <div class="col-6">
            <div id="total-price" data-amount="{{ $cart->totalPrice * 100 }}">
                <span>Total Amount:</span>
                <span><strong>£{{ number_format($cart->totalPrice, 2, '.', ',') }}</strong></span>
            </div>
            <br>
            <form id="payment-form">
                <div id="link-authentication-element">
                    <!--Stripe.js injects the Link Authentication Element-->
                </div>
                <div id="payment-element">
                    <!--Stripe.js injects the Payment Element-->
                </div>
                <button id="submit">
                    <div class="spinner hidden" id="spinner"></div>
                    <span id="button-text">Pay now</span>
                </button>
                <div id="payment-message" class="hidden"></div>
            </form>

        </div>
    </div>

</x-layout>