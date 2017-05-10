FROM debian:jessie

ENV DEBIAN_FRONTEND noninteractive
ARG PHP_UPSTREAM=php

# Install core dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends curl ca-certificates nano \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install dotdeb repo
RUN echo "deb http://packages.dotdeb.org jessie all" > /etc/apt/sources.list.d/dotdeb.list \
    && curl -sS https://www.dotdeb.org/dotdeb.gpg | apt-key add - \
    && apt-get update

# Install Nginx and Nginx extensions
RUN apt-get -y --no-install-recommends install -y \
    nginx \
    nginx-common \
    nginx-extras

# Global configs
ADD nginx.conf /etc/nginx/nginx.conf
ADD .htpasswd /etc/nginx/.htpasswd

# Laravel.Dev
ADD sites-available/default.conf /etc/nginx/sites-available/
RUN ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default.conf

RUN echo "upstream php-upstream { server ${PHP_UPSTREAM}:9000; }" > /etc/nginx/conf.d/upstream.conf

# SSL Certs
ADD ssl/ssl-cert-snakeoil.pem /etc/ssl/certs/
ADD ssl/ssl-cert-snakeoil.key /etc/ssl/private/

CMD ["nginx"]

EXPOSE 80 443
