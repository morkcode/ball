@props([
    'color'     => 'success',
    'field'     => null,
    'box'       => false,
    'col'       => 'col-12',
    'label'     => null,
    'class'     => null,
    'required'  => null,
    'disabled'  => null,
])
@php
    $addClass = '';
    if( isset($box) && $box ) {
        $addClass = ' custom-switch-on-'.$color.' alert-default-'.$color.' py-4 rounded';
    }
    else {
        $addClass = ' custom-switch-on-'.$color ;
    }
@endphp
<x-ball-col col="{{$col}}">
<div class="custom-control custom-switch {{$addClass}}">
    <input type="checkbox" class="custom-control-input mt-3" id="{{$field}}" {{$attributes}} {{($required) ? 'required' : '' }} {{($disabled) ? 'disabled' : '' }}>
    <label class="custom-control-label" for="{{$field}}">@isset($label){{$label}}@endisset</label>
</div>
<x-ball-error field="{{$field}}" />
</x-ball-col>
