{{--

crudform


add


show
    SIN FORM
    FILESET DISABLED


edit
    FORM
    INPUT HIDDEN


delete

restore

erase



Buttons

show

formCrud

<x-ball-formcrud />



<x-ball-buttoncrud />
buttonCrud


@isset($show)
    <x-ball-button wire:click="formActions( 'show', {{$row->id}} )" outline color="success" class="border-0" icon="show" iconlabel="{{ __('Show') }}"/>
@endisset
@isset($edit)
    <x-ball-button wire:click="formActions( 'edit', {{$row->id}} )" outline color="primary" class="border-0" icon="edit" iconlabel="{{ __('Edit') }}"/>
@endisset





@isset($delete)

    // existe ->deleted_at ?
    @if( is_null( $row->deleted_at) )
        <x-ball-button outline color="danger" class="border-0" icon="delete" iconlabel="{{ __('Delete') }}"/>
    @else

        @isset($erase)
            <x-ball-button outline color="danger" class="border-0" icon="erase" iconlabel="{{ __('Erase') }}"/>
        @endisset
        @isset($restore)
            <x-ball-button outline color="secondary" class="border-0" icon="restore" iconlabel="{{ __('Restore') }}"/>
        @endisset


@endisset --}}
