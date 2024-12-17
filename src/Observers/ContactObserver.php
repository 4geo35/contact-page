<?php

namespace GIS\ContactPage\Observers;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;

class ContactObserver
{
    public function creating(ContactInterface $contact): void
    {
        $contact->ico = config("contact-page.defaultIco");
        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        $priority = $contactModel::query()
            ->select("id", "priority")
            ->max("priority");
        if (empty($priority)) $priority = 0;
        $contact->priority = $priority + 1;
    }
}
