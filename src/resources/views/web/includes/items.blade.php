@if ($contact->phones)
    <div class="flex">
        <div class="mr-indent">
            <x-ctp::ico.phone />
        </div>
        <div class="space-y-2">
            @foreach($contact->phones as $item)
                <div>
                    @if ($item->comment)
                        <div class="text-body/60 leading-5">{{ $item->comment }}</div>
                    @endif
                    <a href="tel:{{ $item->value }}" class="text-body hover:text-primary-hover font-bold text-lg leading-6">
                        {{ $item->value }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if ($contact->emails)
    <div class="flex">
        <div class="mr-indent">
            <x-ctp::ico.email />
        </div>
        <div class="space-y-2">
            @foreach($contact->emails as $item)
                <div>
                    @if ($item->comment)
                        <div class="text-body/60 leading-5">{{ $item->comment }}</div>
                    @endif
                    <a href="mailto:{{ $item->value }}" class="text-body hover:text-primary-hover font-bold text-lg leading-6">
                        {{ $item->value }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif

@if ($contact->urls)
    <div class="flex">
        <div class="mr-indent">
            <x-ctp::ico.web />
        </div>
        <div class="space-y-2">
            @foreach($contact->urls as $item)
                <a href="{{ $item->value }}" target="_blank" class="text-body hover:text-primary-hover font-bold text-lg leading-6">
                    {{ $item->value }}
                </a>
            @endforeach
        </div>
    </div>
@endif

@if ($contact->socials)
    <div class="flex">
        <div class="mr-indent">
            <x-ctp::ico.socials />
        </div>
        <div class="flex flex-wrap">
            @foreach($contact->socials as $item)
                <div class="pr-indent-half">
                    <a href="{{ $item->value }}" target="_blank" title="{{ $item->comment }}" class="text-body/60 hover:text-primary-hover">
                        @php($componentName = "ctp::ico.{$item->additionally}")
                        <x-dynamic-component :component="$componentName" class="w-8 h-8"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
