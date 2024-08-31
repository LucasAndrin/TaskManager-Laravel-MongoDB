#!/bin/sh

# Check if composer.json exists
if [ -f composer.json ]; then
    composer install --no-interaction --optimize-autoloader
else
    echo "composer.json not found. Skipping Composer install."
fi

# Check if artisan exists before running Laravel commands
if [ -f artisan ]; then
    php artisan storage:link
    php artisan migrate
    php artisan optimize
else
    echo "artisan not found. Skipping Laravel commands."
fi

# Start PHP-FPM
php-fpm
