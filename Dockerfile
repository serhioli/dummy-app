FROM php:8.1-fpm-alpine as composer-image

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --version=2.3.10 --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

WORKDIR /app
COPY composer.lock composer.json /app/
RUN composer install --no-dev --no-progress --ansi -ao

FROM caddy:2-alpine as caddy

FROM php:8.1-fpm-alpine

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

COPY --chown=www-data:www-data ./src /app/src
COPY --chown=www-data:www-data --from=composer-image ./app/vendor /app/vendor


EXPOSE 80
EXPOSE 443
EXPOSE 2019

WORKDIR /app

CMD ["caddy", "run", "--config", "/app/Caddyfile", "--adapter", "caddyfile"]