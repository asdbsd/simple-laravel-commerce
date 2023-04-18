<x-layout title="Checkout Page" cssPath="/css/checkout.css">
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
            <div id="total-price" data-amount="{{ $cart->totalPrice * 100}}">
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

<script defer>
    // This is your test publishable API key.
    const stripe = Stripe(
        "pk_test_51Mwi7DBQHcCtp6BWhGMNja1TcffxjtG2Ps1vlzyET17lGwgwY29gPvv9EhDe7SUIKtU0grMDHs9fFoL8Dvy4ILvK00klitnct1"
    );

    // The items the customer wants to buy

    const items = [ document.querySelector('#total-price').dataset.amount ];

    let elements;

    initialize();
    checkStatus();

    document
        .querySelector("#payment-form")
        .addEventListener("submit", handleSubmit);

    let emailAddress = '';
    // Fetches a payment intent and captures the client secret
    async function initialize() {
        const purchasePath = location.origin + location.pathname + location.search;
        const {
            clientSecret
        } = await fetch(purchasePath, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                items
            }),
        }).then((r) => r.json());


        elements = stripe.elements({
            clientSecret
        });

        const linkAuthenticationElement = elements.create("linkAuthentication");
        linkAuthenticationElement.mount("#link-authentication-element");

        const paymentElementOptions = {
            layout: "tabs",
        };

        const paymentElement = elements.create("payment", paymentElementOptions);
        paymentElement.mount("#payment-element");
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setLoading(true);

        const {
            error
        } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                // Make sure to change this to your payment completion page
                return_url: `http://localhost/purchase/${location.pathname.split('/')[2]}/complete`,
                receipt_email: emailAddress,
            },
        });

        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occurred.");
        }

        setLoading(false);
    }

    // Fetches the payment intent status after payment submission
    async function checkStatus() {
        const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
        );

        if (!clientSecret) {
            return;
        }

        const {
            paymentIntent
        } = await stripe.retrievePaymentIntent(clientSecret);

        switch (paymentIntent.status) {
            case "succeeded":
                showMessage("Payment succeeded!");
                break;
            case "processing":
                showMessage("Your payment is processing.");
                break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
                break;
            default:
                showMessage("Something went wrong.");
                break;
        }
    }

    // ------- UI helpers -------

    function showMessage(messageText) {
        const messageContainer = document.querySelector("#payment-message");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function() {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 4000);
    }

    // Show a spinner on payment submission
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    }
</script>
