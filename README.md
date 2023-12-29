# Laravel Boilerplate for Development

### Usage

Fill the `dev.env` file before the start.

Next, run the following commands:

```bash
# Create the app docker image
docker build --tag laravel_app:1.0 docker/apps

# Up containers
docker-compose -f docker-compose.dev.yml up

# Enter the container
docker exec -it laravel-boilerplate-dev-apps-1 bash

# Install required libraries
cd /app/frontend && composer install && npm install

# Copy Laravel environment variables file
cp .env.dev.example .env

# Generate "APP_KEY"
php artisan key:generate

# Apply migrations
php artisan migrate
```
