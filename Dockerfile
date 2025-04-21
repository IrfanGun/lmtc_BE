FROM php:8.2-apache-bullseye

# Install extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev unzip curl libpng-dev libonig-dev libxml2-dev zip git \
    && docker-php-ext-install pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Run composer install
RUN composer install --no-dev --optimize-autoloader

# Laravel cache
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Apache rewrite
RUN a2enmod rewrite

# Apache config
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
