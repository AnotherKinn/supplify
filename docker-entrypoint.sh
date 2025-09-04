#!/bin/sh

echo "🚀 Starting Supplify Laravel App..."

# Hanya buat symbolic link storage kalau belum ada
if [ ! -d "/var/www/public/storage" ]; then
    php artisan storage:link
    echo "🔗 Storage link created"
fi

# Jalankan migrate (tanpa fresh) agar tidak hapus data
php artisan migrate --force
echo "📦 Database migrated"

# Jalankan perintah bawaan container (PHP-FPM + Nginx)
exec "$@"
