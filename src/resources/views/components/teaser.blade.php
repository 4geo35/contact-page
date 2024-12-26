@props(["contact"])

<div class="h-full" x-data>
    <div class="map-point" x-ref="contact{{ $contact->id }}"
         data-id="{{ $contact->id }}"
         data-title="{{ $contact->title }}"
         data-description="{{ $contact->address }}"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"
         data-ico="{{ $contact->ico }}"></div>

    <x-tt::h4 class="mb-indent-half cursor-pointer hover:text-body/40"
              @click="$dispatch('move-to', { el: $refs.contact{{ $contact->id }} }); document.getElementById('map').scrollIntoView()">
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
