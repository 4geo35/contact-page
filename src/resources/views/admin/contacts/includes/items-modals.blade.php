<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">{{ __("Delete item") }}</x-slot>
    <x-slot name="text">{{ __("It will be impossible to restore the item!") }}</x-slot>
</x-tt::modal.confirm>
