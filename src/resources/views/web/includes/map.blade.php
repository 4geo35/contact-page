@push("js-lib")
    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('contact-page.mapApiKey') }}&lang=ru_RU"
            type="text/javascript">
    </script>
@endpush

<div wire:ignore id="map" class="w-full h-[400px]"></div>

@include("ctp::web.includes.map-script")
