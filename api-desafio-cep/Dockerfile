# syntax=docker/dockerfile:1

FROM php:8.1.2-apache as base

COPY . /var/www/html

RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

FROM base as dev

RUN pecl install pecl install xdebug-3.2.1 \
   && docker-php-ext-enable xdebug

   
RUN echo "xdebug.mode=debug" >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini" \
   && echo "xdebug.start_with_request=yes" >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini" \
   && echo "xdebug.client_host=host.docker.internal" >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini" \
   && echo "xdebug.client_port=9003" >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini" \
   && echo "xdebug.log=/var/log/xdebug.log" >> "$PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini"
   
RUN touch /var/log/xdebug.log && chown www-data:www-data /var/log/xdebug.log

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
USER www-data
   
FROM base as production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
USER www-data
