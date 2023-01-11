FROM php:8.1-fpm

COPY ./php/php.ini "${PHP_INI_DIR}/conf.d"
COPY ./xdebug/99-xdebug.ini "${PHP_INI_DIR}/conf.d"
# COPY ./env-vars.conf "/usr/local/etc/php-fpm.d"

# RUN echo "env[SECRET_KEY] = 123" > /usr/local/etc/php-fpm.d/env-vars.conf
# CMD chmod +x /usr/local/etc/php-fpm.d/env-vars.conf

# ADD ./php/php.ini /usr/local/etc/php

# RUN apt-get update && apt-get install -y \
#     git \
#     curl \
#     zip \
#     vim \
#     unzip

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=usr/local/bin --filename=composer

# RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

WORKDIR /var/www/html

# RUN ls /var/www/html/logs/
# RUN chown -R root:root /var/www/html/logs/php/performance
# RUN chmod 777 /var/www/html/logs/php/performance


# FROM php:8.2-fpm-alpine
# ADD ./php/php.ini /usr/local/etc/php
# RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
