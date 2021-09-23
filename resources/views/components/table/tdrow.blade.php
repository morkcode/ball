@props([
    'sorting'   => null,
    'class'     => null,
])
@php
    $addClass = '';
    if( isset($class) )
        $addClass .= $class;

    if( isset( $sorting ) && Arr::exists($this->sorts, $sorting) )
        $addClass .= ' sorting';

@endphp
<td {{ $attributes->merge(['class' => $addClass ]) }}>
    {{ $slot }}
</td>
