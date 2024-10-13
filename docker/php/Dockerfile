FROM php:8.1.27-apache

# Установка расширений PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_mysql

# Установка Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

WORKDIR /var/www/html

# Устанавливаем зависимости через Composer (если есть composer.json)
RUN if [ -f "composer.json" ]; then composer install; fi