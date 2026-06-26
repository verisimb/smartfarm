#!/bin/sh
set -e

# Link the storage directory if it doesn't exist
php artisan storage:link --exist-ok || true

# Run migrations if enabled via environment variable
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
fi

# Cache configuration, routes, and views for optimal production performance
echo "Caching config, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute the main command
exec "$@"
