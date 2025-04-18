# Use the official PHP image as a base image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/laravel-si-pencatatan-besi-tua

# Install system dependencies
RUN apt-get update && apt-get install -y \
  build-essential \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  locales \
  zip \
  jpegoptim optipng pngquant gifsicle \
  vim \
  unzip \
  git \
  curl \
  libzip-dev \
  libpq-dev \
  libonig-dev \
  software-properties-common \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl

# Install Node.js (Latest version using NodeSource)
# RUN curl -sL https://deb.nodesource.com/setup_current.x | bash - \
#   && apt-get install -y nodejs

# Install latest npm
# RUN npm install -g npm@latest

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Composer Install
COPY composer.json composer.lock ./

# Install composer dependencies
# RUN composer install --no-scripts --no-autoloader --prefer-dist --no-interaction

# Install Node.js dependencies
# COPY package.json package-lock.json ./

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy the existing application directory contents to the working directory
COPY . .

# Fix permissions for the application directory and node_modules
RUN chown -R www:www /var/www/laravel-si-pencatatan-besi-tua
RUN chmod -R 775 /var/www/laravel-si-pencatatan-besi-tua

# Change current user to www
USER www

# Install NPM dependencies
# RUN npm install
# RUN npm install laravel-mix@latest

# Run npm dev script
# RUN npm run dev

# Run Laravel migrations and seed the database (Make sure .env is configured correctly for DB)
# RUN php artisan migrate --seed

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
