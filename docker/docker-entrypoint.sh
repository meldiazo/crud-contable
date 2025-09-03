#!/bin/sh

# Inicia PHP-FPM en el background
php-fpm -D

# Inicia Nginx en el foreground.
# El comando 'exec' asegura que Nginx se convierta en el proceso principal del contenedor,
# lo que evita que el contenedor se cierre.
exec nginx -g 'daemon off;'