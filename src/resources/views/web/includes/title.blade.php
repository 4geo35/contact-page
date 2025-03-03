@props(["teaser" => true])

<div class="flex">
    <div class="mr-indent">
        <x-ctp::ico.place />
    </div>
    <div>
        @if ($teaser)
            <div class="text-lg font-semibold leading-6 cursor-pointer hover:text-body/40"
                 @click="
                $dispatch('switch-contact', { id: {{ $contact->id }} });
                $dispatch('move-to', { el: $refs.contact{{ $contact->id }} });
                document.getElementById('map').scrollIntoView();
                current = {{ $contact->id }}
                ">
                {{ $contact->title }}
            </div>
        @else
            <div class="text-lg font-semibold leading-6">
                {{ $contact->title }}
            </div>
        @endif
        @if ($contact->address)
            <div class="text-body/60">{{ $contact->address }}</div>
        @endif
        @if ($contact->description && ! $teaser)
            <div class="text-sm text-body/60">{{ $contact->description }}</div>
        @endif
    </div>
</div>
