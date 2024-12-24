<div class="space-y-indent-half">
    <h3 class="text-2xl font-medium">{{ __("Phones") }}</h3>

    <x-tt::notifications.error prefix="phone-" />
    <x-tt::notifications.success prefix="phone-" />


        <form wire:submit.prevent="addPhone"
              class="flex flex-col md:flex-row items-center space-y-indent-half md:space-y-0 md:space-x-indent-half"
              x-data>
            <div class="w-full md:w-auto flex-auto">
                <input type="text" id="phone" required
                       placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}"
                       class="form-control {{ $errors->has("phone") ? "border-danger" : "" }}"
                       x-mask="+7 (999) 999-99-99"
                       wire:loading.attr="disabled"
                       wire:model="phone">
                <x-tt::form.error name="phone"/>
            </div>

            <div class="w-full md:w-auto flex-auto">
                <input type="text" id="phoneComment"
                       placeholder="{{ __('Comment') }}" aria-label="{{ __('Comment') }}"
                       class="form-control {{ $errors->has("phoneComment") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="phoneComment">
                <x-tt::form.error name="phoneComment"/>
            </div>

            <button type="submit" class="btn btn-primary w-full md:w-auto">
                {{ __("Add") }}
            </button>
        </form>


    @if ($phones->count())
        <div class="p-indent-half border border-secondary rounded-lg beautify-scrollbar overflow-x-auto">
            <table class="w-full">
                <tbody>
                @foreach($phones as $phoneItem)
                    <tr>
                        @if ($displayPhoneEdit && $itemId === $phoneItem->id)
                            <td class="p-indent-xs" colspan="4">
                                <form wire:submit.prevent="updatePhone"
                                      class="flex flex-col md:flex-row items-center space-y-indent-half md:space-y-0 md:space-x-indent-half"
                                      x-data>
                                    <div class="flex-auto">
                                        <input type="text" id="editPhone" required
                                               placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}"
                                               class="form-control {{ $errors->has("editPhone") ? "border-danger" : "" }}"
                                               x-mask="+7 (999) 999-99-99"
                                               wire:loading.attr="disabled"
                                               wire:model="editPhone">
                                        <x-tt::form.error name="editPhone"/>
                                    </div>

                                    <div class="flex-auto">
                                        <input type="text" id="editPhoneComment"
                                               placeholder="{{ __('Comment') }}" aria-label="{{ __('Comment') }}"
                                               class="form-control {{ $errors->has("editPhoneComment") ? "border-danger" : "" }}"
                                               wire:loading.attr="disabled"
                                               wire:model="editPhoneComment">
                                        <x-tt::form.error name="editPhoneComment"/>
                                    </div>

                                    <div class="flex items-center space-x-indent-half">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __("Update") }}
                                        </button>

                                        <button type="button" class="btn btn-secondary" wire:click="closePhoneEdit">
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
                            </td>
                            <td class="p-indent-xs">
                                <div class="font-medium">{{ $phoneItem->value }}</div>
                            </td>
                            <td class="p-indent-xs">
                                <div class="text-secondary">{{ $phoneItem->comment }}</div>
                            </td>
                            <td class="p-indent-xs">
                                <div class="flex justify-end">
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
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
