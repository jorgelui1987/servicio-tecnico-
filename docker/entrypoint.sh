#!/bin/bash

set -e

# Esperar a que MySQL esté listo
echo "Esperando a que MySQL esté disponible..."
until php -r "try { new PDO('mysql:host='.\$_ENV['DB_HOST'].';port='.\$_ENV['DB_PORT'], \$_ENV['DB_USERNAME'], \$_ENV['DB_PASSWORD']); echo 'OK'; } catch(PDOException \$e) { echo \$e->getMessage(); exit(1); }" 2>/dev/null | grep -q 'OK'; do
    sleep 2
    echo "Reintentando conexión a MySQL..."
done
echo "MySQL está listo!"

# Generar key de la aplicación si no existe
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
    echo "Archivo .env creado desde .env.example"
fi

# Generar APP_KEY si está vacía
if ! grep -q "APP_KEY=base64" /var/www/html/.env 2>/dev/null; then
    cd /var/www/html && php artisan key:generate --force
    echo "APP_KEY generada"
fi

# Ejecutar migraciones
cd /var/www/html && php artisan migrate --force
echo "Migraciones ejecutadas"

# Crear enlace simbólico para storage
cd /var/www/html && php artisan storage:link --force || true
echo "Storage link creado"

# Limpiar caché
cd /var/www/html && php artisan config:clear
cd /var/www/html && php artisan cache:clear

echo "========================================"
echo "Aplicación lista en http://localhost:8000"
echo "phpMyAdmin en http://localhost:8080"
echo "========================================"

exec "$@"