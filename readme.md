<p align="center"><img src="https://avatars1.githubusercontent.com/u/5966874?v=4&s=100"></p>

<p align="center">
    <a href="https://scrutinizer-ci.com/g/LaravelRUS/laravel.ru/?branch=2.0"><img src="https://scrutinizer-ci.com/g/LaravelRUS/laravel.ru/badges/quality-score.png?b=master" alt="Scrutinizer CI" /></a>
    <a href="https://styleci.io/repos/18944609"><img src="https://styleci.io/repos/18944609/shield?branch=2.0" alt="StyleCI" /></a>
    <a href="https://github.com/laravel"><img src="https://img.shields.io/badge/laravel-~5.5-green.svg?style=flat-square" alt="Laravel Support"></a>
    <a href="https://github.com/php"><img src="https://img.shields.io/badge/php-7.1+-green.svg?style=flat-square" alt="Laravel Support"></a>
    <a href="https://travis-ci.org/LaravelRUS/laravel.ru"><img src="https://travis-ci.org/LaravelRUS/laravel.ru.svg?branch=2.0&style=flat-square" alt="Travis CI Build Status" /></a>
    <a href="https://github.com/auchenberg/volkswagen"><img src="https://auchenberg.github.io/volkswagen/volkswargen_ci.svg?v=1" alt="Volkswagen Tests Status" /></a>
    <a href="https://gitter.im/LaravelRUS/laravel.ru"><img src="https://badges.gitter.im/gitterHQ/gitter.png" alt="Чат"></a>
</p>

# Сайт русскоязычного сообщества Laravel

- Site: [https://new.laravel.su](https://new.laravel.su)

**ВНИМАНИЕ! Это нестабильная ветка, актуальная [находится тут](https://github.com/LaravelRUS/laravel.ru/tree/develop)**

## Установка

1. Скачайте и установите Docker и Docker Compose ([подробнее тут](./docker/README.md))
2. Откройте консоль и выполните `docker-compose up`
3. Откройте в браузере `https://127.0.0.1`

## Описание

- [Wiki](https://github.com/LaravelRUS/laravel.ru/wiki)
  - [Концепция](https://github.com/LaravelRUS/laravel.ru/wiki/%D0%9A%D0%BE%D0%BD%D1%86%D0%B5%D0%BF%D1%86%D0%B8%D1%8F-%D1%81%D0%B0%D0%B9%D1%82%D0%B0)
  - [Структура кода](https://github.com/LaravelRUS/laravel.ru/wiki/%D0%A1%D1%82%D1%80%D1%83%D0%BA%D1%82%D1%83%D1%80%D0%B0-%D0%BA%D0%BE%D0%B4%D0%B0) _\*Только для ветки **develop**_

## Помощь

- Перевод документации.
  - [Инструкция, как это делать правильно](https://github.com/translation-gang/ru.docs.laravel/blob/5.4-ru/readme.md).
  - [Обсуждение: Чат](https://gitter.im/LaravelRUS/docs)

## Docker
   
Список и краткая информация по сервисам, использующихся в сборке.
   
### PHP 7.1

- **Имя**: `laravel_su`
- **Доступ**: `docker exec -it --user=www-data laravel_su bash`
- **Root доступ**: `docker exec -it laravel bash`

### Nginx

- **Имя**: `laravel_su_nginx`
- **Доступ**: `docker exec -it laravel_su_nginx bash`
- **Внешние порты** 
   - `80`: http протокол, переводит на https
   - `443`: https протокол (внимание, сертификаты самподписные)
   
### Postgres

- **Имя**: `laravel_su_database`
- **Доступ**: `docker exec -it laravel_su_database bash`
- **Внешние порты** 
   - `5432`: Порт postgres сервера
   
### Sentry

- **Имя**: `sentry`
- **Доступ**: `docker exec -it sentry bash`
- **Внешние порты** 
   - `9000`: ...
   
### Redis

- **Имя**: `laravel_su_redis`
- **Доступ**: `docker exec -it laravel_su_redis bash`
- **Внешние порты** 
   - `6379`: Демон Redis сервера
   
### Supervisor

- **Имя**: `laravel_su_supervisor`
- **Доступ**: `docker exec -it laravel_su_supervisor bash`


