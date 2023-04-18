<x-layout title="Shopping Cart">
    <x-header.navigation />
    <h4>Shopping Cart</h4>
    @php
        $totalProducts = 0;
    @endphp

    <div class="row">
        @if ($cart->products->count())
            <div class="col-8">
                @foreach ($cart->products as $product)
                    <div id="{{ $product->slug }}" class="card rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Card Image" width="100%"
                                        height="225">
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <p class="lead fw-normal mb-2">{{ $product->name }}</p>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                                    <form action="/cart/{{ $cart->id }}/update/{{ $product->slug }}/down"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-link px-2" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                            </svg>
                                        </button>
                                    </form>

                                    <input id="form1" min="0" name="quantity"
                                        value="{{ $product->pivot->count }}" @php $totalProducts += $product->pivot->count @endphp type="number"
                                        class="form-control form-control-sm" />
                                    <form action="/cart/{{ $cart->id }}/update/{{ $product->slug }}/up"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-link px-2" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 offset-lg-1">
                                    <h5 class="mb-0">£{{ number_format($product->price, 2, '.', ',') }}</h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <form action="/cart/{{ $cart->id }}/{{ $product->slug }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-danger border-0 bg-white"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                            </svg></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Products
                                <span>
                                    {{ $totalProducts }}
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Shipping
                                <span>N/A</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total amount</strong>
                                    <strong>
                                        <p class="mb-0">(including VAT)</p>
                                    </strong>
                                </div>
                                <span><strong>£{{ number_format($cart->totalPrice, 2, '.', ',') }}</strong></span>
                            </li>
                        </ul>

                        <div class="text-end">
                            <form action="{{ route('store.purchase', $cart->id) }}" action="GET">
                                @csrf

                                <button type="submit" class="btn btn-primary btn-md btn-block">
                                    Go to checkout
                                </button>
                            </form>
                           
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <p>There are no products in your shopping cart. Please go to <a class="btn btn-sm btn-primary"
                        href="/store">STORE</a> to add products
                    in your cart.</p>
            </div>
        @endif
    </div>
</x-layout>
