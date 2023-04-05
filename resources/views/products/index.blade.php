<x-layout title="Products Store">
    <x-header.navigation /> 
    <main>

        <div class="row">


            <div class="col-3">
                <strong>Search by Name</strong>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                </div>
            </div>
            <div class="col-3">
                <strong>Search by Category</strong>
                <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                    <option selected disabled>Select Shopping Category</option>
                    <option value="1">Food</option>
                    <option value="2">Beverages</option>
                    <option value="3">Clothes</option>
                    <option value="3">Appliances</option>
                </select>
            </div>
            <div class="col-2">
                <strong>Order by</strong>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected disabled>Order By</option>
                    <option value="1">Name Ascending</option>
                    <option value="2">Name Descending</option>
                    <option value="3">Price Ascending</option>
                    <option value="3">Price Descending</option>
                </select>

            </div>
        </div>

        <div class="row">

            @foreach ($products as $product)
                
                <div class="col-4">
                    <x-products.box :product="$product" />
                </div>
                
               
            @endforeach

        </div>

    </main>

</x-layout>
