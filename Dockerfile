# Menggunakan base image PHP 8.2 FPM
FROM php:8.2-fpm-alpine

# Menginstal ekstensi PHP yang dibutuhkan (misalnya MySQLi)
RUN apk update && apk add \
    mysql-client \
    && docker-php-ext-install pdo_mysql mysqli

# Mengatur user/group ke www-data
WORKDIR /var/www/html