@props(['product'])


<div class="card shadow-sm m-1">
    <x-products.link :product="$product" />
    
        <div class="row my-1">
            <div class="col-8">
                <div class="btn-group ms-1">
                    <button type="button" class="btn btn-sm btn-outline-primary">Buy Now</button>
                    <button type="button" class="btn btn-sm btn-outline-danger">Favorite</button>
                </div>
            </div>
            <div class="col-4 text-center">
                <x-products.category />
            </div>

      
        </div>
    
    
</div>
