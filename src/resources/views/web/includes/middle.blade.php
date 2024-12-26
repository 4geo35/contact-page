<div class="container">
    @php($firstContact = $contacts->first())

    <div id="mapData"
         data-longitude="{{ $firstContact->longitude }}"
         data-latitude="{{ $firstContact->latitude }}"></div>

    <div class="mb-indent">
        @include("ctp::web.includes.map")
    </div>

    <div class="row">
        @foreach($contacts as $contact)
            <div class="col w-full md:w-6/12 lg:w-3/12 mb-indent-half">
                <x-ctp::teaser :contact="$contact" />
            </div>
        @endforeach
    </div>
</div>
