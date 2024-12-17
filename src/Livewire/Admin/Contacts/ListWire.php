<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListWire extends Component
{
    public bool $hasSearch = false;

    public function render(): View
    {
        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        $contacts = $contactModel::query()
            ->select("id", "title", "priority")
            ->orderBy("priority", "asc")
            ->get();

        return view('ctp::livewire.admin.contacts.list-wire', compact("contacts"));
    }

    public function reorderItems(array $newOrder): void
    {
        foreach ($newOrder as $priority => $id) {
            $contact = $this->findContact($id);
            if (! $contact) continue;
            $contact->priority = $priority;
            $contact->save();
        }
    }

    protected function findContact(int $id): ?ContactInterface
    {
        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        $contact = $contactModel::find($id);
        if (! $contact) {
            session()->flash("list-error", __("Contact not found"));
            return null;
        }
        return $contact;
    }
}
