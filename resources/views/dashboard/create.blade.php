<x-dashboard-layout :add="true">
    <div class="col-md-7 col-lg-8 ms-3">
        <h4 class="mb-3">Add Product</h4>
        <form method="POST" action="/dashboard/add-product" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-sm-12">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Description</label>
                    <textarea rows="4" type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                         placeholder="Product description" value="{{ old('description') }}" required></textarea>
                    @error('description')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                
            <hr class="my-4">

            <button class="w-100 btn btn-success btn-lg" type="submit">Create Product</button>
        </form>
    </div>
</x-dashboard-layout>
