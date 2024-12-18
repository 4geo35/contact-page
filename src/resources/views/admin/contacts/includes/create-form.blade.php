<form wire:submit.prevent="store"
      class="space-y-indent-half">
    <x-tt::notifications.error prefix="create-" />
    <x-tt::notifications.success prefix="create-" />
    <div class="flex flex-col space-y-indent-half md:flex-row md:space-x-indent-half md:space-y-0">
        <div class="flex-1">
            <input type="text" aria-label="{{ __('Title') }}" placeholder="{{ __('Title') }}"
                   id="create-title" class="form-control {{ $errors->has('title') ? 'border-danger' : '' }}"
                   required
                   wire:model="title">
            <x-tt::form.error name="title" />
        </div>

        <button type="submit" class="btn btn-primary">{{ __("Add") }}</button>
    </div>
</form>
