<x-dashboard-layout :favorites="true">
    <div class="row w-100">
        <x-products.filters :categories="$categories"/>
        @if (count($products))
            @foreach ($products as $product)
                <div class="col-4">
                    <x-products.box :product="$product" />
                </div>
            @endforeach
        @else
            <div class="col text-center">
                <p class="lead">
                    There don't have any favorites yet...
                </p>
                <a href="/store" class="btn btn-success">Go to store</a>
            </div>
        @endif
    </div>
</x-dashboard-layout>
