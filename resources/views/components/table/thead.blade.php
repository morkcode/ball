@props([
    'data',
    'stype'     => null,
    'sortingEnabled' => true,
    'sortable'  => false,
    'direction' => null,
    'title'     => null,
    'icon'      => null,
    'class'     => null,
    'width'     => null,
])
{{--
PatchBALL
@todo
    - Ver de Visible o no para search
    - Visible para Celulares
--}}
@unless( $sortingEnabled && $sortable )
    <th {{ $attributes->merge(['class' => 'text-center ' . $class ] ?? '') }} title="{{ $title }}"
        @isset($width) style="width:{{$width}}%;" @endisset>
        @isset($icon)<x-ball-icon icon="{{ $icon }}"/>@endisset {{-- icon --}}
        {{ $title }}
    </th>
@else
    <th wire:click="sortBy('{{ $data }}')"
        :direction="$direction"
        {{ $attributes->merge(['class' => $class ] ?? '') }} title="{{ $title }}"
        style="@isset($width)width:{{$width}}%;@endisset cursor:pointer;">
        <div class="d-flex align-items-center">
            @if( isset( $icon ) || isset( $title ) )
                <span class="w-100 text-center">
                    @isset($icon)<x-ball-icon icon="{{ $icon }}"/>@endisset {{-- icon --}}
                    {{ $title }}
                    {{-- ·  {!! $sort_showkey !!} --}}
                </span>
            @endif
            <span class="flex-shrink-1 text-center">
                @include('ball::includes.table.sort_icons')
            </span>
        </div>
    </th>
@endif
