<?php

namespace GIS\ContactPage\Traits;

trait EditSitesTrait
{
    public string $url = "";
    public string $editUrl = "";
    public bool $displayUrlEdit = false;

    public function addUrl(): void
    {
        $this->validate([
            "url" => ["required", "url", "max:250"],
        ], [], [
            "url" => __("Url address")
        ]);

        $this->contact->items()->create([
            "type" => "url",
            "value" => $this->url,
        ]);
        session()->flash("url-success", __("Url address successfully added"));

        $this->reset("url");
    }

    public function showUrlEdit(int $id): void
    {
        $this->itemId = $id;
        $this->type = "url";
        $item = $this->findItem();
        if (! $item) {
            $this->resetGeneralFields();
            return;
        }

        $this->editUrl = $item->value;
        $this->displayUrlEdit = true;
    }

    public function closeUrlEdit(): void
    {
        $this->resetGeneralFields();
        $this->reset("displayUrlEdit", "editUrl");
    }

    public function updateUrl(): void
    {
        $this->type = "url";
        $item = $this->findItem();
        if (! $item) {
            $this->resetGeneralFields();
            return;
        }
        $this->validate([
            "editUrl" => ["required", "url", "max:250"],
        ], [], [
            "editUrl" => __("Url address")
        ]);
        $item->update([
            "value" => $this->editUrl
        ]);
        session()->flash("url-success", __("Url address successfully updated"));
        $this->closeUrlEdit();
    }
}
