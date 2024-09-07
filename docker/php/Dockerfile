FROM php:8.0-fpm-alpine

# COPY php.ini
COPY ./docker/php/php.ini /user/local/etc/php/php.ini

# Composer install
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# install Node.js
COPY --from=node:10.22 /usr/local/bin /usr/local/bin
COPY --from=node:10.22 /usr/local/lib /usr/local/lib

RUN apk update && \
    apk add \
    bash \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath

RUN apk add nodejs npm && npm install n -g && n 12.14

WORKDIR /var/www/html