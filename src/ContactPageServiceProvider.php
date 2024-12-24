<?php

namespace GIS\ContactPage;

use GIS\ContactPage\Livewire\Admin\Contacts\CreateWire as ContactCreateWire;
use GIS\ContactPage\Livewire\Admin\Contacts\ListWire as ContactListWire;
use GIS\ContactPage\Livewire\Admin\Contacts\ShowWire as ContactShowWire;
use GIS\ContactPage\Livewire\Admin\Contacts\MapWire as ContactMapWire;
use GIS\ContactPage\Livewire\Admin\Contacts\ItemsWire as ContactItemsWire;
use GIS\ContactPage\Livewire\Admin\Contacts\WorkDaysWire as ContactWorkDaysWire;
use GIS\ContactPage\Models\Contact;
use GIS\ContactPage\Models\ContactItem;
use GIS\ContactPage\Observers\ContactItemObserver;
use GIS\ContactPage\Observers\ContactObserver;
use Illuminate\Support\Facades\Gate;
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

        $contactItemObserverClass = config("contact-page.customContactItemObserver") ?? ContactItemObserver::class;
        $contactItemModelClass = config("contact-page.customContactItemModel") ?? ContactItem::class;
        $contactItemModelClass::observe($contactItemObserverClass);

        // Policy
        $contactModelClass = config("contact-page.customContactModel") ?? Contact::class;
        Gate::policy($contactModelClass, config("contact-page.contactPolicy"));

        // Добавить политики в конфигурацию
        $this->expandConfiguration();
    }

    public function register(): void
    {
        // migrations
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // config
        $this->mergeConfigFrom(__DIR__ . "/config/contact-page.php", "contact-page");

        // routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");

        // translations
        $this->loadJsonTranslationsFrom(__DIR__ . "/lang");
    }

    protected function addLivewireComponents(): void
    {
        // Contact
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

        $component = config("contact-page.customContactShowComponent");
        Livewire::component(
            "ctp-contact-show",
            $component ?? ContactShowWire::class
        );

        $component = config("contact-page.customContactMapComponent");
        Livewire::component(
            "ctp-contact-map",
            $component ?? ContactMapWire::class
        );

        $component = config("contact-page.customContactWorkDaysComponent");
        Livewire::component(
            "ctp-contact-work-days",
            $component ?? ContactWorkDaysWire::class
        );

        // Contact Item
        $component = config("contact-page.customContactItemsComponent");
        Livewire::component(
            "ctp-contact-items",
            $component ?? ContactItemsWire::class
        );
    }

    protected function expandConfiguration(): void
    {
        $um = app()->config["user-management"];
        $permissions = $um["permissions"];
        $ctp = app()->config["contact-page"];
        $permissions[] = [
            "title" => $ctp["contactPolicyTitle"],
            "policy" => $ctp["contactPolicy"],
            "key" => $ctp["contactPolicyKey"]
        ];
        app()->config["user-management.permissions"] = $permissions;
    }
}
