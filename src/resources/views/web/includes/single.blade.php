<div class="container">
    @php($contact = $contacts->first())
    <div id="mapData"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"></div>

    <div class="row">
        <div class="col w-full md:w-8/12 lg:w-9/12 md:order-last mb-indent">
            @include("ctp::web.includes.map")
        </div>
        <div class="col w-full md:w-4/12 lg:w-3/12 md:order-first mb-3">
            <x-ctp::teaser :contact="$contact" />
        </div>
    </div>
</div>
