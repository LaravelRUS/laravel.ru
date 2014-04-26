#!/bin/sh

apt-get install mc -y
apt-get install htop -y
apt-get install mytop -y
mysql -uroot -p123 -e 'CREATE DATABASE IF NOT EXISTS `laravel-su`;'
cd /var/www/laravel-su.dev 
composer update 
php artisan debugbar:publish
php artisan config:publish barryvdh/laravel-debugbar