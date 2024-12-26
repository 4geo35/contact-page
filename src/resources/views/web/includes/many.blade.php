<div class="container">
    @php($firstContact = $contacts->first())

    <div id="mapData"
         data-longitude="{{ $firstContact->longitude }}"
         data-latitude="{{ $firstContact->latitude }}"></div>

    <div class="row">
        <div class="col w-full md:w-8/12 lg:w-9/12 md:order-last mb-indent">
            @include("ctp::web.includes.map")
        </div>
        <div class="col w-full md:w-4/12 lg:w-3/12 md:order-first mb-indent">
            <div x-data="{ current: 0 }">
                @foreach($contacts as $contact)
                    <x-ctp::teaser-collapse :contact="$contact" />
                @endforeach
            </div>
        </div>
    </div>
</div>
