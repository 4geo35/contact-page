<?php

namespace GIS\ContactPage\Livewire\Web\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class ItemWire extends Component
{
    public ContactInterface|null $contact;
    public Collection $items;

    public function render(): View
    {
        return view('ctp::livewire.web.contacts.item-wire');
    }

    #[On("switch-contact")]
    public function switchContact(int $id): void
    {
        if ($this->contact->id == $id) return;
        $this->contact = $this->findContact($id);
        $this->contact?->load("phones", "emails", "urls", "socials");
    }

    protected function findContact(int $id): ?ContactInterface
    {
        return $this->items->first(function ($item) use ($id) {
            return $item->id === $id;
        });
    }
}
