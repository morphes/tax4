FROM php:7.2-fpm

RUN apt-get update

RUN apt-get install -y zlib1g-dev

RUN docker-php-ext-install pdo_mysql && docker-php-ext-install zip

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

WORKDIR /var/www/tax