@props([
    'color'     => null,
    'cardtype'  => null,
    'style'     => null,
    'title'     => null,
    'icon'      => null,
    // 'buttonsSlot'   => null,
    // 'miscSlot'   => null,
    // 'miscSlot'   => null,
    'removable'     => null,
    'collapsible'   => null,
    'maximizable'   => null,
    'disabled'      => null,
])
@php
    $addclass = null;
    if( isset( $color ) ) {
        if( $color === '' ) {
            $color = config('ball.dsg.color');
        }
        if( isset( $cardtype ) ) {
            if($cardtype === 'outline') {
                $addclass = 'card-outline card-'.$color;
            }
            elseif( $cardtype === 'gradient' ) {
                $addclass = 'bg-gradient-'.$color;
            }
            elseif( $cardtype === 'background' ) {
                $addclass = 'bg-'.$color;
            }
            else {
                $addclass = 'card-'.$color;
            }
        }
    }
@endphp
<div {{ $attributes->merge(['class' => "card {$addclass}"]) }} >
    {{-- Card header --}}
    @isset($title)
        <div class="card-header d-flex justify-content-between align-items-center">
            {{-- Title --}}
            <h3 class="card-title">
                @isset($icon)<x-ball-icon icon="{{ $icon }}"/>@endisset
                {{-- @isset($icon)<i class="{{ $icon }} mr-2"></i>@endisset --}}
                @isset($title){{ $title }}@endisset
            </h3>
            {{-- Tools --}}
            <div class="card-tools ml-auto">
                @isset($maximizable)
                    <x-ball-button theme="tool" data-card-widget="maximize" icon="fas fa-lg fa-expand"/>
                @endisset

                @if($collapsible === 'collapsed')
                    <x-ball-button theme="tool" data-card-widget="collapse" icon="fas fa-lg fa-plus"/>
                @elseif (isset($collapsible))
                    <x-ball-button theme="tool" data-card-widget="collapse" icon="fas fa-lg fa-minus"/>
                @endif

                @isset($removable)
                    <x-ball-button theme="tool" data-card-widget="remove" icon="fas fa-lg fa-times"/>
                @endisset

                {{-- Buttons & Miscellaneous --}}
                @isset( $buttonsSlot )
                    {{ $buttonsSlot }}
                @endisset
            </div>
        </div>
    @endisset

    {{-- Card body --}}
    @if(! $slot->isEmpty())
        <div class="card-body">{{ $slot }}</div>
    @endif

    {{-- @if(! $footerSlot->isEmpty()) --}}
    @isset($footerSlot)
        <div class="card-footer text-muted p-2">
            <div class="d-flex align-items-center">
                <i class="fas fa-ellipsis-v fa-fw"></i>&nbsp;
                {{-- HELP <span class="">?</span> --}}
                <div class="ml-auto">
                    {{-- {{$botonesizq}} --}}
                    {{ $footerSlot }}
                </div>
            </div>
        </div>
    @endisset
    {{-- @endif --}}

    {{-- Card overlay --}}
    @if($disabled)
        <div class="overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin text-gray"></i>
        </div>
    @endif
</div>
