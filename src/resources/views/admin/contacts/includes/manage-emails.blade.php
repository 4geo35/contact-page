<div class="space-y-indent-half">
    <h3 class="text-2xl font-medium">Emails</h3>

    <x-tt::notifications.error prefix="email-" />
    <x-tt::notifications.success prefix="email-" />

    <form wire:submit.prevent="addEmail"
          class="flex flex-col md:flex-row items-center space-y-indent-half md:space-y-0 md:space-x-indent-half">
        <div class="w-full md:w-auto flex-auto">
            <input type="email" id="email" required
                   placeholder="Email" aria-label="Email"
                   class="form-control {{ $errors->has("email") ? "border-danger" : "" }}"
                   wire:loading.attr="disabled"
                   wire:model="email">
            <x-tt::form.error name="email"/>
        </div>

        <div class="w-full md:w-auto flex-auto">
            <input type="text" id="emailComment"
                   placeholder="{{ __('Comment') }}" aria-label="{{ __('Comment') }}"
                   class="form-control {{ $errors->has("emailComment") ? "border-danger" : "" }}"
                   wire:loading.attr="disabled"
                   wire:model="emailComment">
            <x-tt::form.error name="emailComment"/>
        </div>

        <button type="submit" class="btn btn-primary w-full md:w-auto">
            {{ __("Add") }}
        </button>
    </form>

    @if ($emails->count())
        <div class="p-indent-half border border-secondary rounded-lg beautify-scrollbar overflow-x-auto">
            <table class="w-full">
                <tbody>
                @foreach($emails as $emailItem)
                    <tr>
                        @if ($displayEmailEdit && $itemId === $emailItem->id)
                            <td class="p-indent-xs" colspan="4">
                                <form wire:submit.prevent="updateEmail"
                                      class="flex flex-col md:flex-row items-center space-y-indent-half md:space-y-0 md:space-x-indent-half">
                                    <div class="flex-auto">
                                        <input type="email" id="editEmail" required
                                               placeholder="Email" aria-label="Email"
                                               class="form-control {{ $errors->has("editEmail") ? "border-danger" : "" }}"
                                               wire:loading.attr="disabled"
                                               wire:model="editEmail">
                                        <x-tt::form.error name="editEmail"/>
                                    </div>

                                    <div class="flex-auto">
                                        <input type="text" id="editEmailComment"
                                               placeholder="{{ __('Comment') }}" aria-label="{{ __('Comment') }}"
                                               class="form-control {{ $errors->has("editEmailComment") ? "border-danger" : "" }}"
                                               wire:loading.attr="disabled"
                                               wire:model="editEmailComment">
                                        <x-tt::form.error name="editEmailComment"/>
                                    </div>

                                    <div class="flex items-center space-x-indent-half">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __("Update") }}
                                        </button>

                                        <button type="button" class="btn btn-secondary" wire:click="closeEmailEdit">
                                            {{ __("Cancel") }}
                                        </button>
                                    </div>
                                </form>
                            </td>
                        @else
                            <td class="p-indent-xs">
                                <div class="flex items-center mr-indent-half">
                                    <button type="button" class="btn btn-primary btn-sm px-btn-x-ico rounded-e-none"
                                            @if ($loop->last) disabled
                                            @else wire:loading.attr="disabled"
                                            @endif
                                            wire:click="moveDown({{ $emailItem->id }}, '{{ $emailItem->type }}')">
                                        <x-tt::ico.line-arrow-bottom width="18" height="18" />
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-s-none"
                                            @if ($loop->first) disabled
                                            @else wire:loding.attr="disabled"
                                            @endif
                                            wire:click="moveUp({{ $emailItem->id }}, '{{ $emailItem->type }}')">
                                        <x-tt::ico.line-arrow-top width="18" height="18" />
                                    </button>
                                </div>
                            </td>
                            <td class="p-indent-xs">
                                <div class="font-medium text-nowrap">{{ $emailItem->value }}</div>
                            </td>
                            <td class="p-indent-xs">
                                <div class="text-secondary text-nowrap">{{ $emailItem->comment }}</div>
                            </td>
                            <td class="p-indent-xs">
                                <div class="flex justify-end">
                                    <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                                            wire:loading.attr="disabled"
                                            wire:click="showEmailEdit({{ $emailItem->id }})">
                                        <x-tt::ico.edit />
                                    </button>
                                    <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                            wire:loading.attr="disabled"
                                            wire:click="showDelete({{ $emailItem->id }}, '{{ $emailItem->type }}')">
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
