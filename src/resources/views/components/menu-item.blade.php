{{--TODO: add can--}}

<x-tt::admin-menu.item href="{{ route('admin.contacts') }}" :active="\Illuminate\Support\Facades\Route::currentRouteName() == 'admin.contacts'">
    <x-slot name="ico"><x-cp::ico.contacts /></x-slot>
    {{ __("Contacts") }}
</x-tt::admin-menu.item>
