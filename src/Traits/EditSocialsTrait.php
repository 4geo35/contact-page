<?php

namespace GIS\ContactPage\Traits;

trait EditSocialsTrait
{
    public string $social = "";
    public string $ico = "share";
    public string $editSocial = "";
    public bool $displaySocialEdit = false;

    public function setIco(string $title): void
    {
        $this->ico = $title;
    }

    public function addSocial(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("social-", "update", $this->contact);
        if (! $check) return;

        $this->validate([
            "social" => ["required", "max:250"],
        ], [], [
            "social" => __("Social network")
        ]);

        $this->contact->items()->create([
            "type" => "social",
            "value" => $this->social,
            "additionally" => $this->ico,
        ]);
        session()->flash("social-success", __("Social network successfully added"));

        $this->reset("social", "ico");
    }

    public function showSocialEdit(int $id): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("social-", "update", $this->contact);
        if (! $check) return;

        $this->itemId = $id;
        $this->type = "social";
        $item = $this->findItem();
        if (! $item) {
            $this->resetGeneralFields();
            return;
        }

        $this->editSocial = $item->value;
        $this->displaySocialEdit = true;
    }

    public function closeSocialEdit(): void
    {
        $this->resetGeneralFields();
        $this->reset("displaySocialEdit", "editSocial");
    }

    public function updateSocial(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("social-", "update", $this->contact);
        if (! $check) return;

        $this->type = "social";
        $item = $this->findItem();
        if (! $item) {
            $this->resetGeneralFields();
            return;
        }
        $this->validate([
            "editSocial" => ["required", "max:250"],
        ], [], [
            "editSocial" => __("Social network")
        ]);
        $item->update([
            "value" => $this->editSocial,
        ]);
        session()->flash("social-success", __("Social network successfully updated"));
        $this->closeSocialEdit();
    }
}
