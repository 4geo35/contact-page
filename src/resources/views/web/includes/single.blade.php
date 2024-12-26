<div class="container" x-data>
    @php($contact = $contacts->first())
    <div id="mapData"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"></div>

    <div class="map-point" x-ref="contact{{ $contact->id }}"
         data-id="{{ $contact->id }}"
         data-title="{{ $contact->title }}"
         data-description="{{ $contact->address }}"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"
         data-ico="{{ $contact->ico }}"></div>

    <div class="row">
        <div class="col w-full md:w-8/12 lg:w-9/12 md:order-last mb-indent">
            @include("ctp::web.includes.map")
        </div>
        <div class="col w-full md:w-4/12 lg:w-3/12 md:order-first mb-3">
            <x-tt::h4 class="mb-indent-half cursor-pointer hover:text-body/40"
                      @click="$dispatch('move-to', { el: $refs.contact{{ $contact->id }} })">
                {{ $contact->title }}
            </x-tt::h4>
            @if ($contact->address)
                <div class="text-sm text-secondary mb-indent-half -mt-indent-half">{{ $contact->address }}</div>
            @endif

            @include("ctp::web.includes.days")

            @if ($contact->description)
                <div class="text-secondary mb-indent-half">{{ $contact->description }}</div>
            @endif

            @include("ctp::web.includes.items")
        </div>
    </div>
</div>
