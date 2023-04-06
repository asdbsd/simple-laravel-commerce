@props(['product'])


<div class="card shadow-sm m-1">
    <x-products.link :product="$product" />

    <div class="row my-3 mx-2">
        <div class="col-8">
            <div class="btn-group ms-1">
                @if (auth()->id() === $product->user_id)
                    <a href="/dashboard/edit-product/{{ $product->slug }}" type="button" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a type="button" class="btn btn-sm btn-outline-danger">Delete</a>
                @else
                    <a type="button" class="btn btn-sm btn-outline-success">Buy Now</a>
                @endif


            </div>
        </div>
        <div class="col-4 text-center">
            <x-products.category />
        </div>


    </div>


</div>
