FROM php:8.2-apache

# Enable required extensions
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install mbstring pdo pdo_mysql zip \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
# Enable Apache rewrite
RUN a2enmod rewrite

# Copy Kirby files
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port (optional, Render detects 8080 automatically)
EXPOSE 8080