#!/bin/sh

echo "🚀 Starting Supplify Laravel App..."

# Clear cache agar .env terbaru terbaca
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Hanya buat symbolic link storage kalau belum ada
if [ ! -d "/var/www/public/storage" ]; then
    php artisan storage:link
    echo "🔗 Storage link created"
fi

# Jalankan migrate tanpa hapus data
php artisan migrate --force --seed
echo "📦 Database migrated"

# Jalankan perintah bawaan container (PHP-FPM + Nginx)
exec "$@"
