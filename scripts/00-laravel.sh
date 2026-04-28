#!/usr/bin/env bash
# No set -e — any failure here must NOT prevent PHP-FPM from starting.
# composer install is handled at Docker build time (see Dockerfile).

echo "Caching config..."
php artisan config:cache  || echo "[warn] config:cache failed — APP_KEY may not be set yet"

echo "Caching routes..."
php artisan route:cache   || echo "[warn] route:cache failed"

echo "Caching views..."
php artisan view:cache    || echo "[warn] view:cache failed"

echo "Bootstrap complete."
