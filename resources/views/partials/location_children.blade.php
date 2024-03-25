<ul>
    @foreach($children as $child)
        <li>{{ $child->location_name }}</li>
        @if($child->children)
            @include('partials.location_children', ['children' => $child->children])
        @endif
    @endforeach
</ul>
