FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libonig-dev libxml2-dev zip curl nginx netcat-openbsd \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath \
    && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Clear cache agar .env terbaru terbaca
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Copy nginx config
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port Nginx
EXPOSE 8080

ENTRYPOINT ["docker-entrypoint.sh"]

# Jalankan PHP-FPM + Nginx
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
