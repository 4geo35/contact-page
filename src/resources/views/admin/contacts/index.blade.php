<x-admin-layout>
    <x-slot name="title">{{ __("Contacts") }}</x-slot>
    <x-slot name="pageTitle">{{ __("Contacts") }}</x-slot>

    <div class="space-y-indent-half">
        @can("create", config("contact-page.customContactModel") ?? \GIS\ContactPage\Models\Contact::class)
            <livewire:ctp-contact-create />
        @endcan
        <div class="row">
            <div class="col w-full md:w-1/3">
                <livewire:ctp-contact-list />
            </div>
            <div class="col w-full md:w-2/3">
                <livewire:ctp-contact-show />
            </div>
        </div>
    </div>

    @push("js-lib")
        <script src="https://api-maps.yandex.ru/2.1/?apikey={{ config('contact-page.mapApiKey') }}&lang=ru_RU"
                type="text/javascript">
        </script>
    @endpush
</x-admin-layout>
