FROM php:7-fpm

RUN apt-get update && apt-get install -y \
        g++ \
        libicu-dev \
        libxml2-dev \
        nano \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install soap
