<x-app-layout>
    @include("ctp::web.includes.metas")
    @include("ctp::web.includes.breadcrumbs")
    @include("ctp::web.includes.h1")

    @if ($contacts->count())
        @include("ctp::web.includes.list")
    @else
        <div class="container">
            <x-tt::h4>Нет адресов</x-tt::h4>
        </div>
    @endif
</x-app-layout>
