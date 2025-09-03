# Primera etapa: Composer
FROM composer:2.4 as composer

# Segunda etapa: Build de la aplicación
FROM php:8.2-fpm-alpine

# Instala dependencias del sistema operativo
RUN apk add --no-cache \
    nginx \
    git \
    libzip-dev \
    libpng-dev \
    jpeg-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev \
    && docker-php-ext-install pdo_pgsql zip exif mbstring gd

# Instala Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo
WORKDIR /var/www

# Copia los archivos del proyecto
COPY . .

# Instala las dependencias del proyecto
RUN composer install --optimize-autoloader --no-dev

# Ejecuta los comandos de optimización
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Configura Nginx
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

# Inicia Nginx y PHP-FPM
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["-g", "daemon off;"]