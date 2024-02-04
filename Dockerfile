FROM php:8.2-fpm

ARG user=hiyan
ARG uid=1000

# Instalar dependências do sistema e extensões PHP
RUN apt-get update && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  libpq-dev \
  zip \
  unzip \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP
RUN docker-php-ext-install mbstring exif pcntl bcmath gd sockets pdo_pgsql

# Instalar extensão Redis
RUN pecl install -o -f redis \
  && rm -rf /tmp/pear \
  && docker-php-ext-enable redis

# Instalar Xdebug
RUN pecl install xdebug-3.2.0 \
  && docker-php-ext-enable xdebug

# Configurações adicionais do Xdebug
RUN echo 'xdebug.mode=coverage' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
  && echo 'xdebug.start_with_request=yes' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Adicionar repositório NodeSource e instalar Node.js
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
  && apt-get install -y nodejs

# Instalar NPM
RUN curl -sL https://www.npmjs.com/install.sh | sh

# Verificar a instalação do Node.js e do NPM
RUN node --version \
  && npm --version

# Criar usuário do sistema
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
  && mkdir -p /home/$user/.composer \
  && chown -R $user:$user /home/$user

WORKDIR /var/www

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar arquivos de configuração customizados e scripts
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY permissions.sh ./permissions.sh

# Tornar o script de permissões executável e executá-lo
RUN chmod +x ./permissions.sh \
  && ./permissions.sh

USER $user
