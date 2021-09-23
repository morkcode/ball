@if ($searchingEnabled )
    <div class="input-group input-group-sm">
        <div class="input-group-prepend">
            <button class="btn dropdown-toggle border-0"
                type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="@lang('Search')">
                <x-ball-icon icon="search" color="{{config('ball.dsg.color')}}" fixed size="lg"/>
            </button>
            <div class="dropdown-menu alert-default-info border-info">
                <div class="form-group px-2 mb-1">
                    <span class="text-left font-italic">Buscar por:</span>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" wire:model="searchType" value="1">
                        <label class="form-check-label"> las palabras</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" wire:model="searchType" value="2">
                        <label class="form-check-label"> la frase</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" wire:model="searchType" value="3">
                        <label class="form-check-label">Comienza con frase</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" wire:model="searchType" value="4">
                        <label class="form-check-label">Frase exacta</label>
                    </div>
                </div>
            </div>
        </div>
        {{-- PatchBALL ver tiempo de debounce ms?? 500 --}}

        <input class="form-control form-control-border"
            {{-- @if( strlen($this->q ) > 0 && strlen($this->q ) < 3 ) is-invalid @endif" --}}

            {{--
            x-data="{q: @entangle('q')}"
            x-on:change="console.log('q');"
            --}}
            {{-- x-model.debounce.500ms="q" --}}
            type="text"
            wire:model.debounce.1500ms="q"
            wire:keydown.escape="resetSearch()"
            aria-label="@lang('Search')"
            autocomplete="off"
            data-widget="sidebar-search"
            placeholder="@lang('Search')...">

        <p class="text-danger">
            A:<span x-text="q"></span>
            L:{{$q}}
        </p>
        {{-- <input class="form-control form-control-border
                @if( strlen($this->q ) > 0 && strlen($this->q ) < 3 ) is-invalid @endif"
                type="text"
                wire:model.debounce.500ms="q"
                wire:keydown.escape="resetSearch()"
                aria-label="@lang('Search')"
                autocomplete="off"
                data-widget="sidebar-search"
                placeholder="@lang('Search')...">
                --}}
        {{-- * for Safari, Firefox | Chome? Edge?  --}}
        <div class="input-group-append d-flex align-items-center border-bottom">
            <span wire:target="q"
                wire:click="resetSearch()"
                class="fas fa-times-circle @if( !isset($q) ) disabled text-white @endif" type="reset" title="@lang('Reset')"
                style="opacity:0.2">
            </span>
        </div>
        {{-- <div class="input-group-append d-flex align-items-center border-bottom">
            <a wire:target="q"
                wire:click="resetSearch()"
                class="btn border-0 @if( !isset($q) ) disabled text-white @endif" type="reset" title="@lang('Reset')"
                style="opacity:0.2">
                <x-ball-icon icon="reset" fixed/>
            </a>
        </div> --}}
    </div>

@endif
