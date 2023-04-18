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
                    <div class="row">
                        <div class="col-5">
                            @auth
                                <form action="/cart/{{ auth()->user()->cart->id }}/add/{{ $product->slug }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-sm btn-outline-success">Add to Cart</button>
                                </form>
                            @endauth
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
                        <div class="btn-group">
                            <div class="col-5">
                                @auth
                                <form action="/cart/{{ auth()->user()->cart->id }}/add/{{ $product->slug }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-sm btn-outline-success">Add to Cart</button>
                                </form>
                                @endauth
                            </div>
                            <div class="col-7">
                                <form method="POST" action="/store/{{ $product->slug }}/favorites">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Remove Favorite</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endcanany

        </div>
    </div>



</div>
