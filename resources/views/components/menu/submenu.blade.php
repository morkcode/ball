@props([
    'prefix'     => null,
    'label'     => null,
    'icon'      => null,
    'color'     => null,
])
@php
    if ( request()->is( config('ball.dashboard') .'/'. $prefix . '*' ) ) {
        $addOpen = ' menu-open';
        $addClass = ' active';
    }
    else {
        $addClass = '';
        $addOpen  = '';
    }
@endphp
<li class="nav-item{{$addOpen}}">
    <a href="" class="nav-link{{ $addClass }}">
        <x-ball-icon icon="nav-icon {{$icon}}"/>
        <p>
            {{$label}}
            <i class="fas fa-caret-left right"></i>
        {{-- <span class="badge badge-{{$color}}} right"></span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        {{$slot}}
    </ul>
</li>
