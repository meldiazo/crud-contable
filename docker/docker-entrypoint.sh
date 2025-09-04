#!/bin/sh
set -e

# Iniciar php-fpm en segundo plano.
php-fpm -D

# Esperar a que el socket de php-fpm esté disponible.
# Es crucial que Nginx no se inicie hasta que php-fpm esté listo.
echo "Esperando a que el socket de php-fpm esté disponible..."
while [ ! -S /var/run/php-fpm.sock ]; do
    sleep 0.1
done

# Corregir los permisos del socket para que Nginx pueda acceder a él.
# Este es un paso crítico para evitar el error 502 Bad Gateway.
chown www-data:www-data /var/run/php-fpm.sock
chmod 660 /var/run/php-fpm.sock

# Iniciar Nginx en primer plano, lo que mantendrá el contenedor en ejecución.
exec nginx -g "daemon off;"
