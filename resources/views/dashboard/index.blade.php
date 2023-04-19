<x-dashboard-layout :all="true">

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
                You have not created any products yet.
            </p>
            <a href="{{ route('dashboard.create') }}" class="btn btn-success">Add Product</a>
        </div>


        @endif

    </div>

</x-dashboard-layout>
