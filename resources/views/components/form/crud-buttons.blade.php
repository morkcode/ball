@props([
    'field',
    'show'      => null,
    'edit'      => null,
    'delete'    => null,
    'deleteat'  => null,
])
@isset($show)
{{-- {{$row->id}}  --}}
    <x-ball-button wire:click="formActions( 'show', {{$field}} )" outline color="success" class="border-0" icon="show" iconlabel="{{ __('Show') }}"/>
@endisset
@isset($edit)
    <x-ball-button wire:click="formActions( 'edit', {{$field}} )" outline color="primary" class="border-0" icon="edit" iconlabel="{{ __('Edit') }}"/>
@endisset
@isset($delete)
    {{-- // existe ->deleted_at ? --}}
    {{-- @isset( $deletedat ) --}}
        {{-- @Rol('admin') --}}
        <x-ball-button outline color="danger" class="border-0" icon="erase" iconlabel="{{ __('Erase') }}"/>
        {{-- @endRol --}}
        <x-ball-button outline color="secondary" class="border-0" icon="restore" iconlabel="{{ __('Restore') }}"/>
    {{-- @else --}}
        <x-ball-button outline color="danger" class="border-0" icon="delete" iconlabel="{{ __('Delete') }}"/>
    {{-- @endisset --}}
@endisset
