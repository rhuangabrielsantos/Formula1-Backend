FROM php:7.2-cli

RUN set -e

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y curl nano git

RUN apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
