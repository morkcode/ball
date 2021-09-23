@php
    $icon_asc   = '';
    $icon_desc  = '';
    switch( $stype ) {
        case 'str':
            $icon_asc  = 'fa-sort-alpha-up';
            $icon_desc = 'fa-sort-alpha-down-alt';
            break;
        case 'num':
        case 'date':
            $icon_asc  = 'fa-sort-numeric-up';
            $icon_desc = 'fa-sort-numeric-down-alt';
            break;
        case 'on':
            $icon_asc  = 'fa-toggle-off fa-xs';
            $icon_desc = 'fa-toggle-on fa-xs';
            break;
        case 'dec':
            $icon_asc  = 'fa-sort-amount-up-alt';
            $icon_desc = 'fa-sort-amount-down';
            break;
        default:
            $icon_asc  = 'fa-long-arrow-alt-up';
            $icon_desc = 'fa-long-arrow-alt-down';
    }
    $direction = $this->sortOrderView( $data, $direction );
@endphp
@if ($direction === 'asc')
    <i class="fas {{$icon_asc ?? 'fa-long-arrow-alt-up'}} fa-fw ml-1 text-success" title="{{ $title }}: @lang('Sort Up')" style="min-width:1rem;"></i>
@elseif ($direction === 'desc')
    <i class="fas {{$icon_desc ?? 'fa-long-arrow-alt-down'}} fa-fw ml-1 text-success" title="{{ $title }}: @lang('Sort Up')" style="min-width:1rem;"></i>
@else
    <i class="fas fa-arrows-alt-v fa-fw ml-1" title="@lang('Reset to default')" style="min-width:1rem;opacity: .3"></i>
@endif
