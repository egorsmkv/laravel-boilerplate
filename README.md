# Laravel Boilerplate

> [!NOTE]
> It must:
> - be on the latest version of Laravel
> - be lightweight to run with Docker
> - use modern technologies such as [PHP 8.3][1], [Go 1.22][2], [Python 3.12][3], etc.

### Requirements

- [Moby](https://github.com/moby/moby) 26.x
- [Task](https://taskfile.dev) 3.x
- [Bun](https://bun.sh) 1.x

### Usage

```bash
# Generate certificates for CockroachDB
task certs-init

# Build dev image
task build

# Prune builds
task prune-builds

# Up containers
task up

# Show logs
task logs

# Copy Laravel environment variables file
cp -n dev-frontend.env apps/frontend/.env

# Install dependencies, generate key, run migrations
task install

# Run queue worker
task queue

# Enter the apps container
task console
```

### Commands

Build assets:

```bash
task bun-dev
task bun-prod
```

Update locales:

```bash
task lang-update
```

Apply fixes by [phpcs](https://github.com/squizlabs/PHP_CodeSniffer):

```bash
task fix-phpcs
```

Fix permissions:

```bash
task fix-perms
```

Analyse the code by [Larastan](https://github.com/larastan/larastan):

```bash
task phpstan
```

Check security vulnerabilities in dependencies:

```bash
task check-security
```

Create a new migration using [go-migrate](https://github.com/golang-migrate/migrate):

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

### Misc

- Access `http://localhost/?SPX_KEY=dev&SPX_UI_URI=/` to enable PHP-SPX and see the profiling results;
- Read [UPDATE.md](https://github.com/egorsmkv/laravel-boilerplate/blob/main/UPDATE.md) to keep the project up to date;
- Use [dive](https://github.com/wagoodman/dive) to analyze Docker images;
- Use [grype](https://github.com/anchore/grype) to check security vulnerabilities.

### Alternatives

- https://github.com/egorsmkv/laravel-boilerplate-mariadb
- https://github.com/egorsmkv/laravel-boilerplate-pgsql

[1]: https://hub.docker.com/layers/library/php/8.3.6-cli-alpine3.19/images/sha256-dc7d4d8248ec8c31bfa65ec964b7db7b34384cf9a3a16ee5fbc8bf25e29c7413?context=explore
[2]: https://hub.docker.com/layers/library/golang/1.22.2-alpine3.19/images/sha256-963da5f97ab931c0df6906e8c0ebc7db28c88d013735ae020f9558c3e6cf0580?context=explore
[3]: https://hub.docker.com/layers/library/python/3.12-alpine3.19/images/sha256-4cd9558bd358d0d25fe46ce38f01b34eb83171b9aa0a9be018701a8fece8854d?context=explore
