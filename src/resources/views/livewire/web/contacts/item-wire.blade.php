<div class="bg-white rounded-base shadow-md p-indent">
    <div class="h-full" x-data>
        <x-tt::h4 class="mb-indent-half cursor-pointer hover:text-body/40">
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
