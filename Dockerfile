# Use the official PHP-Apache image
FROM php:8.2-apache

# Install required dependencies and PostgreSQL extension
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pgsql pdo_pgsql

# Enable mod_rewrite (optional if you use .htaccess)
RUN a2enmod rewrite

# Copy all files from your project into the Apache web root
COPY . /var/www/html/

# Set proper permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
