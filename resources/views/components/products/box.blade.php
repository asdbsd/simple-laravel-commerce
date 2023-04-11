@props(['product'])


<div class="card shadow-sm m-1">
    <x-products.link :product="$product" />

    <div class="row my-3 mx-2">
        <div class="col-8">

            @canany (['update', 'destroy'], $product)
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
                <a type="button" class="btn btn-sm btn-outline-success" disabled>Buy Now</a>
            @endcanany


        </div>
        <div class="col-4 text-center">
            <x-products.category :category="$product->category" />
        </div>
    </div>



</div>
