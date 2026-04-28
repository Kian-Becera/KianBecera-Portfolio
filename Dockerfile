# ── Stage 1: build frontend assets ──────────────────────────────────────────
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json vite.config.js ./
COPY resources ./resources
RUN npm install && npm run build

# ── Stage 2: production PHP + Nginx image ────────────────────────────────────
FROM richarvey/nginx-php-fpm:3.1.6

COPY . .
# Bring in the compiled CSS/JS from the node stage
COPY --from=node-builder /app/public/build ./public/build

# Install PHP dependencies and set storage permissions at build time
# so the startup script cannot fail due to missing vendor/ or bad permissions
RUN composer install --no-dev --optimize-autoloader && \
    mkdir -p storage/framework/sessions \
             storage/framework/views \
             storage/framework/cache/data \
             storage/logs && \
    chown -R nginx:nginx storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
