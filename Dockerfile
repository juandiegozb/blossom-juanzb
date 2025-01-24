FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY ./src /var/www/html

RUN chown -R www-data:www-data /var/www/html


RUN composer require --dev phpunit/phpunit ^10.0

EXPOSE 9000

CMD ["php-fpm"]
