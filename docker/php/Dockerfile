FROM php:7.4-fpm-alpine AS base

# Install dependencies
RUN apk add --no-cache freetype \
    bash mysql-client curl \
    libzip-dev zip zlib-dev \
    redis nodejs npm build-base gcc autoconf \
    libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) pdo_mysql zip exif gd && \
    apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

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
