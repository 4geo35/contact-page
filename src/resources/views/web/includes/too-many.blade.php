<div class="container">
    @php($firstContact = $contacts->first())

    <div id="mapData"
         data-longitude="{{ $firstContact->longitude }}"
         data-latitude="{{ $firstContact->latitude }}"></div>

    <div class="row">
        <div class="col w-full md:order-last mb-indent">
            @include("ctp::web.includes.map")
        </div>
        <div class="col w-full md:order-first mb-indent">
            <div class="row" x-data="{ current: 0 }">
                @foreach($contacts as $contact)
                    <div class="col w-full md:w-4/12">
                        <x-ctp::teaser-collapse :contact="$contact" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
