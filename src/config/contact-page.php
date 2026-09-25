<?php

return [
    "mapApiKey" => env('MAP_API_KEY', ''),
    "defaultIco" => "islands#blueIcon",
    "defaultLatitude" => env("MAP_DEFAULT_LATITUDE", "39.90092731952594"),
    "defaultLongitude" => env("MAP_DEFAULT_LONGITUDE", "59.21567389811249"),
    "defaultMapZoom" => env("MAP_DEFAULT_ZOOM", "14"),
    "webPageUrl" => "contacts",
    "useBreadcrumbs" => true,
    "useH1" => true,

    // Models
    "customContactModel" => null,
    "customContactObserver" => null,

    "customContactItemModel" => null,
    "customContactItemObserver" => null,

    // Controllers
    "customContactController" => null,

    // Wire Components
    "customContactCreateComponent" => null,
    "customContactListComponent" => null,
    "customContactShowComponent" => null,
    "customContactMapComponent" => null,
    "customContactWorkDaysComponent" => null,

    "customContactItemsComponent" => null,

    "customWebContactItemComponent" => null,

    // Policy
    "contactPolicyTitle" => "Управление контактами",
    "contactPolicy" => \GIS\ContactPage\Policies\ContactPolicy::class,
    "contactPolicyKey" => "contacts",
];
