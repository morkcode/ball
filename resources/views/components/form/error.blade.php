@props([
    'field'
])
@error($field)
    <span class="error invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
