### Установка

Добавить в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/contact-page/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/contact-page/src/resources/views/admin/**/*.blade.php",
    "./vendor/4geo35/contact-page/src/resources/views/livewire/admin/**/*.blade.php",

Добавить в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/contact-page/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/contact-page/src/resources/views/web/**/*.blade.php",
    "./vendor/4geo35/contact-page/src/resources/views/livewire/web/**/*.blade.php",

Запустить миграции для создания таблиц `php artisan migrate`

Установить маску `npm install @alpinejs/mask`, добавить в `admin.js`:

    import mask from '@alpinejs/mask'
    Alpine.plugin(mask)

#### Views

Сокращение для представлений: `ctp`  
Меню для панели администрирования: `<x-ctp::menu-item/>`

#### Livewire Components

Web

- `ctp-web-contact-item`: отображение контакта на странице; `contact` - элемент, `items` - список всех элементов

#### Config

Название файла: `contact-page`

- `mapApiKey` => `env('MAP_API_KEY', '')`: ключ для Яндекс карты
- `defaultIco` => `islands#blueIcon`: иконка маркера на карте, которая устанавливается для новых контактов
- `defaultLatitude` => `env("MAP_DEFAULT_LATITUDE", "39.90092731952594")`: координаты новой метки
- `defaultLongitude` => `env("MAP_DEFAULT_LONGITUDE", "59.21567389811249")`: координаты новой метки
- `defaultMapZoom` => `env("MAP_DEFAULT_ZOOM", "14")`: zoom карты при инициализации
- `webPageUrl` => `contacts`
- `useBreadcrumbs` => `true`: выводить хлебные крошки на странице
- `useH1` => `true`: выводить h1

#### Routes

Файл `admin.php`, `middleware(["web", "auth", "app-management"])`

- `admin.contacts` => `admin/contacts`

Файл `web.php`, `middleware(["web"])`, `! empty(config("contact-page.webPageUrl")`

- `web.contacts.page` => `{config("contact-page.webPageUrl")}`
