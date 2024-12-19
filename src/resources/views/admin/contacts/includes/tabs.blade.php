<div class="card overflow-visible" x-data="{ show: 'items' }">
    <div class="card-header">
        <x-tt::tabs class="flex items-center space-x-indent-half">
            <x-tt::tabs.item name="items"
                             active="bg-primary text-white"
                             passive="bg-transparent text-primary hover:text-primary-hover"
                             class="px-indent py-indent-half mb-2 rounded-xl">
                {{ __("Contacts") }}
            </x-tt::tabs.item>
            <x-tt::tabs.item name="map"
                             active="bg-primary text-white"
                             passive="bg-transparent text-primary hover:text-primary-hover"
                             class="px-indent py-indent-half mb-2 rounded-xl">
                {{ __("Map") }}
            </x-tt::tabs.item>
            <x-tt::tabs.item name="workDays"
                             active="bg-primary text-white"
                             passive="bg-transparent text-primary hover:text-primary-hover"
                             class="px-indent py-indent-half mb-2 rounded-xl">
                {{ __("Work days") }}
            </x-tt::tabs.item>
        </x-tt::tabs>
    </div>
    <div class="card-body">
        <x-tt::tabs.content name="items">
            <livewire:ctp-contact-items :contact="$contact" />
        </x-tt::tabs.content>

        <x-tt::tabs.content name="map">
            <livewire:ctp-contact-map :contact="$contact" />
        </x-tt::tabs.content>

        <x-tt::tabs.content name="workDays">Work days</x-tt::tabs.content>
    </div>
</div>
