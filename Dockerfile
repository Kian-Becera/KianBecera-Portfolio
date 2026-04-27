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
