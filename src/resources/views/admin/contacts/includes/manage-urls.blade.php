<div class="space-y-indent-half">
    <h3 class="text-2xl font-medium">{{ __("Url addresses") }}</h3>

    <x-tt::notifications.error prefix="url-" />
    <x-tt::notifications.success prefix="url-" />

    <form wire:submit.prevent="addUrl" class="flex items-center space-x-indent-half">
        <div>
            <input type="text" id="url" required
                   placeholder="{{ __('Url address') }}" aria-label="{{ __('Url address') }}"
                   class="form-control {{ $errors->has("url") ? "border-danger" : "" }}"
                   wire:loading.attr="disabled"
                   wire:model="url">
            <x-tt::form.error name="url"/>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __("Add") }}
        </button>
    </form>

    @if ($urls->count())
        <div class="space-y-indent-half p-indent border border-secondary rounded-lg">
            @foreach($urls as $urlItem)
                @if ($displayUrlEdit && $itemId === $urlItem->id)
                    <form wire:submit.prevent="updateUrl" class="flex items-center space-x-indent-half">
                        <div>
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
                @else
                    <div class="flex items-center space-x-indent justify-between">
                        <div class="flex items-center space-x-indent-half">
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
                            <div class="font-medium">{{ $urlItem->value }}</div>
                        </div>
                        <div>
                            <div class="flex justify-center">
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
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
