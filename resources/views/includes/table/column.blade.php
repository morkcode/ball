@foreach($columns as $column)
    @if( is_visible( $column->visible ?? '' ) )
        <x-ball-thead
            :data="$column->field"
            :sortingEnabled="$sortingEnabled"
            :stype="$column->stype ?? null"
            :sortable="is_sortable( $column->sortable ?? false )"
            :direction="$this->sortBy === $column->field ? $this->sort : null"
            :title="$column->title ?? ''"
            :icon="$column->icon ?? null"
            :class="$column->class ?? null"
            :width="$column->width ?? null"
            />
    @endif
@endforeach
{{-- Actions --}}
@isset( $this->actionsWidth )
    <th class="text-center" style="width:{{$actionsWidth}}%;" title="@lang('Actions')">
        <i class="fas fa-ellipsis-h fa-fw text-primary"></i>
    </th>
@endif
