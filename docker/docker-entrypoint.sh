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
# Esta sección es crucial para evitar errores.
# El 'chown' podría fallar si el usuario 'www-data' no existe o los permisos son incorrectos.
# Por eso, usaremos el usuario y grupo del socket que php-fpm creó, y
# luego corregiremos los permisos para que Nginx pueda leer/escribir.
SOCKET_OWNER=$(stat -c '%U' /var/run/php-fpm.sock)
SOCKET_GROUP=$(stat -c '%G' /var/run/php-fpm.sock)

# Si el propietario o grupo no es el esperado, intentamos cambiarlo.
if [ "$SOCKET_OWNER" != "www-data" ] || [ "$SOCKET_GROUP" != "www-data" ]; then
    chown www-data:www-data /var/run/php-fpm.sock || true
fi
chmod 660 /var/run/php-fpm.sock

# Iniciar Nginx en primer plano, lo que mantendrá el contenedor en ejecución
exec nginx -g "daemon off;"
