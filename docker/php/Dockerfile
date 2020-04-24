FROM php:7.3-fpm-alpine AS base

# Install dependencies
RUN apk --no-cache add bash mysql-client curl libzip-dev zip zlib-dev redis nodejs npm build-base gcc autoconf

# Install extensions
RUN docker-php-ext-install pdo_mysql zip

# Install redis native ext
RUN pecl install -o -f redis igbinary \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis igbinary

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Attach volume
VOLUME /app

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

FROM base AS dev
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
