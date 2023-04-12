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
            <option value="all" selected>No Sorting</option>
            <option value="asc" @if (request()->query('orderBy') == 'asc') selected @endif>Name Ascending</option>
            <option value="desc" @if (request()->query('orderBy') == 'desc') selected @endif>Name Descending</option>
        </select>

    </div>
</div>

<script>
    const getNewLocation = (queryStringArr) => {
        return location['pathname'] + getUpdatedLocation(queryStringArr);
    }

    const optionChangeEvent = (data, event) => {

        const selectElement = event.target;
        const selectedElementValue = selectElement.options[selectElement.selectedIndex].value;

        location.assign(getNewLocation([selectElement.id, selectedElementValue]));

    };

    document.querySelector('#category').addEventListener('change', optionChangeEvent.bind(null, 'category'));
    document.querySelector('#orderBy').addEventListener('change', optionChangeEvent.bind(null, 'orderBy'));
    const getUpdatedLocation = (newData) => {
        const newLoc = location.href.split('?').reduce((acc, currentEl, index, originalArr) => {



            if (originalArr.length > 1 && index > 0) {
                const splitedQueryParams = currentEl.split('&');
                splitedQueryParams.forEach(paramPair => {
                    const [key, value] = [...paramPair.split('=')];
                    acc[key] = value;
                });

            }

            if (newData[1] === 'all') {
                acc[newData[0]] ? delete acc[newData[0]] : null;
                return acc;
            }

            acc[newData[0]] = newData[1];

            return acc;
        }, {});

        return Object.entries(newLoc).reduce((acc, [key, value], index) => {
            acc += (index == 0 ? '?' : '&') + key + '=' + value;

            return acc;
        }, '')
    }
</script>
