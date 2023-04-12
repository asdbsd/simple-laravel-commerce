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
        <select id="category" class="form-select form-select-sm mb-3">

            <option value="all" selected>All</option>
            @foreach ($categories as $category)
                <option value="{{ $category->slug }}" @if (request()->query('category') && request()->query('category') === $category->slug) selected @endif>
                    {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <strong>Order by</strong>
        <select id="orderBy" class="form-select form-select-sm">
            <option selected disabled>Order By</option>
            <option value="nameAsc">Name Ascending</option>
            <option value="nameDsc">Name Descending</option>
        </select>

    </div>
</div>

<script>

    const categoryRedirectLink = (element) => {
        const categorySlug = element.options[element.selectedIndex].value;
        return categorySlug == 'all' ? location['pathname'] : location['pathname'] + '?category=' +  categorySlug;
    }
    const orderByRedirectLink = () => {

    }
    const optionChangeEvent = (data, event) => {
        const selectElement = event.target;
        const actions = {
            category: categoryRedirectLink(selectElement),
            orderBy: orderByRedirectLink(selectElement)
        }

        location.assign(actions[data]);
    };

    document.querySelector('#category').addEventListener('change', optionChangeEvent.bind(null, 'category'));
    document.querySelector('#orderBy').addEventListener('change', optionChangeEvent.bind(null, 'orderBy'));

</script>
