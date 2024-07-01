# syntax=docker/dockerfile:1

FROM php:8.1.2-apache as base

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip mysqli pdo pdo_mysql

RUN a2enmod rewrite

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

COPY --link --chown=:www-data . /var/www/html

WORKDIR /var/www/html

RUN chown -R :www-data /var/www/html \
    && chmod -R 775 /var/www/html

RUN chmod +x /var/www/html/entrypoint.sh
USER www-data:www-data

ENTRYPOINT [ "/var/www/html/entrypoint.sh" ]
   
FROM base as production
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
WORKDIR /var/www/html
RUN mkdir vendor \
    && chown root:www-data /var/www/html/vendor \
    && chmod -R 775 /var/www/html/vendor
COPY composer.json /var/www/html/composer.json
RUN composer install
