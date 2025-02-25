<section>
    @php($contact = $contacts->first())
    <div id="mapData"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"></div>

    @if ($contacts->count() == 1)
        <div class="container">
            <div class="row">
                <div class="col w-full lg:w-1/2 xl:w-1/3 order-last lg:order-first">
                    <livewire:ctp-web-contact-item :contact="$contact" :items="$contacts" />
                </div>
                <div class="col w-full lg:w-1/2 xl:w-2/3 order-first lg:order-last">
                    <div class="mb-indent">
                        @include("ctp::web.includes.map")
                    </div>
                    <div class="hidden">
                        <x-ctp::teaser :contact="$contact" />
                    </div>
                    @include("ctp::web.includes.under-list")
                </div>
            </div>
        </div>
    @else
        <div class="mb-indent">
            @include("ctp::web.includes.map")
        </div>

        <div class="container">
            <div class="row" x-data="{ current: {{ $contact->id }} }">
                <div class="col w-1/3">
                    <livewire:ctp-web-contact-item :contact="$contact" :items="$contacts" />
                </div>
                <div class="col w-2/3">
                    <div class="row {{ $contacts->count() <= 1 ? 'hidden' : '' }}">
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
    @endif
</section>
