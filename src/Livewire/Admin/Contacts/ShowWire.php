<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Models\Contact;
use GIS\ContactPage\Traits\AuthContactTrait;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class ShowWire extends Component
{
    use AuthContactTrait;

    public ContactInterface|null $contact = null;
    public int|null $contactId = null;

    public bool $displayDelete = false;

    public string $title = "";
    public string $address = "";
    public string $description = "";
    public string $ico = "";

    protected function queryString(): array
    {
        return [
            "contactId" => ["as" => "contact", "except" => ""]
        ];
    }

    public function mount(): void
    {
        if ($this->contactId) {
            $this->setContact($this->contactId);
        }
    }

    public function rules(): array
    {
        return [
            "title" => ["required", "string", "max:50"],
            "address" => ["nullable", "string", "max:50"],
            "description" => ["nullable", "string", "max:250"],
            "ico" => ["required", "string", "max:100"]
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => __("Title"),
            "address" => __("Address"),
            "description" => __("Description"),
            "ico" => "Ico"
        ];
    }

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

        $this->title = $contact->title;
        $this->address = $contact->address ?? "";
        $this->description = $contact->description ?? "";
        $this->ico = $contact->ico ?? "";
        $this->dispatch("update-contact");
        $this->dispatch("fresh-map");
    }

    public function update(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("show-", "update", $this->contact);
        if (! $check) return;

        $this->validate();

        $contact = $this->findContact($this->contact->id);
        if (! $contact) {
            $this->resetContact();
            return;
        }
        try {
            $this->contact->update([
                "title" => $this->title,
                "address" => $this->address,
                "description" => $this->description,
                "ico" => $this->ico,
            ]);

            session()->flash("show-success", __("Contact successfully updated"));

            $this->dispatch("update-contact");
            $this->dispatch("fresh-map");
        } catch (\Exception $exception) {
            session()->flash("error", __("Error while update"));
        }
    }

    public function showDelete(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("show-", "delete", $this->contact);
        if (! $check) return;
        $this->displayDelete = true;
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
    }

    public function confirmDelete(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("show-", "delete", $this->contact);
        if (! $check) return;

        try {
            $this->contact->delete();
            session()->flash("show-success", __("Contact successfully deleted"));
        } catch (\Exception $ex) {
            session()->flash("show-error", __("Contact not found"));
        }
        $this->resetContact();
        $this->closeDelete();
    }

    protected function resetContact(): void
    {
        $this->dispatch("delete-contact");
        $this->reset("contact", "title", "address", "description", "ico");
    }

    protected function findContact(int $id): ?ContactInterface
    {
        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        $contact = $contactModel::find($id);
        if (! $contact) {
            session()->flash("show-error", __("Contact not found"));
            return null;
        }
        return $contact;
    }
}
