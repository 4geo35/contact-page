<div class="bg-white rounded-base shadow-md p-indent mb-indent {{ $items->count() > 1 ? 'relative z-10 lg:-mt-36' : '' }}" x-data>
    <div class="h-full space-y-indent">
        @include("ctp::web.includes.title", ["teaser" => false])
        @include("ctp::web.includes.days")
        @include("ctp::web.includes.items")
    </div>
</div>
