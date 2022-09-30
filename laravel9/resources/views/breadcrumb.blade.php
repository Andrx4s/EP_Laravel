<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @forelse($breadcrumbs as $item)
            @if(isset($item['link']))
                <li class="breadcrumb-item"><a href="{{route($item['routeName'])}}">{{$item['name']}}</a></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{$item['name']}}</li>
            @endif
        @empty
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Главная страница</a></li>
        @endforelse
    </ol>
</nav>
