<x-dashboard-layout :add="true">
    <div class="col-md-7 col-lg-8 ms-3">
        <h4 class="mb-3">Add Product</h4>
        <form method="POST" action="/dashboard/add-product" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        placeholder="Product Name" value="{{ old('name') }}" required />
                    @error('name')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-sm-3">
                    <label class="form-label">Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input id="priceInput" placeholder="00.00" type="number" step="0.01"
                            class="form-control @error('price') is-invalid @enderror" name="price" />
                        @error('price')
                            <div class="text-danger form-text">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="col-sm-3">
                    <label class="form-label">Category</label>
                    <x-form-elements.select :categories="$categories" />
                    @error('category_id')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Description</label>
                    <textarea rows="4" type="text" name="description"
                        class="form-control @error('description') is-invalid @enderror" placeholder="Product description" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" />
                    @error('image')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>


                <hr class="my-4">

                <button class="w-100 btn btn-success btn-lg" type="submit">Create Product</button>
        </form>
    </div>
</x-dashboard-layout>


<script>
    const handlePriceInputChange = (event) => {
        const priceInputElement = event.target;

        if (priceInputElement.value < 0.5) {
            priceInputElement.value = 0;
            return;
        }

        while (priceInputElement.value[0] == '0' && priceInputElement.value[1] !== '.') {
            priceInputElement.value = priceInputElement.value.slice(1);
        }

        let [charsBeforeDot, charsAfterDot] = [...priceInputElement.value.split('.')];



        if (!charsAfterDot) {
            charsAfterDot = '00';
        } else if (charsAfterDot.length < 2) {
            charsAfterDot += '0'
        } else if (charsAfterDot.length > 2) {
            charsAfterDot = charsAfterDot.slice(0, 2);
        }

        if (charsBeforeDot > 5) {
            priceInputElement.value = [charsBeforeDot.slice(0, 6), charsAfterDot].join('.');
        }

    }

    document.querySelector('#priceInput').addEventListener('change', handlePriceInputChange);
</script>
