@props(['categories'])

<div class="row">
    <div class="col-4">
        <strong>Search by Name</strong>
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" placeholder="Product Name/Category"
                aria-label="Product Name/Category" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
        </div>
    </div>
    <div class="col-3">
        <strong>Search by Category</strong>
        <select class="form-select form-select-sm mb-3">

            <option value="all" selected>All</option>
            @foreach ($categories as $category)
                <option value="{{ $category->slug }}" @if (request()->query('category') && request()->query('category') === $category->slug) selected  @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <strong>Order by</strong>
        <select class="form-select form-select-sm">
            <option selected disabled>Order By</option>
            <option value="1">Name Ascending</option>
            <option value="2">Name Descending</option>
            <option value="3">Price Ascending</option>
            <option value="3">Price Descending</option>
        </select>

    </div>
</div>

<script>
    const optionChangeEvent = (event) => {
        const selectElement = event.target;
        const categorySlug = selectElement.options[selectElement.selectedIndex].value;

        const newPath = categorySlug == 'all' ? location['pathname'] : location['pathname'] + '?category=' + categorySlug;
        location.assign(`${newPath}`);
    };

    const data = document.querySelector('SELECT').addEventListener('change', optionChangeEvent);
</script>
