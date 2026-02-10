#!/bin/bash

set -e

echo "==> Iniciando configuracion de Laravel..."

# Esperar a que la base de datos este lista
echo "==> Esperando base de datos..."
sleep 5

# Ejecutar migraciones
echo "==> Ejecutando migraciones..."
php artisan migrate --force

# Poblar datos iniciales (solo si es necesario)
if [ "$SEED_DATABASE" = "true" ]; then
    echo "==> Poblando base de datos..."
    php artisan db:seed --force
fi

# Limpiar y cachear configuracion
echo "==> Optimizando Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Limpiar cache de permisos
echo "==> Limpiando cache de permisos..."
php artisan permission:cache-reset || true

# Establecer permisos finales
echo "==> Estableciendo permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "==> Laravel listo!"

# Ejecutar el comando original de Docker
exec "$@"
