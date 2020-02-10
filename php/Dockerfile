FROM php:alpine

RUN apk update \
    && apk upgrade \
    && apk add --update --no-cache \
        $PHPIZE_DEPS \
    && pecl install \
        xdebug \
    && apk del $PHPIZE_DEPS \
    && docker-php-ext-enable \
        xdebug \
    && mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer global require hirak/prestissimo
