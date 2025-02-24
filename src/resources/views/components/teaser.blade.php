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

    <button type="button" class="cursor-pointer hover:text-primary-hover"
            @click="
                $dispatch('switch-contact', { id: {{ $contact->id }} });
                $dispatch('move-to', { el: $refs.contact{{ $contact->id }} });
                document.getElementById('map').scrollIntoView();
                current = {{ $contact->id }}
                ">
        {{ $contact->title }}
    </button>
</div>
