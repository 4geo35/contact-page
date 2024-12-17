<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::get("contacts", function () {
            return view("ctp::admin.contacts.index");
        })->name("contacts");
    });
