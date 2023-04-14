@props(['product'])

<a href="/store/{{ $product->slug }}">
    <img src="{{ asset('storage/' . $product->image) }}" alt="Card Image" width="100%" height="225">

    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <hr>
        <p>
            <x-products.category :category="$product->category" />
        </p>
        <p class="card-text">
            {{ $product->excerpt }}
        </p>
    </div>
</a>
