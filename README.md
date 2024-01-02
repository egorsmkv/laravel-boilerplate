# Laravel Boilerplate for Development

### Usage

Run the following commands to install this project:

```bash
# Create the app docker image
docker build --tag laravel_app:1.0 .

# Up containers
docker compose up

# Enter the container
docker exec -it laravel-boilerplate-dev-apps-1 bash

# Install required libraries
cd /app/frontend && \
  composer install && \
  php artisan telescope:install && \
  npm install

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

Start queue worker:

```bash
docker exec -it laravel-boilerplate-dev-apps-1 php /app/frontend/artisan queue:listen -vvv
```

### Maintenance

Read the UPDATE.md file to keep the project up to date.
