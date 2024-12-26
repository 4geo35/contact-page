<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;
use GIS\ContactPage\Traits\AuthContactTrait;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class ListWire extends Component
{
    public bool $hasSearch = false;
    public string $updatedAt;
    public int|string $contactId = "";

    protected function queryString(): array
    {
        return [
            "contactId" => ["as" => "contact", "except" => ""]
        ];
    }

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
    public function updateList(int $id = null): void
    {
        $this->dispatch("update-list");
        $this->updatedAt = now()->toString();
        if ($id) $this->setContact($id);
    }

    #[On('update-contact')]
    public function refreshList(): void
    {
        $this->updatedAt = now()->toString();
    }

    #[On('delete-contact')]
    public function resetContact(): void
    {
        $this->reset("contactId");
        $this->updateList();
    }

    public function setContact(int $id): void
    {
        $this->contactId = $id;
        $this->dispatch("set-contact", id: $id);
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
