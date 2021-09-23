@props([
    'color'     => null,
    'cardtype'  => null,
    'style'     => null,
    'title'     => null,
    'icon'      => null,
    // 'buttonsSlot'   => null,
    // 'miscSlot'   => null,
    // 'miscSlot'   => null,
    // 'removable'     => null,
    // 'collapsible'   => null, // ="collapsed" + plus ini
    // 'maximizable'   => null,
    'disabled'      => null,
])
@php
    $addClass = 'card';
    if( isset( $color ) ) {
        if( $color === '' ) {
            $color = config('ball.dsg.color');
        }
        if( isset( $cardtype ) ) {
            if($cardtype === 'outline') {
                $addClass = 'card-outline card-'.$color;
            }
            elseif( $cardtype === 'gradient' ) {
                $addClass = 'bg-gradient-'.$color;
            }
            elseif( $cardtype === 'background' ) {
                $addClass = 'bg-'.$color;
            }
            else {
                $addClass = 'card-'.$color;
            }
        }
    }
    // if( isset($collapsible) & ($collapsible === 'collapsed') ) {
    //     $addClass .= ' collapsed-card';
    // }
@endphp
<div {{ $attributes->merge(['class' => $addClass ]) }}>
    {{-- Card header --}}
    @isset($title)
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title"> {{-- Title --}}
                @isset($icon)<x-ball-icon icon="{{ $icon }}" fixed color="{{config('ball.dsg.color')}}" class="mr-1"/>@endisset {{-- icon --}}
                @isset($title){{ $title }}@endisset
            </h3>
            <div class="card-tools ml-auto">{{-- Tools --}}
                @isset( $buttonsSlot )      {{-- Buttons & Miscellaneous --}}
                    {{ $buttonsSlot }}
                @endisset
            </div>
        </div>
    @endisset

    {{-- Card body --}}
    @if(! $slot->isEmpty())
        <div class="card-body">{{ $slot }}</div>
    @endif

    @isset($footerSlot) {{-- Footer --}}
        <div class="card-footer text-muted p-2">
            <div class="d-flex align-items-center">
                <i class="fas fa-ellipsis-v fa-fw"></i>&nbsp;
                {{-- PatchBALL HELP <span class="">?</span> --}}
                <div class="ml-auto">
                    {{ $footerSlot }}
                </div>
            </div>
        </div>
    @endisset
    {{-- Card overlay --}}
    @if($disabled)
        <div class="overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin text-gray"></i>
        </div>
    @endif
</div>
