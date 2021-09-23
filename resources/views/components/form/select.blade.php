@props([
    'field'     => null,
    'col'       => 'col-12',
    'label'     => null,
    'placeholder'  => null,
    'size'      => null,
    'icon'      => null,
    'class'     => null,
    'required'  => null,
    'disabled'  => null,
    'multiple'  => null,
])
@php
    $sizes = ['sm', 'lg'];

    if( isset($label) && ! isset($placeholder) )
        $placeholder = $label;
@endphp
<x-ball-col col="{{$col}}">
@isset($label)<x-ball-label label="{{$label}}" icon="{{$icon}}" required="{{$required}}"/>@endisset

<div x-data="{ {{$field}}: '' }">
<select {{$attributes}}
    class="custom-select form-control-border @if( $disabled ) form-control-plaintext @endif {{$class}} @error($field) is-invalid @enderror"
    {{-- id="id-{{$field}}"
    name="{{$field}}" --}}
@isset($placeholder) placeholder="{{$placeholder}}"@endisset
{{-- value="{{ old($field, $value ?? '') }}" --}}
{{($required) ? 'required readonly' : '' }}
{{($disabled) ? 'disabled' : '' }}
{{($multiple) ? 'multiple' : '' }}>
{{ $slot }}
</select>
{{-- <span x-show="{{$field}}" x-text="`cambio ${ {{$field}} }`"> --}}
</div>

<x-ball-error field="{{$field}}" />
</x-ball-col>


{{--

@if(!is_null($label))
    <label for="{{$id}}">
        @if(!is_null($icon))
        <x-buttons.icon icono="{{$icon}}"/>
        @endif
        {{$label}} @if($required) <strong class="text-danger">*</strong> @endif
        <i class="fas fa-cog fa-spin fa-fw load-ajax d-none"></i>
        <span class="text-danger d-none"><i class="icon-close"></i> Error al cargar</span>
    </label>
@endif

<select id="{{$id}}" name="{{$name}}" class="custom-select form-control-border @if( $disabled ) form-control-plaintext @endif {{$inputclass}} @error($name) is-invalid @enderror"
{{($disabled) ? 'disabled readonly' : '' }}
{{($required) ? 'required' : '' }}
{{($multiple) ? 'multiple' : '' }}>


@if( !is_null($placeholder) )
<option selected disabled>{{$placeholder}}</option>
@endif
{{$slot}}
</select>

 --}}
