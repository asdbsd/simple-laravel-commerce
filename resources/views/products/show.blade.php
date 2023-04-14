<x-layout title="{{ $product->name }}">
    <x-header.navigation />

    <div class="row">
        <img class="col-3 rounded-2 m-0 p-0" src="{{ asset('storage/' . $product->image) }}"
            alt="{{ $product->slug . '-image' }}" />

        <div class="col-9">

            <h2>{{ $product->name }}</h2>
            <x-products.category :category="$product->category" />
            <hr>
            <p>
                {{ $product->description }}
            </p>
            @canany(['update', 'destroy'], $product)
                <form action="/dashboard/{{ $product->slug }}">
                    @csrf
                    @method('DELETE')

                    <a href="/dashboard/edit-product/{{ $product->slug }}" class="btn btn-sm btn-outline-primary"
                        type="button">Edit</a>
                    <button type="submit" class="btn btn-sm btn-outline-danger" type="button">Delete</button>

                </form>
            @else
                <p><small>Price: </small><strong class="pricing-card-title">£{{ $product->price }}</strong></p>

                @if (!$product->isFavorited())
                    <div class="row">
                        <div class="col-5">
                            <form action="/store/{{ $product->slug }}/purchase" method="GET">
                                @csrf

                                <button class="btn btn-sm btn-outline-success" type="submit">Buy Now</button>
                            </form>
                        </div>
                        <div class="col-7">
                            <form method="POST" action="/store/{{ $product->slug }}/favorites">
                                @csrf
                                
                                <button type="submit" class="btn btn-sm btn-info">Favorite</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-5">
                            <form action="/store/{{ $product->slug }}/purchase" method="GET">
                                @csrf
                                <button class="btn btn-sm btn-outline-success" type="submit">Buy Now</button>
                            </form>
                        </div>
                        <div class="col-7">
                            <form method="POST" action="/store/{{ $product->slug }}/favorites">
                                @csrf
                                @method('DELETE').

                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove Favorite</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endcanany

        </div>

    </div>


</x-layout>
