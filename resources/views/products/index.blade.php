<x-layout title="Products Store">
    <x-header.navigation />
    <main>

        <x-products.filters :categories="$categories"/>

        <div class="row">
            @if (count($products))
                @foreach ($products as $product)
                    <div class="col-4">
                        <x-products.box :product="$product" />
                    </div>
                @endforeach
            @else
                <p class="lead">
                    There are no Products yet. Be first to add a product!
                </p>
                <a href="/dashboard/add-product" class="btn btn-success">Add Product</a>

            @endif
        </div>

    </main>

</x-layout>
