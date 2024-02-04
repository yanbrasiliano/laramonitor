FROM php:8.2-fpm

ARG user=hiyan
ARG uid=1000

RUN apt-get update && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  zip \
  unzip \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user \
  && mkdir -p /home/$user/.composer \
  && chown -R $user:$user /home/$user

RUN pecl install -o -f redis \
  && rm -rf /tmp/pear \
  && docker-php-ext-enable redis

WORKDIR /var/www

COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY permissions.sh ./permissions.sh

RUN chmod +x ./permissions.sh \
  && ./permissions.sh 
  
USER $user
