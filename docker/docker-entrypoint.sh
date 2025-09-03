#!/bin/sh
set -e

# Iniciar PHP-FPM en segundo plano
php-fpm -D

# Esperar a que el socket de PHP-FPM esté disponible
if [ ! -S /var/run/php-fpm.sock ]; then
    echo "Esperando a que el socket de php-fpm esté disponible..."
    while [ ! -S /var/run/php-fpm.sock ]; do
        sleep 0.1
    done
fi

# Corregir permisos del socket para que Nginx pueda acceder
chown www-data:www-data /var/run/php-fpm.sock
chmod 660 /var/run/php-fpm.sock

# Iniciar Nginx en primer plano, lo que mantendrá el contenedor en ejecución
exec nginx -g "daemon off;"
