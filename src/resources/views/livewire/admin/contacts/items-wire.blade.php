<div>
    <x-tt::notifications.error prefix="items-" />
    <x-tt::notifications.success prefix="items-" />

    <div class="space-y-indent">
        <h3 class="text-2xl font-medium">{{ __("Phones") }}</h3>

        <x-tt::notifications.error prefix="phone-" />
        <x-tt::notifications.success prefix="phone-" />

        <div>
            <form wire:submit.prevent="addPhone" class="flex items-center space-x-indent-half" x-data>
                <div>
                    <input type="text" id="phone" required
                           placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}"
                           class="form-control {{ $errors->has("phone") ? "border-danger" : "" }}"
                           x-mask="+7 (999) 999-99-99"
                           wire:loading.attr="disabled"
                           wire:model="phone">
                    <x-tt::form.error name="phone"/>
                </div>

                <div>
                    <input type="text" id="phoneComment"
                           placeholder="{{ __('Comment') }}" aria-label="{{ __('Comment') }}"
                           class="form-control {{ $errors->has("phoneComment") ? "border-danger" : "" }}"
                           wire:loading.attr="disabled"
                           wire:model="phoneComment">
                    <x-tt::form.error name="phoneComment"/>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __("Add") }}
                </button>
            </form>
        </div>

        <div class="space-y-indent-half p-indent border border-secondary rounded-lg">
            @foreach($phones as $phoneItem)
                <div class="flex items-center space-x-indent justify-between">
                    <div class="flex items-center space-x-indent-half">
                        <div class="flex items-center">
                            <button type="button" class="btn btn-primary btn-sm px-btn-x-ico rounded-e-none"
                                    @if ($loop->last) disabled
                                    @else wire:loading.attr="disabled"
                                    @endif
                                    wire:click="moveDown({{ $phoneItem->id }}, '{{ $phoneItem->type }}')">
                                <x-tt::ico.line-arrow-bottom width="18" height="18" />
                            </button>
                            <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-s-none"
                                    @if ($loop->first) disabled
                                    @else wire:loding.attr="disabled"
                                    @endif
                                    wire:click="moveUp({{ $phoneItem->id }}, '{{ $phoneItem->type }}')">
                                <x-tt::ico.line-arrow-top width="18" height="18" />
                            </button>
                        </div>
                        <div class="font-medium">{{ $phoneItem->value }}</div>
                        <div class="text-secondary">{{ $phoneItem->comment }}</div>
                    </div>
                    <div>
                        <div class="flex justify-center">
                            <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                                    wire:loading.attr="disabled"
                                    wire:click="showPhoneEdit({{ $phoneItem->id }})">
                                <x-tt::ico.edit />
                            </button>
                            <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                    wire:loading.attr="disabled"
                                    wire:click="showDelete({{ $phoneItem->id }}, '{{ $phoneItem->type }}')">
                                <x-tt::ico.trash />
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include("ctp::admin.contacts.includes.items-modals")
</div>
