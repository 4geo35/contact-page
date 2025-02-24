<div class="bg-white rounded-base shadow-md p-indent">
    <div class="h-full" x-data>
        @include("ctp::web.includes.title", ["teaser" => false])

        @include("ctp::web.includes.days")

        @if ($contact->description)
            <div class="text-secondary mb-indent-half">{{ $contact->description }}</div>
        @endif

        @include("ctp::web.includes.items")
    </div>
</div>
