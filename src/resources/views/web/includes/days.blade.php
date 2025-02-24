@if (count($contact->dayGroups))
    <div class="flex items-start justify-start">
        <div class="mr-indent">
            <x-ctp::ico.calendar />
        </div>
        <div class="space-y-2 flex-auto">
            @foreach($contact->dayGroups as $day)
                <div class="flex items-stretch justify-start">
                    <div class="w-2 mr-indent-sm rounded-full {{ empty($day['time']) ? 'bg-[#E58787]' : 'bg-[#ABE587]' }}"></div>
                    <div class="flex-auto">
                        <div class="text-body text-sm">
                            @if ($day["start"] != $day["end"]) {{ $day["start"] }} - {{ $day["end"] }}
                            @else {{ $day["start"] }}
                            @endif
                        </div>
                        <div class="flex items-end justify-between border-b border-stroke">
                            <div class="text-body text-lg">
                                {{ empty($day["time"]) ? "Выходной" : $day["time"] }}
                            </div>
                            @if (! empty($day["time"]))
                                <div class="text-body/40 text-sm">
                                    {{ $day["dinerTime"] ? "Обед {$day['dinerTime']}" : "Без обеда" }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
