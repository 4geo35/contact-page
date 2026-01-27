<?php

namespace GIS\ContactPage\Observers;

use GIS\ContactPage\Events\ContactDeleted;
use GIS\ContactPage\Events\ContactUpdated;
use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;

class ContactObserver
{
    public function creating(ContactInterface $contact): void
    {
        $contact->ico = config("contact-page.defaultIco");
        $contact->latitude = config("contact-page.defaultLatitude");
        $contact->longitude = config("contact-page.defaultLongitude");

        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        $priority = $contactModel::query()
            ->select("id", "priority")
            ->max("priority");
        if (empty($priority)) $priority = 0;
        $contact->priority = $priority + 1;
    }

    public function updated(ContactInterface $contact): void
    {
        ContactUpdated::dispatch($contact);
    }

    public function deleted(ContactInterface $contact): void
    {
        foreach ($contact->items as $item) {
            $item->delete();
        }

        ContactDeleted::dispatch($contact->id);
    }
}
