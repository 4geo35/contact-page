@push("scripts")
    <script type="module">
        let map;

        (function () {
            document.addEventListener("DOMContentLoaded", function () {
                ymaps.ready(initMap)
            })

            window.addEventListener('move-to', (e) => {
                let element = e.detail.el
                let longitude = element.getAttribute("data-longitude")
                let latitude = element.getAttribute("data-latitude")

                if (! map) return
                map.setCenter([longitude, latitude], {{ config('contact-page.defaultMapZoom') }}, {
                    duration: 400
                }).then(function () {
                    e.detail.el.pointObject.balloon.open()
                })
            })
        })()

        async function initMap() {
            let element = document.querySelector("#mapData");
            if (! element) return
            let longitude = element.getAttribute("data-longitude")
            let latitude = element.getAttribute("data-latitude")

            map = new ymaps.Map("map", {
                center: [longitude, latitude],
                zoom: {{ config('contact-page.defaultMapZoom') }},
                controls: ['smallMapDefaultSet']
            })
            map.behaviors.disable("scrollZoom")

            let points = document.querySelectorAll(".map-point");

            points.forEach(function (el) {
                let pointObject = new ymaps.Placemark([el.getAttribute("data-longitude"), el.getAttribute("data-latitude")], {
                    balloonContentHeader: el.getAttribute("data-title"),
                    balloonContentBody: el.getAttribute("data-description")
                }, {
                    preset: el.getAttribute("data-ico")
                })

                map.geoObjects.add(pointObject)
                el.pointObject = pointObject
            })
        }
    </script>
@endpush
