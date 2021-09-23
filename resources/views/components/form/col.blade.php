@props([
    'col',
])
<div class="form-group {{$col}}" {{$attributes}}>
    {{ $slot }}
</div>
