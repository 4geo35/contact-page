<div>
    <div class="space-y-indent-half mb-indent">
        <x-tt::notifications.error prefix="map-" />
        <x-tt::notifications.success prefix="map-" />

        <button type="button" class="btn btn-outline-primary"
                wire:click="saveCoordinates()"
                @if (! $newCoordinates) disabled @else wire:attribute.loading="disabled" @endif>
            {{ __("Save point coordinates") }}
        </button>
    </div>

    <div id="mapData"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"
         data-ico="{{ $contact->ico }}"></div>

    <div wire:ignore id="map" class="w-full h-[400px]"></div>
</div>

@push("scripts")
<script type="module">
    let map;

    (function () {
        document.addEventListener("DOMContentLoaded", function () {
            ymaps.ready(initMap)
        })
        Livewire.on('fresh-map', () => {
            setTimeout(() => freshMap(), 500)
        })
    })()

    async function freshMap() {
        map.destroy()
        await initMap()
    }

    async function initMap() {
        let element = document.querySelector("#mapData");
        let icon = element.getAttribute("data-ico");
        let longitude = element.getAttribute("data-longitude")
        let latitude = element.getAttribute("data-latitude")

        map = new ymaps.Map("map", {
            center: [longitude, latitude],
            zoom: {{ config('contact-page.defaultMapZoom') }},
            controls: ['smallMapDefaultSet']
        }, {
            searchControlProvider: 'yandex#search'
        })

        let pointToEvent = new ymaps.GeoObject({
            geometry: {
                type: "Point",
                coordinates: [longitude, latitude]
            }
        }, {
            draggable: true,
            preset: icon
        })

        map.events.add('click', function (e) {
            pointToEvent.geometry.setCoordinates(e.get('coords'))
            Livewire.dispatch("move-point", { coordinates: pointToEvent.geometry.getCoordinates() })
        })

        map.geoObjects.add(pointToEvent)
    }
</script>
@endpush
