<?php

namespace GIS\ContactPage\Traits;

trait EditEmailsTrait
{
    public string $email = "";
    public string $emailComment = "";
    public string $editEmail = "";
    public string $editEmailComment = "";
    public bool $displayEmailEdit = false;

    public function addEmail(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("email-", "update", $this->contact);
        if (! $check) return;

        $this->validate([
            "email" => ["required", "email", "max:150"],
            "emailComment" => ["nullable", "max:150"]
        ], [], [
            "email" => "Email",
            "emailComment" => __("Comment")
        ]);

        $this->contact->items()->create([
            "type" => "email",
            "value" => $this->email,
            "comment" => $this->emailComment,
        ]);
        session()->flash("email-success", __("Email address successfully added"));

        $this->reset("email", "emailComment");
    }

    public function showEmailEdit(int $id): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("email-", "update", $this->contact);
        if (! $check) return;

        $this->itemId = $id;
        $this->type = "email";
        $item = $this->findItem();
        if (! $item) {
            $this->resetGeneralFields();
            return;
        }

        $this->editEmail = $item->value;
        $this->editEmailComment = $item->comment;
        $this->displayEmailEdit = true;
    }

    public function closeEmailEdit(): void
    {
        $this->resetGeneralFields();
        $this->reset("displayEmailEdit", "editEmail", "editEmailComment");
    }

    public function updateEmail(): void
    {
        // Проверить авторизацию
        $check = $this->checkAuth("email-", "update", $this->contact);
        if (! $check) return;

        $this->type = "email";
        $item = $this->findItem();
        if (! $item) {
            $this->resetGeneralFields();
            return;
        }
        $this->validate([
            "editEmail" => ["required", "email", "max:150"],
            "editEmailComment" => ["nullable", "max:150"]
        ], [], [
            "editEmail" => "Email",
            "editEmailComment" => __("Comment")
        ]);
        $item->update([
            "value" => $this->editEmail,
            "comment" => $this->editEmailComment,
        ]);
        session()->flash("email-success", __("Email address successfully updated"));
        $this->closeEmailEdit();
    }
}
