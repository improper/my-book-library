# Use the bitnami/laravel as a base image
FROM bitnami/laravel:11.6.1

# Set working directory
WORKDIR /app

# Copy Laravel code to container
COPY ./ /app

# Install dependencies via Composer
RUN composer install --no-dev --optimize-autoloader

# Provide .env file (if you have one locally to copy)
RUN touch .env
RUN echo "APP_KEY=" > .env

# Generate the Laravel app key
RUN php artisan key:generate

# Ensure DB is available
RUN mkdir -p database/db
RUN touch database/db/database.sqlite

# Expose the web port (aligning with the Bitnami Dockerfile)
EXPOSE 3000

# Set default values
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_TIMEZONE=UTC
ENV APP_URL=
ENV LOG_LEVEL=debug
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=database/db/database.sqlite

# Make public assets available to web requests
RUN php artisan storage:link

# Set the command to run the Laravel application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=3000"]
