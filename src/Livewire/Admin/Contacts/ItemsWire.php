<?php

namespace GIS\ContactPage\Livewire\Admin\Contacts;

use GIS\ContactPage\Interfaces\ContactInterface;
use GIS\ContactPage\Interfaces\ContactItemInterface;
use GIS\ContactPage\Models\ContactItem;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ItemsWire extends Component
{
    public ContactInterface $contact;

    public int|null $itemId = null;
    public string|null $type = null;
    public bool $displayDelete = false;

    public string $phone = "";
    public string $phoneComment = "";

    public function render(): View
    {
        $phones = $this->contact->phones()->orderBy("priority")->get();

        return view(
            'ctp::livewire.admin.contacts.items-wire',
            compact("phones")
        );
    }

    public function addPhone(): void
    {
        $this->validate([
            "phone" => ["required", "max:18"],
            "phoneComment" => ["nullable", "max:150"]
        ], [], [
            "phone" => __("Phone"),
            "phoneComment" => __("Comment")
        ]);

        $this->contact->items()->create([
            "type" => "phone",
            "value" => $this->phone,
            "comment" => $this->phoneComment
        ]);
        session()->flash("phone-success", __("Phone number successfully added"));

        $this->reset("phone", "phoneComment");
    }

    public function showDelete(int $id, string $type): void
    {
        $this->resetGeneralFields();
        $this->itemId = $id;
        $this->type = $type;
        $item = $this->findItem();
        if (! $item) return;
        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $item = $this->findItem();
        if (! $item) {
            $this->closeDelete();
            return;
        }
        $item->delete();
        $prefix = $this->type ? "{$this->type}-" : "items-";
        session()->flash("{$prefix}success", __("Element successfully deleted"));
        $this->closeDelete();
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetGeneralFields();
    }

    public function moveUp(int $id, string $type): void
    {
        $this->itemId = $id;
        $item = $this->findItem($type);
        if (! $item) return;

        $previous = $this->contact->items()
            ->where("type", $item->type)
            ->where("priority", "<", $item->priority)
            ->orderBy("priority", "desc")
            ->first();

        if ($previous) $this->switchPriority($item, $previous);
        $this->resetGeneralFields();
    }

    public function moveDown(int $id, string $type): void
    {
        $this->itemId = $id;
        $this->type = $type;
        $item = $this->findItem();
        if (! $item) return;

        $previous = $this->contact->items()
            ->where("type", $item->type)
            ->where("priority", ">", $item->priority)
            ->orderBy("priority")
            ->first();

        if ($previous) $this->switchPriority($item, $previous);
        $this->resetGeneralFields();
    }

    protected function resetGeneralFields(): void
    {
        $this->reset("itemId", "type");
    }

    protected function switchPriority(ContactItemInterface $item, ContactItemInterface $target): void
    {
        $buff = $target->priority;
        $target->priority = $item->priority;
        $target->save();

        $item->priority = $buff;
        $item->save();
    }

    protected function findItem(): ?ContactItemInterface
    {
        $itemModel = config("contact-page.customContactItemModel") ?? ContactItem::class;
        $item = $itemModel::find($this->itemId);
        if (! $item) {
            $prefix = $this->type ? "{$this->type}-" : "items-";
            session()->flash("{$prefix}error", __("Item not found"));
            return null;
        }
        return $item;
    }
}
