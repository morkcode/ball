{{-- @if ($sortField !== $field) --}}
@if ($direction === 'asc')
    {{-- <i class="fas fa-sort fa-fw text-muted float-right"></i> --}}
    <i class="fas fa-arrows-alt-v fa-fw fa-xs text-muted ml-1"></i>
    {{--
        <i class="fas fa-long-arrow-alt-up text-muted p-0 m-0"></i>
        <i class="fas fa-long-arrow-alt-down text-muted p-0 m-0"></i>
    --}}
    {{-- @elseif ($sortAsc) --}}
@elseif ( $sortDirection )
    {{-- <i class="fas fa-sort-up fa-fw float-right" title="Asc"></i> --}}
    <i class="fas fa-sort-amount-up-alt fa-fw fa-xs ml-1" title="{{__('Sort Up')}}"></i>
        {{-- fa-sort-alpha-up-alt  --}}
        {{-- fa-sort-alpha-up --}}
        {{-- fa-sort-numeric-up --}}
@else
    {{-- <i class="fas fa-sort-down fa-fw float-right" title="Desc"></i> --}}
    <i class="fas fa-sort-amount-down fa-fw fa-xs ml-1" title="{{__('Sort Down')}}"></i>
    {{-- fa-sort-amount-down-alt --}}
@endif



@if ($direction === 'asc')
    <i class="fas fa-sort-amount-up-alt fa-fw fa-xs ml-1" title="{{__('Sort Up')}}"></i>
@elseif ($direction === 'desc')
    <i class="fas fa-sort-amount-down fa-fw fa-xs ml-1" title="{{__('Sort Down')}}"></i>
@else
    <i class="fas fa-arrows-alt-v fa-fw fa-xs text-muted ml-1"></i>
@endif
