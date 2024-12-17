<?php

namespace GIS\ContactPage;

use GIS\ContactPage\Livewire\Admin\Contacts\CreateWire as ContactCreateWire;
use GIS\ContactPage\Livewire\Admin\Contacts\ListWire as ContactListWire;
use GIS\ContactPage\Models\Contact;
use GIS\ContactPage\Observers\ContactObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ContactPageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "ctp");

        // Livewire
        $this->addLivewireComponents();

        // Observers
        $contactObserverClass = config("contact-page.customContactObserver") ?? ContactObserver::class;
        $contactModelClass = config("contact-page.customContactModel") ?? Contact::class;
        $contactModelClass::observe($contactObserverClass);
    }

    public function register(): void
    {
        // migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // config
        $this->mergeConfigFrom(__DIR__ . "/config/contact-page.php", "contact-page");

        // routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        // translations
        $this->loadJsonTranslationsFrom(__DIR__ . "/lang");
    }

    protected function addLivewireComponents(): void
    {
        // Contacts
        $component = config("contact-page.customContactCreateComponent");
        Livewire::component(
            "ctp-contact-create",
            $component ?? ContactCreateWire::class
        );

        $component = config("contact-page.customContactListComponent");
        Livewire::component(
            "ctp-contact-list",
            $component ?? ContactListWire::class
        );

    }
}
