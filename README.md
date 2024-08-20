# Laravel Boilerplate

> [!NOTE]
> It must:
> - be on the latest version of Laravel
> - be lightweight to run with Docker
> - use modern technologies such as **PHP 8.3**, **Go 1.23**, **Python 3.12**, etc.

### Requirements

- [Moby](https://github.com/moby/moby) 27.x
- [Task](https://taskfile.dev) 3.x
- [Bun](https://bun.sh) 1.x

### Usage

```bash
# Build dev image
task build

# Copy Laravel environment variables file
cp -n dev-frontend.env apps/frontend/.env

# Up containers
task up

# Install dependencies, generate key, run migrations
task install

# Show logs
task logs

# Run queue worker
task queue

# Enter the apps container
task console

# Down containers
task down
```

### Commands

Install asset deps:

```bash
task bun-install
```

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
task phpcs-fix
```

Analyse the code by [Larastan](https://github.com/larastan/larastan):

```bash
task phpstan
```

Other useful commands:

```bash
task check-security

task lint-dockerfile

task validate-and-format-caddyfile
```

### How to update components

- In `docker-compose.yml` check new versions of images
- In `Dockerfile` check new version of `php` image
  - Check a new version of php-zmq, phpredis
  - Check a new version of Caddy
- In the apps container run `composer update` / `composer outdated` to check new versions
- In the `apps/frontend` folder run:

```bash
docker run --rm -v .:/code -it node:20-alpine sh

$ npm -g install npm-check-updates
$ npm-check-updates --format group -i
```

### Misc

- Access `http://localhost/?SPX_KEY=dev&SPX_UI_URI=/` to enable PHP-SPX and see the profiling results;
- Use [dive](https://github.com/wagoodman/dive) to analyze Docker images;
- Use [grype](https://github.com/anchore/grype) to check security vulnerabilities.
