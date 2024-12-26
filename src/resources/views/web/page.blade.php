<x-app-layout>
    @include("ctp::web.includes.metas")
    @include("ctp::web.includes.breadcrumbs")
    @include("ctp::web.includes.h1")

    @if ($contacts->count() === 1)
        @include("ctp::web.includes.single")
    @elseif($contacts->count() <= 4)
        Middle
    @elseif($contacts->count() > 8)
        Too many
    @elseif($contacts->count() > 4)
        Many
    @else
        No address
    @endif
</x-app-layout>
