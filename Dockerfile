# Use the official PHP-Apache base image
FROM php:8.2-apache

# Install dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y \
        libpq-dev \
        default-mysql-client \
        libpng-dev \
        libjpeg-dev \
        libonig-dev \
        libxml2-dev \
        unzip \
        zip \
        curl \
        git && \
    docker-php-ext-install mysqli pgsql pdo_pgsql

# Enable Apache modules (mod_rewrite for .htaccess)
RUN a2enmod rewrite

# Copy project files into Apache's root directory
COPY . /var/www/html/

# Set proper permissions (recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80
