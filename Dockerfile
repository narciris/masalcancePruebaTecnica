FROM php:8.2-fpm
LABEL authors='Nar programmer'
# Instalandao dependencias y extensiones php
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath


# Obteniendo cmposer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#estableciendo directorio de trabajo
WORKDIR /var/www

COPY . .

# Cambiar permisos a las carpetas necesarias de Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer install

CMD ["php-fpm"]
