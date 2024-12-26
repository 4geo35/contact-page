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
            if (map) map.destroy()
            await initMap()
        }

        async function initMap() {
            let element = document.querySelector("#mapData");
            if (! element) return
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
