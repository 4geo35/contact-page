@props(["contact"])

<div class="rounded-base shadow-md p-indent mb-indent transition-all"
     :class="current === {{ $contact->id }} ? 'bg-secondary/10' : 'bg-white'">
    <div class="map-point" x-ref="contact{{ $contact->id }}"
         data-id="{{ $contact->id }}"
         data-title="{{ $contact->title }}"
         data-description="{{ $contact->address }}"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"
         data-ico="{{ $contact->ico }}"></div>

    @include("ctp::web.includes.title")
</div>
