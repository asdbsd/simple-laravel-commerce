@props(['product'])


<div class="card shadow-sm m-1">
    <x-products.link :product="$product" />

    <div class="row my-2 mx-1">
        <div class="col-12">

            @canany(['update', 'destroy'], $product)
                <form method="POST" action="/dashboard/{{ $product->slug }}" class="text-end">
                    @csrf
                    @method('DELETE')

                    <div class="btn-group ms-1">
                        <a href="/dashboard/edit-product/{{ $product->slug }}" class="btn btn-sm btn-outline-primary"
                            type="button">Edit</a>

      
                        <button type="submit" class="btn btn-sm btn-outline-danger" type="button">Delete</button>

                    </div>

                </form>
            @else
                @if (!$product->isFavorited())
                    <form method="POST" action="/store/{{ $product->slug }}/favorites" class="text-end">
                        @csrf
                        <div class="btn-group ms-1">
                            <a type="button" class="btn btn-sm btn-outline-success" disabled>Buy Now</a>

                            <button type="submit" class="btn btn-sm btn-info">Favorite</button>

                        </div>
                    </form>
                @else
                    <form method="POST" action="/store/{{ $product->slug }}/favorites" class="text-end">
                        @csrf
                        @method('DELETE')

                        <div class="btn-group ms-1">
                            <a type="button" class="btn btn-sm btn-outline-success" disabled>Buy Now</a>

                            <button type="submit" class="btn btn-sm btn-outline-danger">Remove Favorite</button>

                        </div>
                    </form>
                @endif
            @endcanany

        </div>
    </div>



</div>
