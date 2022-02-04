FROM composer:2 as composer-image

FROM nginx/unit:1.26.1-php8.1

ENV APP_ENV="prod" \
    APP_DEBUG="false" \
    APP_SLOWING_ENABLED="false" \
    APP_SLOWING_MIN_MICROSECONDS="0" \
    APP_SLOWING_MAX_MICROSECONDS="0"

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"; \
    apt-get update; \
    apt-get --no-install-recommends --no-install-suggests -y install \
        bash \
        git \
        unzip \
        curl \
        $PHPIZE_DEPS; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*; \
    docker-php-ext-install opcache; \
    docker-php-ext-enable opcache

COPY --chown=unit:unit ./src /app
# Copy Composer
COPY --from=composer-image /usr/bin/composer /usr/bin/composer
RUN composer install -d /app --no-dev --no-progress --ansi -ao

COPY ./docker/app/docker-entrypoint.d /docker-entrypoint.d

WORKDIR /app
