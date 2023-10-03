FROM php:8.0-fpm

WORKDIR /var/www

RUN apt-get update && apt-get -y install \
    cron \
    curl \
    libicu-dev \
    libmemcached-dev \
    libmcrypt-dev \
    nano \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl

RUN docker-php-ext-install pdo_mysql intl

COPY etc/default.ini /usr/local/etc/php/conf.d/default.ini

RUN groupadd -g 1000 www

RUN useradd -u 1000 -ms /bin/bash -g www www


COPY --chown=www:www ./app /var/www

USER www

EXPOSE 9000

EXPOSE 443

EXPOSE 80

CMD ["php-fpm"]