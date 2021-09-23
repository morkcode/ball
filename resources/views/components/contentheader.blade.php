<div class="d-flex align-items-center">
    <div class="mr-3">
        <h5 class="font-weight-light text-bold text-dark-shadow">
            @if(! $slot->isEmpty())
                {{ $slot }}
            @else
                @yield('title')
            @endif
        </h5>
    </div>
    <div class="ml-auto">
        <h6 class="font-weight-light text-dark-shadow text-nowrap">
            @isset($footerSlot)
                {{ $footerSlot }}
            @endisset
        </h6>
    </div>
</div>
