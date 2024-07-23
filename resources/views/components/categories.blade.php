@foreach($categories as $category)
    @if(!$category->children->isEmpty())
        <x-category :category="$category" :i="$i"></x-category>
    @else
        <x-sub-category :category="$category" :i="$i"></x-sub-category>
    @endif
@endforeach
