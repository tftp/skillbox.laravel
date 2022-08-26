## Проект по созданию, добавлению статей на Laravel

Для запуска проекта необходимо выполнить команды:
- `composer install`
- `npm install`
- `npm run dev`
- Копируем .env.example в .env
- Генерируем ключ прилжения `php artisan key:generate`
- [Подробнее про развертывание, настройки сервера и запуск проекта на Laravel](https://laravel.su/docs/8.x/deployment).
- В качестве сервера можно использовать `php artisan serve`
- Не забываем про настройки БД в .env 
- Чтобы работало тэгирование в кэше указываем в .env `CACHE_DRIVER=redis`
- Запускаем миграции `php artisan migrate`
- Можно заполнить БД тестовыми данными командой `php artisan db:seed`
- Возможно появление ошибки `Argument 1 passed to Illuminate\Http\Client\PendingRequest::post() must be of the type string, null given`
- Что бы её исправить нужно в .env заполнить ключи `PUSHALL_API_ID`, `PUSHALL_API_KEY`, `PUSHALL_API_URI`
- Или отключить сервис из EventServiceProvider `#SendArticleCreatedPushNotification::class,`
