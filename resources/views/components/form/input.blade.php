@props([
    'field'     => null,
    'type'      => 'text',
    'col'       => 'col-12',
    'label'     => null,
    'placeholder'  => null,
    'size'      => null,
    'icon'      => null,
    'class'     => null,
    'required'  => null,
    'disabled'  => null,
])
@php
    $sizes = ['sm', 'lg'];

    $types = ['text', 'number', 'range', 'date', 'datetime-local', 'month', 'time', 'week', 'tel', 'email'];
    if( isset($type) && in_array($type, $types) ) {
        $type = $type;
    }
    else {
        $type = null;
    }


    if( isset($label) && ! isset($placeholder) )
        $placeholder = $label;
@endphp
<x-ball-col col="{{$col}}">
@isset($label)<x-ball-label label="{{$label}}" icon="{{$icon}}" required="{{$required}}"/>@endisset

<input type="{{$type}}" {{$attributes}}
    class="form-control form-control-border @if( $disabled ) form-control-plaintext @endif {{$class}} @error($field) is-invalid @enderror"
    {{-- id="id-{{$field}}"
    name="{{$field}}" --}}
@isset($placeholder) placeholder="{{$placeholder}}"@endisset
{{-- value="{{ old($field, $value ?? '') }}" --}}
{{($required) ? 'required' : '' }}
{{($disabled) ? 'disabled' : '' }}>

<x-ball-error field="{{$field}}" />
</x-ball-col>
