FROM php:8.2-fpm-alpine

# Install PHP extensions
RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    postgresql-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable pdo_pgsql

# Set working directory
WORKDIR /var/www

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy entrypoint script
COPY docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Copy custom php ini file
COPY docker/00-config.ini /usr/local/etc/php/conf.d/

# Expose port
EXPOSE 9000

# Run the entrypoint script
ENTRYPOINT ["docker-entrypoint.sh"]
