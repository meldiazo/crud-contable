# Usa una imagen base de PHP-FPM, que es ideal para entornos de producción.
FROM php:8.2-fpm-alpine

# Instala dependencias del sistema operativo que Laravel necesita.
RUN apk add --no-cache \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    jpeg-dev \
    oniguruma-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql zip exif mbstring gd

# Instala Composer globalmente.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define el directorio de trabajo dentro del contenedor.
WORKDIR /app

# Copia los archivos de tu proyecto al contenedor.
COPY . .

# Instala las dependencias del proyecto.
# El comando `--no-dev` evita que se instalen las dependencias de desarrollo, lo que reduce el tamaño de la imagen.
RUN composer install --no-dev --optimize-autoloader

# Ejecuta los comandos de optimización de Laravel.
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# El comando a ejecutar para iniciar la aplicación.
# Este inicia PHP-FPM, que es el servicio que ejecutará tu aplicación.
CMD ["php-fpm"]

EXPOSE 9000
```
eof

---

### Siguientes pasos

1.  **Copia y pega** el contenido del archivo de arriba en un nuevo archivo de texto simple.
2.  **Guárdalo** en la carpeta principal de tu proyecto de Laravel (donde está `artisan`) y asegúrate de que el nombre exacto del archivo sea **`Dockerfile`** (sin ninguna extensión como `.txt`).
3.  **Vuelve a tu terminal** y ejecuta los siguientes comandos para agregar el nuevo archivo a tu repositorio y subirlo a GitHub:
    ```bash
    git add Dockerfile
    git commit -m "Agrega Dockerfile para despliegue en Render"
    git push -u origin master
    
