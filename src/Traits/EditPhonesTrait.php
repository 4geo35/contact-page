<?php

namespace GIS\ContactPage\Traits;

trait EditPhonesTrait
{
    public string $phone = "";
    public string $phoneComment = "";
    public string $editPhone = "";
    public string $editPhoneComment = "";
    public bool $displayPhoneEdit = false;

    public function addPhone(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("phone-", "update", $this->contact);
        if (! $check) return;

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

    public function showPhoneEdit(int $id): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("phone-", "update", $this->contact);
        if (! $check) return;

        $this->itemId = $id;
        $this->type = "phone";
        $item = $this->findItem();
        if (! $item) {
            $this->resetGeneralFields();
            return;
        }
        $this->editPhone = $item->value;
        $this->editPhoneComment = $item->comment;
        $this->displayPhoneEdit = true;
    }

    public function closePhoneEdit(): void
    {
        $this->resetGeneralFields();
        $this->reset("displayPhoneEdit", "editPhone", "editPhoneComment");
    }

    public function updatePhone(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("phone-", "update", $this->contact);
        if (! $check) return;

        $this->type = "phone";
        $item = $this->findItem();
        if (! $item) {
            $this->resetGeneralFields();
            return;
        }
        $this->validate([
            "editPhone" => ["required", "max:18"],
            "editPhoneComment" => ["nullable", "max:150"]
        ], [], [
            "editPhone" => __("Phone"),
            "editPhoneComment" => __("Comment")
        ]);
        $item->update([
            "value" => $this->editPhone,
            "comment" => $this->editPhoneComment
        ]);
        session()->flash("phone-success", __("Phone number successfully updated"));
        $this->closePhoneEdit();
    }
}
