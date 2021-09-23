@props([
    'direction' => null
])
@if ($direction === 'asc')
    <i class="fas fa-sort-amount-up-alt fa-fw fa-xs ml-1" title="{{__('Sort Up')}}"></i>
@elseif ($direction === 'desc')
    <i class="fas fa-sort-amount-down fa-fw fa-xs ml-1" title="{{__('Sort Down')}}"></i>
@else
    <i class="fas fa-arrows-alt-v fa-fw fa-xs text-muted ml-1"></i>
@endif
