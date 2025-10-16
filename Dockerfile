### Builder (composer) stage - instala dependências
FROM composer:2 AS vendor

WORKDIR /app

# Copia apenas composer files para cache
COPY composer.json composer.lock /app/

# Se usa extensões ext-nonce em composer, ajuste o COMPOSER_ALLOW_SUPERUSER conforme necessário
RUN composer install --no-dev --prefer-dist --no-autoloader --no-scripts --no-progress --no-interaction

# -------------------------------------------------------
### Final stage - runtime PHP-FPM
FROM php:8.2-fpm

# Build args to map host UID/GID (helpful em dev)
ARG PUID=1000
ARG PGID=1000
ARG INSTALL_XDEBUG=false

ENV TZ=UTC
ENV COMPOSER_ALLOW_SUPERUSER=1

# Instala pacotes do sistema e extensões PHP comuns para Laravel
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    openssl \
    procps \
    nano \
    ca-certificates \
    gnupg2 \
  && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip xml opcache \
  && docker-php-ext-configure gd --with-freetype --with-jpeg

# Instala icu (se precisar de intl) - descoment if needed
# RUN apt-get update && apt-get install -y libicu-dev && docker-php-ext-install intl

# Ajusta www-data UID/GID para coincidir com host (ajuda permissões em dev)
RUN set -eux; \
    if id -u www-data >/dev/null 2>&1; then \
        usermod -u ${PUID} www-data || true; \
        groupmod -g ${PGID} www-data || true; \
    else \
        groupadd -g ${PGID} www-data; \
        useradd -u ${PUID} -g ${PGID} -m -s /bin/bash www-data; \
    fi

# Copia composer (do stage vendor) e instala autoload + scripts (produção/development controlado no compose)
COPY --from=vendor /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia app
COPY . /var/www/html

# Instala dependências composer (se já tiver rodado no build de vendor, isso será rápido)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev && \
    composer clear-cache || true

# Gera diretórios necessários e define permissões seguras
RUN mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Copia entrypoint
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose php-fpm socket port (internal)
EXPOSE 9000

# Use www-data by default
USER www-data

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
