{{-- @if ($paginationEnabled && $showPerPage) --}}
    {{-- PatchBALL debug <span class="text-danger">{{ $this->perPage }}</span> --}}
    <div class="input-group input-group-sm">
        <div class="input-group-prepend">
            <label class="input-group-text bg-transparent border-0 m-0 p-0" for="inputPaginate">
                <i class="fas fa-list-ol fa-fw fa-lg text-primary mr-2"></i>
            </label>
        </div>
        {{-- Items per Page  --}}
        <select wire:model.debounce="perPage" class="form-control form-control-border custom-select custom-select-sm alert-default-info">
            @foreach ($this->perPageAccepted() as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
        {{-- Total Rows --}}
        {{-- @json( $this->perPageAccepted() ) --}}
        @if( $rows->total() )
            <div class="input-group-append">
                <span class="input-group-text bg-transparent rounded-pill border-0 ml-1" id="basic-addon2">
                    {{-- PatchBALL PAGINATOR Falta sin resultados --}}
                    Total <span class="badge rounded-pill bg-primary ml-2">{{ $rows->total() }}</span>
                </span>
            </div>
        @endif
    </div>
{{-- @endif --}}
