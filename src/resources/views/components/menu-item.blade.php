@can("viewAny", config("contact-page.customContactModel") ?? \GIS\ContactPage\Models\Contact::class)
    <x-tt::admin-menu.item href="{{ route('admin.contacts') }}"
                           :active="\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.contacts'">
        <x-slot name="ico"><x-ctp::ico.contacts /></x-slot>
        {{ __("Contacts") }}
    </x-tt::admin-menu.item>
@endcan
