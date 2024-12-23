<div class="space-y-indent-half">
    <h3 class="text-2xl font-medium">{{ __("Social networks") }}</h3>

    <x-tt::notifications.error prefix="social-" />
    <x-tt::notifications.success prefix="social-" />

    <form wire:submit.prevent="addSocial"
          class="flex flex-col md:flex-row items-center space-y-indent-half md:space-y-0 md:space-x-indent-half">
        <div class="space-x-indent-half flex items-center w-full md:w-auto md:flex-auto">
            <div class="relative" x-data="{ show: false }">
                <button type="button" class="btn btn-outline-secondary px-btn-x-ico" @click="show = !show">
                    @php($componentName = "ctp::ico.{$ico}")
                    <x-dynamic-component :component="$componentName" class="w-6 h-6"/>
                </button>
                <div class="absolute p-indent-half border border-secondary rounded-lg bottom-0 left-0 bg-white"
                     x-show="show" style="display: none" @click.outside="show = false">
                    <div class="flex flex-wrap w-[300px]">
                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('facebook')">
                            <x-ctp::ico.facebook />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('inst')">
                            <x-ctp::ico.inst />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('meta')">
                            <x-ctp::ico.meta />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('ok')">
                            <x-ctp::ico.ok />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('share')">
                            <x-ctp::ico.share />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('tg')">
                            <x-ctp::ico.tg />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('viber')">
                            <x-ctp::ico.viber />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('vk')">
                            <x-ctp::ico.vk />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('wa')">
                            <x-ctp::ico.wa />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('x-twitter')">
                            <x-ctp::ico.x-twitter />
                        </button>

                        <button type="button" class="p-indent-half inline-flex items-center justify-center border border-secondary rounded-lg hover:text-primary m-indent-half"
                                @click="show = false" wire:click="setIco('youtube')">
                            <x-ctp::ico.youtube />
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex-auto">
                <input type="text" id="social" required
                       placeholder="{{ __('Social network') }}" aria-label="{{ __('Social network') }}"
                       class="form-control {{ $errors->has("social") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="social">
                <x-tt::form.error name="social"/>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-full md:w-auto">
            {{ __("Add") }}
        </button>
    </form>

    @if ($socials->count())
        <div class="p-indent-half border border-secondary rounded-lg beautify-scrollbar overflow-x-auto">
            <table class="w-full">
                <tbody>
                @foreach($socials as $socialItem)
                    <tr>
                        @if ($displaySocialEdit && $itemId === $socialItem->id)
                            <td class="p-indent-xs" colspan="4">
                                <form wire:submit.prevent="updateSocial" class="flex items-center space-x-indent-half">
                                    <div class="flex-auto">
                                        <input type="text" id="editSocial" required
                                               placeholder="{{ __('Social network') }}" aria-label="{{ __('Social network') }}"
                                               class="form-control {{ $errors->has("editSocial") ? "border-danger" : "" }}"
                                               wire:loading.attr="disabled"
                                               wire:model="editSocial">
                                        <x-tt::form.error name="editSocial"/>
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
                                            wire:click="moveDown({{ $socialItem->id }}, '{{ $socialItem->type }}')">
                                        <x-tt::ico.line-arrow-bottom width="18" height="18" />
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary px-btn-x-ico rounded-s-none"
                                            @if ($loop->first) disabled
                                            @else wire:loding.attr="disabled"
                                            @endif
                                            wire:click="moveUp({{ $socialItem->id }}, '{{ $socialItem->type }}')">
                                        <x-tt::ico.line-arrow-top width="18" height="18" />
                                    </button>
                                </div>
                            </td>
                            <td class="p-indent-xs">
                                @php($componentName = "ctp::ico.{$socialItem->additionally}")
                                <x-dynamic-component :component="$componentName" class="w-6 h-6"/>
                            </td>
                            <td class="p-indent-xs">
                                <div class="font-medium text-nowrap">{{ $socialItem->value }}</div>
                            </td>
                            <td class="p-indent-xs">
                                <div class="flex justify-end">
                                    <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                                            wire:loading.attr="disabled"
                                            wire:click="showSocialEdit({{ $socialItem->id }})">
                                        <x-tt::ico.edit />
                                    </button>
                                    <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                            wire:loading.attr="disabled"
                                            wire:click="showDelete({{ $socialItem->id }}, '{{ $socialItem->type }}')">
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
