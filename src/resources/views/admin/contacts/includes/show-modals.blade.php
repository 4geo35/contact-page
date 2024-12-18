<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">{{ __("Delete contact") }}</x-slot>
    <x-slot name="text">{{ __("It will be impossible to restore the contact!") }}</x-slot>
</x-tt::modal.confirm>
