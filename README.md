# Laravel Boilerplate for Development

### Usage

Run the following commands to install this project:

```bash
# Create the app docker image
docker build --tag laravel_app:1.0 docker/dev

# Up containers
docker-compose -f docker-compose.dev.yml up

# Enter the container
docker exec -it laravel-boilerplate-dev-apps-1 bash

# Install required libraries
cd /app/frontend && composer install && php artisan telescope:install && npm install

# Copy Laravel environment variables file
cp .env.dev.example .env

# Generate "APP_KEY"
php artisan key:generate

# Apply migrations
php artisan migrate
```

### Useful commands

Start Vite in developer mode:

```bash
docker exec -it laravel-boilerplate-dev-apps-1 bash -c 'cd /app/frontend && npm run dev'
```
