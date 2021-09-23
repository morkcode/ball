@if ($paginationEnabled && $rows->lastPage() > 1)
    <div class="d-flex justify-content-between align-items-center">
        {{-- Records, Pages & Totals --}}
        <nav role="navigation" aria-label="Pagination Navigation">
            <ul class="pagination mb-0">
                <li class="page-item">
                    <span class="page-link bg-light border-0 rounded-pill text-xs">
                        <div class="d-none d-sm-inline">
                            {{-- PatchBALL PAGINATOR --}}
                            {{ $rows->firstItem() }} @lang('to') {{ $rows->lastItem() }}
                            @lang('Page') {{ $page }} @lang('of') {{ $rows->lastPage() }} ·
                        </div>
                        {{-- Total Rows --}}
                        {{-- PatchBALL PAGINATOR --}}
                        <div class="d-inline ml-auto text-primary text-bold">@lang('Total') {{ $rows->total() }}</div>
                    </span>
                </li>
            </ul>
        </nav>
        {{--
            PatchBALL PAGINATOR
            WithPagination
            WithPaginationInfo
            Ver:
            - Show Legenda
            - Total
            - Pagination
        --}}
        {{ $rows->links( config('ball.table.pagination','vendor.livewire.bootstrap')) }}
    </div>
@else
    @if( $rows->total() )
        <div class="page-link bg-light border-0 rounded-pill text-xs">
            <div class="d-inline ml-auto text-primary text-bold">@lang('Total') {{ $rows->total() }}</div>
        </div>
    @endif
@endif
