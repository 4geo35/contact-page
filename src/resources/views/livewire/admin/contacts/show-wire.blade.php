<div class="space-y-indent-half">
    @if (! $contact)
        <div class="card">
            <div class="card-body">
                <p>{{ __("Select one of the contacts, or add a new one") }}</p>
            </div>
        </div>
    @else
        @include("ctp::admin.contacts.includes.edit-form")
        <div class="card">
            <div class="card-body">

            </div>
        </div>
        @include("ctp::admin.contacts.includes.show-modals")
    @endif
</div>
