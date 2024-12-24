<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Models\Contact;
use GIS\ContactPage\Traits\AuthContactTrait;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateWire extends Component
{
    use AuthContactTrait;

    public string $title = "";

    public function rules(): array
    {
        return [
            "title" => ["required", "string", "max:50"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => __("Title"),
        ];
    }

    public function render(): View
    {
        return view('ctp::livewire.admin.contacts.create-wire');
    }

    public function store(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("create-", "create");
        if (! $check) return;

        // Validation
        $this->validate();
        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        $contact = $contactModel::create(["title" => $this->title]);
        session()->flash("create-success", __("Contact successfully added"));
        $this->reset("title");
        $this->dispatch("new-contact", id: $contact->id);
    }
}
