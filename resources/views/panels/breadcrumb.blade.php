<div class="align-self-start">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-slash">
            @foreach($options as $option)
                @if(array_key_exists('url',$option))
                    <li class="breadcrumb-item"><a class="link-secondary" href="{{$option['url']}}">
                            {{$option['name']}}
                        </a></li>
                @else
                    <li class="breadcrumb-item fw-bolder active" aria-current="page">
                      {{$option['name']}}
                @endif
            @endforeach
        </ol>
    </nav>
</div>
