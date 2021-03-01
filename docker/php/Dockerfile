# ./docker/php/Dockerfile
ARG PHP_VERSION=7.4

FROM php:${PHP_VERSION}-fpm

ARG GID=1000
ARG UID=1000
# Prevent Symfony Flex from generating a project ID at build time
ARG SYMFONY_SKIP_REGISTRATION=1

ARG APP_ENV=${APP_ENV}
ENV APP_PATH=/usr/src/app
ARG WITH_XDEBUG=false

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu \
    pecl install mongodb

RUN apt-get update && \
apt-get install -y \
zlib1g-dev \
libzip-dev

RUN apt-get install sudo -y

RUN docker-php-ext-enable apcu

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"

#RUN if [ $WITH_XDEBUG = "true" ] ; then \
#	    pecl install xdebug; \
#	    docker-php-ext-enable xdebug; \
#	    echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
#	    echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
#	    echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
#	    echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
#	fi ;

WORKDIR ${APP_PATH}

COPY server/ /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin
