FROM php:8.0.13-cli-alpine

ENV DEPS \
    autoconf \
    g++ \
    libtool \
    pcre-dev

RUN apk update\
    && apk add --no-cache ca-certificates bash make git\
    && apk add --update --no-cache $DEPS \
    # zip
    && apk add --no-cache libzip-dev openssl-dev\
    && docker-php-ext-configure zip --with-zip=/usr/include \
    && docker-php-ext-install zip \
    # xdebug
    && pecl install xdebug-3.0.1 \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

# Install SUPERVISOR
RUN apk add --no-cache supervisor \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet