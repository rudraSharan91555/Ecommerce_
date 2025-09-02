FROM php:8.3-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install system tools + PHP extensions
RUN apt-get update && apt-get install -y \
    unzip zip git curl libpng-dev libonig-dev libxml2-dev libzip-dev libjpeg-dev libfreetype6-dev libssl-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd soap

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel app
COPY ./app /var/www/html

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

# FROM php:8.3-apache

# # Enable Apache rewrite module
# RUN a2enmod rewrite

# # Install system tools + PHP extensions
# RUN apt-get update && apt-get install -y \
#     unzip zip git curl libpng-dev libonig-dev libxml2-dev libzip-dev libjpeg-dev libfreetype6-dev libssl-dev \
#     && docker-php-ext-install pdo pdo_mysql mbstring zip gd soap

# # Install Composer (copy from official image)
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Copy Laravel app code into container
# COPY ./app /var/www/html

# # Set working directory
# WORKDIR /var/www/html

# # Set permissions for Laravel
# RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# # Change Apache DocumentRoot to Laravel public folder
# RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
