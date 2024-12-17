<?php

namespace GIS\ContactPage;
use Illuminate\Support\ServiceProvider;

class ContactPageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // views
        $this->loadViewsFrom(__DIR__ . "/resources/views", "cp");
    }

    public function register(): void
    {
        // routes
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        // translations
        $this->loadJsonTranslationsFrom(__DIR__ . "/lang");
    }
}
