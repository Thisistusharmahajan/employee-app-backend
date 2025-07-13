# Use PHP 8.1 with Apache
FROM php:8.1-apache

# Install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install intl mysqli pdo pdo_mysql zip \
    && docker-php-source delete

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files to working directory
COPY . /var/www/html

# Change DocumentRoot to /public for CodeIgniter 4
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Set proper permissions (optional, useful for writable folders)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
