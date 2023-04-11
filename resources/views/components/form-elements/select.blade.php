@props(['categories', 'product' => null])

<select name="category_id" class="form-control" required>
    <option value="{{null}}" disabled selected>Select Category</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            @if ($category->id == $product?->category_id || $category->id == old('category_id')) selected @endif>{{ $category->name }}
        </option>
    @endforeach
</select>