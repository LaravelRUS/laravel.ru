#!/bin/sh

cd /var/www/laravel-su.dev 
composer update 
php artisan debugbar:publish
php artisan config:publish barryvdh/laravel-debugbar
