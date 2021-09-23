@props([
    'color'       => 'succcess',
    'field'     => null,
    'col'       => 'col-12',
    'box'       => null,
    'label'     => null,
    'placeholder'  => null,
    'size'      => null,
    'icon'      => null,

    'class'     => null,
    'required'  => null,
    'disabled'  => null,
    'readonly'  => null,
])
<x-ball-col col="{{$col}}">
@isset( $box )<div class="alert-default-{{$color}} border rounded-lg px-3 float-md-right">@endif

    @isset($label)<x-ball-label label="{{$label}}" icon="{{$icon}}" required="{{$required}}"/>@endisset

    <div x-data="{ {{$field}}: '' }" class="checkbox-switch text-left py-2 {{$class}}">
        <input type="checkbox" class="form-check-input"
            {{$attributes}}
            {{-- {{ old( $name, $value ?? '' ) ? 'checked' : '' }}
            value="{{ old( $name, $value ?? '' ) ? '0' : '1' }}" --}}
            {{($required) ? 'required' : '' }}
            {{($readonly) ? 'readonly' : '' }}
            {{($disabled) ? 'disabled' : '' }}>
        <label class="bg-{{$color}}"></label>
    </div>

@isset( $box )</div>@endif
</x-ball-col>
