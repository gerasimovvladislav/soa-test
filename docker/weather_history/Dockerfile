FROM php:7.2-fpm

# Install modules
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libzip-dev \
        libmcrypt-dev \
        libicu-dev \
        libpq-dev \
        unzip\
        nano \
        bash \
        gnupg2 \
        wget \
        nginx \
        git \
            --no-install-recommends

RUN docker-php-ext-install pdo gettext zip mbstring bcmath intl
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo_pgsql pgsql
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

COPY install-composer.sh /
COPY php.ini /usr/local/etc/php/
COPY www.conf /usr/local/etc/php/
COPY nginx/default.conf /etc/nginx/sites-enabled/default

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh /install-composer.sh \
    && rm /install-composer.sh

RUN usermod -u 1000 www-data

VOLUME /root/.composer
WORKDIR /app

EXPOSE 80
CMD php-fpm -D && nginx -g "daemon off;"