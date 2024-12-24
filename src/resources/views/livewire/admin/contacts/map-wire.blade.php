<div>
    <div class="space-y-indent-half mb-indent">
        <x-tt::notifications.error prefix="map-" />
        <x-tt::notifications.success prefix="map-" />

        @can("update", $contact)
            <button type="button" class="btn btn-outline-primary"
                    wire:click="saveCoordinates()"
                    @if (! $newCoordinates) disabled @else wire:attribute.loading="disabled" @endif>
                {{ __("Save point coordinates") }}
            </button>
        @endcan
    </div>

    <div id="mapData"
         data-longitude="{{ $contact->longitude }}"
         data-latitude="{{ $contact->latitude }}"
         data-ico="{{ $contact->ico }}"></div>

    <div wire:ignore id="map" class="w-full h-[400px]"></div>
</div>
