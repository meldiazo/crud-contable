#!/bin/sh

# Inicia PHP-FPM
php-fpm -D

# Inicia Nginx
nginx -g 'daemon off;'