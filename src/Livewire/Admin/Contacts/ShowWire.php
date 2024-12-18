<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class ShowWire extends Component
{
    public ContactInterface|null $contact = null;

    public function render(): View
    {
        return view('ctp::livewire.admin.contacts.show-wire');
    }

    #[On("set-contact")]
    public function setContact(int $id): void
    {
        $contact = $this->findContact($id);
        if (! $contact) return;
        $this->contact = $contact;
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
