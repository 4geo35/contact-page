<div class="space-y-indent-half">
    <x-tt::notifications.error prefix="items-" />
    <x-tt::notifications.success prefix="items-" />

    @include("ctp::admin.contacts.includes.manage-phones")
    @include("ctp::admin.contacts.includes.manage-emails")

    @include("ctp::admin.contacts.includes.items-modals")
</div>
