<div class="d-flex justify-content-between mb-2">
    <div class="nowrap my-auto">
        @include('ball::includes.dtable.perpage')
    </div>
    @includeIf('ball::includes.dtable.loading')
    <div class="my-auto">
        @include('ball::includes.dtable.search')
    </div>
</div>
