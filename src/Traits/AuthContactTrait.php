<?php

namespace GIS\ContactPage\Traits;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;

trait AuthContactTrait
{
    protected function checkAuth(string $prefix, string $action, ContactInterface $contact = null): bool
    {
        try {
            $this->authorize($action, $contact ?? (config("contact-page.customContactModel") ?? Contact::class));
            return true;
        } catch (\Exception $ex) {
            session()->flash("{$prefix}error", __("Unauthorized action"));
            return false;
        }
    }
}
