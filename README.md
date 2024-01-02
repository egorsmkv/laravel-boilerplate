# Laravel Boilerplate for Development

### Usage

Run the following commands to install this project:

```bash
# Create the app docker image
docker build --tag laravel_app:1.0 .

# Up containers
docker compose up

# Copy Laravel environment variables file
cp -n dev-frontend.env apps/frontend/.env

# Set apps container name
APPS_CONTAINER=laravel-boilerplate-dev-apps-1 # bash
set APPS_CONTAINER laravel-boilerplate-dev-apps-1 # fish

# Install required libraries
docker exec -it $APPS_CONTAINER bash -c 'cd /app/frontend && composer install && php artisan telescope:install && npm install'

# Generate "APP_KEY"
docker exec -it $APPS_CONTAINER php /app/frontend/artisan key:generate

# Apply migrations
docker exec -it $APPS_CONTAINER php /app/frontend/artisan migrate
```

### Useful commands

Start Vite in developer mode:

```bash
docker exec -it $APPS_CONTAINER bash -c 'cd /app/frontend && npm run dev'
```

Start queue worker:

```bash
docker exec -it $APPS_CONTAINER php /app/frontend/artisan queue:listen -vvv
```

### Maintenance

Read the UPDATE.md file to keep the project up to date.
