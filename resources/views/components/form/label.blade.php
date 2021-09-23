@props([
    'label',
    'id'        => null,
    'icon'      => null,
    'class'     => null,
    'required'  => null,

])
<label>
    @isset($icon)<x-ball-icon icon="{{$icon}}" fixed/>@endisset
    {{$label}}
    @if($required)<strong class="text-danger">*</strong>@endif
</label>
