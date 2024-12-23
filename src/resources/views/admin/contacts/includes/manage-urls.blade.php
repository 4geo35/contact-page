<div class="space-y-indent-half">
    <h3 class="text-2xl font-medium">{{ __("Url addresses") }}</h3>

    <x-tt::notifications.error prefix="url-" />
    <x-tt::notifications.success prefix="url-" />

    <form wire:submit.prevent="addUrl"
          class="flex flex-col md:flex-row items-center space-y-indent-half md:space-y-0 md:space-x-indent-half">
        <div class="w-full md:w-auto flex-auto">
            <input type="text" id="url" required
                   placeholder="{{ __('Url address') }}" aria-label="{{ __('Url address') }}"
                   class="form-control {{ $errors->has("url") ? "border-danger" : "" }}"
                   wire:loading.attr="disabled"
                   wire:model="url">
            <x-tt::form.error name="url"/>
        </div>

        <button type="submit" class="btn btn-primary w-full md:w-auto">
            {{ __("Add") }}
        </button>
    </form>

    @if ($urls->count())
        <div class="p-indent-half border border-secondary rounded-lg beautify-scrollbar overflow-x-auto">
            <table class="w-full">
                <tbody>
                @foreach($urls as $urlItem)
                    <tr>
                        @if ($displayUrlEdit && $itemId === $urlItem->id)
                            <td class="p-indent-xs" colspan="3">
                                <form wire:submit.prevent="updateUrl" class="flex items-center space-x-indent-half">
                                    <div class="flex-auto">
                                        <input type="text" id="editUrl" required
                                               placeholder="{{ __('Url address') }}" aria-label="{{ __('Url address') }}"
                                               class="form-control {{ $errors->has("editUrl") ? "border-danger" : "" }}"
                                               wire:loading.attr="disabled"
                                               wire:model="editUrl">
                                        <x-tt::form.error name="editUrl"/>
                                    </div>

                                    <div class="flex items-center space-x-indent-half">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __("Update") }}
                                        </button>

                                        <button type="button" class="btn btn-secondary" wire:click="closeUrlEdit">
                                            {{ __("Cancel") }}
                                        </button>
                                    </div>
                                </form>
                            </td>
                        @else
                            <td class="p-indent-xs">
                                <div class="flex items-center">
                                    <button type="button" class="btn btn-primary btn-sm px-btn-x-ico rounded-e-none"
                                            @if ($loop->last) disabled
                                            @else wire:loading.attr="disabled"
                                            @endif
                                            wire:click="moveDown({{ $urlItem->id }}, '{{ $urlItem->type }}')">
                                        <x-tt::ico.line-arrow-bottom width="18" height="18" />
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-s-none"
                                            @if ($loop->first) disabled
                                            @else wire:loding.attr="disabled"
                                            @endif
                                            wire:click="moveUp({{ $urlItem->id }}, '{{ $urlItem->type }}')">
                                        <x-tt::ico.line-arrow-top width="18" height="18" />
                                    </button>
                                </div>
                            </td>
                            <td class="p-indent-xs">
                                <div class="font-medium text-nowrap">{{ $urlItem->value }}</div>
                            </td>
                            <td class="p-indent-xs">
                                <div class="flex justify-end">
                                    <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                                            wire:loading.attr="disabled"
                                            wire:click="showUrlEdit({{ $urlItem->id }})">
                                        <x-tt::ico.edit />
                                    </button>
                                    <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                            wire:loading.attr="disabled"
                                            wire:click="showDelete({{ $urlItem->id }}, '{{ $urlItem->type }}')">
                                        <x-tt::ico.trash />
                                    </button>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
