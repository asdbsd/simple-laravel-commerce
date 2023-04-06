@props(['product'])


<div class="card shadow-sm m-1">
    <x-products.link :product="$product" />

    <div class="row my-1">
        <div class="col-8">
            <div class="btn-group ms-1">
                <button type="button" class="btn btn-sm btn-outline-success">Buy Now</button>
                @if (auth()->id() === $product->user_id)
                    <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                    <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                @endif

            </div>
        </div>
        <div class="col-4 text-center">
            <x-products.category />
        </div>


    </div>


</div>
