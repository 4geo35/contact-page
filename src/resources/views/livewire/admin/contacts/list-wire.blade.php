<div class="card mb-indent">
    <div class="card-body">
        @if (!$contacts->count())
            <p>{{ __("List is empty") }}</p>
        @endif
        <div class="space-y-indent-half">
            <x-tt::notifications.error prefix="list-" />
            <x-tt::notifications.success prefix="list-" />
            <x-tt::table drag-root>
                <x-slot name="body">
                    @foreach($contacts as $key => $item)
                        <tr drag-item="{{ $item->id }}" drag-item-order="{{ $key }}" wire:key="{{ $item->id }}">
                            <td class="align-middle border-none !px-0 !py-indent-half">
                                <div class="flex items-center h-full">
                                    <x-tt::ico.bars drag-grab class="text-secondary mr-indent cursor-grab" />
                                    <button type="button" class="w-full text-left hover:text-primary cursor-pointer {{ $contactId === $item->id ? 'underline text-primary' : '' }}"
                                            wire:click="setContact({{ $item->id }})">
                                        {{ $item->title }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-tt::table>
        </div>
    </div>
</div>

@include("tt::admin.draggable-script")
