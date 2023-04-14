@props(['category'])

<a href="
@if(request()->path() == 'dashboard/my-products')
{{ '/dashboard/my-products?category=' . $category->slug }}
@else
{{ '/store/?category=' . $category->slug }}
@endif
">
<strong>Category: </strong><span class="badge text-bg-info">{{ $category->name }}</span></a>
