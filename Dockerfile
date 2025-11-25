# Use PHP 8.4.11 with FPM
FROM php:8.4.11-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (better caching)
COPY composer.json composer.lock ./

# Install backend dependencies without dev packages
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# Copy the rest of the application
COPY . .

# Generate optimized autoload files
RUN composer dump-autoload --optimize

# Copy Nginx config for Render
COPY deploy/render-nginx.conf /etc/nginx/sites-enabled/default

# Fix Laravel storage and cache permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80 for Nginx
EXPOSE 80

# Start Nginx + PHP-FPM
CMD service nginx start && php-fpm