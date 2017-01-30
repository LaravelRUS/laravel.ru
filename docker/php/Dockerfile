#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#

FROM php:7.1-fpm

RUN DEBIAN_FRONTEND=noninteractive

# Install dotdeb repo
RUN echo "deb http://packages.dotdeb.org jessie all" > /etc/apt/sources.list.d/dotdeb.list \
    && curl -sS https://www.dotdeb.org/dotdeb.gpg | apt-key add - \
    && apt-get update

# Install required libs
RUN apt-get update && \
    apt-get install -y \
        sudo \
        git \
        libcurl4-openssl-dev \
        libedit-dev \
        libssl-dev \
        libxml2-dev \
        libsqlite3-dev \
        sqlite3 \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng12-dev \
        libfreetype6-dev \
        libssl-dev \
        libmcrypt-dev \
        libjudydebian1 \
        libjudy-dev \
        cron \
    && apt-get clean

#
# Configure
#
RUN docker-php-ext-configure gd \
        --enable-gd-native-ttf \
        --with-jpeg-dir=/usr/lib \
        --with-freetype-dir=/usr/include/freetype2

#
# Install extensions
#
RUN docker-php-ext-install \
        mcrypt \
        pdo_mysql \
        pdo_sqlite \
        pcntl \
        sockets \
        bcmath \
        opcache \
        gd

#
# Install non standard extensions
#
RUN pecl install zip
RUN pecl install ev
RUN pecl install -o -f redis

#
# Export configs
#
COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini

#
# Enable non standard extensions
#
RUN docker-php-ext-enable \
    opcache \
    zip \
    redis \
    ev

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

ADD ./laravel.ini /usr/local/etc/php/conf.d
ADD ./laravel.pool.conf /usr/local/etc/php-fpm.d/

RUN rm -r /var/lib/apt/lists/*
RUN rm -rf /tmp/pear


#####################################
# Crontab
#####################################
COPY ./crontab /var/spool/cron/crontabs


#####################################
# Composer:
#####################################

# Install composer and add its bin to the PATH.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN echo "" >> ~/.bashrc && \
    echo 'export PATH="/var/www/laravel.su/vendor/bin:$PATH"' >> ~/.bashrc

ADD ./start.sh /start.sh
RUN chmod 0755 /start.sh

WORKDIR /var/www/laravel.su

RUN usermod -u 1000 www-data
USER www-data

EXPOSE 9000

