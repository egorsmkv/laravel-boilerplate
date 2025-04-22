# Laravel Boilerplate

[![check and test code](https://github.com/egorsmkv/laravel-boilerplate/actions/workflows/check-and-test.yml/badge.svg)](https://github.com/egorsmkv/laravel-boilerplate/actions/workflows/check-and-test.yml)
[![deps](https://github.com/egorsmkv/laravel-boilerplate/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/egorsmkv/laravel-boilerplate/actions/workflows/dependabot/dependabot-updates)

> [!NOTE]
> It must:
> - be on the latest version of Laravel
> - be lightweight to run with Podman
> - use modern technologies such as **PHP 8.4**, **Go 1.24**, **Python 3.13**, etc.

### Requirements

- [podman](https://github.com/moby/moby)
- [just](https://github.com/casey/just)
- [bun](https://bun.sh)

### Usage

```bash
# Pull newer images
just pull

# Build dev image
just build

# Copy Laravel environment variables file
cp -n dev-frontend.env apps/frontend/.env

# Up containers
just up

# Install dependencies, generate key, run migrations
just install

# Show logs
just logs

# Run queue worker
just queue

# Enter the apps container
just console

# Down containers
just down
```

### Commands

Install asset deps:

```bash
just bun-install
```

Build assets:

```bash
just bun-dev
just bun-prod
```

Update locales:

```bash
just lang-update
```

Apply fixes by [phpcs](https://github.com/squizlabs/PHP_CodeSniffer) and check code by [Larastan](https://github.com/larastan/larastan):

```bash
just check-code
```

Other useful commands:

```bash
just check-security
just lint
just fmt
```

### How to update components

- In `compose.yml` check new versions of images
- In `Containerfile` check new version of `php` image
  - Check a new version of php-zmq, phpredis
  - Check a new version of Caddy
- In the apps container run `composer update` / `composer outdated` to check new versions
- In the `apps/frontend` folder run:

```bash
podman run --rm -v .:/code -it node:20-alpine sh

cd /code/apps/frontend
npm -g install npm-check-updates
npm-check-updates --format group -i
```

### Misc

- Access `http://localhost/?SPX_KEY=dev&SPX_UI_URI=/` to enable PHP-SPX and see the profiling results;
- Use [dive](https://github.com/wagoodman/dive) to analyze Podman images;
- Use [grype](https://github.com/anchore/grype) to check security vulnerabilities.
