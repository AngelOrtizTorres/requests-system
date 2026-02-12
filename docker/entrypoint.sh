#!/bin/bash

set -e

echo "==> Iniciando configuración de Laravel para Render..."

# Usar puerto dinámico de Render (por defecto 3000 para desarrollo local)
PORT=${PORT:-3000}
echo "==> Configurando puerto: $PORT"

# Actualizar configuración de Nginx con el puerto dinámico
sed -i "s/listen 3000;/listen $PORT;/g" /etc/nginx/http.d/default.conf

# Esperar a que la base de datos esté lista (solo en producción)
if [ "$APP_ENV" = "production" ]; then
    echo "==> Esperando base de datos..."

    # Verificar si las variables de base de datos están configuradas
    if [ -z "$DATABASE_URL" ] && [ -z "$DB_HOST" ]; then
        echo "==> WARNING: No database configuration found. Skipping migrations."
    else
        # Esperar un momento para que la BD esté lista
        sleep 10

        # Ejecutar migraciones
        echo "==> Ejecutando migraciones..."
        php artisan migrate --force || echo "Migration failed, continuing..."

        # Poblar datos iniciales (solo si es necesario)
        if [ "$SEED_DATABASE" = "true" ]; then
            echo "==> Poblando base de datos..."
            php artisan db:seed --force || echo "Seeding failed, continuing..."
        fi
    fi
fi

# Limpiar y cachear configuración
echo "==> Optimizando Laravel..."
php artisan config:cache || echo "Config cache failed, continuing..."
php artisan route:cache || echo "Route cache failed, continuing..."
php artisan view:cache || echo "View cache failed, continuing..."

# Limpiar cache de permisos si existe
echo "==> Limpiando cache de permisos..."
php artisan permission:cache-reset || echo "Permission cache reset not available, continuing..."

# Establecer permisos finales
echo "==> Estableciendo permisos..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Crear directorios necesarios
mkdir -p /var/log/nginx /var/run/nginx /var/log/supervisor
chown -R nginx:nginx /var/log/nginx /var/run/nginx

echo "==> Laravel listo para Render en puerto $PORT!"

# Ejecutar el comando original de Docker
exec "$@"
