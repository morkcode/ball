<div class="d-flex align-items-center">
    @if ($paginator->hasPages())
        {{-- <div class="badge rounded-pill bg-gray-light text-nowrap mr-2 p-2">
            {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}
        </div> --}}
        <nav role="navigation" aria-label="Pagination Navigation">
            <ul class="pagination mb-0">
                {{-- First Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item first active" aria-disabled="true" aria-label="first" title="{{__('First')}}">
                        <span class="page-link" aria-hidden="true">
                            <i class="fas fa-angle-double-left fa-fw"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item first">
                        <button type="button" dusk="resetPage" class="page-link" wire:click="resetPage"
                            wire:loading.attr="disabled" rel="reset" aria-label="{{__('First')}}" title="{{__('First')}}">
                            <i class="fas fa-angle-double-left fa-fw"></i>
                        </button>
                    </li>
                @endif
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item previous disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" title="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">
                            <i class="fas fa-angle-left fa-fw"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item previous">
                        <button type="button" dusk="previousPage" class="page-link" wire:click="previousPage"
                            wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')" title="@lang('pagination.previous')">
                            <i class="fas fa-angle-left fa-fw"></i>
                        </button>
                    </li>
                @endif

                {{-- Current Page --}}
                <li class="page-item text-center disabled" title="{{__('Current page')}}" aria-disabled="true" style="min-width:45px">
                    <span class="page-link bg-light" aria-hidden="true">
                        {{$paginator->currentPage()}}
                    </span>
                </li>

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item next">
                        <button type="button" dusk="nextPage" class="page-link" wire:click="nextPage"
                            wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')" title="@lang('pagination.next')">
                            <i class="fas fa-angle-right fa-fw"></i>
                        </button>
                    </li>
                @else
                    <li class="page-item next disabled" aria-disabled="true" aria-label="@lang('pagination.next')" title="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">
                            <i class="fas fa-angle-right fa-fw"></i>
                        </span>
                    </li>
                @endif
                {{-- Last Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item last">
                        <button type="button" dusk="lastPage" class="page-link"
                            wire:click="gotoPage( {{$paginator->lastPage()}} )" wire:loading.attr="disabled" rel="last" aria-label="Last" title="{{__('Last')}}">
                            <i class="fas fa-angle-double-right fa-fw"></i>
                        </button>
                    </li>
                @else
                    <li class="page-item last active" aria-disabled="true" aria-label="{{__('Last')}}" title="{{__('Last')}}">
                        <span class="page-link" aria-hidden="true">
                            <i class="fas fa-angle-double-right fa-fw"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
