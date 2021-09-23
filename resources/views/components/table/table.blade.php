@props([
    'hover'     => null,
    'striped'   => null,
    'valign'    => null,
    'borders'   => null,    // [ none | true | false ]
    'small'     => null,
    // 'size'      => null,    // PatcBALL next version
])
@php
    $addClass       = 'table';

    if (isset($hover))
        $addClass .= ' table-hover';

    if (isset($striped))
        $addClass .= ' table-striped';

    if (isset($valign))
        $addClass .= ' table-valign-middle';

    // if (isset($valign))
    //     $addClass .= ' table-valign-middle';

    if (isset($borders))
        if( $borders === true )
            $addClass .= ' table-bordered';
        else
            $addClass .= ' table-borderless';

    if (isset($small))
        $addClass .= ' table-sm';

    /*
    $tableSizes     = ['sm', 'lg', 'xl'];
    if (isset($size) && in_array($size, $tableSizes))
         $addClass .= ' table-'.$size;
    */
@endphp
@if( isset( $this->debug ) && $this->debug ) {!!$this->totalWidthColumns()!!} @endif
<div class="table-responsive mb-4 mb-sm-auto">
    <table {{ $attributes->merge(['class' => $addClass ]) }}>
        @isset( $thead )
            {{ $thead }}
        @endisset

            {{ $tbody }}

        @isset( $tfoot )
            {{ $tfoot }}
        @endisset
    </table>
</div>
