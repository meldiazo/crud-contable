#!/bin/sh
set -e

echo "Iniciando PHP-FPM..."
php-fpm -D

echo "Esperando a que el socket de PHP-FPM esté disponible en /var/run/php-fpm.sock..."
SOCKET_PATH="/var/run/php-fpm.sock"
START_TIME=$(date +%s)
TIMEOUT=60
while [ ! -S "$SOCKET_PATH" ]; do
    CURRENT_TIME=$(date +%s)
    ELAPSED=$((CURRENT_TIME - START_TIME))
    if [ "$ELAPSED" -ge "$TIMEOUT" ]; then
        echo "Error: Tiempo de espera agotado. El socket de PHP-FPM no apareció."
        exit 1
    fi
    sleep 0.5
done
echo "Socket de PHP-FPM encontrado. Corrigiendo permisos."

# Asegurarse de que el usuario de Nginx ('www-data') pueda acceder al socket.
chown www-data:www-data "$SOCKET_PATH" || echo "Advertencia: No se pudo cambiar el propietario del socket. El script continuará, pero verifique los usuarios en el contenedor."
chmod 660 "$SOCKET_PATH" || { echo "Error: No se pudo cambiar los permisos del socket."; exit 1; }

echo "Permisos del socket corregidos. Iniciando Nginx."

# Iniciar Nginx en primer plano, lo que mantendrá el contenedor en ejecución
exec nginx -g "daemon off;"
