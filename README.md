# Laravel Boilerplate

> [!NOTE]
> It must:
>
> - be on the latest version of Laravel
> - be lightweight to run with Podman
> - use modern technologies such as **PHP 8.4**, **Go 1.25**, **Python 3.13**, etc.

### Requirements

- [podman](https://podman.io) >= 4.9
- [just](https://github.com/casey/just), [bun](https://bun.sh), [dockerfmt](https://github.com/reteps/dockerfmt), [dprint](https://github.com/dprint/dprint)

### Usage

```bash
# Pull newer images
just pull

# Build dev image
just build

# Copy Laravel environment variables file
cp dev-frontend.env apps/frontend/.env

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
- Update frontend libraries: `just update-frontend`

### Misc

- Access `http://localhost/?SPX_KEY=dev&SPX_UI_URI=/` to enable PHP-SPX and see the profiling results;
- Use [dive](https://github.com/wagoodman/dive) and [grype](https://github.com/anchore/grype) to analyze OCI images and check their security.
