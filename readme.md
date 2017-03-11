# Сайт русскоязычного сообщества Laravel

[![Build Status](https://travis-ci.org/LaravelRUS/laravel.ru.svg?branch=2.0)](https://travis-ci.org/LaravelRUS/laravel.ru)
[![Volkswagen Tests Status](https://auchenberg.github.io/volkswagen/volkswargen_ci.svg?v=1)](https://github.com/auchenberg/volkswagen) 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LaravelRUS/laravel.ru/badges/quality-score.png?b=2.0)](https://scrutinizer-ci.com/g/LaravelRUS/laravel.ru/?branch=2.0)
[![StyleCI](https://styleci.io/repos/18944609/shield?branch=2.0)](https://styleci.io/repos/18944609)
[![Чат](https://badges.gitter.im/gitterHQ/gitter.png)](https://gitter.im/LaravelRUS/laravel.ru)

- Site: [https://new.laravel.su](https://new.laravel.su)
- WebDav: [https://new.laravel.su/cdn](https://new.laravel.su/cdn)
- GraphQL API: [https://new.laravel.su/graphiql](https://new.laravel.su/graphiql)

**ВНИМАНИЕ! Это нестабильная ветка, актуальная [находится тут](https://github.com/LaravelRUS/laravel.ru/tree/develop)**

## Установка

1. Скачайте и установите Docker и Docker Compose ([подробнее тут](./docker/README.md))
2. Откройте консоль и выполните `docker-compose up`
3. Откройте в браузере `http://127.0.0.1`

#### Требования для работы вне Docker окружения

- PHP 7.1 или выше
- MySql 5.7 или выше
- Apache или Nginx

#### Сборка JS вне докера

- Текущий вариант: `cd server && npm run build`
- React: `cs client && npm run build:prod`

## Описание

- [Wiki](https://github.com/LaravelRUS/laravel.ru/wiki)
  - [Концепция](https://github.com/LaravelRUS/laravel.ru/wiki/%D0%9A%D0%BE%D0%BD%D1%86%D0%B5%D0%BF%D1%86%D0%B8%D1%8F-%D1%81%D0%B0%D0%B9%D1%82%D0%B0)
  - [Структура кода](https://github.com/LaravelRUS/laravel.ru/wiki/%D0%A1%D1%82%D1%80%D1%83%D0%BA%D1%82%D1%83%D1%80%D0%B0-%D0%BA%D0%BE%D0%B4%D0%B0) _\*Только для ветки **develop**_
   
## Помощь
   
- Перевод документации. 
  - [Инструкция, как это делать правильно](https://github.com/translation-gang/ru.docs.laravel/blob/5.4-ru/readme.md).
  - [Обсуждение: Чат](https://gitter.im/LaravelRUS/docs)
- Работа над [кодом](https://trello.com/b/lDqJrw8x/-). 
  - В разработке используется модель [git-flow](https://www.atlassian.com/ja/git/workflows/pageSections/00/contentFullWidth/0/tabs/02/pageSections/010/contentFullWidth/0/content_files/file0/document/git-workflow-release-cycle-4maintenance.png)
