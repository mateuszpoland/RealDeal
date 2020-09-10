# ./docker/php/Dockerfile
FROM php:7.4-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu \
    pecl install mongodb

RUN apt-get update && \
apt-get install -y \
zlib1g-dev \
libzip-dev

#RUN docker-php-ext-install libzip-dev
RUN docker-php-ext-enable apcu

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && mv composer /usr/local/bin/composer

WORKDIR /usr/src/app

COPY server/ /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin
