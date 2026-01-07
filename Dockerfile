# 1. Use the official PHP 8.2 image
FROM php:8.2-cli

# 2. Install system dependencies (Git, Zip, PostgreSQL drivers)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    curl \
    gnupg

# 3. Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_pgsql mbstring bcmath

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Install Node.js & NPM (required for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 6. Set the working directory
WORKDIR /var/www/html

# 7. Copy all project files into the container
COPY . .

# 8. Install PHP and Node dependencies & Build Assets
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# 9. Set permissions (Critical for Laravel)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Start the application (Removed migration for safety)
CMD php artisan serve --host=0.0.0.0 --port=$PORT