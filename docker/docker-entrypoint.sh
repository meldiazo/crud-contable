#!/bin/sh
set -e

# Iniciar PHP-FPM en segundo plano para que el script pueda continuar
php-fpm -D

# Esperar a que el socket de PHP-FPM esté disponible
if [ ! -S /var/run/php-fpm.sock ]; then
    echo "Esperando a que el socket de php-fpm esté disponible..."
    while [ ! -S /var/run/php-fpm.sock ]; do
        sleep 0.1
    done
fi

# Corregir los permisos del socket para que Nginx pueda acceder a él.
# El error 502 Bad Gateway a menudo se debe a que Nginx no puede leer este socket.
chown www-data:www-data /var/run/php-fpm.sock
chmod 660 /var/run/php-fpm.sock

# Iniciar Nginx en primer plano. Esta línea es lo que hace que el contenedor
# siga en ejecución, ya que Nginx se convertirá en el proceso principal.
exec nginx -g "daemon off;"
