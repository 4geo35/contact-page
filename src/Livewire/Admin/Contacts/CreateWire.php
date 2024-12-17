<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Models\Contact;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateWire extends Component
{
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
        // TODO: check auth
        // Validation
        $this->validate();
        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        $contactModel::create(["title" => $this->title]);
        session()->flash("success", __("Contact successfully added"));
        $this->reset("title");
    }
}