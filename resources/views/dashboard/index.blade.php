<x-dashboard-layout :all="true">

    <div class="row">
    @foreach ($products as $product)
        <div class="col-4">
            <x-products.box :product="$product" />
        </div>
    @endforeach
</div>

</x-dashboard-layout>
