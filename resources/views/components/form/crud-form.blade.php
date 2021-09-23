@props([ 'recordid' ])
@if( $this->formMode === 'edit' )
    <form wire:submit.prevent="saveRecord( {{$recordid}} )" {{$attributes}}>
@elseif ( $this->formMode === 'create' )
    <form wire:submit.prevent="createRecord()" {{$attributes}}>
@elseif ( $this->formMode === 'show' )
    <fieldset readonly disabled>
@else
    <span class="alert alert-default-danger">ERROR !!!!!!!!!!</span>
@endif
{{ $slot }}
@if( $this->formMode === 'show' )
    </fieldset>
@else
    </form>
@endif
