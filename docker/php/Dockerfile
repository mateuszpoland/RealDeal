FROM composer:2.0 as composer

FROM php:8.0-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
    apt-get install -y \
    libzip-dev

## install php extensions in docker
## https://github.com/mlocati/docker-php-extension-installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions amqp && \
    install-php-extensions xdebug

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu
RUN docker-php-ext-install opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /usr/src/app

COPY server/ /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin
