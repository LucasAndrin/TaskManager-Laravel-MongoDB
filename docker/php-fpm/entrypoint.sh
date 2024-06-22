#!/bin/bash

cd /var/www/html

# Check if composer.json exists
if [ -f composer.json ]; then
    composer install --no-interaction --optimize-autoloader
else
    echo "composer.json not found. Skipping Composer install."
fi

# Check if artisan exists before running Laravel commands
if [ -f artisan ]; then
    php artisan migrate
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
else
    echo "artisan not found. Skipping Laravel commands."
fi

# Start PHP-FPM
php-fpm
