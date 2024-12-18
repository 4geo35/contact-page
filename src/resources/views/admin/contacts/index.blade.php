<x-admin-layout>
    <x-slot name="title">{{ __("Contacts") }}</x-slot>
    <x-slot name="pageTitle">{{ __("Contacts") }}</x-slot>

    <div class="space-y-indent-half">
        <livewire:ctp-contact-create />
        <div class="row">
            <div class="col w-1/3">
                <livewire:ctp-contact-list />
            </div>
            <div class="col w-2/3">
                <livewire:ctp-contact-show />
            </div>
        </div>
    </div>
</x-admin-layout>
