#!/bin/bash

cd /var/www

# =====================================================
#   Set permissions for web site
# =====================================================

chown www-data:www-data ./laravel.su/storage -R
chmod 0777 ./laravel.su/storage

chown www-data:www-data ./laravel.su/bootstrap/cache -R
chmod 0777 ./laravel.su/bootstrap/cache

mkdir -p /var/www/.composer
chmod 0777 /var/www/.composer

# =====================================================
#   Build web site
# =====================================================

cd /var/www/laravel.su

cp -n .env.example .env

usermod -u 1000 www-data


# =====================================================
#   RUN
# =====================================================

composer install

php ./artisan key:generate
php ./artisan migrate --seed --force

php-fpm
