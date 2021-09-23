@props([
    'icon',
    'fixed'   => null,
    'size'    => null,
    'color'   => null,  // bootstrap default
    'bgcolor' => null,  // bootstrap default
    'class'   => null,
])
@php
    $icons = config('ball.icons');
    if( isset($icons[$icon]) ) {
        $addclass = $icons[$icon] ;
        // For Font Awesome - https://fontawesome.com/v5.15/how-to-use/on-the-web/styling/

        $sizes = ['xs', 'sm', 'lg', '2x', '3x', '4x', '5x', '6x', '7x', '8x', '9x', '10x'];
        if( isset($size) && in_array($size, $sizes) )
            $addclass .= ' fa-'.$size;

        if( isset( $color ) )
            $addclass .= ' text-'.$color;

        if( isset( $bgcolor ) )
            $addclass .= ' bg-'.$bgcolor;
    }
    else {
        $addclass = $icon;
    }
    if( isset( $fixed ) )
            $addclass .= ' fa-fw';

    if( isset( $class ) )
        $addclass .= ' '.$class;
@endphp
<i class="@isset($addclass){{$addclass}}@endisset" {{ $attributes }}></i>
