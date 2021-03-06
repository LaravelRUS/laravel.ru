#!/bin/bash

cd /var/www

chown www-data:www-data ./laravel.su -R
chmod 0777 ./laravel.su

cd /var/www/laravel.su

cp -n .env.example .env

usermod -u 1000 www-data

composer install

php ./artisan key:generate
php ./artisan migrate --force

php ./artisan articles:import
php ./artisan docs:sync

/usr/bin/nohup php ./artisan queue:work --queue=high,default > ./storage/logs/queue.log 2>&1 &

php-fpm
