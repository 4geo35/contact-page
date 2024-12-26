@if ($contact->phones)
    <ul class="mb-indent-sm">
        @foreach($contact->phones as $item)
            <li class="mb-2">
                <a href="tel:{{ $item->value }}" class="text-body hover:text-primary-hover font-semibold text-lg">
                    {{ $item->value }}
                </a>
                @if ($item->comment)
                    <br>
                    <span class="text-secondary text-sm">{{ $item->comment }}</span>
                @endif
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->emails)
    <ul class="mb-indent-sm">
        @foreach($contact->emails as $item)
            <li class="mb-2">
                <a href="mailto:{{ $item->value }}" class="text-body hover:text-primary-hover">
                    {{ $item->value }}
                </a>
                @if ($item->comment)
                    <br>
                    <span class="text-secondary text-sm">{{ $item->comment }}</span>
                @endif
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->urls)
    <ul class="mb-indent-sm">
        @foreach($contact->urls as $item)
            <li class="mb-2">
                <a href="{{ $item->value }}" target="_blank" class="text-body hover:text-primary-hover">
                    {{ $item->value }}
                </a>
            </li>
        @endforeach
    </ul>
@endif

@if ($contact->socials)
    <ul class="mb-indent-sm flex flex-wrap">
        @foreach($contact->socials as $item)
            <li class="pr-indent-half">
                <a href="{{ $item->value }}" target="_blank" title="{{ $item->comment }}" class="text-body hover:text-primary-hover">
                    @php($componentName = "ctp::ico.{$item->additionally}")
                    <x-dynamic-component :component="$componentName" class="w-8 h-8"/>
                </a>
            </li>
        @endforeach
    </ul>
@endif
