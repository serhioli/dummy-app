FROM php:8.1-fpm-alpine

ENV APP_ENV="dev" \
    APP_DEBUG="true" \
    APP_SLOWING_ENABLED="false" \
    APP_SLOWING_MIN_MICROSECONDS="0" \
    APP_SLOWING_MAX_MICROSECONDS="0"

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"; \
    apk add --no-cache \
        bash \
        git \
        unzip \
        curl; \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS; \
    pecl install xdebug; \
    docker-php-ext-install opcache; \
    docker-php-ext-enable xdebug; \
    docker-php-ext-enable opcache; \
    apk del --no-network .build-deps

COPY src /app

RUN chown -R www-data:www-data /app

WORKDIR /app
