<?php

return [
    "mapApiKey" => env('MAP_API_KEY', ''),
    "defaultIco" => "islands#blueIcon",
    "defaultLatitude" => "39.90092731952594",
    "defaultLongitude" => "59.21567389811249",
    "defaultMapZoom" => "14",
    "webPageUrl" => "contacts",
    "customContactController" => null,
    "useBreadcrumbs" => true,
    "useH1" => true,
    "customWebContactItemComponent" => null,

    // Admin
    // Contacts
    "customContactModel" => null,
    "customContactObserver" => null,
    "customContactCreateComponent" => null,
    "customContactListComponent" => null,
    "customContactShowComponent" => null,
    "customContactMapComponent" => null,
    "customContactWorkDaysComponent" => null,
    // Contact Items
    "customContactItemModel" => null,
    "customContactItemObserver" => null,
    "customContactItemsComponent" => null,

    // Policy
    "contactPolicyTitle" => "Управление контактами",
    "contactPolicy" => \GIS\ContactPage\Policies\ContactPolicy::class,
    "contactPolicyKey" => "contacts",
];
