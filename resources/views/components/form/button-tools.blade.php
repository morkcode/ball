@props([
    'removable'     => null,
    'collapsible'   => null, // ="collapsed" => in Card add collapsed-card
    'maximizable'   => null,
    'disabled'      => null,
])
@isset($maximizable)
    <button type="tool" class="btn btn-tool" data-card-widget="maximize" title="@lang('Maximize')"><x-ball-icon icon="maximize"/></button>
@endisset
@if($collapsible === 'collapsed')
    <button type="tool" class="btn btn-tool" data-card-widget="collapse" title="@lang('Expanded')/@lang('Collapse')"><x-ball-icon icon="expanded"/></button>
@elseif (isset($collapsible))
    <button type="tool" class="btn btn-tool" data-card-widget="collapse" title="@lang('Collapse')/@lang('Expanded')"><x-ball-icon icon="collapse"/></button>
@endif
@isset($removable)
    <button type="tool" class="btn btn-tool" data-card-widget="remove" title="@lang('Remove')"><x-ball-icon icon="remove"/></button>
@endisset
