
Пример реализации тестового задания, - "на скорость" aka Rapid scaffold!

В основе проекта Ларка и Вью, Инерция как клей к контролерам.

Основую часть задачи закрывает - https://laravel.com/docs/12.x/starter-kits#livewire 
+ Tailwind стили отключены (но классы в шаблонах частенько остались, что на практике __неприемлемо__!)
+ Попытки в спешке прикрутить Bootstrap.css...
+ По этому могут быть ui glitches and gotchas, так как бутстрап ожидает свою верстку, спасибо https://getbootstrap.com/docs/5.3/examples;

Лучшие практики в коде встретить сложно
+ В основном все копипаста из документации, и склеено __"абы как"__!.
+ Функционал согласно ТЗ, но скорее всего недостаточно протестирован, проработка сценариев не проведена! - PHP Unit Tests, Integration Test Cases __отсутствуют__!


полезные команды:

``` bash

#frontend (build:ssr wan't work, don't known why)
npm i
npm run build 
#or
npm run dev

# backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed 
# maybe also if need
php artisan db:seed --class DomainSeeder
php artisan db:seed --class PlansSeeder
# run it
php artisan serve
```

Thanks & Good luck!

