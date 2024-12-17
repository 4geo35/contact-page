<?php

namespace GIS\ContactPage;
use GIS\ContactPage\Models\Contact;
use GIS\ContactPage\Observers\ContactObserver;
use Illuminate\Support\ServiceProvider;

class ContactPageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "cp");

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

    }
}
