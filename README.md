### Установка

Добавить `"./vendor/4geo35/contact-page/src/resources/views/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Запустить миграции для создания таблиц `php artisan migrate`

Установить маску `npm install @alpinejs/mask`, добавить в `admin.js`:

    import mask from '@alpinejs/mask'
    Alpine.plugin(mask)
