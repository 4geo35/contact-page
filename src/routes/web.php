<?php

use Illuminate\Support\Facades\Route;
use GIS\ContactPage\Http\Controllers\Web\ContactController;

Route::middleware(["web"])
    ->as("web.contacts.")
    ->group(function () {
        if (! empty(config("contact-page.webPageUrl"))) {
            $controllerClass = config("contact-page.customContactController") ?? ContactController::class;
            Route::get(config("contact-page.webPageUrl"), [$controllerClass, "page"])->name("page");
        }
    });
