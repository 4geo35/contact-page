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
                <div class="row">
                    @foreach($contacts as $item)
                        <div class="col w-1/2 mb-indent">
                            <x-ctp::teaser :contact="$item" />
                        </div>
                    @endforeach
                </div>
                @include("ctp::web.includes.under-list")
            </div>
        </div>
    </div>
</section>
