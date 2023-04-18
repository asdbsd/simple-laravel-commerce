<x-layout title="Purchace Page">
    <x-header.navigation />

    <div class="alert alert-success text-center" role="alert">
        You have successfully completed your purchase!
    </div>


    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($products as $product)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Card Image" width="55px" />
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2, '.', ',') }}</td>
                    <td>{{ $product->pivot->count }}</td>
                </tr>
            @endforeach

        </tbody>

    </table>

    <div class="row">
        <div class="col-3">
            <a href="/store" class="btn btn-sm btn-primary">Back to Store</a>
        </div>
        <div class="col-9 text-end">
            <span>Amount Spent: </span><strong>£{{ number_format($cartTotal, 2, '.', ',') }}</strong>
        </div>

    </div>



</x-layout>
