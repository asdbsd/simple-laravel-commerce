@props(['categories'])

<form action="">
    <div class="row">
        <div class="col-4">
            <strong>Search by Name</strong>
            <div class="input-group input-group-sm mb-3">
                <input name="search" value="{{ request()->query('search') }}" id="searchInput" type="text" class="form-control"
                    placeholder="Product Name/Category">
                <button class="btn btn-outline-secondary" type="submit" id="searchBtn">Search</button>
            </div>
        </div>
        <div class="col-3">
            <strong>Search by Category</strong>
            <select id="category" name="category" class="form-select form-select-sm mb-3" onchange="this.form.submit()">

                <option value="" selected>All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @if (request()->query('category') && request()->query('category') === $category->slug) selected @endif>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <strong>Order by</strong>
            <select id="orderBy" name="orderBy" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="" selected>No Sorting</option>
                <option value="asc" @if (request()->query('orderBy') == 'asc') selected @endif>Name Ascending</option>
                <option value="desc" @if (request()->query('orderBy') == 'desc') selected @endif>Name Descending</option>
            </select>
        </div>
    </div>
</form>