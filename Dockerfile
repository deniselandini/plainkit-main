FROM php:8.2-apache

# Enable required extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy Kirby files
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port (optional, Render detects 8080 automatically)
EXPOSE 8080