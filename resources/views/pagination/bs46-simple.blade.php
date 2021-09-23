<div>
    @if ($paginator->hasPages())
        <nav>
            <ul class="pagination mb-0">
                {{-- First Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item first active" aria-disabled="true">
                        <span class="page-link">@lang('First')</span>
                    </li>
                @else
                    <li class="page-item first">
                        <li class="page-item" wire:key="paginator-page-1">
                            <button type="button" class="page-link" wire:click="resetPage">@lang('First')</button>
                        </li>
                    </li>
                @endif

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <button type="button" class="page-link" wire:click="previousPage" wire:loading.attr="disabled" rel="prev">@lang('pagination.previous')</button>
                    </li>
                @endif

                {{-- Show Current Page --}}
                @if( config('ball.table.show_current_page', false) )
                    <li class="page-item text-center disabled" title="@lang('Current page')" aria-disabled="true" style="min-width:45px">
                        <span class="page-link bg-light" aria-hidden="true">
                            {{$paginator->currentPage()}}
                        </span>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button type="button" class="page-link" wire:click="nextPage" wire:loading.attr="disabled" rel="next">@lang('pagination.next')</button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif

                {{-- Last Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                         {{-- PatchBALL PAGINATOR Error lastPage --}}
                        <button type="button" class="page-link" wire:click="gotoPage( {{$paginator->lastPage()}} )" wire:loading.attr="disabled" rel="last">@lang('Last')</button>
                    </li>
                @else
                    <li class="page-item last active" aria-disabled="true">
                        <span class="page-link">@lang('Last')</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
