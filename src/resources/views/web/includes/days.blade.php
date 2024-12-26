@if (count($contact->dayGroups))
    <ul class="mb-indent-half space-y-1">
        @if (count($contact->dayGroups) == 1)
            <li class="flex flex-nowrap items-start">
                <span class="">
                    <span class="text-nowrap">{{ $contact->dayGroups[0]["time"] }}</span>
                    {{ $contact->dayGroups[0]["dinerTime"]? " (обед ".$contact->dayGroups[0]["dinerTime"].")" : "(без обеда)" }}
                </span>
            </li>
            <li class="flex flex-nowrap items-center">
                <span class="text-sm">Без выходных</span>
            </li>
        @else
            @foreach($contact->dayGroups as $day)
                <li class="flex flex-nowrap items-start">
                    @if ($day["start"] != $day["end"])
                        <span class=" pr-2 text-nowrap">{{ $day["start"] }} - {{ $day["end"] }}:</span>
                    @else
                        <span class=" pr-2 text-nowrap">{{ $day["start"] }}:</span>
                    @endif
                    <span class="text-sm">
                        {{ $day["time"] ? $day["time"] : "Выходной" }}
                        @if($day["time"])
                            <span class="text-nowrap">{{ $day["dinerTime"] ? " (обед ".$day["dinerTime"].")" : " (без обеда)" }}</span>
                        @endif
                    </span>
                </li>
            @endforeach
        @endif
    </ul>
@endif
