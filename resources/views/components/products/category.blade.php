@props(['category'])

<a href="
@if(request()->path() == route('dashboard.index'))
{{ '/dashboard/?category=' . $category->slug }}
@else
{{ '/products/?category=' . $category->slug }}
@endif
">
<strong>Category: </strong><span class="badge text-bg-info">{{ $category->name }}</span></a>
