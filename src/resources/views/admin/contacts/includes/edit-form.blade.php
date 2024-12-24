<div class="card">
    <div class="card-body">
        <x-tt::notifications.error prefix="show-" />
        <x-tt::notifications.success prefix="show-" />
        <form wire:submit.prevent="update" class="space-y-indent-half">
            <div>
                <label for="title" class="inline-block mb-2">
                    {{ __("Title") }} <span class="text-danger">*</span>
                </label>
                <input type="text" id="title"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       required
                       @cannot("update", $contact) disabled @endcan
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                <label for="address" class="inline-block mb-2">
                    {{ __("Address") }}
                </label>
                <input type="text" id="address"
                       class="form-control {{ $errors->has("address") ? "border-danger" : "" }}"
                       @cannot("update", $contact) disabled @endcan
                       wire:loading.attr="disabled"
                       wire:model="address">
                <x-tt::form.error name="address"/>
            </div>

            <div>
                <label for="description" class="inline-block mb-2">
                    {{ __("Description") }}
                </label>
                <input type="text" id="description"
                       class="form-control {{ $errors->has("description") ? "border-danger" : "" }}"
                       @cannot("update", $contact) disabled @endcan
                       wire:loading.attr="disabled"
                       wire:model="description">
                <x-tt::form.error name="description"/>
            </div>

            <div>
                <label for="ico" class="inline-block mb-2">
                    Ico
                </label>
                <input type="text" id="ico"
                       class="form-control {{ $errors->has("ico") ? "border-danger" : "" }}"
                       @cannot("update", $contact) disabled @endcan
                       wire:loading.attr="disabled"
                       wire:model="ico">
                <x-tt::form.error name="ico"/>
                <a href="https://tech.yandex.ru/maps/jsapi/doc/2.1/ref/reference/option.presetStorage-docpage/" target="_blank" class="text-info text-sm underline hover:text-primary">
                    {{ __("List of possible labels") }}
                </a>
            </div>

            <div class="flex items-center">
                <button type="submit" class="btn btn-primary rounded-e-none"
                        @cannot("update", $contact) disabled
                        @else wire:loading.attr="disabled"
                        @endcan>
                    {{ __("Update") }}
                </button>
                <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                        @cannot("delete", $contact) disabled
                        @else wire:loading.attr="disabled"
                        @endcan
                        wire:click="showDelete()">
                    <x-tt::ico.trash />
                </button>
            </div>
        </form>
    </div>
</div>
