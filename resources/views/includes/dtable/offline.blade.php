{{-- @if( $offlineIndicator ) --}}
{{-- @include('ball::includes.dtable.offline') --}}
    <div wire:offline.class.remove="d-none" class="d-none m-0">
        <div class="alert alert-danger d-flex align-items-center  m-0">
            <i class="fas fa-exclamation-circle"></i>
            <span class="d-inline-block ml-2">@lang('You are not connected.')</span>
        </div>
    </div>
{{-- @endif --}}
