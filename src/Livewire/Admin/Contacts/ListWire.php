<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class ListWire extends Component
{
    public bool $hasSearch = false;
    public string $updatedAt;

    public function mount(): void
    {
        $this->updatedAt = now()->toString();
    }

    public function render(): View
    {
        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        $contacts = $contactModel::query()
            ->select("id", "title", "priority")
            ->orderBy("priority", "asc")
            ->get();
        $updated = $this->updatedAt;

        return view('ctp::livewire.admin.contacts.list-wire', compact("contacts", "updated"));
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

    #[On('new-contact')]
    public function updateList(): void
    {
        $this->dispatch("update-list");
        $this->updatedAt = now()->toString();
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
