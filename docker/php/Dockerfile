
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
        unzip \
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
        pdo_pgsql \
        pdo_sqlite \
        pcntl \
        sockets \
        bcmath \
        opcache \
        exif \
        tokenizer \
        gd

#####################################
# PCNTL EXTENSION:
#####################################

ARG ENABLE_PCNTL=false
RUN if [ ${ENABLE_PCNTL} = true ]; then \
    docker-php-ext-install pcntl \
;fi

#####################################
# EV EXTENSION:
#####################################

ARG ENABLE_EV=false
RUN if [ ${ENABLE_EV} = true ]; then \
    # Install the ev extension
    pecl install ev && \
    docker-php-ext-enable ev \
;fi

#####################################
# XDEBUG EXTENSION:
#####################################

ARG ENABLE_XDEBUG=false
RUN if [ ${ENABLE_XDEBUG} = true ]; then \
    # Install the xdebug extension
    pecl install xdebug && \
    docker-php-ext-enable xdebug \
;fi


# Copy xdebug configration for remote debugging
ENV XDEBUGINI_PATH=/usr/local/etc/php/conf.d/xdebug.ini
COPY ./xdebug.ini $XDEBUGINI_PATH
RUN echo "xdebug.remote_host="`/sbin/ip route|awk '/default/ { print $3 }'` >> $XDEBUGINI_PATH

#
# Export configs
#
COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini
RUN docker-php-ext-enable opcache

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

ADD ./laravel.ini /usr/local/etc/php/conf.d
ADD ./php-fpm.conf /usr/local/etc/php-fpm.d

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

ADD ./laravel.sh /laravel.sh
RUN chmod 0755 /laravel.sh

WORKDIR /var/www/laravel.su

RUN chmod -R 0777 /var/www

RUN usermod -u 1000 www-data
USER www-data

EXPOSE 9000

CMD ["/laravel.sh"]
