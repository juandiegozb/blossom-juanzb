FROM php:8.2-fpm


RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

COPY ./src /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
