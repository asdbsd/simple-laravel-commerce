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
            <div class="row py-2 mx-1">

                @canany(['update', 'destroy'], $product)
                    <form method="POST" action="/dashboard/{{ $product->slug }}">
                        @csrf
                        @method('DELETE')
        
                        <div class="btn-group ms-1">
                            <a href="/dashboard/edit-product/{{ $product->slug }}" class="btn btn-sm btn-outline-primary"
                                type="button">Edit</a>
        
        
                            <button type="submit" class="btn btn-sm btn-outline-danger" type="button">Delete</button>
        
                        </div>
        
                    </form>
                @else
                    <div class="d-flex">
        
                        <form action="/cart/{{ auth()->user() ? auth()->user()->cart->id : mt_rand(1, 100) }}/add/{{ $product->slug }}"
                            method="POST" class="mx-1">
                            @csrf
        
                            <button type="submit" class="btn btn-sm btn-outline-success">Add to Cart</button>
                        </form>
        
        
                        @if (!$product->isFavorited())
                            <form method="POST" action="/store/{{ $product->slug }}/favorites">
                                @csrf
        
                                <button type="submit" class="btn btn-sm btn-outline-info">Favorite</button>
                            </form>
                        @else
                            <form method="POST" action="/store/{{ $product->slug }}/favorites">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove Favorite</button>
                            </form>
                        @endif
                    </div>
        
                @endcanany
        
        
            </div>
        </div>

    </div>


</x-layout>
