# Laravel Boilerplate

> [!NOTE]
> It must:
> - be on the latest version of Laravel
> - be lightweight to run with Docker
> - use modern technologies such as PHP 8.3, Go 1.21, Python 3.12, etc.

### Requirements

- Docker 25.x
- Task 3.x
- Bun 1.x

### Usage

```bash
# Build dev image
task build

# Remove builds
task build-prune

# Generate database certs
task certs-init

# Up containers
task up

# Copy Laravel environment variables file
cp -n dev-frontend.env apps/frontend/.env

# Install dependencies, generate key, run migrations
task install

# Run queue worker
task queue

# Enter the apps container
task console
```

### Useful commands

Fix permissions:

```bash
task fix-perms
```

Use Vite:

```bash
# Start dev server
task bun-dev

# Build for production
task bun-build
```

Update locales:

```bash
task lang-update
```

Apply fixes by phpcs:

```bash
task fix-phpcs
```

Analyse the code by [Larastan](https://github.com/larastan/larastan):

```bash
task phpstan
```

Check security vulnerabilities in dependencies:

```bash
task check-security
```

Create a new migration:

```bash
task console

migrate create -ext sql -dir database/migrations -seq create_test_table
```

Generate a command to up migrations:

```bash
php artisan app:gen-migrate-command
```

Generate a command to enter CockroachDB SQL shell:

```bash
php artisan app:gen-sql-shell-command
```

### Info

#### Database monitoring

- Access `http://localhost:8081` to enter the pgweb;
- Access `http://localhost:9080` to enter the CockroachDB UI.

#### Other

- Access `http://localhost/?SPX_KEY=dev&SPX_UI_URI=/` to enable PHP-SPX and see the profiling results.
- `task` is a command of [Taskfile](https://taskfile.dev) utility.

### Maintenance

- Read [UPDATE.md](https://github.com/egorsmkv/laravel-boilerplate/blob/main/UPDATE.md) to keep the project up to date;
- Use [dive](https://github.com/wagoodman/dive) to analyze Docker images;
- Use [grype](https://github.com/anchore/grype) to check security vulnerabilities.

### Alternatives

- https://github.com/egorsmkv/laravel-boilerplate-mariadb
- https://github.com/egorsmkv/laravel-boilerplate-pgsql
