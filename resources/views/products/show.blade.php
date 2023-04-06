<x-layout title="{{ $product->name }}">
    <x-header.navigation />

    <div class="row">
        <h5>Categories</h5>
        <div class="list-group col-md-2 my-2">

            <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                The current button
            </button>
            <button type="button" class="list-group-item list-group-item-action">A second button item</button>
            <button type="button" class="list-group-item list-group-item-action">A third button item</button>
            <button type="button" class="list-group-item list-group-item-action">A fourth button item</button>
            <button type="button" class="list-group-item list-group-item-action" disabled>A disabled button
                item</button>
        </div>


        <img class="col-md-3 rounded-2 m-0 p-0" src="{{ asset('storage/' . $product->image) }}"
            alt="{{ $product->slug . '-image' }}" />

        <div class="col-md-7">

            <h2>{{ $product->name }}</h2>
            <p>
                {{ $product->description }}
            </p>
            @if (auth()->id() === $product->user_id)
                <button class="btn btn-sm btn-outline-primary" type="button">Edit</button>
                <button class="btn btn-sm btn-outline-danger" type="button">Delete</button>
            @else
                <button class="btn btn-sm btn-outline-success" type="button">Buy Now</button>
            @endif

        </div>

    </div>


</x-layout>
