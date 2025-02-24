<section>
    @php($contact = $contacts->first())
    <div id="mapData"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"></div>

    <div class="mb-indent">
        @include("ctp::web.includes.map")
    </div>

    <div class="container">
        <div class="row" x-data="{ current: {{ $contact->id }} }">
            <div class="col w-1/3">
                <livewire:ctp-web-contact-item :contact="$contact" :items="$contacts" />
            </div>
            <div class="col w-2/3">
                @foreach($contacts as $item)
                    <x-ctp::teaser :contact="$item" />
                @endforeach
            </div>
        </div>
    </div>
</section>
