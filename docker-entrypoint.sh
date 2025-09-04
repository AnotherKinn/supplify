#!/bin/sh

echo "🚀 Starting Supplify Laravel App..."

# Tunggu database siap (opsional, biar migration ga gagal)
echo "⏳ Waiting for database..."
until nc -z -v -w30 $DB_HOST $DB_PORT
do
  echo "Database not ready, retrying..."
  sleep 5
done
echo "✅ Database is ready!"

# Buat symbolic link storage kalau belum ada
if [ ! -d "/var/www/public/storage" ]; then
    php artisan storage:link
    echo "🔗 Storage link created"
fi

# Jalankan migrate fresh + seeder (gunakan --force biar jalan di production)
php artisan migrate:fresh --seed --force
echo "📦 Database migrated & seeded"

# Terakhir, jalankan perintah bawaan container
exec "$@"
