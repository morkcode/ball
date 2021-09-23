@props([
    'type'      => 'button',    // ['button', 'submit', 'reset', 'tool']
    'label'     => null,
    'block'     => null,
    'color'     => null,
    'outline'   => null,
    'gradient'  => null,
    'size'      => null,
    'flat'      => null,
    'icon'      => null,
    'iconlabel' => null,
    'class'     => null,

])
@php
    $types  = ['button', 'submit', 'reset'];
    if (isset($type) && in_array($type, $types))
        // $type = $type;

    if( isset($label) )
        $iconlabel = $label;

    $addClass = 'btn';

    if( isset($block) )
        $addClass .= ' btn-block';

    if( isset( $color ) ) {
        if( isset( $outline ) ) {
            $addClass .= ' btn-outline-'.$color;
        }
        elseif( isset($gradient) ) {
            $addClass .= ' bg-gradient-'.$color;
        }
        else {
            $addClass .= ' btn-'.$color;
        }
    }
    if( isset($flat) )
        $addClass .= ' btn-flat';

    $sizes  = ['lg', 'sm', 'xs'];
    if (isset($size) && in_array($size, $sizes))
         $addClass .= ' btn-'.$size;

    if( isset($class) )
        $addClass .= ' '.$class;

@endphp
<button type="{{$type}}" {{ $attributes->merge(['class' => $addClass ]) }}@isset($iconlabel) title="{{ $iconlabel }}"@endisset>
    @isset($icon)<x-ball-icon icon="{{ $icon }}" fixed/>@endisset
    @isset($label)<span class="d-none d-md-inline">{{ $label }}</span>@endisset
</button>
