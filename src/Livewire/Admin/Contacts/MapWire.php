<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Traits\AuthContactTrait;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class MapWire extends Component
{
    use AuthContactTrait;

    public ContactInterface $contact;
    public array|null $newCoordinates = null;

    public function render(): View
    {
        return view('ctp::livewire.admin.contacts.map-wire');
    }

    #[On("update-contact")]
    public function freshContact(): void
    {
        $this->contact->fresh();
        $this->reset("newCoordinates");
    }

    #[On("move-point")]
    public function setNewCoordinates(array $coordinates): void
    {
        $this->newCoordinates = $coordinates;
    }

    public function saveCoordinates(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("map-", "update", $this->contact);
        if (! $check) return;

        if (empty($this->newCoordinates) || count($this->newCoordinates) !== 2) {
            session()->flash("map-error", __("Wrong coordinates"));
            $this->reset("newCoordinates");
            return;
        }

        try {
            $this->contact->update([
                "longitude" => $this->newCoordinates[0],
                "latitude" => $this->newCoordinates[1],
            ]);
            session()->flash("map-success", __("Coordinates successfully updated"));
        } catch (\Exception $ex) {
            session()->flash("map-error", __("Error while update coordinates"));
        }

        $this->reset("newCoordinates");
    }
}
