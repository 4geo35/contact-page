<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        $contactModelClass = config("contact-page.customContactModel") ?? \GIS\ContactPage\Models\Contact::class;
        Route::get("contacts", function () {
            return view("ctp::admin.contacts.index");
        })->name("contacts")->middleware("can:viewAny,{$contactModelClass}");
    });
