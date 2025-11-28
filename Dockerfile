FROM php:8.4-cli

RUN apt update -y && apt upgrade -y \
    && apt install -y zip fswatch \
    && apt autoremove -y

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
