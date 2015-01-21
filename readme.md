## Сайт русскоязычного сообщества Laravel

Будущий laravel.ru . Рабочие сборки выкладываются на [http://sharedstation.net](http://sharedstation.net)

Обсуждение в чате: [![Чат](https://badges.gitter.im/gitterHQ/gitter.png)](https://gitter.im/LaravelRUS/laravel.ru)

Таск-лист и багтрекер: [Trello](https://trello.com/b/lDqJrw8x/-).

### Инсталляция

1. Установить переменную окружения `APP_ENV` равную `local` (`SetEnv` в `.htaccess` или `fastcgi_param` в конфиге nginx).
2. Скопировать `env.example.php` в `.env.local.php` и указать в нем данные доступа для mysql, ключ к mailgun для отправки писем и, опционально, ключ к recaptcha.
3. Сделать `composer update`
4. Создать базу данных и выполнить команду `php artisan migrate` 
5. Создать пользователя-админа `php artisan su:create_user admin admin_password admin@mail.ru --admin`
6. Проинициализировать фронтэнд: `bower install`
7. Если не стоит gulp, поставить: `npm install gulp gulp-sass gulp-concat gulp-autoprefixer gulp-notify gulp-rename gulp-uglify gulp-size gulp-replace` . Для сборки css и js нужно держать запущенную команду `gulp watch`. 

### Описание

Описание вынеcено в [wiki](https://github.com/LaravelRUS/laravel.ru/wiki).

[Концепция сайта](https://github.com/LaravelRUS/laravel.ru/wiki/%D0%9A%D0%BE%D0%BD%D1%86%D0%B5%D0%BF%D1%86%D0%B8%D1%8F-%D1%81%D0%B0%D0%B9%D1%82%D0%B0).

[Структура кода](https://github.com/LaravelRUS/laravel.ru/wiki/%D0%A1%D1%82%D1%80%D1%83%D0%BA%D1%82%D1%83%D1%80%D0%B0-%D0%BA%D0%BE%D0%B4%D0%B0).
   
### Помощь
   
1. Перевод документации. [Инструкция, как это делать правильно](http://sharedstation.net/content/rus-documentation-contribution-guide).
2. Работа над [кодом](https://trello.com/b/lDqJrw8x/-). В разработке используется модель [git-flow](https://www.atlassian.com/ja/git/workflows/pageSections/00/contentFullWidth/0/tabs/02/pageSections/010/contentFullWidth/0/content_files/file0/document/git-workflow-release-cycle-4maintenance.png).
