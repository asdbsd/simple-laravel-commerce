<x-dashboard-layout>
    <div class="col-md-7 col-lg-8 ms-3">
        <h4 class="mb-3">Edit Product</h4>
        <form method="POST" action="{{ route('dashboard.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row g-3">
                <div class="col-sm-18">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        placeholder="" value="{{ !$product ? old('name') : $product->name }}" required />
                    @error('name')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-sm-4">
                    <label class="form-label">Product Category</label>
                    <x-form-elements.select :categories="$categories" :product="$product" />
                    @error('category_id')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Description</label>
                    <textarea rows="4" type="text" name="description"
                        class="form-control @error('description') is-invalid @enderror" placeholder="Product description" required>{{ !$product ? old('description') : $product->description }}</textarea>
                    @error('description')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="image"
                                class="form-control @error('image') is-invalid @enderror">
                        </div>
                        <div class="col-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->slug }}"
                                width="100%" height="225">
                        </div>
                    </div>

                    @error('image')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>


                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg" type="submit">Update Product</button>
        </form>
    </div>
</x-dashboard-layout>
