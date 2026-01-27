<?php

namespace GIS\ContactPage\Observers;

use GIS\ContactPage\Interfaces\ContactItemInterface;
use GIS\ContactPage\Models\ContactItem;

class ContactItemObserver
{
    public function creating(ContactItemInterface $contactItem): void
    {
        $contactItemModel = config("contact-page.customContactItemModel") ?? ContactItem::class;
        $priority = $contactItemModel::query()
            ->select("id", "priority")
            ->where("type", $contactItem->type)
            ->where("contact_id", $contactItem->contact_id)
            ->max("priority");
        if (empty($priority)) $priority = 0;
        $contactItem->priority = $priority + 1;
    }

    public function created(ContactItemInterface $contactItem): void
    {
        $contact = $contactItem->contact;
        if (! empty($contact)) { $contact->touch(); }
    }

    public function updated(ContactItemInterface $contactItem): void
    {
        $contact = $contactItem->contact;
        if (! empty($contact)) { $contact->touch(); }
    }

    public function deleted(ContactItemInterface $contactItem): void
    {
        $contact = $contactItem->contact;
        if (! empty($contact)) { $contact->touch(); }
    }
}
