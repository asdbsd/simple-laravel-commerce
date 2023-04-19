@props(['product'])

<a href="{{ route('products.show', $product) }}">
    <img src="{{ asset('storage/' . $product->image) }}" alt="Card Image" width="100%" height="225">

    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <small>Price: </small><strong class="pricing-card-title">£{{ number_format($product->price, 2, '.', ',') }}</strong>
        <hr>
        <p>
            <x-products.category :category="$product->category" />
        </p>
        <p class="card-text">
            {{ $product->excerpt }}
        </p>
    </div>
</a>
