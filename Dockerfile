FROM composer:2 as composer-image

COPY composer.lock composer.json ./

RUN composer install --no-dev --no-progress --ansi -ao

FROM nginx/unit:1.26.1-php8.1

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

ENV APP_ENV="prod" \
    APP_DEBUG="false" \
    APP_SLOWING_ENABLED="false" \
    APP_SLOWING_MIN_MICROSECONDS="0" \
    APP_SLOWING_MAX_MICROSECONDS="0"

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"  && \
        install-php-extensions \
                opcache \
                xdebug && \
        echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/99-xdebug.ini && \
        echo "xdebug.client_host=0.0.0.0" >> /usr/local/etc/php/conf.d/99-xdebug.ini && \
        echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/99-xdebug.ini

COPY --chown=unit:unit ./src /app

COPY ./docker/app/docker-entrypoint.d /docker-entrypoint.d

WORKDIR /app
