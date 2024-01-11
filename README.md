# Laravel Boilerplate for Development

> [!NOTE]  
> The idea of this project is simple: current boilerplate must `a)` be on the latest version of Laravel
> `b)` be lightweight to run with Docker `c)` to use modern technologies (PHP, PgSQL, etc).

### Requirements

- Docker Engine 24.x

### Usage

Run the following commands to install this project:

```bash
# Create the app docker image
docker build --tag laravel_app_dev:1.0 .

# Up containers
docker compose up

# Copy Laravel environment variables file
cp -n dev-frontend.env apps/frontend/.env

# Install required libraries
docker exec -it apps_dev bash -c 'composer install && php artisan telescope:install && bun install'

# Generate "APP_KEY"
docker exec -it apps_dev php artisan key:generate

# Apply migrations
docker exec -it apps_dev php artisan migrate
```

### Useful commands

Use Vite:

```bash
# Start dev server
docker exec -it apps_dev bun run dev

# Build for production
docker exec -it apps_dev bun run build
```

Start queue worker:

```bash
docker exec -it apps_dev php artisan queue:listen -vvv
```

Apply fixes by phpcs:

```bash
docker exec -it apps_dev vendor/bin/php-cs-fixer fix --config phpcs.php
```

Analyse the code by [Larastan](https://github.com/larastan/larastan):

```bash
docker exec -it apps_dev ./vendor/bin/phpstan analyse
```

Check usage of resources:

```bash
docker stats --no-stream
```

Check security vulnerabilities in dependencies:

```bash
docker exec -it apps_dev vendor/bin/security-checker security:check composer.lock
docker exec -it apps_dev composer audit
```

### Database monitoring

Access `http://localhost:8888` to enter the temboard.

### Profiling

Access `http://localhost/?SPX_KEY=dev&SPX_UI_URI=/` to enable PHP-SPX and see the profiling results.

### Maintenance

Read the UPDATE.md file to keep the project up to date.
