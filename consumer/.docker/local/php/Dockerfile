FROM php:8.2-fpm

ARG DEBUG_HOST
ARG DEBUG_PORT

#ENV user=deploybot
#ENV uid=1000

RUN apt-get update \
    && apt-get upgrade -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsodium-dev \
    zip \
    unzip

RUN docker-php-ext-configure pcntl --enable-pcntl

# Install PHP extensions
RUN docker-php-ext-install bcmath exif gd mbstring pcntl pdo_mysql sodium gd opcache

RUN apt-get -y install git ssh

COPY . /var/www

WORKDIR /var/www

RUN mkdir -p /run/php/
COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf

#COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add the Pact binary directory to the PATH
ENV PATH="/app/pact/bin:${PATH}"

EXPOSE ${DEBUG_PORT}
