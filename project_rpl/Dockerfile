FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip \
  libonig-dev \
  libzip-dev \
  && docker-php-ext-install pdo_mysql mbstring zip exif pcntl
COPY . /var/www/html/
WORKDIR /var/www/html/
EXPOSE 8009