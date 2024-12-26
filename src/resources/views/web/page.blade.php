<x-app-layout>
    @include("ctp::web.includes.metas")
    @include("ctp::web.includes.breadcrumbs")
    @include("ctp::web.includes.h1")

    @if ($contacts->count() === 1)
        @include("ctp::web.includes.single")
    @elseif($contacts->count() <= 4)
        @include("ctp::web.includes.middle")
    @elseif($contacts->count() > 8)
        @include("ctp::web.includes.too-many")
    @elseif($contacts->count() > 4)
        @include("ctp::web.includes.many")
    @else
        <div class="container">
            <x-tt::h4>Нет адресов</x-tt::h4>
        </div>
    @endif
</x-app-layout>
