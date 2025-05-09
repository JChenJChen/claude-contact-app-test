# First stage: Build the app image using the php-app Dockerfile
FROM php:8.2-fpm AS app-base
# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the application code from the current directory
COPY . /var/www/html

# Install application dependencies
# RUN composer install
RUN apt-get update && apt-get install -y git
# RUN apt-get install -y zip && apt-get install -y unzip
RUN composer install --prefer-dist

# Second stage: Build the queue worker
FROM app-base AS queue-worker

# Install Supervisor
RUN apt-get update && apt-get install -y supervisor

# Copy Supervisor configuration from the queue_worker directory
COPY .dev-ops/queue_worker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set the working directory
WORKDIR /var/www/html

# Run Laravel commands and Supervisor
CMD /bin/sh -c "php artisan config:cache && \
                php artisan route:cache && \
                supervisord -c /etc/supervisor/conf.d/supervisord.conf"
