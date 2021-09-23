@props([
    'route'     => null,
    'label'     => null,
    'icon'      => null,
    'color'     => null,
])
@php
    if ( request()->is( config('ball.dashboard') .'/'. Str::replace('.','/', Str::replaceFirst('board.', '', $route ) ) . '*' ) ) {
        $addClass = ' active';
    }
    else {
        $addClass = '';
    }
@endphp
<li class="nav-item">
    <a href="{{route($route)}}" class="nav-link{{ $addClass }}">
        <x-ball-icon icon="nav-icon {{$icon}}"/>
        <p>
            {{$label}}
        {{-- <span class="badge badge-{{$color}}} right"></span> --}}
        </p>
    </a>
</li>
