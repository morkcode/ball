@props([
    'field',
    'label' => null,
    'short' => null,
])
@php
    if( isset($short) ) {
        $format = 'd.m.Y';
    }
    else {
        $format = 'd.m.Y';
    }
@endphp
@if( ! empty($field) )
    @isset( $label ) {{$label}} @endisset
    {{ \Carbon\Carbon::parse($field)->format('d.m.y') }}
@endif
